<?php  
error_reporting(E_ALL);  
  
class test{  
 public $public;  
 private $private;  
 protected $protected;  
 static $instance;  
 public  function __construct(){  
 $this->public    = 'public     <br>';  
 $this->private   = 'private    <br>';  
 $this->protected = 'protected  <br>';  
 }  
 static function tank(){  
 if (!isset(self::$instance[get_class()]))  
 {  
 $c = get_class();  
 self::$instance = new $c;  
 }  
  
 return self::$instance;  
 }      
  
 public function pub_function() {  
 echo "you request public function<br>";  
 echo $this->public;  
 echo $this->private;        //private,内部可以调用  
 echo $this->protected;      //protected,内部可以调用  
 $this->pri_function();      //private方法，内部可以调用  
 $this->pro_function();      //protected方法，内部可以调用  
 }  
 protected  function pro_function(){  
 echo "you request protected function<br>";  
 }  
 private function pri_function(){  
 echo "you request private function<br>";  
 }  
}  
  
$test = test::tank();  
echo $test->public;  
echo $test->private;    //Fatal error: Cannot access private property test::$private  
echo $test->protected;  //Fatal error: Cannot access protected property test::$protected  
$test->pub_function();  
$test->pro_function();  //Fatal error: Call to protected method test::pro_function() from context  
$test->pri_function();  //Fatal error: Call to private method test::pri_function() from context  
  
?>

<pre>
从上面的例子中，我们可以看出，
public:    可以class内部调用，可以实例化调用。
private:   可以class内部调用，实例化调用报错。
protected：  可以class内部调用，实例化调用报错。
</pre>




















<?php  

class test{  
 public $public;  
 private $private;  
 protected $protected;  
 static $instance;  
  
 public  function __construct(){  
 $this->public    = 'public     <br>';  
 $this->private   = 'private    <br>';  
 $this->protected = 'protected  <br>';  
 }  
 protected function tank(){                          //私有方法不能继承，换成public,protected  
 if (!isset(self::$instance[get_class()]))  
 {  
 $c = get_class();  
 self::$instance = new $c;  
 }  
 return self::$instance;  
 }      
  
 public function pub_function() {  
 echo "you request public function<br>";  
 echo $this->public;  
 }  
 protected  function pro_function(){  
 echo "you request protected function<br>";  
 echo $this->protected;  
 }  
 private function pri_function(){  
 echo "you request private function<br>";  
 echo $this->private;  
 }  
}  
  
class test1 extends test{  
  
 public function __construct(){  
 parent::tank();  
 parent::__construct();  
 }  
 public function tank(){  
 echo $this->public;  
 echo $this->private;       //Notice: Undefined property: test1::$private  
 echo $this->protected;  
 $this->pub_function();  
 $this->pro_function();  
 $this->pri_function();    //Fatal error: Call to private method test::pri_function() from context 'test1'  
 }  
  
 public  function pro_extends_function(){  
 echo "you request extends_protected function<br>";  
 }  
 public function pri_extends_function(){  
 echo "you request extends_private function<br>";  
 }  
}  
  
error_reporting(E_ALL);  
$test = new test1();  
$test -> tank();       //子类和父类有相同名字的属性和方法，实例化子类时，子类的中的属性和方法会盖掉父类的。  
  
?>  

<pre>
从上面的例子中，我们可以看出，
public:    test中的public可以被继承。
private:   test中的private不可以被继承。
protected：  test中的protected可以被继承。
static：        test中的static可以被继承。
</pre>















<?php 

class hum{
	public $name = 'zhangsan';
	protected $age = '25';
	private $sex = '男';

	public function age(){
		return $this->age;
	}

	public function sex(){
		return $this->sex;
	}

	public function __set($k,$v){
		echo '给私有属性赋值直接调用这个__set()';
		if($this->$k){
			return $this->$k = $v;
		}else{
			return false;
		}
	}

	public function __get($k){
		echo '调用私有属性会直接调用这个__get()';
		if($this-$k){
			return $this->$k;
		}else{
			return false;
		}
	}
}

class man extends hum{
	public $name = 'lisi';
	protected $age = '28';
	private $sex = '女';


}

$man = new man();

echo $man->age();

echo $man->sex();

$hum = new hum();

$hum->sex = '女';

echo $hum->sex;

?>