<?php
/**
  * 投色子
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
				$Event=$postObj->Event;
				$EventKey=$postObj->EventKey;
		       	$keyword = trim($postObj->Content);
			    $time = time();
				$mysql = new SaeMysql();
				
				
			
					if($EventKey=="begin"){
		//有无空位
		  $sql="SELECT * FROM `caiquan` WHERE  `user2` =  '' AND  `user1` !=  '' LIMIT 1";	  
           $data = $mysql->getData($sql);
		   $user1=$data[0][user1];
		   $id=$data[0][id];
				if(empty($id))
					{//没有人等待
					$sql="INSERT INTO `caiquan` (`id`,`user1`)VALUES (
	NULL,  '{$fromUsername}')";	  	
					$mysql->runSql($sql);
					$reply="没有配对人员，请稍后";
				    $this->sendtext($fromUsername,$reply);
						
						}
					//有人等
					else{
					$sql="UPDATE `caiquan` SET `user2`= '{$fromUsername}' WHERE  `id` =  '{$id}' LIMIT 1";
					$mysql->runSql($sql);
					$reply="已配对，请投色子";
					$this->sendtext($fromUsername,$reply);
					$this->sendtext($user1,$reply);
					  }	
			   }
	
		
			elseif($EventKey=="end"){




$sql="SELECT * FROM `caiquan` WHERE  `user1` =  '{$fromUsername}' OR  `user2` =  '{$fromUsername}'";	
                 $data = $mysql->getData($sql);
				 $user1=$data[0][user1];
				 $user2=$data[0][user2];
$sql="DELETE FROM `caiquan` WHERE  `user1` =  '{$fromUsername}'
OR  `user2` ='{$fromUsername}'";	
				  $mysql->runSql($sql);
				    $reply="已结束游戏,点击重新开始";
					$this->sendtext($user1,$reply);
				$this->sendtext($user2,$reply);	 
	
				}
		// 
		elseif($EventKey=="play"){
				//判断用户是否在user1
				
				$sql="SELECT * FROM `caiquan` WHERE  `user1` =  '{$fromUsername}'
AND `user2` !=  '' ";	
                 $data = $mysql->getData($sql);
				 $id=$data[0][id];
				 if(!empty($id)){
					//user1情况
				$win1=rand(1,6);
				$user2=$data[0][user2];
				$sql="UPDATE `caiquan` SET `win1`= '{$win1}' WHERE  `id` =  '{$id}' LIMIT 1";		  
				$mysql->runSql($sql);
				 }
				else{
					//user2情况
				$sql="SELECT * FROM `caiquan` WHERE  `user2` =  '{$fromUsername}'
AND `user1` !=  '' ";	
                 $data = $mysql->getData($sql);
				 $id=$data[0][id];	
				 if(!empty($id)){
					 //确定为user2
					$win2=rand(1,6);
					$user1=$data[0][user1]; 
					$sql="UPDATE `caiquan` SET `win2`= '{$win2}' WHERE  `id` =  '{$id}' LIMIT 1";		  
				$mysql->runSql($sql); 
					 }
				else{
					$reply="请先配对";
					$this->sendtext($fromUsername,$reply);
					}
					
				} 
					
//判断输赢
				$sql="SELECT * FROM `caiquan` WHERE  `win1` !=  ''
AND `win2` !=  '' AND `id` =  '{$id}' ";	
                 $data = $mysql->getData($sql);
				 $id=$data[0][id];
				 
				 if(!empty($id)){
				 $user1=$data[0][user1];
				 $user2=$data[0][user2];
				 $win1=$data[0][win1];
				 $win2=$data[0][win2];
					 if($win1==$win2){
						 $reply="你投的是".$win1."对方投的是".$win2."平局";
					$this->sendtext($user1,$reply);
					$this->sendtext($user2,$reply);	 
						 }
					 elseif($win1>$win2){
						 $reply1="你投的是".$win1."对方投的是".$win2."你赢了";
						 $this->sendtext($user1,$reply1);
						 $reply2="你投的是".$win2."对方投的是".$win1."你输了";
						 $this->sendtext($user2,$reply2);
						 }
					elseif($win1<$win2){
						 $reply1="你投的是".$win1."对方投的是".$win2."你输了";
						 $this->sendtext($user1,$reply1);
						 $reply2="你投的是".$win2."对方投的是".$win1."你赢了";
						 $this->sendtext($user2,$reply2);
						}
					$sql="UPDATE `caiquan` SET `win1`= NULL,`win2`= NULL WHERE  `id` =  '{$id}' LIMIT 1";		  
				$mysql->runSql($sql); 	
						
							 
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
		
}
?>