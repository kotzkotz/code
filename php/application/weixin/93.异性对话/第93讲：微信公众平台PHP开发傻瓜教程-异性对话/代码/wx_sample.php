<?php
/**
  * 多客服系统
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
				$fromUsername=strval($fromUsername);
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
		        $time = time();
				$type=$postObj->MsgType;				
                $MediaId= $postObj->MediaId;
		       	$keyword = trim($postObj->Content);
			    $time = time();
				$mysql = new SaeMysql();
				$sex=$this->getsex($fromUsername);
				echo $sex;
			//判断男1女2未知0
			if($sex=="1"){
			$sql="SELECT * FROM `love` WHERE  `boy` =  '{$fromUsername}' LIMIT 1";	
           $data = $mysql->getData($sql);
		   $boy=$data[0][boy];
		   $girl=$data[0][girl];			
			if(empty($boy))
			  {
				//查找有女孩占位的空位
			  $sql="SELECT * FROM `love` WHERE  `boy` =  '' AND  `girl` !=  '' LIMIT 1";	  
			  $data = $mysql->getData($sql);
			  $id=$data[0][id];
			  $girl=$data[0][girl];
					if(empty($id))
					{//没有女孩等待
					$sql="INSERT INTO `love` (`id`,`boy`)VALUES (
	NULL,  '{$fromUsername}')";	  	
					$mysql->runSql($sql);
					$reply="没有配对人员，请稍后";
					echo $reply;
					$this->sendtext($fromUsername,$reply);
						
						}
					else{
					$sql="UPDATE `love` SET `boy`= '{$fromUsername}' WHERE  `id` =  '{$id}' LIMIT 1";
					$mysql->runSql($sql);
					$reply="已配对，你可以她聊天了";
					$this->sendtext($fromUsername,$reply);
						echo $reply;
					$reply="已配对，你可以他聊天了";
					$this->sendtext($girl,$reply);
							echo $reply;
						}
			  }
		//处理会话
		 else{	
                   if($keyword=="0")
				   {//结束对话
				  $sql="UPDATE `love` SET `boy`= '' WHERE  `boy` =  '{$fromUsername}' LIMIT 1";	
				  $mysql->runSql($sql);
				    $reply="已结束聊天，请换人";
					$this->sendtext($fromUsername,$reply);
					$this->sendtext($girl,$reply);	 
				   }
				   else{
							
                if($type=="text"){	
				$this->sendtext($girl,$keyword);
				}
				elseif($type=="voice"){
					$this->sendvoice($girl,$MediaId);
					}
               }
		}
			
	}//boy流程
	//*********girl流程开始
	
	elseif($sex=="2"){
			$sql="SELECT * FROM `love` WHERE  `girl` =  '{$fromUsername}' LIMIT 1";	
           $data = $mysql->getData($sql);
		   $boy=$data[0][boy];
		   $girl=$data[0][girl];			
			if(empty($girl))
			  {
				//查找有男孩占位的空位
			  $sql="SELECT * FROM `love` WHERE  `girl` =  '' AND  `boy` !=  '' LIMIT 1";	  
			  $data = $mysql->getData($sql);
			  $id=$data[0][id];
			  $boy=$data[0][boy];
					if(empty($id))
					{//没有男孩等待
					$sql="INSERT INTO `love`  (`id`,`girl`)VALUES (
	NULL,  '{$fromUsername}')";	  	
					$mysql->runSql($sql);
					$reply="没有配对人员，请稍后";
					$this->sendtext($fromUsername,$reply);
						
						}
					else{
					$sql="UPDATE `love` SET `girl`= '{$fromUsername}' WHERE  `id` =  '{$id}' LIMIT 1";
					$mysql->runSql($sql);
					$reply="已配对，你可以他聊天了";
					$this->sendtext($fromUsername,$reply);
					$reply="已配对，你可以她聊天了";
					$this->sendtext($boy,$reply);
						}
			  }
		//处理会话
		 else{	
                   if($keyword=="0")
				   {//结束对话
				  $sql="UPDATE `love` SET `girl`= '' WHERE  `girl` =  '{$fromUsername}' LIMIT 1";	
				  $mysql->runSql($sql);
				    $reply="已结束聊天，请换人";
					$this->sendtext($fromUsername,$reply);
					$this->sendtext($boy,$reply);	 
				   }
				   else{
							
                if($type=="text"){	
				$this->sendtext($boy,$keyword);
				}
				elseif($type=="voice"){
					$this->sendvoice($boy,$MediaId);
					}
               }
		}
			
	}
	elseif($sex=="0"){
		$reply="性别未知，不提供服务";
					$this->sendtext($fromUsername,$reply);
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
	private function sendtext($touser,$text)
	
	{
include ("token.php");
$content=urlencode($text);
$a=array("content"=>"{$content}");
$b=array("touser"=>"{$touser}","msgtype"=>"text","text"=>$a);
$post=json_encode($b); 
$post=urldecode($post);
$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token={$token}";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);//url  
curl_setopt($ch, CURLOPT_POST, 1);  //post
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);  
curl_exec($ch);    
curl_close($ch); 		
		
		}
		private function sendvoice($touser,$media_id)
	
	{
include ("token.php");
$a=array("media_id"=>"{$media_id}");
$b=array("touser"=>"{$touser}","msgtype"=>"voice","voice"=>$a);
$post=json_encode($b); 
$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token={$token}";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);//url  
curl_setopt($ch, CURLOPT_POST, 1);  //post
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);  
curl_exec($ch);    
curl_close($ch); 		
		
		}
		private function getsex($fromUsername)
	
	{
include ("token.php");
$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token={$token}&openid={$fromUsername}";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$a = curl_exec($ch);
$strjson=json_decode($a);
$sex=$strjson->sex;//获取性别
return $sex;		
		}
}
?>