<?php
/**
  * wechat php test一站到底
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
				$EventKey= $postObj->EventKey;
		        $keyword = trim($postObj->Content);
			    $time = time();
				$Recognition= $postObj->Recognition;
				$mmc=memcache_init();//初始化缓存
				
			if($type=="event"){
				if($Event=="CLICK"){
					if($EventKey=="begin"){
							
						memcache_set($mmc,$fromUsername,"1");//第一题	
						$menu=memcache_get($mmc,$fromUsername);
					$mysql = new SaeMysql();
					$sql="SELECT * FROM `quiz` order by rand() limit 1";
					$data = $mysql->getData($sql);
					$que=$data[0][que];
					$reply="第1题：".$que;
					$ans=$data[0][ans];
					memcache_set($mmc,$fromUsername."ans",$ans);
						}
						
						
					elseif($EventKey=="1"){
						
						$menu=memcache_get($mmc,$fromUsername);
						if(empty($menu)){			
						$reply="点击开始答题";
							
								}
						else{
					
					$ans=memcache_get($mmc,$fromUsername."ans");
					if($ans==1){
						
						
						$menu=$menu+1;
						memcache_set($mmc,$fromUsername,$menu);
						$mysql = new SaeMysql();
						$sql="SELECT * FROM `quiz` order by rand() limit 1";
						$data = $mysql->getData($sql);
						$que=$data[0][que];
						$ans=$data[0][ans];
						memcache_set($mmc,$fromUsername."ans",$ans); 
						$reply="答对了，第".$menu."题：".$que;  
					           }//69
					else{
						$reply="答错了，重新开始";
						memcache_delete($mmc,$fromUsername);
							
						
					}
					}//60
			          }
			elseif($EventKey=="2"){
						$mmc=memcache_init();
						$menu=memcache_get($mmc,$fromUsername);
						if(empty($menu)){			
						$reply="点击开始答题";
										}
						else{
					$ans=memcache_get($mmc,$fromUsername."ans");
					if($ans==2){
						$menu=$menu+1;
						memcache_set($mmc,$fromUsername,$menu);
						$mysql = new SaeMysql();
						$sql="SELECT * FROM `quiz` order by rand() limit 1";
						$data = $mysql->getData($sql);
						$que=$data[0][que];
						$ans=$data[0][ans];
						memcache_set($mmc,$fromUsername."ans",$ans); 
						$reply="答对了，第".$menu."题：".$que;
						    
					           }//69
					else{
						$reply="答错了，重新开始";
						memcache_delete($mmc,$fromUsername);
					}
					}//60
			          }
					  elseif($EventKey=="3"){
						$mmc=memcache_init();
						$menu=memcache_get($mmc,$fromUsername);
						if(empty($menu)){			
						$reply="点击开始答题";
										}
						else{
					$ans=memcache_get($mmc,$fromUsername."ans");
					if($ans==3){
						$menu=$menu+1;
						memcache_set($mmc,$fromUsername,$menu);
						$mysql = new SaeMysql();
						$sql="SELECT * FROM `quiz` order by rand() limit 1";
						$data = $mysql->getData($sql);
						$que=$data[0][que];
						$ans=$data[0][ans];
						memcache_set($mmc,$fromUsername."ans",$ans); 
						$reply="答对了，第".$menu."题：".$que;
					           }//69
					else{
					$reply="答错了，重新开始";
						memcache_delete($mmc,$fromUsername);
					}
					}
			          }
			$textTpl = "<xml>
							<ToUserName>$fromUsername</ToUserName>
							<FromUserName>$toUsername</FromUserName>
							<CreateTime>$time</CreateTime>
							<MsgType><![CDATA[text]]></MsgType>
							<Content>$reply</Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
					echo $textTpl;
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
	
}
?>