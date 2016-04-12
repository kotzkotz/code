<?php

/*
telnet pop.163.com 110         #telnet登录110端口

USER php0620@163.com           #用户名不需要base64编码

PASS 12345gy                   #登录密码

STAT                           #查看邮箱状态

LIST                           #邮件列表

TOP 1 0     				   #查看指定邮件的邮件头，0表示查看整个邮件头，其它正整数表示限制返回多少行。

RETR 1                         #获取指定邮件

DELE 1                         #删除第1封邮件
*/


class pop3{
	const CRLF = "\r\n";
	protected $host = 'pop3.163.com';
	protected $port = 110;

    protected $errno = -1;
    protected $errstr = '';

    protected $user = 'php0620';
    protected $pass = '12345gy';

    protected $fh = null;

    public function conn() {
        $this->fh = fsockopen($this->host,$this->port);
    }

    public function login(){
    	fwrite($this->fh,'USER '.$this->user.self::CRLF);
    	if(substr($this->getLine(),0,3) != '+OK'){
    		throw new Exception("用户名不正确");
    	}
    	fwrite($this->fh,'PASS '.$this->pass.self::CRLF);
    	if(substr($this->getLine(),0,3) != '+OK'){
    		throw new Exception("密码不正确");
    	}
    }

    //查询所有发件人
    public function getAll(){
    	fwrite($this->fh,'top 1 1'.self::CRLF);
    	while( stripos(($row = fgets($this->fh)),'Sender:') === false){
    	}
    	return $row;
    }

    protected function getLine(){
    	return fgets($this->fh);
    }
    public function fclose(){
    	fclose($this->fh);
    }
}

header("Content-type: text/html; charset=utf-8");

$pop = new pop3();
try {
    $pop->conn();
    $pop->login();
    echo '发信人是';print_r($pop->getAll());
    $pop->fclose();
} catch(exception $e) {
    echo $e->getMessage();
}

?>