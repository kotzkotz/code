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
				
			//是否客服人员id
			$sql="SELECT * FROM `kefu` WHERE  `user2` =  '{$fromUsername}' LIMIT 1";	
           $data = $mysql->getData($sql);
		   $user2=$data[0][user2];			
			if(!empty($user2))
			  {
					   if($keyword=="0")
				   {//结束对话
					 	$sql="UPDATE `kefu` SET `user`= '' WHERE  `user2` =  '{$fromUsername}' LIMIT 1";	
				$mysql->runSql($sql);
					 
				   }
				   else{
					//回复
				
				$sql="SELECT * FROM `kefu` WHERE  `user2` =  '{$fromUsername}' LIMIT 1";	
           $data = $mysql->getData($sql);
		   $customeid=$data[0][user];		
                if($type=="text"){	
				$this->sendtext($customeid,$keyword);
				}
				elseif($type=="voice"){
					$this->sendvoice($customeid,$MediaId);
					}
               }
		}
			
			//用户流程
	else{
				//是否已配对
		  $sql="SELECT * FROM `kefu` WHERE  `user` =  '{$fromUsername}' LIMIT 1";	
          $data = $mysql->getData($sql);
		  $user=$data[0][user];
		  if($user=="")
		    {		
				$sql="SELECT * FROM `kefu` WHERE  `user` =  ''";
				$data = $mysql->getData($sql);
				$id=$data[0][id];
				
				if(empty($id))
				{//已经有人
					$reply="客服正在忙，请稍后";
					$this->sendtext($fromUsername,$reply);	
				}
				else{
				$reply="正在连接客服";
				$this->sendtext($fromUsername,$reply);	
				$sql="UPDATE `kefu` SET `user`= '{$fromUsername}' WHERE  `user` =  '' LIMIT 1";	
				$mysql->runSql($sql);
				}
		    }
			else{	
				
				$kefuid=$data[0][user2];
				if ($type=="text"){
				$this->sendtext($kefuid,$keyword);	
				//与客服人员链接
				}
				elseif($type=="voice"){
					$this->sendvoice($kefuid,$MediaId);
					}
		       }
		  
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
}
?>