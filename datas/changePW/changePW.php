<!DOCTYPE html>
<?php
include '../connectAdmin.php';
include "../lgCheck.php";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="../css/table.css" rel="stylesheet"/>
</head>

<body>
    <h2>后台管理系统-修改密码</h2>

    <div class="wrap">
        <h4>
            当前用户：
            <span>
            <?php
            echo $_SESSION['name'];
            ?>
            </span>
            <a href="../admin/adminIndex.php" style="float:right;">返回</a>
        </h4>
        <h3>密码修改</h3>
        <form action="changePWsend.php?id=<?php echo $_GET['id']; ?>" method="post">
            <p>
                原　密码：<input type="password" name="oldPw" placeholder="请输入旧的密码"/>
            </p>
            <p>
                新　密码：<input type="password" name="newPw" maxlength="18" minlength="8" placeholder="新密码最少8位字符"/>
            </p>
            <p>
                确认密码：<input type="password" name="newPw2" maxlength="18" minlength="8" placeholder="新密码最少8位字符"/>
            </p>
            <hr/>
            <input type="submit" value="确认修改"/>
        </form>
    </div>
</body>

</html>