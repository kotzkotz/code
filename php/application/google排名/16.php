    <!DOCTYPE html>
    <html>  
    <body>  
        <?php  
                // 初始化一个 cURL 对象  
        $curl = curl_init();  
        $key = 'AIzaSyCmsDqmScSy2TNVbRRxDxll2RWTt3TxyzQ';  
        $cx = '014669375805372418625:hpevqrxmf-0';  
        $q = 'A-line';  
        $url = 'https://www.googleapis.com/customsearch/v1?'.'fields=items(link)&key='.$key.'&cx='.$cx.'&q='.$q.'&d=10&alt=json';
        // echo $url;exit;


        // https://www.googleapis.com/customsearch/v1?key=AIzaSyDHctGDOPv_aJelWL6z4Fp2jarBQUIuGOc&cx=014669375805372418625:hpevqrxmf-0&alt=json&q=A-line%20lace%20court%20train%20wedding%20dress&gl=US&start=2&dateRestrict=d10&fields=items(link)
        // echo $url;  
                // 设置你需要抓取的URL  
        curl_setopt($curl, CURLOPT_URL, $url);  
                // 设置header  
        curl_setopt($curl, CURLOPT_HEADER, 0);  
                // 设置cURL 参数，要求结果保存到字符串中还是输出到屏幕上。  
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                // 运行cURL，请求网页  
        $data = curl_exec($curl);  
                // 关闭URL请求  
        curl_close($curl);  
                // 显示获得的数据  
        // var_dump("string".$data);  
                // Parse json data  
        $json = json_decode($data,true);  

        print_r($json);




        ?>  
    </body>  
    </html> 

