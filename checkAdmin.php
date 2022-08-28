<?php
//首先判断是否为管理员
session_start();
if(!(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'])){
    //说明不是管理员，则显示以下
    echo "<script>alert('请登录管理者账号');location.href='index.html';</script>";
    exit;
}
?>