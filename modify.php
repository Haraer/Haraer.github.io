<!doctype html>
<html lang="utf-8">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TEN 学习博客</title>
    <style>

        .main{width: 80%;margin: 0 auto;text-align: center;}
        <!-- 导航栏和标题设计 -->
        h2{font-size: 20px}
        h2 a{color: lightpink;text-decoration: none;margin-right: 15px}
        h2 a:last-child{margin-right: 0}
        h2 a:hover{color: aquamarine}

        .current{color: coral}    <!-- 当前页面显示的颜色 -->

    </style>
</head>
<body>
<div class="main">
    <?php
    include_once 'nav.php';
    include_once 'conn.php';
    $sql = "select * from info where name= '".$_SESSION['loggedName']."'";
    $result = mysqli_query($conn,$sql);
    if (mysqli_num_rows($result)){
        $info=mysqli_fetch_array($result);   //注意得到的是一个数组
    }
    else{
        die("未找到有效用户");
    }
    ?>

    <form action="postModify.php" method="post" onsubmit="return check()">
        <!--提交的表单   post更安全，密文传输优于默认的get   注意onsubmit是提前获取提取信息，即在点击提交的时候先去执行check这个方法，执行以后如果是真则继续，如果是假则不提交.真假取决于验证的数据-->
        <table align="center" border="1" style="border-collapse: collapse" cellpadding="10" cellspacing="0">
            <tr>
                <td>用户名</td>
                <td><input name="name" value="<?php  echo $info['name'] ?>"></td>
            </tr>
            <tr>
                <td>密码</td>
                <td><input name="pw" type="password" placeholder="不修改密码请留空"></td>
            </tr>
            <tr>
                <td>确认密码</td>
                <td><input name="cpw" type="password"placeholder="不修改密码请留空"></td>
            </tr>
            <tr>
                <td><input type="submit" value="提交"></td>
                <td><input type="reset" value="重置"></td>
            </tr>
        </table>
    </form>

</div>

<script>
    function check(){        //检验行为
        //这个函数返回的是一个数组，后面加【0】是指取第一个.后面的trim是指去掉空格
        let pw = document.getElementsByName('pw')[0].value.trim();
        let cpw = document.getElementsByName('cpw')[0].value.trim();

    //判断密码
        let pwReg=/^[a-zA-Z0-9@*_]{6,10}$/;
        if(pw.length>0){
            if (!pwReg.test(pw)){
                alert('密码只能为6到10长度的字母和数字和特殊字符@*_');
                return false;        //返回错误，在上面的return就会终止跳转页面
            }
            else {
                if (pw!=cpw){
                    alert('请确认密码一致');
                    return false;
                }
            }
            return true;     //如果以上都未触发证明合格，进入提交表单
        }
    }

</script>

</body>
</html>
