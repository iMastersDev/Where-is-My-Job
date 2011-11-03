<?php
//------------------------------------------------------------------------------
// Nome: ExecutaQuery
// Parametros
//    - SQL       - Query a ser executada
//    - enconde   - Codifica o resultado para UTF-8. Padrao falso.
//    - id        - Retorna o ultimo ID inserido, no lugar da consulta. 
//------------------------------------------------------------------------------   
  function ExecutaQuery($sql, $encode=false, $id=false)
  {   
    include 'conexao_hackaton.php';
  
 	 if (!$link = mysql_connect($host, $user, $pass)) 
    {
      die('Invalid connection: ' . mysql_error());
      //exit;
    }
    //POG - Mata a conexao e cria de novo de tempos em tempos
    if(rand(1, 100) <= 25)
    {
                           
       mysql_close($link);
    	 if (!$link = mysql_connect($host, $user, $pass)) 
       {
         die('Invalid connection: ' . mysql_error());
         //exit;
       }      
    }
    
    mysql_query("database $db");
    if (!mysql_select_db($db, $link)) 
    {
       die('Invalid database: ' . mysql_error());
       //exit;
    }
    //mysql_query("SET CHARACTER SET utf-8");
    if($encode)
      mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
    $result = mysql_query($sql, $link);
    if (!$result) 
    {
      if($id)
         return -1;          
      echo ('Invalid query: ' . mysql_error());
    }
    if($id) //$result = mysql_insert_id($link)
      return mysql_insert_id($link);      
    else
      return $result;
    //mysql_close($link);
    //return $result;
         
  }
//------------------------------------------------------------------------------
// Nome: Trata o nome da variavel para url amigaveis
// Resumo: Retorna o caminho completo até o arquivo desejado
// Parametros
//    - $url     - Nome do arquivo, como se tivesse sido incluido na raiz
//    
//------------------------------------------------------------------------------
function MakeUrl($Url)
{
   $a = array(' '=>'_','.'=>'', '!'=>'', '?'=>'', ','=>'', ';'=>'', ':'=>'', '^'=>'', '`'=>'', '´'=>'', '\''=>'', '\"'=>'', '%'=>'', '$'=>'', "," => '');
   $Url = strtolower(RemoveAcentos($Url));
   return str_replace(array_keys($a), array_values($a), $Url);      
}
//------------------------------------------------------------------------------  
function RemoveAcentos($Msg)
{
$a = array(
     'Â'=>'A',
     'À'=>'A',
     'Á'=>'A',
     'Ä'=>'A',
     'Ã'=>'A', 
     'â'=>'a',
     'à'=>'a',
     'á'=>'a',
     'ä'=>'a',
     'ã'=>'a',
     'Ê'=>'E',
     'È'=>'E',
     'É'=>'E',
     'Ë'=>'E', 
     'ê'=>'e',
     'è'=>'e',
     'é'=>'e',
     'ë'=>'e',            
     'Î'=>'I',
     'Ì'=>'I',
     'Í'=>'I',
     'Ï'=>'I', 
     'î'=>'i',
     'ì'=>'i',
     'í'=>'i',
     'ï'=>'i',            
     'Ô'=>'O',
     'Ò'=>'0',
     'Ó'=>'0',
     'Ö'=>'0',
     'Õ'=>'0', 
     'ô'=>'o',
     'ò'=>'o',
     'ó'=>'o',
     'ö'=>'o',
     'õ'=>'o',
     'Û'=>'U',
     'Ù'=>'U',
     'Ú'=>'U',
     'Ü'=>'U', 
     'û'=>'u',
     'ù'=>'u',
     'ú'=>'u',
     'ï'=>'u',
 	  'ç'=>'c',
	  'Ç'=> 'C',
	  'ª'=> 'o',
	  'º'=> 'a',
	  'Ñ'=> 'N',
	  'ñ'=> 'n',
     );
      // Tira o acento pela chave do array	
	 return str_replace(array_keys($a), array_values($a), $Msg);
}
//------------------------------------------------------------------------------------------------------
function AjustaNome($String)
{
   $pre_de   = array("Da ", "De ", "E " , "Do ", "Del ", "Das ", "Dos ");
   $pre_para = array("da ", "de ", "e ", "do ", "del ", "das ", "dos ");
   //$nm_tela  = strtolower($String);
   $nm_tela  = utf8_encode(ucwords(strtolower(utf8_decode($String))));
   $nm_tela  = ucwords($nm_tela);
   $nm_tela  = str_replace($pre_de, $pre_para, $nm_tela);
   return $nm_tela;
}

