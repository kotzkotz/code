<?php

$mysql = new SaeMysql();//sae内部类链接数据
$num = "SELECT * FROM `consult` ";
$mysql->runSql($num); 
$no=$mysql->affectedRows();//获取行数

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
<script src="http://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="ion.sound.js" type="text/javascript"></script>
<script>
$(document).ready(function() {
   	 $.ionSound({
            sounds: [
                "door_bell",
                ],
            path: "/",
            multiPlay: true,
            volume: "1.0"
        });
  
	var m;
    getline();
	});
	
	function getline(){
        
	$.ajax({
		type:'GET',
		url:'list.php',
        success: function(line,st){
			var n=+$("#abc").text();
           //n=+document.getElementById("abc").innerHTML;
		   	m=parseInt(line);
			if(m>n)
			{
			 $.ionSound.play("door_bell");	
			$("#abc").html(line);
			}
			                   	}
		
      
		});
	setTimeout("getline()",3000)	
	}
</script>
</head>

<body>

<div id="abc"><?php echo $no;?></div>
  
  </div>
 
</div>
</body>
</html>
