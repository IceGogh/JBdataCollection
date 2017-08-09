<!DOCTYPE html>
<?php
include '../lgCheck.php';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>嘉宝橱柜后台管理</title>
    <link href="../css/table.css" rel="stylesheet"/>
    <script src="../../js/jquery.min.js"></script>
    <script src="../js/closeLg.js"></script>
</head>
<body>
<div class="bodyinner">

    <h2>嘉宝网络客户信息系统</h2>
    <h4>
        当前ID：
        <span>
            <?php
            echo $_SESSION['uid'];
            ?>
        </span>
        用户:
        <span>
            <?php
            echo $_SESSION['name'];
            ?>
        </span>

        <a class="changePW" href='../changePW/changePW.php?id=<?php
        echo $_SESSION['uid'];?>'>修改密码</a>
        <span class="closeLg">退出系统</span>
    </h4>

    <?php
    include "../connectAdmin.php";
    //  根据 url 参数  若没有参数 取 1
    $nowPages = !empty($_GET['page']) ? $_GET['page'] : 1;

    //  获取信息总条数
    $result = mysqli_query( $con,"SELECT id FROM user" );
    $num_rows = mysqli_num_rows( $result );
    $pageTotle =  ceil($num_rows/10);

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
    $endPage = $nowPages * $showPage;
    if($endPage > $num_rows){
        $endPage = $num_rows;
    }
    echo '现在页：'.$nowPages.'<br/>'.'开始页'.$startPage.'<br/>'.'结束页'.$endPage.'<br/>'.$pageTotle;
    $sql = "select * from user order by id desc limit $startPage, $endPage";


    //    echo $sql;
    $query = mysqli_query($con, $sql);

    echo "<h4>
        客户信息列表
        <a href='../addInfo/addInfo.php?id=$_SESSION[uid]' style='float:right;'>添加客户</a>
    </h4>
    <div class=\"pageSelect\">
        客户信息总条数
            <span>
            $num_rows
            </span>
        当前显示
        <span>
        第  $startPageA 条 至 $endPage 条
        </span>
        页面
        <span>
             $nowPages
        
        /
        
            $pageTotle 
        </span>
        <a href=\"http://localhost/Jiabao0519/datas/admin/adminindex.php\" class='changePage first'>首页</a>
        <a href=\"http://localhost/Jiabao0519/datas/admin/adminindex.php?page={$prePages}\" class='changePage prePage'>上一页</a>
        <a href=\"http://localhost/Jiabao0519/datas/admin/adminindex.php?page={$nextPages}\" class='changePage nextPage'>下一页</a>
    </div>";


    while ($data = mysqli_fetch_assoc($query)){

        echo "<div class=\"wrap\">
        <div class=\"item\">
            <div class=\"title\">
                编号：<span class=\"number\">$data[id]</span>
                <span class=\"date\">星期$data[week]</span>
                时间：<span class=\"time\">$data[time]</span>
                状态：<span class=\"orno$data[status]\" data-color=$data[status]></span>
              
                
                <a class=\"renew\" href='../updata/updata.php?id=$data[id]'>修改客户资料</a>
            </div>
        </div>
        <div class=\"info\">
            <div>
                客户姓名：<span class=\"name\">$data[name]</span>
            </div>
            <div>
                信息来源：<span class=\"infoFrom\">$data[infoFrom]</span>
            </div>
            <div>
                手机号码 : <span class=\"phone\">$data[phone]</span>
            </div>

            <div>
                责任客服：<span class=\"name\">$data[customer]</span>
            </div>
            <div>
                所在城市 : <span class=\"city\">$data[location]</span>
            </div>
            <div>
                所属团队 : <span class=\"team\">$data[team]</span>
            </div>
            
            <div>
                QQ/微信：<span class=\"weico\">$data[weico]</span>
            </div>
            <div>
                楼盘名称：<span class=\"house\">$data[house]</span>
            </div>
            <div>
                IP地址：<span class=\"IP\">$data[IP]</span>
            </div>
            <div>
                跟进导购：<span class=\"guide\">$data[guide]</span>
            </div>
            <i class=\"clearFl\"></i>
        </div>
        <div class=\"from\">
            <div>
                访问网页地址：
                <span class=\"href\">
                    <a href='$data[href]'>$data[href]</a>
                </span>
            </div>
            
        
        </div>

    </div>";
    }

    ?>
</div>
</body>
</html>
