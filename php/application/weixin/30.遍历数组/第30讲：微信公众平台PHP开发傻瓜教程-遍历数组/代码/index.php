<?php
/**
  * wechat php test
  */

//define your token
define("TOKEN", "jiekou");
$wechatObj = new wechatCallbackapiTest();
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
		if (!empty($postStr)){
                
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
             	$keyword = trim($postObj->Content);
				$time = time();
                $url="http://222.206.65.12/opac/search_rss.php?dept=ALL&title={$keyword}&doctype=ALL&lang_code=ALL&match_flag=forward&displaypg=20&showmode=list&orderby=DESC&sort=CATA_DATE&onlylendable=no";
				 $fa=file_get_contents($url);
				 $f=simplexml_load_string($fa);
				foreach ($f->channel->item as $reply)
				 {	
				 foreach ($reply->title as $re)
				    {
					$a[]=$re;
					}
				 }
				$no=count($a);
				
				if ($no>10)
				{$no=10;}
				else {}
							
				
				$textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							 <MsgType><![CDATA[news]]></MsgType>
							 <ArticleCount>$no</ArticleCount>
							 <Articles>";
			   	
				foreach($a as $id=>$b)
				{if($id>$no) break; else null; 
				$textTpl.=" <item>
							 <Title>$b</Title> 
							 <Description><![CDATA[s]]></Description>
							 <PicUrl><![CDATA[url]]></PicUrl>
							 <Url><![CDATA[url]]></Url>
							 </item>";
					
				}
					$textTpl.="</Articles>
							 <FuncFlag>1</FuncFlag>
							</xml>";             
					               
			  $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time);
                	echo $resultStr;
                  
                

        }else {
        	echo "";
        	exit;
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