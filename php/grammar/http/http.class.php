<?php

interface Proto{
	//连接url
	function conn($url);

	//发送get请求
	function get();

	//发送post请求
	function post();

	//关闭连接
	function close();
}

class Http implements Proto{
	const CRLF = "\r\n";

	protected $errno = -1;
	protected $errstr = '';
	protected $response = '';

	protected $url = null;
	protected $version = 'HTTP/1.1';
	protected $fh = null;

	protected $line = array();
	protected $header = array();
	protected $body = array();

	public function __construct($url){
		$this->conn($url);
		$this->setHeader('Host: '.$this->url['host']);
	}

	protected function setLine($method){
		$this->line[0] = $method.' '.$this->url['path'].'?'.$this->url['query'].' '.$this->version;
	}

	public function setHeader($headerline){
		$this->header[] = $headerline;
	}

	protected function setBody($body){
		$this->body[] = http_build_query($body);
	}

	public function conn($url){
		$this->url = parse_url($url);
		if(!isset($this->url['port'])){
			$this->url['port'] = 80;
		}

		$this->fh = fsockopen($this->url['host'],$this->url['port'],$this->errno,$this->errstr,3);
	}

	public function get(){
		$this->setLine('GET');
		$this->request();
		return $this->response;
	}

	public function post($body = array()){
		$this->setLine('POST');
		$this->setHeader('Contect-type: application/x-www-form-urlencoded');
		$this->setBody($body);
		$this->setHeader('Content-length: '.strlen($this->body[0]));

		$this->request();
	}

	public function request(){
		$req = array_merge($this->line,$this->header,array(''),$this->body,array(''));
		$req = implode(self::CRLF,$req);
		fwrite($this->fh,$req);

		while(!feof($this->fh)){
			$this->response .= fread($this->fh,1024);
		}

		$this->close();
	}

	public function close(){
		fclose($this->fh);
	}


}

/*
$url = 'http://news.163.com/13/0613/09/9187CJ4C00014JB6.html';
$http = new Http($url);
echo $http->get();
*/

?>