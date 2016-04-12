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
                $MsgType=$postObj->MsgType;
				$j=$postObj->Location_X;
				$w=$postObj->Location_Y;
                $time = time();
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							 <MsgType><![CDATA[news]]></MsgType>
							 <ArticleCount>4</ArticleCount>
							 <Articles>
							 <item>
							 <Title><![CDATA[你周边附近的酒店如下]]></Title> 
							 <Description><![CDATA[s]]></Description>
							 <PicUrl><![CDATA[url]]></PicUrl>
							 <Url><![CDATA[url]]></Url>
							 </item>
							 <item>
							 <Title><![CDATA[%s]]></Title>
							 <Description><![CDATA[s]]></Description>
							 <PicUrl><![CDATA[url]]></PicUrl>
							 <Url><![CDATA[url]]></Url>
							 </item>
							 <item>
							 <Title><![CDATA[%s]]></Title>
							 <Description><![CDATA[s]]></Description>
							 <PicUrl><![CDATA[url]]></PicUrl>
							 <Url><![CDATA[url]]></Url>
							 </item>
							 <item>
							 <Title><![CDATA[%s]]></Title>
							 <Description><![CDATA[s]]></Description>
							 <PicUrl><![CDATA[url]]></PicUrl>
							 <Url><![CDATA[url]]></Url>
							 </item>
							 </Articles>
							 <FuncFlag>1</FuncFlag>
							</xml>";             
						
								
				if($MsgType=="location")
				
				{
				$url="http://api.map.baidu.com/telematics/v2/local?location={$w},{$j}&keyWord=酒店&number=3&ak=1a3cde429f38434f1811a75e1a90310c";
				}
				
				else
				{
				echo "";
        	     }
				 $fa=file_get_contents($url);
				 $f=simplexml_load_string($fa);
				 $d1=$f->poiList->point[0]->name;
				 $d2=$f->poiList->point[1]->name;
             	 $d3=$f->poiList->point[2]->name;		
				 $w1=$f->poiList->point[0]->address;
				 $w2=$f->poiList->point[1]->address;
             	 $w3=$f->poiList->point[2]->address;		
				 $p1=$f->poiList->point[0]->telephone;
				 $p2=$f->poiList->point[1]->telephone;
             	 $p3=$f->poiList->point[2]->telephone;		
				 $q1=$f->poiList->point[0]->distance;
				 $q2=$f->poiList->point[1]->distance;
             	 $q3=$f->poiList->point[2]->distance;	
				 $m1="{$d1}地址{$w1}电话{$p1}距离{$q1}米";
				 $m2="{$d2}地址{$w2}电话{$p2}距离{$q2}米";
				 $m3="{$d3}地址{$w3}电话{$p3}距离{$q3}米";			               
			  $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time,$m1,$m2,$m3);
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