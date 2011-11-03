<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
   <head>
      <meta http-equiv="content-type" content="text/html; charset=UTF-8">
      <meta name="generator" content="PSPad editor, www.pspad.com">
      <title>Hackaton - Cidades das vagas</title>
   </head>
   <body>
      <?php
      	 $per_page = 500;
      	 $page = $_GET['page'];
      	 
      	 if($page == "") $page = 1;
         require_once("../extras/xml2array_class.php");
         require_once("../extras/basico.php");
         
         $xmlClass = new XmlToArray();
         $url = "http://afiliados.catho.com.br/BuscaVagaXML.php?perfil=1&area=47&nivel=4&estado=25&pagina={$page}&total={$per_page}";
         //echo $url;
         $handleiItems  = fopen($url, "r");
         $Items         = $xmlClass->getXmlData($handleiItems);
         $arrayVagas    = $xmlClass->createArray($Items);
         $total_vagas   = $arrayVagas['listing']['totalvagas'];
         $completo 			= $page * $per_page / $total_vagas;
         echo number_format($completo*100, 2)."%<br>";
         if(sizeof($arrayVagas['listing']['vacant']) > 0)
         {      
	         foreach($arrayVagas['listing']['vacant'] as $key=>$job)
	         {
	            //title
	            //date 
	            //company
	            //description
	            //branch
	            //link
	            //id  campo calculado
	            
	            ///////outro foreach
	            //cidade
	            //vagas
	            
	           
	            $nm_vaga    = mysql_real_escape_string(utf8_decode($job['title'])); 
	            $dc_vaga    = mysql_real_escape_string(utf8_decode($job['description'])); 
	            $nm_empresa = mysql_real_escape_string(utf8_decode($job['company'])); $job['company'];  
	            //$dt_vaga    = $job['link']; 
              $dt_vaga    = substr($job['date'], 6, 4)."-".substr($job['date'], 3, 2)."-".substr($job['date'], 0, 2);
	            $dc_area    = mysql_real_escape_string(utf8_decode($job['branch'])); $job['branch'];  
	            $vl_link    = urldecode($job['link']); 
	            
	            $cd_vaga    = rand(); 
	            
	            $cd_vaga = substr($vl_link, strpos($vl_link, 'vag_id=')+7);
	
	            foreach ($job['city'] as $field => $value) 
	            {
	            	$nm_cidade = mysql_real_escape_string(utf8_decode($value['name'])); 
	            	$qt_vaga   = $value['amount'];
	            	//`CD_VAGA`, `NM_VAGA`, `DC_VAGA`, `NM_EMPRESA`, `DT_VAGA`, `DC_AREA`, `VL_LINK`, `NM_CIDADE`, `QT_VAGAS`
	            	$sql = "INSERT INTO s_catho VALUES ($cd_vaga, '$nm_vaga', '$dc_vaga','$nm_empresa', '$dt_vaga', '$dc_area', '$vl_link', '$nm_cidade', '$qt_vaga')"; 
	              //echo $sql."\n";
                  if(!ChecaIndice($cd_vaga, $nm_cidade)) ExecutaQuery($sql);
	               //echo $cd_vaga."-".$vl_link."<br>\n";
	            }
	         }
	         $page++;
	         echo "<script> document.location = 'catho.php?page={$page}';</script>";
	       }
      ?>
   
   </body>
</html>
