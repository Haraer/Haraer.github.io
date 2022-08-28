<?php
include_once 'checkAdmin.php';
$action = $_GET['action'];
$id = $_GET['id'];
//进行一些判断
if (is_numeric($action) && is_numeric($id)){       //这里的函数iss_numeric是进行判断是否是数字
    if ($action == 1){
        // 1 说明是设置管理员, 0 说明是取消管理员
        $sql = "update info set admin =1 where id = $id";
    }
    elseif ($action == 0){
        $sql = "update info set admin =0 where id = $id";
    }

    else{
        echo"<script>alert('参数错误');history.back();</script>";
    }
    include_once 'conn.php';
    $result = mysqli_query($conn,$sql);
    if($result){
        echo"<script>alert('设置或取消管理员成功');location.href='admin.php';</script>";
    }
    else{
        echo"<script>alert('设置或取消管理员失败');history.back();</script>";
    }
}
else{
    //说明传输的action和id不是数字，即参数传输有问题
    echo"<script>alert('参数错误');history.back();</script>";
}
