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
				$keyword = trim($postObj->Content);
				$time = time();
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							 <MsgType><![CDATA[text]]></MsgType>
							 <Content>%s</Content>
							 <FuncFlag>0</FuncFlag>
							</xml>";             
						
				$strweather= substr($keyword,-6,6);
				$strcity=substr($keyword,0,strlen($keyword)-6); 
				if($strweather=="天气")
				{
				$url="http://api.map.baidu.com/telematics/v2/weather?location={$strcity}&ak=1a3cde429f38434f1811a75e1a90310c";
								
				 $fa=file_get_contents($url);
				 $f=simplexml_load_string($fa);
				 $city=$f->currentCity;
				 $da1=$f->results->result[0]->date;
				 $da2=$f->results->result[1]->date;
             	 $da3=$f->results->result[2]->date;		
				 $w1=$f->results->result[0]->weather;
				 $w2=$f->results->result[1]->weather;
             	 $w3=$f->results->result[2]->weather;		
				 $p1=$f->results->result[0]->wind;
				 $p2=$f->results->result[1]->wind;
             	 $p3=$f->results->result[2]->wind;
				 $q1=$f->results->result[0]->temperature;
				 $q2=$f->results->result[1]->temperature;
             	 $q3=$f->results->result[2]->temperature;	
				 $d1=$city.$da1.$w1.$p1.$q1;
				 $d2=$city.$da2.$w2.$p2.$q2;
				 $d3=$city.$da3.$w3.$p3.$q3;
				 $content=$d1.$d2.$d3;
				 if (empty($content))
				 {$content="你输入的地区有误";}
				 }
				 else{
				 $content="请输入地区天气,如北京天气进行天气情况查询";
				 }				               
			  $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time,$content);
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