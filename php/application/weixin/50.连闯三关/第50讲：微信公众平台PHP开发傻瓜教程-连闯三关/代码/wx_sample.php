<?php
/**
  * wechat php test
  */

//define your token
define("TOKEN", "weixin");
$wechatObj = new wechatCallbackapiTest();
if (isset($_GET['echostr'])) {
    $wechatObj->valid();
}else{
    $wechatObj->responseMsg();
}

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
		if (!empty($postStr)){
                
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
				$type = $postObj->MsgType;
				$customevent = $postObj->Event;
				$latitude  = $postObj->Location_X;
				$longitude = $postObj->Location_Y;
                $keyword = trim($postObj->Content);
                $time = time();
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content>%s</Content>
							<FuncFlag>0</FuncFlag>
							</xml>"; 
			   include("coon.php");            
				$array=array("河北"=>"石家庄","山西"=>"太原","广东"=>"广州","黑龙江"=>"哈尔滨","广西"=>"南宁","浙江"=>"杭州","江苏"=>"南京","山东"=>"济南","河南"=>"郑州");
				if($keyword=="8")
				{
               
				$a=array_rand($array,3);
               	$contentStr="第一题".$a[0]."省会是哪里？";
                 $a=implode(",",$a); 
                $sql="SELECT * FROM `menu2` where `user`= '{$fromUsername}'";
				$query=mysql_query($sql);
                $rm=mysql_fetch_array($query);  
				$user=$rm['user'];
                     if (empty($user))
                     {
				$sql="INSERT INTO `menu2` (`id` ,`user` ,`sec`,`answer`,`num`)VALUES (NULL ,  '{$fromUsername}',  '8','{$a}','0')";
                  mysql_query($sql);
				          }   
                  else{
                   $sql="UPDATE `menu2` SET `sec`='8',`answer`='{$a}', `num`='0' where `user`= '{$fromUsername}'";
		           mysql_query($sql);
                  }
                }
		else{
		$sql="SELECT * FROM `menu2` where `user`= '{$fromUsername}'";
				$query=mysql_query($sql);
				$rm=mysql_fetch_array($query);
				$sec=$rm['sec'];
				$answer=$rm['answer'];
                $answer=explode(",",$answer);
                       
                
				$num=$rm['num'];		
		if($sec=="8")
		{
          
          if($num=="0")
		  {
            
		  	if($keyword==$array[$answer[0]]){
		  $contentStr="恭喜你，答对了。\n第二题".$answer[1]."省会是哪里？";
		  $sql="UPDATE `menu2` SET `num`='1' where `user`= '{$fromUsername}'";
          mysql_query($sql);
	     	}
		else
	    	{$contentStr="很遗憾，你错了，重新来玩吧。";
			 $sql="UPDATE `menu2` SET `sec`='' where `user`= '{$fromUsername}'";
		     mysql_query($sql);
			}
          }  
		elseif($num=="1")
		  {
		  	if($keyword==$array[$answer[1]]){
		  $contentStr="恭喜你，答对了。\n第三题".$answer[2]."省会是哪里？";
		  $sql="UPDATE `menu2` SET `num`='2' where `user`= '{$fromUsername}'";
          mysql_query($sql);
	     	}
		else
	    	{$contentStr="很遗憾，再努力一把，重新来玩吧。";
			 $sql="UPDATE `menu2` SET `sec`='' where `user`= '{$fromUsername}'";
		     mysql_query($sql);
			}
          }
		elseif($num=="2")
		  {
		  	if($keyword==$array[$answer[2]]){
		  $contentStr="恭喜你，连闯三关！";
		  $sql="UPDATE `menu2` SET `sec`='' where `user`= '{$fromUsername}'";
          mysql_query($sql);
	     	}
		else
	    	{$contentStr="很遗憾，就差一步，重新来玩吧。";
			 $sql="UPDATE `menu2` SET `sec`='' where `user`= '{$fromUsername}'";
		     mysql_query($sql);
			}
		  }
         }   
		else 
		{$contentStr="请先输入8";
		}
		}
				$msgType="text";
				$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
                

        
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