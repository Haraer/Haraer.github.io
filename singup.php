<!doctype html>
<html lang="utf-8">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css"  href="../TE/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.css">
    <!-- Stylesheet-->
    <link rel="stylesheet" type="text/css"  href="../TE/css/style.css">
    <link rel="stylesheet" type="text/css" href="../TE/css/nivo-lightbox/nivo-lightbox.css">
    <link rel="stylesheet" type="text/css" href="../TE/css/nivo-lightbox/default.css">

    <title>TEN 学习博客注册页面</title>
    <style>
        .red{color: #c9302c}
        .a{
            position:relative;
            top: 100px;
            width: 1100px;
            height: 500px;
            box-shadow: 0 5px 15px rgba(0,0,0,.8);
            display: flex;
            margin: auto;
        }
        .b{
            width: 800px;
            height: 550px;
            background-image: url("https://ts1.cn.mm.bing.net/th?id=OIP-C.UFzng6v3XAlLJCy5vcrWNAHaIS&w=152&h=170&c=8&rs=1&qlt=90&o=6&dpr=1.25&pid=3.1&rm=2");
            /* 让图片适应大小 */
            background-size: cover;
        }
        .c{
            width: 300px;
            height: 550px;
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .d{
            width: 250px;
            height: 500px;
        }
        .d h1{
            font: 900 30px '';
        }
        .e{
            width: 230px;
            margin: 20px 0;
            outline: none;
            border: 0;
            padding: 10px;
            border-bottom: 3px solid rgb(80,80,170);
            font: 900 16px '';
        }

    </style>
</head>

<!-- 标签头像 -->
<link rel="shortcut icon" href="img/1.png" type="image/png">

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
<!-- 导航-->
<nav id="login" class="navbar navbar-default navbar-fixed-top">
    <div class="container">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <!-- 元素只在屏幕阅读器中显示 -->
                <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            <a class="navbar-brand page-scroll" href="#page-top"><i class="fa fa-play fa-code"></i> BLOG</a> </div>


        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <!-- 将页面滚动到目标位置 -->
                <li><a href="index.html" class="page-scroll">首页</a></li>
                <li><a href="login.php" >登录</a></li>
            </ul>
        </div>
    </div>
</nav>


<div class="a">
    <div class="b"></div>
    <div class="c">
        <div class="d">
            <h1>注册</h1>
            <form action="post.php" method="post" onsubmit="return check()">
                <input name="name" onblur="checkname()" placeholder="用户名"> <span id="nameMsg">*</span><br>
                <input name="pw" type="password"placeholder="密码"><br>
                <input name="cpw" type="password"placeholder="确认密码"><br>
                <input type="submit" value="提交">
                <input type="reset" value="重置">
            </form>
        </div>
    </div>
</div>

<!--//使用jQuery 1.9.1版本的框架，使用ajax实现异步请求-->
<script src="https://apps.bdimg.com/libs/jquery/1.9.1/jquery.min.js"></script>


<script>
    function checkname(){
        let name = document.getElementsByName('name')[0].value.trim();
        let nameReg = /^[a-zA-Z0-9]{3,10}$/;
        if (!nameReg.test(name)) {
            alert('用户名必填，且只能是3到10个大小写字母或数字的字符');
            return false;
        }
        $.ajax({
            url:"checkName.php",
            type:'post',
            dataType:'json',
            data:{name:name},
            success:function (data) {
                if (data.code == 0){
                    //表明不可用date.msg
                    $("#nameMsg").text(data.msg).addClass('red');
                }
                else if(data.code == 2){
                    //表明可用
                    $("#nameMsg").text(data.msg);
                }

            },
            error:function (){
                alert('网络错误');
            }
        })
    }
    function check(){
        let name = document.getElementsByName('name')[0].value.trim();
        //这个函数返回的是一个数组，后面加【0】是指取第一个.后面的trim是指去掉空格
        let pw = document.getElementsByName('pw')[0].value.trim();
        let cpw = document.getElementsByName('cpw')[0].value.trim();

        //确认用户名是否填写正确
        //     if (name.length==0){
        //         alert('用户名不能为空');
        //         return false;
        //     }
        //  规定了字符要求
        let nameReg=/^[a-zA-Z0-9]{3,10}$/;
        if (!nameReg.test(name)){
            alert('用户名只能为3到10长度的字母和数字');
            return false;        //返回错误，在上面的return就会终止跳转页面
        }
        //判断密码
        let pwReg=/^[a-zA-Z0-9@*_]{6,10}$/;
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
</script>


<br><br><br><br><br><br><br><br>
<!-- 底部 -->
<div id="footer" >
    <div class="container text-center">
        <div class="fnav">
            <p>这是注册页面的神秘领域。</p>
        </div>
    </div>
</div>

</body>
</html>
