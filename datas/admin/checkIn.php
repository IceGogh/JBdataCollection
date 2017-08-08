<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>嘉宝管理员入口</title>
    <style>
        body{ padding:0; margin:0; backgrond:#ccc;}
        h2{
            text-align: center;
        }
        form{
            width:300px;
            height:300px;
            margin:200px auto 0;
        }
        form p {
            position: relative;
            height:30px;
        }
        span{
            position:absolute;
            height:30px;
            line-height:30px;
            text-indent:.5em;
        }
        input {
            text-indent:.5em;
            height:30px;
            width:200px;
        }
    </style>
</head>
<body>
    <h2>嘉宝橱柜管理后台登录系统(测试版1.0.1)</h2>
    <form action="adminlogin.php" method="POST">
        <p>
            <span>帐号</span>
            <input type="text" name="phone"/>
        </p>
        <p>
            <span>密码</span>
            <input type="password" name="password"/>
        </p>
        <p>
            <input type="submit" name="submit" value="登录"/>
        </p>
    </form>
</body>
<script src="../../js/jquery.min.js"></script>
<script>
    $(function(){
        $('input').on('focus', function(){
            $(this).prev('span').css({display:'none'});
        });
        if($('input').html()){
            $(this).prev('span').css({display:'none'});
        }
    })
</script>
</html>