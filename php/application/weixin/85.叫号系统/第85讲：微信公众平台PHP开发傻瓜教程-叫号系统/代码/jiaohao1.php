<?php
$c = new SaeCounter();
$jiao=$c->get('jiao'); 
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
  <script src="http://code.jquery.com/jquery-1.6.4.min.js" type="text/javascript"></script>
</head>
<script>
$(document).ready(function() {
	$("#btn").click(function(){
	$.ajax({
		type:'GET',
		url:'jiaohao2.php',
		data:'id=1', 
        success: function(data){
			$("#abc").val(data);			
		                        }
	      })
	})
	$("#change").click(function(){
		var m=+$("#abc").val();
		$.ajax({
		type:'GET',
		url:'jiaohao2.php',
		data:'change='+m, 
		
		})
	})
})
</script>			
<body>
<div>
当前号是<input name="dangqian" id="abc" type="text" value="<?php echo $jiao;?>">号
<button id="change">修改</button>
</div>

<div>
<button id="btn">下一个</button>
</div>
<div> <a href="jiaohao3.php">新的一天(将清除所有数据）</a></div>
</body>
</html>