//------------------------------------------------------------------------------------------------------
   function isUTF8($str) 
   {
        if ($str === mb_convert_encoding(mb_convert_encoding($str, "UTF-32", "UTF-8"), "UTF-8", "UTF-32")) {
            return true;
        } else {
            return false;
        }
    }
//------------------------------------------------------------------------------------------------------    
   function utf8_super_encode($str, $name=true)
   {
      //There are prepostion for Brazilian names. You can adapt it for any language
      // as you need it.
      $pre_de   = array("Da ", "De ", "E " , "Do ", "Del ", "Das ", "Dos ");
      $pre_para = array("da ", "de ", "e ", "do ", "del ", "das ", "dos ");
      //Thanks for PHP.NET 
      $utf8     = isUTF8($str);
      //echo "<script>alert('$utf8');</script>";
      //Converting....
      if($utf8)    $str_utf8   = $str;
      else         $str_utf8   = mb_convert_encoding($str, "utf-8");
      
      //applying captlizing just for first       
      if($name) 
      {
         $str_utf8 = utf8_encode(ucwords(strtolower(utf8_decode($str_utf8))));
         $str_utf8 = str_replace($pre_de, $pre_para, $str_utf8);
      }
      
      return utf8_decode($str_utf8);              
   }
//------------------------------------------------------------------------------
// Nome: TrocaEndereco
// Resumo: Atualiza a endereco para buscar na base de dados e evitar duplicidade 
// Parametros
//    - $Str     - String contendo curingas 
//------------------------------------------------------------------------------   
function TrocaEndereco($Endereco)
{
   $Endereco = str_replace("R.",       "RUA",      $Endereco);
   //$Endereco = str_replace("RUA",      "R.",       $Endereco);
   
   $Endereco = str_replace("AV.",      "AVENIDA",  $Endereco);
   //$Endereco = str_replace("AVENIDA",  "AV.",      $Endereco);

   $Endereco = str_replace("AV.",      "AVENIDA",  $Endereco);
   //$Endereco = str_replace("AVENIDA",  "AV.",      $Endereco);     

   $Endereco = str_replace("QD.",      "QUADRA",   $Endereco);
   //$Endereco = str_replace("QUADRA",   "QD.",      $Endereco);     

   $Endereco = str_replace("DR.",      "DOUTOR",   $Endereco);
   //$Endereco = str_replace("DOUTOR",   "DR.",      $Endereco);     


   $Endereco = str_replace("LT.",      "LOTE",     $Endereco);
   //$Endereco = str_replace("LOTE",     "LT.",      $Endereco);
   
   $Endereco = str_replace("AVENIDA AVENIDA",  "AVENIDA",      $Endereco);
   $Endereco = str_replace("RUA RUA",          "RUA",          $Endereco);
   $Endereco = str_replace("ESTRADA ESTRADA",          "ESTRADA",          $Endereco); 
   $Endereco = str_replace("LAGO LAGO",          "LAGO",          $Endereco);
   $Endereco = str_replace("RODOVIA RODOVIA",          "RODOVIA",          $Endereco);
   $Endereco = str_replace("ENDERECO ENDERECO",          "ENDERECO",          $Endereco);            
} 
//--------------------------------------------------------------------------
function Media($Array)
{
   $sum = 0;
   foreach ($Array as $key=>$value) 
   {
      $sum += $value;	
   }
   return $sum/count($Array);
}
//--------------------------------------------------------------------------
// DesvioPadrao - Calcula o desvio padrao do array
// $Array - lista de valores
//--------------------------------------------------------------------------
function DesvioPadrao($Array)
{
   $media = Media($Array);
   $sum = 0;
   foreach ($Array as $key=>$value) 
   {
      $sum += (($value - $media)*($value - $media));
      //echo "<br>$value $media ".($value - $media)." ".(($value - $media)^2);	
   }
   //echo $sum;
   
   return sqrt($sum/(count($Array) - 1));
}
//--------------------------------------------------------------------------
// ChecaIndice - Verifica se ja esta inserido no banco
// $Array - lista de valores
//--------------------------------------------------------------------------
function ChecaIndice($cd_vaga, $nm_cidade)
{
	$sql = "SELECT * FROM s_catho WHERE CD_VAGA = $cd_vaga AND NM_CIDADE = '$nm_cidade'"; 
	$result = ExecutaQuery($sql);
	if(mysql_num_rows($result) > 0) return TRUE;
   return FALSE;
}
?>