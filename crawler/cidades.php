<?php

?>
<html>
<html>
   <head>
      <meta http-equiv="content-type" content="text/html; charset=utf-8">
      <meta name="generator" content="PSPad editor, www.pspad.com">
      <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
      <script src="http://code.jquery.com/jquery-1.6.4.min.js" type="text/javascript"></script>
   </head>   
   <body>
      <?php
         require_once("../extras/basico.php");
         $sql = "SELECT * FROM `s_cidades` WHERE VL_LATITUDE is NULL;";
         $rs    = ExecutaQuery($sql, true);
         for($i = 0; $i < mysql_num_rows($rs); $i++)
         {
            $row = mysql_fetch_array($rs);
            echo "<input type='checkbox' id='cb_".makeURL($row["NM_CIDADE"])."'>".$row["NM_CIDADE"]."<br>";
         }
      ?>
      <script type="text/javascript" >
         var geocoder = new google.maps.Geocoder();
         <?php
            $sql = "SELECT * FROM `s_cidades` WHERE VL_LATITUDE is NULL LIMIT 0, 1000;";
            $rs    = ExecutaQuery($sql, true);
            for($i = 0; $i < mysql_num_rows($rs); $i++)
            {
               $row = mysql_fetch_array($rs);
               echo "Localiza(\"{$row['NM_CIDADE']}\", 'cb_".makeURL($row["NM_CIDADE"])."');\n"; 
            }
         ?>
         Localiza("SAO PAULO", 'cb_sao_paulo');
         function Localiza(Cidade, CbId)
         {
            geocoder.geocode({ 'address': Cidade}, function(results, status) 
            {        
               if (status == google.maps.GeocoderStatus.OK) 
               {
                  $('#'+CbId).attr('checked', true);
                  //alert(results[0].geometry.location.lat());
                  var lat = results[0].geometry.location.lat();
                  var lng = results[0].geometry.location.lng();
                  var script = document.createElement("script");        
                  script.setAttribute("src","./salva_cidades.php?cidade="+Cidade+"&lat="+lat+"&lng="+lng);
                  script.setAttribute("type","text/javascript"); 
                  document.body.appendChild(script);       
                  
               }
                  
               else
               {
                  //alert("Não foi possível encontrar o endereço digitado. Tente digitar algo mais especifico ou o CEP da região. ERROR_CODE:" + status);
                  $('#'+CbId).attr('checked', true);
               }
            });           
         }
         

      </script>
   </body>
   
</html>