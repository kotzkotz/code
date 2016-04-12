<?php
/****
燕十八 公益PHP讲堂

论  坛: http://www.zixue.it
微  博: http://weibo.com/Yshiba
YY频道: 88354001
****/




define('ACC',true);
require('./include/init.php');

$goods_id = isset($_GET['goods_id'])?$_GET['goods_id']+0:0;


// 先查询这个商品信息
$goods = new GoodsModel();
$g = $goods->find($goods_id);

if(empty($g)) {
    header('location: index.php');
    exit;
}


$cat = new CatModel();
$nav = $cat->getTree($g['cat_id']);

include(ROOT . 'view/front/shangpin.html');
