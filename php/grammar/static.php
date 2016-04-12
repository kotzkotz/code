<?php

// 类的静态和非静态

class kop{
	static $num1 = 1;
	public $num2 = 1;
	public function __construct(){
		self::$num1 = self::$num1 + 1;
		$this->num2 = $this->num2 + 1;
	}
}

$a = new kop();
$b = new kop();
$c = new kop();
$d = new kop();
$e = new kop();
$f = new kop();
$g = new kop();

// echo $g::$num1.'<br />'.kop::$num1.'<br />'.$g->num2;
echo kop::$num1,'<br />',$g->num2,'<br />';

class user   
{     
    private static $count = 0 ; //记录所有用户的登录情况.     
    public function __construct() {     
        self::$count = self::$count + 1;     
    }     
    public function getCount() {       
        return self::$count;     
    }     
    public function __destruct() {     
        self::$count = self::$count - 1;     
    }     
}     
$user1 = new user();     
$user2 = new user();     
$user3 = new user();     
echo "now here have " . $user1->getCount() . " user";     
echo "<br />";     
unset($user3);
echo "now here have " . $user1->getCount() . " user";  


?>