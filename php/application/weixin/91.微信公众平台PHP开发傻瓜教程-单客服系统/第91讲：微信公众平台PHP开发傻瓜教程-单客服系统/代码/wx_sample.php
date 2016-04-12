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
				$fromUsername=strval($fromUsername);
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
		        $time = time();
				$type=$postObj->MsgType;				
                $MediaId= $postObj->MediaId;
		       	$keyword = trim($postObj->Content);
			    $time = time();
				$mmc=memcache_init();//初始化缓存
				
			//客服人员id	
			if($fromUsername=="os7R7uGofd69mYftQo7NTBgAFqTg")
			    {
					   if($keyword=="0")
				   {//结束对话
					 $customeid=memcache_get($mmc,"customeid");//获取id
					  memcache_delete($mmc,"customeid");
					  memcache_delete($mmc,$customeid);
				   }
				   else{
					//回复
				
				$customeid=memcache_get($mmc,"customeid");//获取id
                if($type=="text"){	
				$this->sendtext($customeid,$keyword);
				}
				elseif($type=="voice"){
					$this->sendvoice($customeid,$MediaId);
					}
                	}
				}
			else{
			
            $status=memcache_get($mmc,$fromUsername);//获取状态	
			if($status==1){
				//发送客服
				memcache_set($mmc,$fromUsername,1,0,120);//过期时间2分钟
				
				$kefuid="os7R7uGofd69mYftQo7NTBgAFqTg";
				if($type=="text"){
				$this->sendtext($kefuid,$keyword);	
				}
				elseif($type=="voice"){
				$this->sendvoice($kefuid,$MediaId);
				}
				}	
			else{
				$customeid=memcache_get($mmc,"customeid");
				if(!empty($customeid))
				{//已经有人
					$reply="客服忙，请稍后";
					$this->sendtext($fromUsername,$reply);	
					}
				else{
				$reply="正在连接客服";
				$this->sendtext($fromUsername,$reply);	
				memcache_set($mmc,$fromUsername,1,0,120);//过期时间2分钟
				memcache_set($mmc,"customeid",$fromUsername);//客户id	
				
				$kefuid="os7R7uGofd69mYftQo7NTBgAFqTg";
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