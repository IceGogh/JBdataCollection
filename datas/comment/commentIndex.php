<!DOCTYPE html>
<?php
include '../lgCheck.php';
include '../connectAdmin.php';
$comment = "select comment from user where id = $_GET[id]";
$result = mysqli_query($con, $comment);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>查看/修改备注信息</title>
    <link href="../css/table.css" rel="stylesheet"/>
</head>
<body>
    <h2>查看/修改备注信息</h2>
    <div class="wrap">
        <div class="title">
            信息ID：
            <span>
            <?php
                echo $_GET['id'];
            ?>
            </span>
            客户姓名:
            <span>
                <?php
                echo $_GET['name'];
                ?>
            </span>
            <a href="../admin/adminIndex.php" style="float:right;">返回首页</a>
        </div>
    </div>
    <div class="wrap">
        <div style="border-bottom: 1px solid #eee;">
            备注列表：
            <input class='addComment' type="button" style="float:right;" value="添加备注"/>
        </div>
        <div>
            <?php
            echo (mysqli_fetch_assoc($result)['comment']);
            ?>
        </div>
        <form class="keyin" method="post"  action="commentSend.php?id=<?php echo $_GET['id']?>&name=<?php echo $_GET['name']?>">
            <textarea name="comment"></textarea>
            <p style="text-align: center;">
                <input class="sendComment" type="submit" disabled="disabled" value="确认提交"/>
                <input class="cancelComment" type="button" value="取消备注"/>
            </p>
        </form>
    </div>
</body>
<script src="../../js/jquery.min.js"></script>
<script>
    $(function(){
        $('.addComment').on('click', function(){
            $('.keyin').slideDown();
        });

        $('.cancelComment').on('click', function(){
            $('.keyin').slideUp();
        });

        $('.keyin textarea').on('keyup', function(){

            if( $('.sendComment').val()){

                $('.sendComment').removeAttr('disabled');
            }else{

                $('.sendComment').attr('disabled');
            }
        })
    })
</script>
</html>