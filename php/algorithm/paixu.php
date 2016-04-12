<?php

echo '<pre>';

// print_r($_SERVER);

$arr = array(5,4,8,2,85,45,3);

class sort {
	//冒泡排序
	public function bubbleSort($res, $type = 'asc') {	
		if(!in_array($type, array('asc', 'desc'))) {return false;}
		for($i = 0; $i < count($res); $i++) {
			for($j = $i+1; $j < count($res); $j++) {
				if(($res[$i] < $res[$j] && $type == 'desc') || ($res[$i] > $res[$j] && $type == 'asc')) {
					list($res[$i], $res[$j]) = array($res[$j], $res[$i]);
				}
			}
		}
		return $res;
	}

	//快速排序
	public function quickSort($res, $type = 'asc') {	
		if(($count = count($res)) <= 1 ) return $res;
		$base = $res[0];
		$left = $right = array();
		for($i = 1; $i < $count; $i++) {
			if(($res[$i] <= $base && $type == 'asc') || ($res[$i] > $base && $type == 'desc')) $left[] = $res[$i];
			else $right[] = $res[$i];
		}
		$left = $this->quickSort($left, $type);
		$right = $this->quickSort($right, $type);
		return array_merge($left, array($base), $right);
	}

	//插入排序
	public function insertSort($res, $type = 'asc') {	
		for($i = 1; $i < count($res); $i++) {
			$k = $i;
			while($k > 0) {
				if(($res[$k-1] > $res[$k] && $type == 'asc') || ($res[$k-1] < $res[$k] && $type == 'desc')) 
					list($res[$k], $res[$k-1]) = array($res[$k-1], $res[$k]);
				$k--;
			}
		}
		return $res;
	}

	//选择排序
	public function selectSort($res, $type = 'asc') {
		for($i = 0; $i < count($res); $i++) {
			$index = $i;
			$tmp = $res[$i];

			for($j = $i+1; $j < count($res); $j++) {
				if(($tmp < $res[$j] && $type == 'desc') || ($tmp > $res[$j] && $type == 'asc')) {
					$index = $j;
					$tmp = $res[$j];
				}
			}

			if($index != $i) list($res[$index], $res[$i]) = array($res[$i], $res[$index]);
		}

		return $res;
	}
}

$px = new sort();

print_r($px->bubbleSort($arr,'desc'));		//冒泡排序
print_r($px->quickSort($arr,'desc'));		//快速排序
print_r($px->insertSort($arr,'desc'));		//插入排序
print_r($px->selectSort($arr,'desc'));		//选择排序

$str = 'abc_def_ghi';

$arr = explode('_',$str);

foreach($arr as $v){
	$a .= ucwords($v);
}

echo $a;



/*
$handle = fopen("http://www.example.com/", "rb");
$contents = '';
while (!feof($handle)) {
  $contents .= fread($handle, 8192);
}

echo $contents;

fclose($handle);
*/

