<?php 

include_once "function.php";
$url = "https://cc.moocollege.com/nodeapi/3.0.1/common/upload/getOssUploadPolicy";
$res= Curl_Post($url,$data=array());

echo $res;