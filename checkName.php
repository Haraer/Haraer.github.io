<?php
include_once 'conn.php';
$name = $_POST['name'];
$a = array();
if (empty($name)){
    $a['code'] = 1;
    $a['msg'] = '用户名不能为空';
}
else{
    $sql = "select 1 from info where name = '$name'";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)){
        //找到了用户名说明此用户名不可用
        $a['code']=0;
        $a['msg']='用户名已被占用';
    }
    else{
        $a['code']=2;
        $a['msg']='用户名可用';
    }
}
echo json_encode($a);