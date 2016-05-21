<?php

/*

CREATE TABLE IF NOT EXISTS `category` (
  `id` tinyint(3) unsigned AUTO_INCREMENT NOT NULL,
  `name` char(20) NOT NULL DEFAULT '',
  `parent_id` tinyint(3) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='无限极分类测试表';

INSERT INTO `test`.`category` (`id` , `name` , `parent_id`) VALUES (1 , '手机', '0'), (2 , '苹果', '1'),(3 , '诺基亚', '1'),(4 , 'iphone', '2'),(5 , 'ipad', '2'),(6 , 'N系列', '3'),(7 , 'E系列', '3'),(8 , 'N97', '6'),(9 , 'N98', '6');



*/

mysql_connect('localhost','root','root');
mysql_query('set names utf8');
mysql_select_db('test');
header("Content-type:text/html;charset=utf-8");

echo '<pre>';
$arr = wxjfl_recursive_more();
print_r($arr);





/*
递归获取
*/
// 多维数组
function wxjfl_recursive_more($parent_id=0,$lev=1){
	static $arr = array();
	$sql = 'select * from category where parent_id='.$parent_id;
	$rs = mysql_query($sql);
	while($row = mysql_fetch_assoc($rs)){
		$row['lev'] = $lev;
		array_push($arr,$row);
		// array_push($arr,wxjfl_recursive_more($row['id'],$lev+1));

	}

	return $arr;
}

// 无限极分类多维数组
function zc_children_more($arr,$id=0){
	$children = array();
	foreach($arr as $k=>$v){
		if($v['parent']==$id){
			unset($arr[$k]);
			$v['child'] = zc_children_more($arr,$v['id']);
			$children[] = $v;
		}
	}

	return $children;
}



// 一维数组
function wxjfl_recursive_one(){
	static $arr = array();
	$sql = 'select * from category where parent_id='.$parent_id;
	$rs = mysql_query($sql);
	while($row = mysql_fetch_assoc($rs)){
		$row['lev'] = $lev;
		array_push($arr,$row);
		wxjfl_recursive_more($row['id'],$lev+1);
	}

	return $arr;
}

// 无限极分类一维数组
function zc_children_one($arr,$id=0,$lev=1){
	$children = array();
	foreach($arr as $k=>$v){
		if($v['parent']==$id){
			unset($arr[$k]);
			$v['lev'] = $lev;
			$children[] = $v;
			$children = array_merge($children,zc_children_one($arr,$v['id'],$lev+1));
		}
	}

	return $children;
}

/*
迭代
*/
// 多维数组
function wxjfl_iterative_more(){

}
// 一维数组
function wxjfl_iterative_one(){

}

?>