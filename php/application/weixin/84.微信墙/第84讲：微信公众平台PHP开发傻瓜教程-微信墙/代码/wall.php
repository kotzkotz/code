<?php
$mysql = new SaeMysql();//sae内部类链接数据
$sql = "SELECT * FROM `user3` ORDER BY `id` DESC limit 6 ";
$data = $mysql->getData($sql);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>微信墙</title>
<style type="text/css">
*{margin:0;padding:0;}
ul{list-style:none;}
#marquee4{position:absolute;top:150px;left:100px;width:80%;height:500px; overflow:hidden;background:#EFEFEF;}
#marquee4 ul li{float:left; width:96%; padding:10px; line-height:100px;font-size:36px;
font-family:"方正正准黑简体";
border:green solid thin;
} 
#banner{position:absolute;top:0px;	left:200px;width:80%;height:150px;font-size:48px;
color:#F00
	}
</style>

  <script src="http://code.jquery.com/jquery-1.6.4.min.js" type="text/javascript"></script>
<script src="js/kxbdmarquee.js"></script>

<script>
$(document).ready(function() {
   $("#marquee4").kxbdMarquee({direction:"up",isEqual:true,scrollDelay:20,scrollAmount:1});
  
	
    getline();
	});
	
	function getline(){
        
	$.ajax({
		type:'GET',
		url:'list.php',
		dataType:'json', 
        success: function(data){
var strul= ""; 
for (var i=0;i<6;i++)
{
strul+="<li>"+"<img src=\""+data[i].url+"\">"+data[i].nickname+":"+data[i].content+"</li>";
}
$("#myli").html(strul);


		}
      
		});
	setTimeout("getline()",3000)	
	}
</script>
</head>
<body>
<div id="banner">
微信墙震撼上线,扫描二维码立即上墙<img src="0.jpg" width="140">
</div>

<div id="marquee4">
	<ul id="myli">
     <?php 
	  for ($i= 0;$i<6; $i++){
	  ?>
	 <li>
     <img src="<?php echo $data[$i][url];?>">
     <?php echo $data[$i][nickname].":"; echo $data[$i][content];?>
      </li>
   <?php
	}
	?>
      
	</ul>
</div>





</body>
</html>