/*
抓取远程图片到本地,你会用什么函数?

fsockopen

5、假设a.html和b.html在同一个文件夹下面，用javascript实现当打开a.html五秒钟后，自动跳转到b.html。

function go2b(){
window.location = “b.html”;
window.close();
}

setTimeout( “go2b()”,5000 ); //5秒钟后自动执行go2b()


 

6、//正在浏览当前页面用户的 IP 地址:127.0.0.1
echo $_SERVER["REMOTE_ADDR"].”
”;
//查询（query）的字符串（URL 中第一个问号 ? 之后的内容）:id=1&bi=2
echo $_SERVER["QUERY_STRING"].”
”;
//当前运行脚本所在的文档根目录:d:inetpubwwwroot
echo $_SERVER["DOCUMENT_ROOT"].”
”;


8、写一个函数，能够遍历一个文件夹下的所有文件和子文件夹。
<?php
function my_scandir($dir)
{
$files=array();
if(is_dir($dir))
{
if($handle=opendir($dir))
{
while(($file=readdir($handle))!==false)
{
if($file!=”.” && $file!=”..”)
{
if(is_dir($dir.”/”.$file))
{
$files[$file]=my_scandir($dir.”/”.$file);
}
else
{
$files[]=$dir.”/”.$file;
}
}
}
closedir($handle);
return $files;
}
}
}
print_r(my_scandir(“D:Program FilesInternet ExplorerMUI”));
?>

 

11、请用正则表达式（Regular Expression）写一个函数验证电子邮件的格式是否正确。
答：
<?php

$email=$_POST['email'];
if(!preg_match(‘/^[\w.]+@([\w.]+)\.[a-z]{2,6}$/i’,$email))  {
echo “电子邮件检测失败”;
}else{
echo “电子邮件检测成功”;
}

?>

12、用PHP写出显示客户端IP与服务器IP的代码

答:打印客户端IP:echo $_SERVER[‘REMOTE_ADDR’]; 或者: getenv(‘REMOTE_ADDR’);

打印服务器IP:echo gethostbyname(“www.bolaiwu.com”)

 

13、如何修改SESSION的生存时间(1分).

答:方法1:将php.ini中的session.gc_maxlifetime设置为9999重启apache

方法2:$savePath = “./session_save_dir/”;

$lifeTime = 小时 * 秒;

session_save_path($savePath);

session_set_cookie_params($lifeTime);

session_start();

方法3:setcookie() and session_set_cookie_params($lifeTime);

 

14、有一个网页地址, 比如PHP开发资源网主页: http://www.phpres.com/index.html,如何得到它的内容?($1分)

答:方法1(对于PHP5及更高版本):

$readcontents = fopen(“http://www.phpres.com/index.html”, “rb”);

$contents = stream_get_contents($readcontents);

fclose($readcontents);

echo $contents;

方法2:

echo file_get_contents(“http://www.phpres.com/index.html”);

 

15、请说明php中传值与传引用的区别。什么时候传值什么时候传引用?(2分)

答:按值传递：函数范围内对值的任何改变在函数外部都会被忽略

按引用传递：函数范围内对值的任何改变在函数外部也能反映出这些修改

优缺点：按值传递时，php必须复制值。特别是对于大型的字符串和对象来说，这将会是一个代价很大的操作。

按引用传递则不需要复制值，对于性能提高很有好处。

 

16、写一个函数，尽可能高效的，从一个标准 url 里取出文件的扩展名

例如: http://www.sina.com.cn/abc/de/fg.php?id=1 需要取出 php 或 .php

答案1:

function getExt($url){

$arr = parse_url($url);

$file = basename($arr['path']);

$ext = explode(“.”,$file);

return $ext[1];

}

答案2:

function getExt($url) {

$url = basename($url);

$pos1 = strpos($url,”.”);

$pos2 = strpos($url,”?”);

if(strstr($url,”?”)){

return substr($url,$pos1 + 1,$pos2 – $pos1 – 1);

} else {

return substr($url,$pos1);

}

}

 

17、使用五种以上方式获取一个文件的扩展名

要求：dir/upload.image.jpg，找出 .jpg 或者 jpg ，
必须使用PHP自带的处理函数进行处理，方法不能明显重复，可以封装成函数，比如 get_ext1($file_name), get_ext2($file_name)

function get_ext1($file_name){

return strrchr($file_name, ‘.’);

}

function get_ext2($file_name){

return substr($file_name, strrpos($file_name, ‘.’));

}

function get_ext3($file_name){

return array_pop(explode(‘.’, $file_name));

}

function get_ext4($file_name){

$p = pathinfo($file_name);

return $p['extension'];

}

function get_ext5($file_name){

return strrev(substr(strrev($file_name), 0, strpos(strrev($file_name), ‘.’)));

}

 

18、<?php
$str1 = null;
$str2 = false;
echo $str1==$str2 ? ‘相等’ : ‘不相等’;

$str3 = ”;
$str4 = 0;
echo $str3==$str4 ? ‘相等’ : ‘不相等’;

$str5 = 0;
$str6 = ’0′;
echo $str5===$str6 ? ‘相等’ : ‘不相等’;
?>

相等 相等 不相等
 

20、请使用JavaScript写出三种产生一个Image 标签的方法（提示：从方法、对象、HTML角度考虑）

(1)var img = new Image();
(2)var img = document.createElementById(“image”)
(3)img.innerHTML = “”

 

21、16.请描述出两点以上XHTML和HTML最显著的区别
(1)XHTML必须强制指定文档类型DocType，HTML不需要
(2)XHTML所有标签必须闭合，HTML比较随意

22、写一个排序算法，可以是冒泡排序或者是快速排序，假设待排序对象是一个维数组。

//冒泡排序（数组排序）
function bubble_sort($array)
{
$count = count($array);
if ($count <= 0) return false;
for($i=0; $i<$count; $i++){
for($j=$count-1; $j>$i; $j–){
if ($array[$j] < $array[$j-1]){
$tmp = $array[$j];
$array[$j] = $array[$j-1];
$array[$j-1] = $tmp;
}
}
}
return $array;
}
//快速排序（数组排序）
function quicksort($array) {
if (count($array) <= 1) return $array;
$key = $array[0];
$left_arr = array();
$right_arr = array();
for ($i=1; $i<count($array); $i++){
if ($array[$i] <= $key)
$left_arr[] = $array[$i];
else
$right_arr[] = $array[$i];
}
$left_arr = quicksort($left_arr);
$right_arr = quicksort($right_arr);
return array_merge($left_arr, array($key), $right_arr);
}

 

23、写出三种以上MySQL数据库存储引擎的名称（提示：不区分大小写）
MyISAM、InnoDB、BDB（Berkeley DB）、Merge、Memory（Heap）、Example、Federated、Archive、CSV、Blackhole、MaxDB 等等十几个引擎

 

24、求两个日期的差数，例如2007-2-5 ~ 2007-3-6 的日期差数
方法一：
<?php
class Dtime
{
function get_days($date1, $date2)
{
$time1 = strtotime($date1);
$time2 = strtotime($date2);
return ($time2-$time1)/86400;
}
}
$Dtime = new Dtime;
echo $Dtime->get_days(’2007-2-5′, ’2007-3-6′);
?>
方法二：
<?php
$temp = explode(‘-’, ’2007-2-5′);
$time1 = mktime(0, 0, 0, $temp[1], $temp[2], $temp[0]);
$temp = explode(‘-’, ’2007-3-6′);
$time2 = mktime(0, 0, 0, $temp[1], $temp[2], $temp[0]);
echo ($time2-$time1)/86400;
方法三：echo abs(strtotime(“2007-2-1″)-strtotime(“2007-3-1″))/60/60/24 计算时间差

 

25、请写一个函数，实现以下功能：
字符串“open_door” 转换成 “OpenDoor”、”make_by_id” 转换成 ”MakeById”。
方法：
function str_explode($str){
$str_arr=explode(“_”,$str);$str_implode=implode(” “,$str_arr); $str_implode=implode
(“”,explode(” “,ucwords($str_implode)));
return $str_implode;
}
$strexplode=str_explode(“make_by_id”);print_r($strexplode);
方法二：$str=”make_by_id!”;
$expStr=explode(“_”,$str);
for($i=0;$i<count($expStr);$i++)
{
echo ucwords($expStr[$i]);
}方法三：echo str_replace(‘ ‘,”,ucwords(str_replace(‘_’,’ ‘,’open_door’)));

 

26、一个表中的Id有多个记录，把所有这个id的记录查出来，并显示共有多少条记录数，用SQL语句及视图、
存储过程分别实现。
DELIMITER //
create procedure proc_countNum(in columnId int,out rowsNo int)
begin
select count(*) into rowsNo from member where member_id=columnId;
end
call proc_countNum(1,@no);
select @no;
方法：视图：
create view v_countNum as select member_id,count(*) as countNum from member group by
member_id
select countNum from v_countNum where member_id=1

 

27、js中网页前进和后退的代码 ( 前进: history.forward();=history.go(1); 后退: history.back
();=history.go(-1); )

 

28、echo count(“abc”); 输出什么?
答案:1

count — 计算数组中的单元数目或对象中的属性个数

int count ( mixed$var [, int $mode ] ), 如果 var 不是数组类型或者实现了 Countable 接口的对象，将返回1，有一个例外，如果 var 是 NULL 则结果是 0。

对于对象，如果安装了 SPL，可以通过实现 Countable 接口来调用 count()。该接口只有一个方法 count()，此方法返回 count() 函数的返回值。

 

29、有一个一维数组，里面存储整形数据，请写一个函数，将他们按从大到小的顺序排列。要求执行效率高。并说明如何改善执行效率。（该函数必须自己实现，不能使用php函数）

<?php
function BubbleSort(&$arr)
{
$cnt=count($arr);
$flag=1;
for($i=0;$i<$cnt;$i++)
{
if($flag==0)
{
return;
}
$flag=0;
for($j=0;$j<$cnt-$i-1;$j++)
{
if($arr[$j]>$arr[$j+1])
{
$tmp=$arr[$j];
$arr[$j]=$arr[$j+1];
$arr[$j+1]=$tmp;
$flag=1;
}
}
}
}
$test=array(1,3,6,8,2,7);
BubbleSort($test);
var_dump($test);
?>

30、请举例说明在你的开发过程中用什么方法来加快页面的加载速度
答：要用到服务器资源时才打开，及时关闭服务器资源，数据库添加索引，页面可生成静态，图片等大文件单独服务器。使用代码优化工具

 

31、.以下的代码会产生什么?为什么?
$num =10;
function multiply(){
$num =$num *10;
}
multiply();
echo $num;
由于函式 multiply() 没有指定 $num 为全域变量（例如 global $num 或者 $_GLOBALS['num']），所以 $num 的值是 10。

 

32. php class中static,public,private,protected的区别?

static 静态，类名可以访问

public 表示全局，类内部外部子类都可以访问；

private表示私有的，只有本类内部可以使用；

protected表示受保护的，只有本类或子类或父类中可以访问；

 

33. HTTP协议中GET、POST和HEAD的区别?

HEAD： 只请求页面的首部。

GET： 请求指定的页面信息，并返回实体主体。

POST： 请求服务器接受所指定的文档作为对所标识的URI的新的从属实体。

（1）HTTP 定义了与服务器交互的不同方法，最基本的方法是 GET 和 POST。事实上 GET 适用于多数请求，而保留 POST 仅用于更新站点。

（2）在FORM提交的时候，如果不指定Method，则默认为GET请 求，Form中提交的数据将会附加在url之后，以?分开与url分开。字母数字字符原样发送，但空格转换为“+“号，其它符号转换为%XX,其中XX为 该符号以16进制表示的ASCII（或ISO Latin-1）值。GET请求请提交的数据放置在HTTP请求协议头中，而POST提交的数据则放在实体数据中；

GET方式提交的数据最多只能有1024字节，而POST则没有此限制。

（3）GET 这个是浏览器用语向服务器请求最常用的方法。POST这个方法也是用来传送数据的，但是与GET不同的是，使用POST的时候，数据不是附在URI后面传递的，而是要做为独立的行来传递，此时还必须要发送一个Content_length标题，以标明数据长度，随后一个空白行，然后就是实际传送的数据。网页的表单通常是用POST来传送的。

*/

?>