<?php
/**
  * wechat php test
  */

//define your token
define("TOKEN", "Cns");
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
				$type = $postObj->MsgType;
				$Event= $postObj->Event;
				$Latitude= $postObj->Latitude;
				$Latitude=doubleval($Latitude);
				$Longitude= $postObj->Longitude;
				$Longitude=doubleval($Longitude);
				$keyword = trim($postObj->Content);
			    $time = time();
				include("conn.php");
				if($Event=="subscribe")
				{
				$reply="感谢关注";
				$sql="INSERT INTO `run` (`id` ,`openid`,`sec`)VALUES (
NULL ,  '{$fromUsername}','0')";
                mysql_query($sql);
				}		 
				elseif($Event=="LOCATION")
			{
				$sql="SELECT * FROM `run` where `openid`= '{$fromUsername}'";
				$query=mysql_query($sql);
				$rm=mysql_fetch_array($query);
				$sec=$rm['sec'];
				if ($sec=="0")
				{				
				$Lat=$Latitude+0.001;
				$Long=$Longitude-0.001;
				$sql="UPDATE `run` SET `sec`='1',`Lat`='{$Lat}',`Long`='$Long' where `openid`= '{$fromUsername}'";
                mysql_query($sql);
				$reply="开始跑步签到，目标".$Lat.",".$Long;
				}
				else if($sec=="1")
				{
				$Lat=$rm['Lat'];
				$Long=$rm['Long'];
				$juli=$this->ceju($Long,$Lat,$Longitude,$Latitude);
                    if($juli<"150")
                   {
					$reply="恭喜你完成跑步签到，重新开始";
				$sql="UPDATE `run` SET `sec`='0'where `openid`= '{$fromUsername}'";
                mysql_query($sql);	
                    }
                   else{
             $reply="目标".$Lat.",".$Long."当前位置".$Latitude.",".$Longitude."距离".$juli."米";
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
       public function ceju($j1,$w1,$j2,$w2){
	           $geourl="http://api.map.baidu.com/telematics/v3/distance?waypoints={$j1},{$w1};{$j2},{$w2}&ak=1a3cde429f38434f1811a75e1a90310c";//测距api
				$apistr=file_get_contents($geourl);
				$apiobj=simplexml_load_string($apistr);
				$distanceobj=$apiobj->results->distance;
                                 $distanceobj=intval($distanceobj);
				return $distanceobj;
	                                           }


}

?>