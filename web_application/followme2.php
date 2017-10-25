<?php
session_start();
$id=$_SESSION['id'];
?>
<!DOCTYPE html>
<html>
   <head>
   	   <title>따라오슈</title>
   	   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
       <link rel="stylesheet" type="text/css" href="css/mainstyle.css" />
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
   	   <script type="text/javascript">
       var httpRequest=null;
       function getXMLHttpRequest() {
         if(window.ActiveXObject) {
           try {
             return new ActiveXObject("Msxml2.XMLHTTP");
           } catch(e) {
             try {
               return new ActiveXObject("Microsoft.XMLHTTP");
             } catch(e1) {
               return null;
             }
           }
         } else if(window.XMLHttpRequest) {
           return new XMLHttpRequest();
         } else {
           return null;
         }
     }
         function a() {
           var param="spot="+f.spot.value;
           httpRequest = new getXMLHttpRequest();
           httpRequest.onreadystatechange=b;
            httpRequest.open("get", "a.php?"+param, true);
           httpRequest.onreadystatechange = function(){
               if(httpRequest.readyState === 4 && httpRequest.status === 200){
                   var _tzs = httpRequest.responseText;
                   var tzs = _tzs.split(',');
                   var _str = '';
                   for(var i = 0; i< tzs.length; i++){
                       _str += tzs[i];
                   }
                   document.querySelector('#timezones').innerHTML = _str;
                                }
           }
           httpRequest.send();
         }
         function b() {
           if(httpRequest.readyState==4) {
             if(httpRequest.status==200) {
               var txt = httpRequest.responseText;
               httpRequest.onreadystatechange=c;
               var myDiv = document.getElementById("myDiv");
               myDiv.innerHTML = txt;
             }
           }
         }
   	      $(function(){
   	      	var pull=$('#pull');
   	      	    menu=$('nav ul');
   	      	    menuHeight=menu.height();
   	      $(pull).on('click', function(e){
   	      	e.preventDefault();
   	      	menu.slideToggle();
   	      });
   	      $(window).resize(function(){
   	      	var w=$(window).width();
   	      	if(w>600 && menu.is(':hidden'))
   	      		{menu.removeAttr('style');}
   	      });
   	  });
   	   </script>
   </head>
   <body>
     <form action="" name="f">
   	  <nav class="clearfix">
   	      <ul class="clearfix">
   	         <li><a href="http://192.168.0.13/followme2.php">Home</a></li>
   	         <li><a href="#">History</a></li>
   	         <li><a href="#">Q&A</a></li>
              <li><a href="#">UserInfo</a></li>
   	         <li><a href="http://192.168.0.13/">LogOut</a></li>
   	      </ul>
   	      <a id="pull" href="#">Menu</a>
   	  </nav>
   <div class="imgcontainer">
     <a href="http://192.168.0.13/followme2.php"<center><img src="http://imageshack.com/a/img924/8268/9iaouH.png" alt="Banner" class="Banner_img" id="logo" width=600px style="margin-left: auto; margin-right: auto; display: block;"></center></a>
   </div>
    <div class="searchDiv">
      <input type="text" name="spot" class="searchInput" placeholder="목적지를 입력">
     <input type="button" id="execute" name="execute" value="검색" onclick="a()" class="searchBtn">
     </div>
       </form>
        <div id="myDiv"> </div>
        <p id="timezones">   </p>
        <canvas id="canvas" width="1500" height="500"></canvas>
          </body>
          <script type="text/javascript">
          var _ = Infinity;
           var direction = [[_,2,4,_,_],
                            [3,_,_,_,_],
                            [3,_,_,2,4],
                            [_,_,3,_,_],
                            [_,_,3,_,_]];
           var path = [[[],[],[],[],[]],
                      [[0,2,4],[1,0,2,4],[2,4],[3,2,4],[4]],
                      [[0,2,4],[1,0,2,4],[2,4],[3,2,4],[4]],
                      [[0,2,3],[1,0,2,3],[2,3],[3],[4,2,3]],
                      [[0,2,3],[1,0,2,3],[2,3],[3],[4,2,3]],
                      [[0,1],[1],[2,0,1],[3,2,0,1],[4,2,0,1]],
                      [[0,1],[1],[2,0,1],[3,2,0,1],[4,2,0,1]]];
               function b() {
                $(function () {
                var ctx = $('#canvas')[0].getContext('2d');
                  for(var j=0;j<path[1][0].length;j++) {
                  ctx.fillStyle = '#58626C';
                  ctx.beginPath();
                  ctx.arc(80*(j+1)+10, 50, 25, 0, Math.PI*2, false);
                  ctx.closePath();
                  ctx.fill();
                  ctx.font="30px Arial";
                  ctx.fillText(path[3][0][j], 80*(j+1),120);
                  if(j < path[3][0].length-1) {
                    ctx.beginPath();
                    ctx.lineWidth="5";
                    ctx.strokeStyle="white";
                    ctx.moveTo(80*(j+1)+40,50);
                    ctx.lineTo(80*(j+2)-20,50);
                    ctx.stroke();
                  }
                }
              });
            }
          </script>
</html>
