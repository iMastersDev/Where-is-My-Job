<html>
   <head>
      <meta http-equiv="content-type" content="text/html; charset=utf-8">
      <meta name="generator" content="PSPad editor, www.pspad.com">
      <title>Hackaton - Luciano Camilo</title>
      <style>
         #divMapa
         {
            background: #FF0000;
            width: 620px;
            height: 620px;
            border: 2px solid black;
         }
         #divColuna
         {
            background: #FFFFFF;
            height: 600px;
            flex-box:1;
            -webkit-box-flex: 1;   
            overflow: scroll;
            border: 2px solid black;
            padding: 10px;
            margin: 5px;            
         }
         #divMain
         {
            display: -webkit-box;
            -webkit-box-orient: horizontal;
            -webkit-box-pack: center;
            -webkit-box-align: center;
            
            display: -moz-box;
            -moz-box-orient: horizontal;
            -moz-box-pack: center;
            -moz-box-align: center;
            
            display: box;
            box-orient: horizontal;
            box-pack: center;
            box-align: center;
         }
      </style> 
      <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false">    </script>
      <script src="http://code.jquery.com/jquery-1.6.4.min.js" type="text/javascript"></script>
              
   </head>
   <body>
      <!-- <div id="divColunaHeader">ad</div> -->
      <div id="divMain">
         <div id="divMapa">           
            <?php
            echo "Hello, Hackaton";
            ?>     
            asdasd
         </div>  
         <div id="divColuna">
            teste
         </div>
      </div>
   </body>
   <script>
   //Global Var (pog)
   var saopaulo            = new google.maps.LatLng(-23.5489, -46.6388);
   var map;
   var myOptions = 
   {
      zoom: 11,
      scaleControl: true,
      mapTypeId: google.maps.MapTypeId.ROADMAP
   };
   
   
   //Functions 
   //--------------------------------------------------------------------------  
   function initialize() 
   {   
      map         = new google.maps.Map(document.getElementById("divMapa"), myOptions);
      map.setCenter(saopaulo);
      google.maps.event.addListener(map, 'idle', function() 
      {
         var center = map.getCenter();
         
                  var script = document.createElement("script");        
                  script.setAttribute("src","./rest/busca_cidades.php?lat="+center.lat()+"&lon="+center.lng()+"&callback=MontaLista");
                  script.setAttribute("type","text/javascript"); 
                  document.body.appendChild(script);     
                  
                  

                  
         //$("#divColunaHeader").html("procurar por empregos próximos a ("+center.lat()+", "+center.lng()+")");
      });
      
      var script = document.createElement("script");        
      script.setAttribute("src","./rest/resumo_cidades.php?callback=MostraResumo");
      script.setAttribute("type","text/javascript"); 
      document.body.appendChild(script);                     
                  
   }
   //--------------------------------------------------------------------------
   function MostraResumo(oArg)
   {
      for(var i = 0; i < oArg.data.length ; i++) 
      {
         var myLatLng = new google.maps.LatLng(oArg.data[i].vl_latitude, oArg.data[i].vl_longitude);
         var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            flat: false,
            visible: true,
            title: oArg.data[i].nm_cidade,               
            icon: oArg.data[i].icone
         });
         google.maps.event.addListener(marker, 'click', function() 
         {
            map.panTo(this.getPosition());
            //this.infowindow.open(map, this); 
         }); 
      }
 
   }
   //--------------------------------------------------------------------------
   function MontaLista(oArg)
   {
      var aData = new Array();
      html = "";
      for(var i = 0; i < oArg.data.length ; i++) 
      {
         if(oArg.data[i].qt_vagas == 1)
            html += "<b><a target='_blank' href='"+oArg.data[i].vl_link+"'>"+oArg.data[i].nm_vaga+"</a> ("+oArg.data[i].qt_vagas+" vaga de "+oArg.data[i].dc_area+")</b> - "+oArg.data[i].dc_vaga+"<br>";
         else
            html += "<b><a target='_blank' href='"+oArg.data[i].vl_link+"'>"+oArg.data[i].nm_vaga+"</a> ("+oArg.data[i].qt_vagas+" vagas de "+oArg.data[i].dc_area+")</b> - "+oArg.data[i].dc_vaga+"<br>";
      }
      $("#divColuna").html("");
      $("#divColuna").html(html);
      //alert(html);
      
   }
   //-------------------------------------------------------------------------- 
   function handleNoGeolocation(errorFlag, errorCode) 
   {     
      map.setCenter(saopaulo);  
   }   
   //-------------------------------------------------------------------------- 
   initialize();  
   </script>
</html>
