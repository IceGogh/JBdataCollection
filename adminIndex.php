<!DOCTYPE html>
<?php
session_start();
if($_SESSION['uid']){

}else{
    header('refresh:-1; checkIn.php');
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>嘉宝橱柜后台管理</title>
    <style>
        .bodyinner {
            width:1200px;
            margin:0 auto;
            background:#eee;
        }
        .clearFl { display:block; width:0; height:0; font-size:0; clear:both;}
        .orno { display:inline-block; width:15px; height:15px; background:red;}
        .wrap { width:1200px; margin:20px auto 0; border:1px solid #000; border-bottom: none; background:#777;}
        .wrap div {
            text-indent:.5em;
        }
        .wrap > div > div{
            border-bottom: 1px solid #000;
            height:26px;
            line-height:26px;
        }
        .title {
            cursor:pointer;

        }
        .title span {
            margin-right:20px;
        }
        .info {
            height:auto;
        }
        .info > div {
            width:50%;
            float:left;

        }

        h2 {
            width:100%; height:50px; line-height:50px; text-align: center;
        }
        h4 {color:#bd8a39; border-bottom: 1px #bd8a39 inset; height:26px; line-height:26px;}

        h4 > span {
            color:red; margin-right:20px;
        }

        .pageSelect {
            color:#00a6b9;
        }

        .pageSelect > span {
            color:#bd8a39;
            margin-right:15px;
        }

        .pageSelect .changePage {
            display:inline-block;
            width: 68px;
            height:26px;
            line-height:26px;
            background:#bd8a39;
            text-align:center;
            color:#000;
            cursor:pointer;
            margin-left:15px;
        }
    </style>
</head>
<body>
<div class="bodyinner">

    <h2>嘉宝官网信息收集系统</h2>
    <h4>
        当前用户ID：
        <span>
            <?php
            echo $_SESSION['uid'];
            ?>
        </span>
        欢迎
        <span>
            <?php
            echo $_SESSION['name'];
            ?>
        </span>进入管理系统
    </h4>

    <?php
    include "connectAdmin.php";
    //  根据 url 参数  若没有参数 取 1
    $nowPages = !empty($_GET['page']) ? $_GET['page'] : 1;

    //  获取信息总条数
    $result = mysqli_query( $con,"SELECT id FROM user" );
    $num_rows = mysqli_num_rows( $result );
    $pageTotle =  $num_rows%10;

    $prePages = $nowPages - 1;
    if( $prePages < 1){
        $prePages = 1;
    }
    $nextPages = $nowPages + 1;
    if( $nextPages > $pageTotle){
        $nextPages = $pageTotle;
    }
    $showPage = 10;
    $startPage = $nowPages * $showPage - $showPage;
    $startPageA = $startPage + 1;
    $endPage = $startPage + $showPage;
    echo $nowPages.'<br/>'.$startPage.'<br/>'.$endPage;
    $sql = "select * from user order by id desc limit $startPage, $endPage";


    //    echo $sql;
    $query = mysqli_query($con, $sql);

    echo "<h4>
        客户信息列表
    </h4>
    <div class=\"pageSelect\">
        客户信息总条数
            <span>
            $num_rows
            </span>
        当前
        <span>
        第  $startPageA 条 至 $endPage 条
        </span>
        页面
        <span>
             $nowPages
        
        /
        
            $pageTotle 
        </span>
        <a href=\"http://localhost/Jiabao0519/admin/adminindex.php\" class='changePage first'>首页</a>
        <a href=\"http://localhost/Jiabao0519/admin/adminindex.php?page={$prePages}\" class='changePage prePage'>上一页</a>
        <a href=\"http://localhost/Jiabao0519/admin/adminindex.php?page={$nextPages}\" class='changePage nextPage'>下一页</a>
    </div>";


    while ($data = mysqli_fetch_assoc($query)){

        echo "<div class=\"wrap\">
        <div class=\"item\">
            <div class=\"title\">
                编号：<span class=\"number\">$data[id]</span>
                星期：<span class=\"date\">$data[week]</span>
                时间：<span class=\"time\">$data[time]</span>
                是否查看：<span class=\"orno\" data-color=$data[checkOr]></span>
                是否派单：<span class=\"orno\" data-color=$data[sendOr]></span>
                信息渠道：<span class=\"infoFrom\">$data[infoFrom]</span>

            </div>
        </div>
        <div class=\"info\">
            <div>
                客户姓名：<span class=\"name\">$data[name]</span>
            </div>
            <div>
                责任客服：<span class=\"name\">$data[customer]</span>
            </div>
            <div>
                手机号码 : <span class=\"phone\">$data[phone]</span>
            </div>
            <div>
                所在城市 : <span class=\"city\">$data[location]</span>
            </div>
            <div>
                QQ/微信：<span class=\"weico\">$data[weico]</span>
            </div>
            <div>
                楼盘名称：<span class=\"house\">$data[house]</span>
            </div>
            <i class=\"clearFl\"></i>
        </div>
        <div class=\"from\">
            <div>
                访问网页地址：<span class=\"href\">$data[href]</span>
            </div>
            <div>
                IP地址：<span class=\"IP\">$data[IP]</span>
            </div>
            <div>
                留言时间：<span class=\"time\">$data[time]</span>
            </div>
        </div>

    </div>";
    }

    ?>
</div>
</body>
<script src="../js/jquery.min.js"></script>
<script>
    $(function(){
        // changePage
        $('.prePage').on('click', function(){
            alert($startPage)
        })
    })
</script>
</html>
