<?php
session_start();    //开启sesssion
$name = trim($_POST['name']);
$pw = md5(trim($_POST['pw']));     //trim去掉空格的
//判断用户名或密码是否为空
if (!strlen($name)or!strlen($pw)){
    echo "<script>alert('请输入用户名或密码');history.back();</script>";
    exit;
}    //strlen()用来验证字符长度,会返回变量的字符长度     history.back()是让页面后退一步
else{
    //后端再次检查用户名是否符合要求     preg函数第一个参数是一个字符串，即字符表达式是什么.第二个参数是和哪一个进行匹配
    if (!preg_match('/^[a-zA-Z0-9]{3,10}$/',$name)){
        echo "<script>alert('用户名只能为3到10长度的字母和数字');history.back();</script>";
        exit;
    }
}
//判断密码是否正确填写
if (!preg_match('/^[a-zA-Z0-9@*_]{6,10}$/',$_POST['pw'])){
    echo "<script>alert('密码只能为6到10长度的字母和数字和特殊字符@*_');history.back();</script>";
    exit;
}

include_once "conn.php";     //引入数据库

$sql="select * from info where name='$name' and pw='$pw'";
$result = mysqli_query($conn,$sql);    //第一个参数是数据源
//判断里面有没有东西使用以下函数，如果有就会返回条数，如果没有就是零
$num=mysqli_num_rows($result);
if($num){
    $_SESSION['loggedName'] = $name;       //这里是登录成功后给是session进行一个赋值，在后续可以根据它是否为真进行判断是否登录状态
    //判断是不是管理员
    $info = mysqli_fetch_array($result);    //将这登录的这一行进行抓取
    if ($info['admin']){       //根据在管理员设置这一行进行的0和1进行判断是否为管理员
        $_SESSION['isAdmin']=1;
    }
    else{
        $_SESSION['isAdmin']=0;
    }
    echo "<script>alert('登录成功');location.href = 'index.html';</script>";

}
else{
    unset($_SESSION['isAdmin']);
    unset($_SESSION['loggedName']);     //unset 销毁，inset查看是否为真
    echo "<script>alert('登录失败');history.back()</script>";
}
