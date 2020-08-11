<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>moocollege oss pac</title>
    <link rel="stylesheet" href="https://cdn.iw3c.top/bootstrap/bootstrap-3.3.7/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdn.iw3c.top/font_icon/font_awesome/4.7.0/css/font-awesome.min.css">
    <!--[if lt IE 9]>
    <script type="text/javascript" src = "https://cdn.iw3c.top/html5/html5shiv/r29/html5.min.js"></script>
    <script type="text/javascript" src = "https://cdn.iw3c.top/html5/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container">
    <div class="jumbotron">
        <h2>moocollege oss pac</h2>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <table class="table table-bordered">
                <tr><td width="15%">文件类型</td><td>不限制</td></tr>
               
                <tr><td>上传文件</td><td><button type="button" onclick="Button_Select()" class="btn btn-info"><i class="fa fa-search" style="color:white"></i>选择文件</button>&nbsp;&nbsp;&nbsp;<button type="button" onclick="UploadFiles()" class="btn btn-success"><i class="fa fa-upload" style="color:white"></i>上传文件</button></td></tr>
            </table>
            <input type="file" id="FileData" multiple = "multiple" style="display: none" onchange="SelectFiles()">
        </div>

    </div>


    <div class="panel panel-default">
    <div class="panel-heading"><h2>文件信息</h2></div>
    <div class="panel-body">
        <table class="table table-bordered" id="FileList">
            <thead><th width="10%">序号</th><th width="25%">文件名</th><th width="10%">文件大小</th><th width="10%">传输进度</th><th width="45%">访问链接</th></thead>
            <tbody id="FileList_Body"></tbody>
        </table>
    </div>

</div>
</div>


</body>
<script type="text/javascript" src = "https://cdn.iw3c.top/jquery/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src = "https://cdn.iw3c.top/jquery/lib/jquery.base64.js"></script>
<script type="text/javascript" src = "https://cdn.iw3c.top/jquery/lib/jquery.md5.js"></script>
<script type="text/javascript" src="https://gosspublic.alicdn.com/aliyun-oss-sdk-6.8.0.min.js"></script>
<script>

var fileobj = "/publicossupload/";

function Button_Select() {
    $("#FileData").click();
}

function SelectFiles() {
    var files = document.getElementById("FileData").files;
    var i = files.length;
    var FileHtml = "";
    for (var q = 0; q < i; q++) {
        file = files[q];
        files[q]["id"] = q;
        FileHtml = FileHtml + "<tr><td>" + (q + 1) + "</td><td>" + file["name"] + "</td><td>" + GetFileSize(file["size"]) + "</td><td id=\"Upload_Process_" + q + "\"></td><td id=\"File_Link_" + q + "\"</td></tr>";
    }
    $("#FileList_Body").html(FileHtml);
    console.log(files);
}

function GetFileSize(size) {
    var _size;
    var B = 1;
    var KB = 1024 * B;
    var MB = 1024 * KB;
    var GB = 1024 * MB;
    if (size < KB) _size = (size / KB).toFixed(2) + "&nbsp;KB";
    else if (size >= KB && size < MB) _size = (size / KB).toFixed(2) + "&nbsp;KB";
    else if (size >= MB && size < GB) _size = (size / MB).toFixed(2) + "&nbsp;MB";
    else _size = (size / GB).toFixed(2) + "&nbsp;GB";
    return _size;
}

function UploadFiles() {
    var files = document.getElementById("FileData").files;
    var i = files.length;
    UploadFileLine(0,i);
}

function UploadFileLine(q,j){
	var files = document.getElementById("FileData").files;
	file = files[q];
    $("#Upload_Process_" + q).html("<span style=\"color:orange\">上传中...</span>");
    $.ajax({
        url:"sign.php",
        dataType:"JSON",
        type:"GET",
        success:function(rdata){
            ossconfig = rdata;
            putObject(ossconfig,file,fileobj + randomString(64) + "/" + file["name"],q,j)
            
        }
    })
        
}






async function putObject (ossconfig,file,objcect_key,fileid,num) {
    
let client = new OSS({
    region: 'oss-cn-beijing',
    accessKeyId: ossconfig["data"]["credentials"]["AccessKeyId"],
    accessKeySecret:  ossconfig["data"]["credentials"]["AccessKeySecret"],
    stsToken: ossconfig["data"]["credentials"]["SecurityToken"],
    bucket: 'compeition-excute'
});


  try {
   
    let result = await client.put(objcect_key, file);
    
    url  = result.url;
    url = url.replace("http://","https://");
    id =fileid;
    	$("#Upload_Process_" + id).html("<span style=\"color:green\">上传成功</span>");
        $("#File_Link_" + id).html("<a href=\""+url+"\" target=\"_blank\">点此打开</a>");
    if(fileid+1!=num){UploadFileLine(fileid+1,num)
        
    }
    
  } catch (e) {
    console.log(e);
  }
}



function randomString(len) {
　　len = len || 32;
　　var $chars = 'ABCDEFGHJKMNPQRSTWXYZabcdefhijkmnprstwxyz2345678';   
　　var maxPos = $chars.length;
　　var pwd = '';
　　for (i = 0; i < len; i++) {
　　　　pwd += $chars.charAt(Math.floor(Math.random() * maxPos));
　　}
　　return pwd;
}

</script>
</html>