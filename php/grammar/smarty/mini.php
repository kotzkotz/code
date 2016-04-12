<?php 

//仿smarty的类

class mini{
	public $template_dir = '';
	public $compile_dir = '';

	public $_tpl_var = array();

	public function assign($k,$v){
		$this->_tpl_var[$k] = $v;
	}

	public function display($template){
		$comp = $this->compile($template);
		include($comp);
	}

	public function compile($template){
		$temp = $this->template_dir . '/' . $template;
		$comp = $this->compile_dir . '/' . $template . '.php';

		if(file_exists($comp) && filemtime($temp) < filemtime($comp)){
			return $comp;
		}

		$source = file_get_contents($temp);
		$source = str_replace('{$','<?php echo $this->_tpl_var[\'',$source);
		$source = str_replace('}','\'] ;?>',$source);
		file_put_contents($comp,$source);

		return $comp;
	}
}

?>