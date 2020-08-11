<?php 
function bt_auth($api)
{
    $res ['request_time'] = time();
    $res ['request_token'] = md5(  $res ['request_time'].md5($api));
    return $res;
}

 function Curl_Post($url,$post,$time=5,$isjson=false){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
        if($isjson){
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8', 'Content-Length:' .strlen($post)));}
        // 最大执行时间
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT , $time);
        curl_setopt($curl, CURLOPT_TIMEOUT, $time);
        $data = curl_exec($curl);
        if($data=="") return curl_error($curl);
        curl_close($curl);
        return $data;
    }
    
    
    function pre_print($data){
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
    
    
    
function curlPut($destUrl, $sourceFileDir, $headerArr = array(), $timeout = 10)
{
    $ch = curl_init(); //初始化curl
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //返回字符串,而不直接输出
    curl_setopt($ch, CURLOPT_URL, $destUrl); //设置put到的url
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headerArr);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //不验证对等证书
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); //不检查服务器SSL证书

    curl_setopt($ch, CURLOPT_PUT, true); //设置为PUT请求
    curl_setopt($ch, CURLOPT_INFILE, fopen($sourceFileDir, 'rb')); //设置资源句柄
    curl_setopt($ch, CURLOPT_INFILESIZE, filesize($sourceFileDir));

    $response = curl_exec($ch);
    if ($error = curl_error($ch))
    {
        $bkArr =  array(
            'code' => 0,
            'msg' => $error,
        );
    }
    else
    {
        $bkArr =  array(
            'code' => 1,
            'msg' => 'ok',
            'resp' => $response,
        );
    }

    curl_close($ch); // 关闭 cURL 释放资源

    return $bkArr;
}

