<?php
/****
燕十八 公益PHP讲堂

论  坛: http://www.zixue.it
微  博: http://weibo.com/Yshiba
YY频道: 88354001
****/



define('ACC',true);
require('./include/init.php');


// 取出5条新品
$goods = new GoodsModel();
$newlist = $goods->getNew(5);


/*
取出指定栏目的商品

*/

// 女士大栏目下的商品
$female_id = 4;
$felist = $goods->catGoods($female_id);


// 男士大栏目下的商品,同学们自己来完成

include(ROOT . 'view/front/index.html');
