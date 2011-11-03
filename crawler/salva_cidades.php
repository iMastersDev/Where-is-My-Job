<?php
   $cidade =  mysql_real_escape_string($_GET['cidade']);
   $lat    = $_GET['lat'];
   $lng    = $_GET['lng'];
   
   require_once("../extras/basico.php");
  
  

   //$sql = "INSERT INTO s_cidades2 ('{$cidade}', '$lat', '$lng')";
   $sql = "UPDATE s_cidades SET VL_LATITUDE = $lat WHERE NM_CIDADE = '{$cidade}'";
   echo $sql;
   ExecutaQuery($sql);

   $sql = "UPDATE s_cidades SET VL_LONGITUDE = $lng WHERE NM_CIDADE = '{$cidade}'";
   ExecutaQuery($sql);
   
?>