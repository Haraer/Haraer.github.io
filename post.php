<?php
//在后端获取前端表单数据的方法是使用全局数组$_GET或$_POST   具体使用哪个要看前端获取的方法是什么
$name = $_POST['name'];
$pw = $_POST['pw'];
$cpw = $_POST['cpw'];
//echo "您的用户名是：" . $name;   //中间的点相当于加号将前面两个物品拼接起来。后面也可以加上“<br>”进行换行
//也可以在双引号里面直接放变量   注意单引号不行
//数据库中使用md5进行一个加密的操作，最终的字节长度为32


//因为将引入数据库另外写在conn.php页面里面了，因此每次引入只需要包含进来即可
include_once "conn.php";

//增加一些验证，验证用户名是否可用和密码是否一致
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

//验证两次密码是否一致
if ($pw <> $cpw){
    echo "<script>alert('请确认密码一致');history.back();</script>";
    exit;
}
else{
    //后端再次检查pw是否符合要求     preg函数第一个参数是一个字符串，即字符表达式是什么.第二个参数是和哪一个进行匹配
    if (!preg_match('/^[a-zA-Z0-9@*_]{6,10}$/',$pw)){
        echo "<script>alert('密码只能为6到10长度的字母和数字和特殊字符@*_');history.back();</script>";
        exit;
    }
}


//判断用户名是否存在
$sql = "select * from info where name = '$name'";
$result = mysqli_query($conn,$sql);   //返回一个记录集，如果有内容证明已经被占用
//判断里面是否有内容，使用以下函数，这个函数是显示行里面的记录数
$num = mysqli_num_rows($result);
if($num){
    echo "<script>alert('此用户名已经被占用');history.back();</script>";
    exit;     //终止执行
}


//第三步写入数据库，sql语句
$sql = "insert into info(name,pw,cpw,createtime) values ('$name','".md5($pw)."','".md5($cpw)."','".time()."')";   //引入数据
$result = mysqli_query($conn,$sql);   //第一个参数使用哪一个连接，第二个参数执行哪一个查询语句，这个是获得查询结果
if ($result){
    echo "<script>alert('注册成功');location.href='index.html';</script>";     //弹出成功的弹窗,转到首页
}
else{
    echo "<script>alert('发生波动，注册失败');history.back();</script>";
}


