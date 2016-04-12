<?php
$name=$_GET["name"];
$word=$_GET["word"];
?>
﻿<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<title>贺年卡</title>
<link href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css" rel="stylesheet" type="text/css">
<script src="http://code.jquery.com/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js" type="text/javascript"></script>
<style>
#main{
	margin:auto;
	position:relative;
	width:100%;
	height:100%;
    background-image:url(5.jpg);
	background-repeat:no-repeat;
	background-size:100%;

	}
#kahao{
	position:absolute;
	left:10px;
	top:10px;
	font-size:16px;
	font-weight:bold;
		}
#jifen{
	position:absolute;
	left:25px;
	top:30px;
	font-size:16px;
	font-weight:bold;
	}
</style>
  <script>
$(document).bind('pageinit',function()
{$(window).resize()})
   $(window).resize(function(){
  var mainwidth=+document.body.clientWidth;
 var mainheight=+mainwidth/600*417;
document.getElementById("main").style.height=mainheight+"px";
  })
  
</script>
</head>

<body>
<div data-role="page" id="page">
  <div data-role="header">
    <h1>贺年卡</h1>
  </div>
  <div data-role="content">
  <div id="main">
    <div id="kahao">
    <?php echo $name ?>:
    </div>  
    <div id="jifen">
  <?php echo $word ?>
   </div>
   </div>
   </div>
   </div>
   </body>
   </html>

