<?php

class Http{
	private $version = '1.1';
	private $urlinfo = array();
	private $fh = null;

	protected function conn($url){
		$this->urlinfo = parse_url($url);
		$this->fh = fsockopen($this->urlinfo['host'],80);


	}

	public function get($url){
		$this->conn($url);

		$req = array();
		$req[] = 'GET '.$this->urlinfo['path'].' HTTP/'.$this->version;
		$req[] = 'host: '.$this->urlinfo['host'];
		$req[] = '';
		$req[] = '';

		//print_r($req);

		$req = implode("\r\n",$req);
		fwrite($this->fh,$req);

		$res = '';
		while(!feof($this->fh)){
			$res .= fread($this->fh,1024);
		}

		//var_dump(fread($this->fh,1024));

		echo($req);

		return $res;

	}
}

$http = new Http();

$html = $http->get('http://news.163.com/13/0606/18/90N5L1TC00014JB6.html');

file_put_contents('./a.txt',$html);

echo '完成';

?>