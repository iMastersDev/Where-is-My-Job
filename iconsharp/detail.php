<?php
/*
 * ./iconsharp/detail.php
 * 
 * Copyright (c) 2011, Luciano Moreira Camilo e Silva. All rights reserved.
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301  USA
 */
?>
<html>
   <head>
      <title>Icon # - Dinamic Generated Icon Marker with Numbers</title>
      <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.9.0/build/fonts/fonts-min.css" />
      <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.9.0/build/button/assets/skins/sam/button.css" />
      <script type="text/javascript" src="http://yui.yahooapis.com/2.9.0/build/yahoo-dom-event/yahoo-dom-event.js"></script>
      <script type="text/javascript" src="http://yui.yahooapis.com/2.9.0/build/element/element-min.js"></script>
      <script type="text/javascript" src="http://yui.yahooapis.com/2.9.0/build/button/button-min.js"></script>
      <style>
         #divMainPlay
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
         #divPlayControls
         {
            border: 1px solid #909090;
            flex-box:1;
            -webkit-box-flex: 1; 
            height: 303px;  
            padding-left: 10px;              
         }
         #divDisplay
         {
            border: 1px solid #909090;             
            margin-left: 10px;
            padding-top: 120px;
            padding-bottom: 120px;
            padding-left: 100px;
            padding-right: 100px;
         }  
         .divLink
         {
            background: #E0E0E0;
            border: 1px solid #606060; 
            color: #000000;
            padding: 5px; 
            margin-top: 10px;
         }  
      </style>
   </head>
   <body class="yui-skin-sam">
      <h1>Icon Sharp</h1>

      <p> Icon Sharp or Icon # is a simple script developed in PHP to generate some icon marker usually used into maps applications.  All you need is a PHP server – could be either Linux, Mac OS or Windows – and GD library installed. You will also need apache server with rewrite rules enable to run it.</p>
      <h1>How to Install</h1>
         <p> Just download the zip file (<a href="">here</a>) into your Server directory and unzip it. Make sure you PHP with GD library and apache rewrite rules enabled. After your install you should access this page thought this link:</p> 
         <div class="divLink">         
         http://yourservername/installdirectory/iconsharp/
         </div>
      
      <h1>How to use</h1>
         <p> There are two ways. The shortest link will always show you a white marker with orange border. It is the default patter (you can change it in the code. I kept this cause I like it). You address should be accessed like this:
         <div class="divLink">http://yourservername/installdirectory/iconsharp/123.png</div>
         <p> And you will see the following icon:</p> 
         <img src="123.png">         
         <p> The other way is the complete address. You must send the three parameters: color, model and value. Your address will seem like</p> 
         <div class="divLink">http://yourservername/installdirectory/iconsharp/darkblue_2_99.png</div>
         <p> And you will see the following icon:</p> 
         <img src="darkblue_2_99.png">  
         <p> The available colors are:  black, blue, darkblue,  green, orange, purple and red. Models are numbered from 1 to 7. You can play with them bellow.</p> 
      <h1>License</h1>
      <p>I look for a really permissive license and it is the reason I decided to release this software as LGPL software. My main concern is just to keep it available for other developers to use it and help me to improve it. So, feel free to use it in your free or commercial application, open or proprietary software. But if you make any improvement on it, let us know. And keep our credit, please. ;)</p>
      <h1>Play with it</h1>
      <div id="divMainPlay">
         <div id="divPlayControls">
            <p>Choose the parameters and click generate</p>     
            <!-- Color /-->
            <p>Choose the color</p>
            <div id="buttongroup1" class="yui-buttongroup">
                <span id="colorradio1" class="yui-button yui-radio-button yui-button-checked">
                    <span class="first-child">
                        <button type="button" name="radiofield1" value="1">
                             <img src="img/balloon_black_1.png" width="25">
                        </button>
                    </span>
                </span>
                <span id="colorradio2" class="yui-button yui-radio-button">
                    <span class="first-child">
                        <button type="button" name="radiofield1" value="2">
                            <img src="img/balloon_blue_1.png" width="25">
                        </button>
                    </span>
                </span>
                <span id="colorradio3" class="yui-button yui-radio-button">
                    <span class="first-child">
                        <button type="button" name="radiofield1" value="3">
                            <img src="img/balloon_darkblue_1.png" width="25">
                        </button>
                    </span>
                </span>
                <span id="colorradio4" class="yui-button yui-radio-button">
                    <span class="first-child">
                        <button type="button" name="radiofield1" value="4">
                            <img src="img/balloon_green_1.png" width="25">
                        </button>
                    </span>
                </span>
                <span id="colorradio5" class="yui-button yui-radio-button">
                    <span class="first-child">
                        <button type="button" name="radiofield1" value="5">
                            <img src="img/balloon_orange_1.png" width="25">
                        </button>
                    </span>
                </span>
                <span id="colorradio6" class="yui-button yui-radio-button">
                    <span class="first-child">
                        <button type="button" name="radiofield1" value="6">
                            <img src="img/balloon_purple_1.png" width="25">
                        </button>
                    </span>
                </span>
                <span id="colorradio7" class="yui-button yui-radio-button">
                    <span class="first-child">
                        <button type="button" name="radiofield1" value="7">
                            <img src="img/balloon_red_1.png" width="25">
                        </button>
                    </span>
                </span>
            </div>      
            <!-- Model --> 
            <p>Choose the model</p>
            <div id="buttongroup2" class="yui-buttongroup">
                <span id="radio1" class="yui-button yui-radio-button yui-button-checked">
                    <span class="first-child">
                        <button type="button" name="radiofield2" value="1">
                             <img src="img/balloon_black_1.png" width="25">
                        </button>
                    </span>
                </span>
                <span id="radio2" class="yui-button yui-radio-button">
                    <span class="first-child">
                        <button type="button" name="radiofield2" value="2">
                            <img src="img/balloon_black_2.png" width="25">
                        </button>
                    </span>
                </span>
                <span id="radio3" class="yui-button yui-radio-button">
                    <span class="first-child">
                        <button type="button" name="radiofield2" value="3">
                            <img src="img/balloon_black_3.png" width="25">
                        </button>
                    </span>
                </span>
                <span id="radio4" class="yui-button yui-radio-button">
                    <span class="first-child">
                        <button type="button" name="radiofield2" value="4">
                            <img src="img/balloon_black_4.png" width="25">
                        </button>
                    </span>
                </span>
                <span id="radio5" class="yui-button yui-radio-button">
                    <span class="first-child">
                        <button type="button" name="radiofield2" value="5">
                            <img src="img/balloon_black_5.png" width="25">
                        </button>
                    </span>
                </span>
                <span id="radio6" class="yui-button yui-radio-button">
                    <span class="first-child">
                        <button type="button" name="radiofield2" value="6">
                            <img src="img/balloon_black_6.png" width="25">
                        </button>
                    </span>
                </span>
                <span id="radio7" class="yui-button yui-radio-button">
                    <span class="first-child">
                        <button type="button" name="radiofield2" value="7">
                            <img src="img/balloon_black_7.png" width="25">
                        </button>
                    </span>
                </span>
            </div>
            <p>Type de value and click generate</p>
            <input type="text"  value="<?=rand(1, 100)?>" id="isValue"/>
            <input type="button"  value="Generate" id="isGenerate" onclick="generate_icon()"/>
            <p>
               <img src="http://i.creativecommons.org/l/by/3.0/88x31.png">
               If you just wanna use the generated icons, go ahead and save it. It is CC BY (<a href="http://creativecommons.org/licenses/by/3.0/" target = "_blank">see more here</a>)
            </p>
         </div>
         <div  id="divDisplay">
            <img src="img/balloon_black_1.png" id="dst_icon"> 
         </div>   
      </div>

      <h1>Samples</h1>
      <p>You can see all sets of avaiable icons generated by Icon Sharp</p>
      <?php
         $color = array('black', 'blue', 'darkblue', 'green', 'orange', 'purple', 'red');
         foreach ($color as $key => $color_value) 
         {
            for ($model_value=1; $model_value < 8; $model_value++) 
            {
               $value = rand(0, 200); 
               echo "<img src='{$color_value}_{$model_value}_{$value}.png's>";   
            }
            echo "<br>";
               
         }
      ?>
    </body>
     <script type="text/javascript">
         //------------------------------------------------------------------------------------
         var oButtonGroup1;
         var oButtonGroup2;
         var ButtonGroup = YAHOO.widget.ButtonGroup;
         var Colors = new Array('black', 'blue', 'darkblue', 'green', 'orange', 'purple', 'red'); // condensed array
         //------------------------------------------------------------------------------------
         var generate_icon = function()
         {
            var color = oButtonGroup1.get("value");
            var model = oButtonGroup2.get("value");
            var value = document.getElementById("isValue").value;
            document.getElementById("dst_icon").src = Colors[color-1]+"_"+model+"_"+value+".png";
         }
         //------------------------------------------------------------------------------------
         YAHOO.util.Event.addListener(window, "load", function () {
            oButtonGroup1 = new ButtonGroup("buttongroup1", {value: 1});
            oButtonGroup2 = new ButtonGroup("buttongroup2", {value: 1});
         });

      </script>

</html>