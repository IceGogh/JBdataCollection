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
        用 户:
        <span>
             <?php
             $customer = $_SESSION['name'];
            echo  $customer;
            ?>
        </span>

        <a class="changePW" href='../changePW/changePW.php?id=<?php
        echo $_SESSION['uid'];?>'>修改密码</a>
        <span class="closeLg">退出系统</span>
    </h4>

    <?php
    include "../connectAdmin.php";
    $team = floor($_SESSION['uid']/10);
    $power =  $_SESSION['power'];

    //  根据 url 参数  若没有参数 取 1
    $nowPages = !empty($_GET['page']) ? $_GET['page'] : 1;


    //  根据 登录人员 的权限设置
    if( $power == 0 ){

        //  全局查看
        $result = mysqli_query( $con,"SELECT id FROM user");

    }else if( $power == 1 ){

        //  查看所属team的信息
        $result = mysqli_query( $con,"SELECT id FROM user where team = $team" );

    }else if(  $power == 2 ){
        //  查看个人所负责的信息
        $result = mysqli_query( $con,"SELECT id FROM user where customer = '$customer'" );
    }

    //  获取信息总条数
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


    //  根据 登录人员 的权限设置
    if( $power == 0 ){

        //  全局查看
        $sql = "select * from user order by id desc limit $startPage, $endPage";

    }else if( $power == 1 ){

        //  查看所属team的信息
        $sql = "select * from user  where team = $team order by id desc limit $startPage, $endPage";

    }else if ( $power == 2 ){
        //  查看个人所负责的信息
        $sql = "select * from user  where customer = '$customer' order by id desc limit $startPage, $endPage";
    }




    $query = mysqli_query($con, $sql);
    ?>

    <h4>
        客户信息列表
    <?php
    //  根据管理人员ID 是否赋予 [添加用户] 权限
    include '../poweLv/addInfoButton.php';


    echo "

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
        <a href=\"";
    include "../urlTransf.php";
    echo "datas/admin/adminindex.php\" class='changePage first'>首页</a>
        <a href=\"";
    include "../urlTransf.php";
    echo "datas/admin/adminindex.php?page={$prePages}\" class='changePage prePage'>上一页</a>
        <a href=\"";
    include "../urlTransf.php";
    echo "datas/admin/adminindex.php?page={$nextPages}\" class='changePage nextPage'>下一页</a>
    </div>";


    while ($data = mysqli_fetch_assoc($query)){

        $team = $data['team'];

        echo "<div class=\"wrap\">
        <div class=\"item\">
            <div class=\"title\">
                编号：<span class=\"number\">$data[id]</span>
                <span class=\"date\">星期$data[week]</span>
                时间：<span class=\"time\">$data[time]</span>
                状态：<span class=\"orno$data[status]\" data-color=$data[status]></span>";

    include "../poweLv/changeInfoButton.php";

    echo "</div>
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
                责任客服: <span class=\"name\">$data[customer]</span>
            </div>
            <div>
                所在城市 : <span class=\"city\">$data[location]</span>
            </div>
            <div>
                所属团队: 
                <span class=\"team\">";
                //  根据 工作人员ID值范围 转换成对应中文的 组别
                include '../teamTransform/teamTs.php';
        echo "
                    
                </span>
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
                跟进导购/经销商客服：<span class=\"guide\">$data[guide]</span>
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
