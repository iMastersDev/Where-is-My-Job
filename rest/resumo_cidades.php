<?php
   $sql = "SELECT c.NM_CIDADE, VL_LATITUDE, VL_LONGITUDE, SUM(QT_VAGAS) as QT_VAGAS FROM s_catho c INNER JOIN s_cidades cd ON c.NM_CIDADE = cd.NM_CIDADE GROUP BY 1,2,3 ORDER BY 4 DESC;";
   require_once("../extras/basico.php");  
      $rs    = ExecutaQuery($sql, true);
      for($i = 0; $i < mysql_num_rows($rs); $i++)
      {
         $row = mysql_fetch_array($rs);
        $content[] =  array( 

                     "nm_cidade"       =>  $row["NM_CIDADE"], 
                     "vl_latitude"     =>  $row["VL_LATITUDE"], 
                     "vl_longitude"    =>  $row["VL_LONGITUDE"], 
                     "qt_vagas"        =>  $row["QT_VAGAS"],  
                     "icone"           =>  "http://localhost/zeetha/open/iconsharp/".$row["QT_VAGAS"].".png",
                     "distancia"       =>  $row["VL_DISTANCIA"]);
         
      }
      $result = (json_encode(array("data" => $content)));
      //echo $result;
      
      $get_callback = $_GET['callback'];
      if($get_callback != "")
         echo $get_callback."(".$result.");"; 
      else
         echo $result;  
?>