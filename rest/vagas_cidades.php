<?php
   $get_lat      = $_GET['lat'];
   $get_lon      = $_GET['lon'];    
   require_once("../extras/basico.php");  
   if($get_lat == "" || $get_lon == "")
   {
        $get_lat = -23.5489;
        $get_lon = -46.6388;
   }
  $sql_max_dist = 100000; 
  $sql= "
      SELECT
         c.*,
         1000*6371*2*ATAN2(SQRT(sin((($get_lat * 3.1415926535897932384626433832795 / 180 ) - (cd.VL_LATITUDE * 3.1415926535897932384626433832795 / 180))/2)*sin((($get_lat * 3.1415926535897932384626433832795 / 180 ) - (cd.VL_LATITUDE * 3.1415926535897932384626433832795 / 180))/2) + cos($get_lat * 3.1415926535897932384626433832795 / 180)*cos(cd.VL_LATITUDE * 3.1415926535897932384626433832795 / 180)*sin(((cd.VL_LONGITUDE * 3.1415926535897932384626433832795 / 180) - ($get_lon * 3.1415926535897932384626433832795 / 180))/2)*sin(((cd.VL_LONGITUDE * 3.1415926535897932384626433832795 / 180) - ($get_lon * 3.1415926535897932384626433832795 / 180))/2)), SQRT(1-(sin((($get_lat * 3.1415926535897932384626433832795 / 180 ) - (cd.VL_LATITUDE * 3.1415926535897932384626433832795 / 180))/2)*sin((($get_lat * 3.1415926535897932384626433832795 / 180 ) - (cd.VL_LATITUDE * 3.1415926535897932384626433832795 / 180))/2) + cos($get_lat * 3.1415926535897932384626433832795 / 180)*cos(cd.VL_LATITUDE * 3.1415926535897932384626433832795 / 180)*sin(((cd.VL_LONGITUDE * 3.1415926535897932384626433832795 / 180) - ($get_lon * 3.1415926535897932384626433832795 / 180))/2)*sin(((cd.VL_LONGITUDE * 3.1415926535897932384626433832795 / 180) - ($get_lon * 3.1415926535897932384626433832795 / 180))/2)))) as VL_DISTANCIA
      FROM
         s_catho  c INNER JOIN s_cidades cd ON cd.NM_CIDADE = cd.NM_CIDADE
      WHERE
         1000*6371*2*ATAN2(SQRT(sin((($get_lat * 3.1415926535897932384626433832795 / 180 ) - (cd.VL_LATITUDE * 3.1415926535897932384626433832795 / 180))/2)*sin((($get_lat * 3.1415926535897932384626433832795 / 180 ) - (cd.VL_LATITUDE * 3.1415926535897932384626433832795 / 180))/2) + cos($get_lat * 3.1415926535897932384626433832795 / 180)*cos(cd.VL_LATITUDE * 3.1415926535897932384626433832795 / 180)*sin(((cd.VL_LONGITUDE * 3.1415926535897932384626433832795 / 180) - ($get_lon * 3.1415926535897932384626433832795 / 180))/2)*sin(((cd.VL_LONGITUDE * 3.1415926535897932384626433832795 / 180) - ($get_lon * 3.1415926535897932384626433832795 / 180))/2)), SQRT(1-(sin((($get_lat * 3.1415926535897932384626433832795 / 180 ) - (cd.VL_LATITUDE * 3.1415926535897932384626433832795 / 180))/2)*sin((($get_lat * 3.1415926535897932384626433832795 / 180 ) - (cd.VL_LATITUDE * 3.1415926535897932384626433832795 / 180))/2) + cos($get_lat * 3.1415926535897932384626433832795 / 180)*cos(cd.VL_LATITUDE * 3.1415926535897932384626433832795 / 180)*sin(((cd.VL_LONGITUDE * 3.1415926535897932384626433832795 / 180) - ($get_lon * 3.1415926535897932384626433832795 / 180))/2)*sin(((cd.VL_LONGITUDE * 3.1415926535897932384626433832795 / 180) - ($get_lon * 3.1415926535897932384626433832795 / 180))/2)))) < $sql_max_dist 
      GROUP BY
         1
      ORDER BY
         3,2
      LIMIT 0, 100";
      $rs    = ExecutaQuery($sql, true);
      for($i = 0; $i < mysql_num_rows($rs); $i++)
      {
         $row = mysql_fetch_array($rs);
         $content[] =  array( 
                              "cd_vaga"         =>  $row["CD_VAGA"], 
                              "nm_vaga"         =>  $row["NM_VAGA"], 
                              "dc_vaga"         =>  $row["DC_VAGA"], 
                              "nm_empresa"      =>  $row["NM_EMPRESA"],  
                              "dt_vaga"         =>  $row["DT_VAGA"], 
                              "dc_area"         =>  $row["DC_AREA"], 
                              "vl_link"         =>  $row["VL_LINK"], 
                              "nm_cidade"       =>  $row["NM_CIDADE"], 
                              "qt_vagas"        =>  $row["QT_VAGAS"],  
                              "distancia"       =>  $row["VL_DISTANCIA"]);
      }
      $result = (json_encode(array("data" => $content)));
      echo $result;



?>