<?php 

class mysmarty extends Smarty{
	public function __construct(){
		parent::__construct();

		$this->setTemplateDir('./temp');
        $this->setCompileDir('./comp');
	}
}

?>