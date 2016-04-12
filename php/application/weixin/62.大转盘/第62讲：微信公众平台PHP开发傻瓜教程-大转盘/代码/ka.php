﻿﻿<?php
$uid=$_GET["uid"];
include("conn.php");
$sql="SELECT * FROM `menu` where `user`= '{$uid}'";
				$query=mysql_query($sql);
				$rm=mysql_fetch_array($query);
				$score=$rm['score'];
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<title>大转盘</title>
<link href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css" rel="stylesheet" type="text/css">
<script src="http://code.jquery.com/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js" type="text/javascript"></script>
<script src="jQueryRotateCompressed.js" type="text/javascript">
</script>

<style>
#main{
	position:relative;
	width:100%;
	height:100%;
    background-image:url(disk.jpg);
	background-repeat:no-repeat;
	background-size:100%;

	}
#zhen{
	position:relative;
	margin:auto;
	width:40%;
	top:10%;
	}
</style>
  <script>
  
    
  
   
  
$(document).bind('pageinit',function()
{var w=<?php echo $score;?>;
	
	$(window).resize();
$("#zhi").rotate({bind:{click: function(){
	if (w<50){
	  alert ("你的分数不够");
	  }
  else {
 var i=+Math.random()*100;
  var m;
  var prize;
  if (i<2){
  m=10;
  prize="一等奖";}
  else if(i>2 && i<=5){
  m=320;
  prize="二等奖";}
  else if(i>5 && i<=10){
  m=260;
  prize="三等奖";}
  else if(i>10 && i<=20){
  m=190;
  prize="四等奖";}
  else if(i>20 && i<=30){
  m=130;
  prize="五等奖";}
  else if(i>30 && i<=60){
  m=80;
  prize="六等奖";}
  else if(i>60 && i<=100){
  m=350;
  prize="七等奖";}
		    $(this).rotate
			    ({
	
				angle:0,
				animateTo:3600+m,
				callback: function(){
			document.getElementById("btn1").value=prize;		
		w=w-50;
		document.getElementById("score1").value=w;				
document.getElementById("show").innerHTML="恭喜你获得"+prize;
       document.getElementById("fen").innerHTML="你的分数"+w;         
      $.ajax({
  Type: "get",
  url: "a.php",
  data: "uid=<?php echo $uid; ?>&score="+w,
  
  
});
                
                }
				})
        }
     } 
}
});
})
   $(window).resize(function(){
  var mainwidth=+document.body.clientWidth;
 var mainheight=+mainwidth;
document.getElementById("main").style.height=mainheight+"px";
  })
 
  
</script>
</head>

<body>
<div data-role="page" id="page">
  <div data-role="header">
    <h1>大转盘</h1>
  </div>
  <div data-role="content">
  <div id="main">
    <div id="zhen">
     <img src="start.png" id="zhi" width=100%>
    </div>
  </div>
  <div data-role="collapsible-set">
    <div data-role="collapsible">
      <h3>奖品设置</h3>
      <p>一等奖：iphone5s</p>
      <p>二等奖：iphone4s</p>
      <p>三等奖：红米</p>
      <p>四等奖：鼠标</p>
      <p>五等奖：鼠标垫</p>
      <p>六等奖：CDW</p>
      <p>七等奖：谢谢参与</p>
    </div>
   </div>
  
    <p id="fen">你的分数<?php echo $score;?>,</p>
  <p>每转一次消耗50分</p>
     <h3 id="show"> </h3>
    <form action="a.php" method="get" data-ajax="false" >
       <input name="uid" type="hidden" value="<?php echo $uid; ?>">
      <input name="btn" id="btn1" type="hidden" value="p" >
      <input name="score" id="score1" type="hidden" value="<?php echo $score;?>" >
    <input type="submit" value="兑奖" />
  
  </form>
    
  </div>
</div>
</body>
</html>
