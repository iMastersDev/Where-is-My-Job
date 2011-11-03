<?
class XmlToArray
{
    
    var $xml='';
    var $categories_relation; 
    
    function XmlToArray()
    {
		return true;
    }
    
    
    function _struct_to_array($values, &$i)
    {
        $child = array();
        if (isset($values[$i]['value'])) array_push($child, $values[$i]['value']);
        
        while ($i++ < count($values)) {
            switch ($values[$i]['type']) {
                case 'cdata':
                array_push($child, $values[$i]['value']);
                break;
                
                case 'complete':
                    $name = $values[$i]['tag'];
                    if(!empty($name)){
						if($name == 'category'){
							$child[$name][$i] = ($values[$i]['value'])?($values[$i]['value']):'';
						}
						else{
                	    	$child[$name] = ($values[$i]['value'])?($values[$i]['value']):'';
						}
                   		if(isset($values[$i]['attributes'])) {                    
							if($name == 'category'){
								$child[$name][$i] = $values[$i]['attributes'];
							}
							elseif($name == 'item'){
                        		$child[$name] = $values[$i]['attributes'];
							}

                    	}
                	}    
              break;
                
                case 'open':
                    $name = $values[$i]['tag'];
                    $size = isset($child[$name]) ? sizeof($child[$name]) : 0;
                    $child[$name][$size] = $this->_struct_to_array($values, $i);
                break;
                
                case 'close':
                return $child;
                break;
            }
        }
        return $child;
    }
    function createArray($xml,$type=false){
		$this->xml = $xml;
        $values = array();
        $index  = array();
        $array  = array();
        $parser = xml_parser_create();
        xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
        xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
        xml_parse_into_struct($parser, $xml, $values, $index);
        xml_parser_free($parser);
        $i = 0;
        $name = $values[$i]['tag'];
        $array[$name] = isset($values[$i]['attributes']) ? $values[$i]['attributes'] : '';
		$array[$name] = $this->_struct_to_array($values, $i);
       	return $array;
    }

	function getXmlData($handle){
		if ($handle) {
			 while (!feof($handle)) {
    	   		$xml_data.= fgets($handle, 4096);
   			}
   			fclose($handle);
		}
			return $xml_data;
	}

 
}
?> 
