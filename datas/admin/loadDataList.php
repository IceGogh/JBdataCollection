<?php
$power =  $_SESSION['power'];

//  根据 url 参数  若没有参数 取 1
$nowPages = !empty($_GET['page']) ? $_GET['page'] : 1;


//  根据 登录人员 的权限设置
if( $power == 0 ){

    //  全局查看
    $result = mysqli_query( $con, "SELECT id FROM user ".@$_SESSION['f_teamWord'].@$_SESSION['f_customerWord'].@$_SESSION['f_statusWord'].@$_SESSION['f_fromWord'].@$_SESSION['timeStartWord'].@$_SESSION['timeEndWord'].@$_SESSION['f_arriveWord'].@$_SESSION['f_consultWord'].@$_SESSION['f_dealerWord']);

}else if( $power == 1 ){

    //  查看所属team的信息
    $result = mysqli_query( $con,"SELECT id FROM user ".@$_SESSION['f_teamWord'].@$_SESSION['f_customerWord'].@$_SESSION['f_statusWord'].@$_SESSION['f_fromWord'].@$_SESSION['timeStartWord'].@$_SESSION['timeEndWord'].@$_SESSION['f_arriveWord'].@$_SESSION['f_consultWord'].@$_SESSION['f_dealerWord'] );

}else if(  $power == 2 ){
    //  查看个人所负责的信息
    $result = mysqli_query( $con,"SELECT id FROM user ".@$_SESSION['f_teamWord'].@$_SESSION['f_customerWord'].@$_SESSION['f_statusWord'].@$_SESSION['f_fromWord'].@$_SESSION['timeStartWord'].@$_SESSION['timeEndWord'].@$_SESSION['f_arriveWord'].@$_SESSION['f_consultWord'].@$_SESSION['f_dealerWord']);
}else if( $power == 4 ){
    //  经销商
    $result = mysqli_query( $con,"SELECT id FROM user where dealer = '$team'" );
}


//  获取信息总条数;
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
    $sql = "select * from user ".@$_SESSION['f_teamWord'].@$_SESSION['f_customerWord'].@$_SESSION['f_statusWord'].@$_SESSION['f_fromWord'].@$_SESSION['timeStartWord'].@$_SESSION['timeEndWord'].@$_SESSION['f_arriveWord'].@$_SESSION['f_consultWord'].@$_SESSION['f_dealerWord']." order by id desc limit $startPage, $endPage";

}else if( $power == 1 ){

    //  查看所属team的信息
    $sql = "select * from user ".@$_SESSION['f_teamWord'].@$_SESSION['f_customerWord'].@$_SESSION['f_statusWord'].@$_SESSION['f_fromWord'].@$_SESSION['timeStartWord'].@$_SESSION['timeEndWord'].@$_SESSION['f_arriveWord'].@$_SESSION['f_consultWord'].@$_SESSION['f_dealerWord']." order by id desc limit $startPage, $endPage";
    echo $sql;
}else if ( $power == 2 ){
    //  查看个人所负责的信息

    $sql = "select * from user ".@$_SESSION['f_teamWord'].@$_SESSION['f_customerWord'].@$_SESSION['f_statusWord'].@$_SESSION['f_fromWord'].@$_SESSION['timeStartWord'].@$_SESSION['timeEndWord'].@$_SESSION['f_arriveWord'].@$_SESSION['f_consultWord'].@$_SESSION['f_dealerWord']." order by id desc limit $startPage, $endPage";

}else if( $power == 4 ){
    // 经销商帐号权限
    $sql = "select * from user  where dealer = '$team' order by id desc limit $startPage, $endPage";
}

$query = mysqli_query($con, $sql);
?>