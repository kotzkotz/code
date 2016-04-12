<?php
/**
  * wechat php test
  */

//define your token
define("TOKEN", "weixin");
$wechatObj = new wechatCallbackapiTest();
//$wechatObj->valid();
$wechatObj->responseMsg();
class wechatCallbackapiTest
{
	public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }

    public function responseMsg()
    {
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

      	//extract post data
		
                
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
		        $time = time();
				$type=$postObj->MsgType;
                $Event= $postObj->Event;
		        $keyword = trim($postObj->Content);
			    $time = time();
				$mysql = new SaeMysql();
				if($type=="text"){
				$reply="留言已上墙"; 
	            $textTpl = "<xml>
							<ToUserName>$fromUsername</ToUserName>
							<FromUserName>$toUsername</FromUserName>
							<CreateTime>$time</CreateTime>
							<MsgType><![CDATA[text]]></MsgType>
							<Content>$reply</Content>
							<FuncFlag>0</FuncFlag>
							</xml>";            
               echo $textTpl;
				
				include("token.php");
	
				$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token={$token}&openid={$fromUsername}";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$a = curl_exec($ch);
$strjson=json_decode($a);
$nickname=$strjson->nickname;//获取昵称
$image= $strjson->headimgurl;//获取头像
$samllimage=substr($image,0,-1)."132";//换小头像
$file= file_get_contents($samllimage);//获取远程，防盗链
$name=$fromUsername.".jpg";//命名头像
$stor = new SaeStorage();//保存到sae
$stor->write( 'download',$name,$file);//写入storage
$url=$stor->getUrl("download",$name);
$sql="INSERT INTO `user3` (`id` ,`openid`,`nickname`,`url`,`content`)VALUES (
NULL ,  '{$fromUsername}','{$nickname}','{$url}','{$keyword}')";
        $mysql->runSql($sql); 
     
	
				}
	
	}
		
	private function checkSignature()
	{
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];	
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
	
}
?>