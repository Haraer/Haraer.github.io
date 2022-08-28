<?php
session_start()
?>
<style>
    .current{color: coral}    <!-- 当前页面显示的颜色 -->
    .logged{font-size: 16px;color: black}
    .logout{margin-left: 20px;}

</style>

<h1>TEN 学习博客</h1>
<?php
if (isset($_SESSION['loggedName']) <> ''){
    ?>
    <div class="logged">登录用户：<?php echo $_SESSION['loggedName'];?>  <span class="logout"><a href="logout.php">注销登录</a></span> </div>

    <?php
    if ($_SESSION['isAdmin']){echo "欢迎管理员登录";}
    ?>

    <?php
}
$id=isset($_GET['id']) ? $_GET['id'] : 1;
?>

<h2>
    <a href="index.html?id=1" <?php if ($id==1){?>class="current"<?php } ?>>首页</a>
    <a href="singup.html?id=2" <?php if ($id==2){?>class="current"<?php } ?>>注册</a>
    <a href="login.html?id=3" <?php if ($id==3){?>class="current"<?php } ?>>登录</a>
    <a href="modify.php?id=4"<?php if ($id==4){?>class="current"<?php } ?>>资料修改</a>
    <a href="admin.php?id=5"<?php if ($id==5){?>class="current"<?php } ?>>后台管理</a>
</h2>
<!-- 增加if灵活判断在哪一个页面，前面的三元运算符是防止直接在首页就会导致id=0这一情况。-->