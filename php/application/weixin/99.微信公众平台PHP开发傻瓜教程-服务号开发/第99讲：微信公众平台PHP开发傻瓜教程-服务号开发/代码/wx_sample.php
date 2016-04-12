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
				$EventKey= $postObj->EventKey;
		        $keyword = trim($postObj->Content);
			    $time = time();
				$Recognition= $postObj->Recognition;
				
			if($type=="event"){
				if($Event=="CLICK"){
					if($EventKey=="ques"){
						include("ques.php");
						echo $ques;
						}
					elseif($EventKey=="consult"){
						$mmc=memcache_init();//初始化缓存
						//写入缓存
						memcache_set($mmc,$fromUsername,"2",0,60);//过期时间600秒				
						$reply="请输入你的问题或发送语音，我们会尽快回复";
						include("textTpl.php");
						echo $textTpl;
						}
					elseif($EventKey=="case")
				{	
					//查找该用户是否绑定
					$mysql = new SaeMysql();
					$sql="SELECT * FROM `case` where `openid`= '{$fromUsername}'";
					$data = $mysql->getData($sql);
					$user=$data[0][openid];

						 if (empty($user)){
							 $reply="请先输入绑定密码";
							 include("textTpl.php");
							 echo $textTpl;
							 $mmc=memcache_init();//初始化缓存
							 memcache_set($mmc,$fromUsername,"3",0,60);//过期时间600秒	
							 }
	 
						else{
							$reply=$data[0][status];
							include("textTpl.php");
							echo $textTpl;
							}         
					
				}
			}//click
			
			elseif ($Event=="subscribe"){
          //欢迎语
		   
		   $reply="欢迎关注万格律所";
		  include("textTpl.php");
		  echo $textTpl;
		  //处理自动分组
		   include("city.php");
		  if($city=="佛山"){
			  $openid=strval($fromUsername);			
				$groupid=105;
				$b=array("openid"=>$openid,"to_groupid"=>$groupid);
				$post=json_encode($b); 
				include ("token.php");
				$url = "https://api.weixin.qq.com/cgi-bin/groups/members/update?access_token={$token}";
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);//url  
				curl_setopt($ch, CURLOPT_POST, 1);  //post
				curl_setopt($ch, CURLOPT_POSTFIELDS, $post);  
				curl_exec($ch);    
				curl_close($ch);
			  
			  }
		       //处理分场景统计
			  $c = new SaeCounter();
			   if($EventKey=="qrscene_1"){
			   $c->incr('ad',1);}
			   elseif($EventKey=="qrscene_2"){
			   $c->incr('site',1);}
			   elseif($EventKey=="qrscene_3"){
			   $c->incr('weibo',1);}
		       elseif($EventKey=="qrscene_2"){
			   $c->incr('book',1);}
			}
		}//event
          elseif($type=="text"){
			  //调取缓存
			  $mmc=memcache_init();//初始化缓存
			  $menu=memcache_get($mmc,$fromUsername);//获取二级菜单
			  	if($menu=="2"){
				 $mysql = new SaeMysql();//sae内部类链接数据库    
				 $sql="INSERT INTO `consult` (`id` ,`openid` ,`content`)VALUES (
NULL ,  '{$fromUsername}',  '{$keyword}')";
         		 $mysql->runSql($sql);
				  			}
				
			 elseif($menu=="3"){
					$mysql = new SaeMysql();
					$sql="SELECT * FROM `case` where `secret`= '{$keyword}'";
					$data = $mysql->getData($sql);
						if (empty($data)){
							$reply="密码错误";
							include("textTpl.php");
							echo $textTpl;
										}
						else {
							$sql="UPDATE `case` SET `openid`='{$fromUsername}' where `secret`= '{$keyword}'";
							$mysql->runSql($sql);
							$reply="已经绑定";
							include("textTpl.php");
							echo $textTpl;
							$mmc=memcache_init();//初始化缓存
							memcache_set($mmc,$fromUsername,"1",0,60);//过期时间600秒
							}
					 }//menu3
				
			else {
					$reply="请点击底部菜单栏选择";
					include("textTpl.php");
						echo $textTpl;
				}  
			  }	//text
			  
		elseif($type=="voice"){
			$mmc=memcache_init();//初始化缓存
			  $menu=memcache_get($mmc,$fromUsername);//获取二级菜单
			  if($menu=="2"){
				  $mysql = new SaeMysql();//sae内部类链接数据库    
		 $sql="INSERT INTO `consult` (`id` ,`openid` ,`content`)VALUES (
NULL ,  '{$fromUsername}',  '{$Recognition}')";
          $mysql->runSql($sql);
				  }
				else {
					$reply="请点击底部菜单栏选择";
					include("textTpl.php");
						
						echo $textTpl;
					}  
			
			}	//voice  
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