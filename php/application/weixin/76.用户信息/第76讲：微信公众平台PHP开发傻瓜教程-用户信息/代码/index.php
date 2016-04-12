<?php
/**
  * wechat php test
  */

//define your token
define("TOKEN", "Cns");
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
				$type = $postObj->MsgType;
				$Event= $postObj->Event;
				$keyword = trim($postObj->Content);
			    $time = time();
				include("conn.php");
				if($Event=="subscribe")
				{
				//获取token
				$appid="";//填写appid
$secret="";//填写secret
$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$secret}";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$a = curl_exec($ch);
$strjson=json_decode($a);
$token = $strjson->access_token;
$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token={$token}&openid={$fromUsername}";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$a = curl_exec($ch);
$strjson=json_decode($a);
$nickname=$strjson->nickname;//获取昵称
$sex=$strjson->sex;//获取性别
$city=$strjson->city;//获取城市
$province=$strjson->province;//获取城市
$image= $strjson->headimgurl;//获取头像
//$image=substr($image,0,-1)."96";//换小头像
$img=file_get_contents($image);//获取远程，防盗链
$m=$fromUsername.".jpg";//命名头像
file_put_contents ($m,$img);//存入本地
				$reply=$nickname."感谢关注";
				$sql="INSERT INTO `user` (`id` ,`openid`,`nickname`,`sex`,`city`,`province`,`image`)VALUES (
NULL ,  '{$fromUsername}','{$nickname}','{$sex}','{$city}','{$province}','{$m}')";
                mysql_query($sql);
				}		 
				elseif($type=="text")
				{
				$sql="INSERT INTO `message` (`id` ,`openid`,`message`)VALUES (
NULL ,  '{$fromUsername}','{$keyword}')";
                mysql_query($sql);
				
				
				$reply='<a href="http://fuwuhao.duapp.com/message1.php">留言墙</a>';
				
					
				}
                   $textTpl = "<xml>
							<ToUserName>$fromUsername</ToUserName>
							<FromUserName>$toUsername</FromUserName>
							<CreateTime>$time</CreateTime>
							<MsgType><![CDATA[text]]></MsgType>
							<Content><![CDATA[$reply]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";            
      echo $textTpl;
          
      
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