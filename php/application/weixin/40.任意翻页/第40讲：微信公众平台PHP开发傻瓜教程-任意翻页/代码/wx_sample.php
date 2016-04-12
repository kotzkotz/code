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
				switch ($type)
			{   case "event";
				if ($customevent=="subscribe")
				    {$contentStr = "感谢你的关注\nqq群245628839\n栏目正在搭建，敬请期待\n回复m看视频教程";}
				break;
				case "image";
				$contentStr = "你的图片很棒！";
				break;
				case "location";
				$contentStr = "你的纬度是{$latitude},经度是{$longitude},我已经锁定！";
				break;
				case "link" ;
				$contentStr = "你的链接有病毒吧！";
				break;
				case "text";
				  	   include("coon.php");
				     $num = "SELECT * FROM `kecheng` ";
					 $que=mysql_query($num);
					 $no=mysql_num_rows($que);//获得条数
				     $sumpage=ceil($no/9);
				  switch ($keyword)
				  {			
					 
					
					case "m";
					 $sql3="SELECT * FROM `auto` where `user`= '{$fromUsername}'";
					 $query3=mysql_query($sql3);
					 $rm=mysql_fetch_array($query3);
					 $k=$rm['page'];
                     if (empty($k))
                     {                 
					$sq="INSERT INTO `auto` (`id` ,`user` ,`page`)VALUES (
NULL ,  '{$fromUsername}',  '{$k}')";
                       mysql_query($sq);}
					 $k++;
                     if ($k>$sumpage)
                     {$k=1;}
              
					 $sql4="UPDATE `auto` SET `page`={$k}  where `user`= '{$fromUsername}'";
                     mysql_query($sql4);
                   
                   break;}
                     
               $page=($k-1)*9;                   
					 $total=$no-$page+1;
                    
					 if($total>10)
					 {$total=10;} 
					 $sql = "SELECT * FROM `kecheng` ORDER BY `id` DESC LIMIT {$page},9";
					 $query=mysql_query($sql);				
					 $newsTpl = "<xml>
				<ToUserName><![CDATA[%s]]></ToUserName>
				<FromUserName><![CDATA[%s]]></FromUserName>
				<CreateTime>%s</CreateTime>
				<MsgType><![CDATA[news]]></MsgType>
				<ArticleCount>$total</ArticleCount>
				<Articles>
				<item>
				<Title><![CDATA[总共{$sumpage}页，输入m翻页]]></Title>
				<Description><![CDATA[]]></Description>
				<PicUrl>http://autoguitar.duapp.com/1.jpg</PicUrl>
				<Url><![CDATA[]]></Url>
				</item>";
					while($rs=mysql_fetch_array($query)){		
					$newsTpl.="<item>
							 <Title>$rs[title]</Title> 
							 <Description><![CDATA[]]></Description>
							 <PicUrl>http://autoguitar.duapp.com/1.jpg</PicUrl>
							 <Url>$rs[url]</Url>
							 </item>";
							 }
					$newsTpl.="</Articles>
							 <FuncFlag>0</FuncFlag>
							</xml>";
			 $myresultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time);
                     echo $myresultStr;
				    				
				
					
				 break;					
			default;
			$contentStr ="此项功能尚未开发";	
			}
				$msgType="text";
				$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
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