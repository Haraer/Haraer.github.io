<?php
//------连接数据库--------//
//链接数据库服务器
//第一步链接数据库服务器
$conn = mysqli_connect("localhost","root","root","member");
//存放到变量conn，下次链接直接使用变量即可
//增加一个判断是否链接成功语句
if (!$conn){
    die("连接数据库服务器失败");      //die表示输出参数里面的内容，然后终止程序的运行，从这行以后都不再执行
}


//第二步设置字符集
mysqli_query($conn,"set names utf8");

