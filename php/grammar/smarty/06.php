<?php 

require('./Smarty/libs/Smarty.class.php');

$smarty = new Smarty();
$smarty->template_dir = './temp';
$smarty->compile_dir = './comp';
$smarty->config_dir = './conf';

$smarty->append('stu','李四');
$smarty->append('stu','王五');


class human{
	public $name = '赵六';
	public $age = '20';

	public function say(){
		$a = 'hello world';
		return $a;
	}
}

$hum = new human();

$smarty->assign('hum',$hum);

$smarty->display('06temp.html');

?>