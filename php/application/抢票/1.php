<?php
session_start();
// 这个是高并发抢票，不考虑memcache集群
/*
提前给memchached设定变量
电影票：
$mem->add('movie',50);
演唱会：
$mem->add('concert',30);
*/
$mem=new Memcache;
if(!$mem->connect("192.168.1.104",11211)){
    die('连接失败!');
}
/*
获奖概率计算法不是重点，这个就写一个简单的：先抢电影票，抢完在抢演唱会，在抢完就提示已经都抢完了。
*/
if(($num=$mem->get('movie'))>0){
	$mem->set('movie',--$num);
	echo '恭喜您抢到了电影票一张！';
	$data = array();
	$data['userid'] = $_SESSION['userid'];
	$data['type'] = 'movie';
	// 这个是交给另一个php进行写入数据库处理
	forward($data);
}elseif(($num=$mem->get('concert'))>0){
	$mem->set('concert',--$num);
	echo '恭喜您抢到了演唱会门票一张！';
	$data = array();
	$data['userid'] = $_SESSION['userid'];
	$data['type'] = 'concert';
	// 这个是交给另一个php进行写入数据库处理
	forward($data);
}else{
	echo '对不起，已经抢完了！';
}

$mem->close(); 

/*
forward函数把抢购成功的用户转发到2.php
$data：需要转发的数据（如用户ID，奖品）
*/
function forward($post_data){
	$url = "http://localhost/2.php";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
	// $output = curl_exec($ch);
	curl_close($ch);
}

?>