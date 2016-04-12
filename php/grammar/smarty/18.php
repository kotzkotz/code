<?php 

class mini{
	protected $ld='{';
	protected $rd='}';
	protected $rlen = 1;

	public function __construct(){
		$this->rlen = strlen($this->rd);
	}

	protected $tags = array();

	public function parse($file){
		$cont = file_get_contents($file);

		$offset = 0;
		while(($poss = strpos($cont,$this->ld,$offset)) !== false){
			$pose = strpos($cont,$this->rd,$poss);
			$this->tags[] = substr($cont,$poss,$pose-$poss+$this->rlen);
			$offset = $pose + $this->rlen;
		}

		return $this->tags;
	}
}

$mini = new mini();

print_r($mini->parse('./temp/11.html'));

?>