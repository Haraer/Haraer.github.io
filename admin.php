<?php
include_once 'checkAdmin.php';    //判断管理员文件
?>
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
    </style>
</head>
<body>
<div class="main">
    <?php
    include_once 'nav.php';
    include_once 'conn.php';
    include_once 'page.php';
    $sql = "select count(id) as total from info";   //使用聚合函数count统计id记录的总数
    $result = mysqli_query($conn,$sql);
    $info = mysqli_fetch_array($result);
    $total = $info['total'];    //total是给id总数的别称
    $perPage = 5;//设置每一页显示多少条数据
    $page = $_GET['page'] ?? 1;   //双问号标识标识如果有值就使用原值如果没有就赋值为1
    paging($total,$perPage); //引用分页函数
    $sql = "select * from info order by id desc limit $firstCount,$displayPG";
    $result = mysqli_query($conn,$sql);
    ?>
    <table border="1" cellspacing="0" cellpadding="10" style="border-collapse: collapse" align="center" width="90%">
        <tr>
            <td>序号</td>
            <td>用户名</td>
            <td>是否管理员</td>
            <td>操作</td>
        </tr>

        <?php
        $i=($page-1) * $perPage +1;
        while ($info = mysqli_fetch_array($result)){
        ?>
        <tr>
            <td><?php echo $i;?> </td>
            <td><?php echo $info['name'];?> </td>
            <td><?php echo $info['admin'] ? '是' : '否';?> </td>
            <td> <?php if($info['name'] <> 'admin')
                {?>
                    <a href="javascript:del(<?php echo $info['id'];?>,'<?php echo $info['name']; ?>');">删除会员</a>
                <?php
                }


                if ($info['admin']) {
                    if($info['name'] <> 'admin'){
                        ?><a href="setAdmin.php?action=0&id=<?php echo $info['id'];?>" >取消管理员</a>
                        <?php
                    } else{
                        echo'<span style="color: #555555">取消管理员</span>';
                    }
                } else {
                if ($info['name'] <> 'admin'){
                ?><a href="setAdmin.php?action=1&id=<?php echo $info['id'];?>" >设置管理员</a>
                    <?php
                    }
                    else{
                       echo'<span style="color: #555555">设置管理员</span>';
                    }
                }

                ?>
            </td>
        </tr>
        <?php
        $i++;
        }
        ?>
    </table>

    <?php echo $pageNav; ?>
</div>

<script>
    function del(id,name){
        if(confirm('您确定要删除会员' + name + ' ?' )){
            location.href='del.php?id=' + id + '&name' + name;
        }
    }
</script>

</body>
</html>
