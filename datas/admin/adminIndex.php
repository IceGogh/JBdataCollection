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
    <?php
    echo @$_POST['F-team'];
    echo '客服： '.@$_POST['F-customer'];
    echo '状态： '.@$_POST['F-status'];
    echo ' 来源： '.@$_POST['F-from'];
    echo ' 来源： '.@$_POST['f_status'];

    ?>

    <!--显示用户名title部分-->
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



    <!--高级筛选-->
    <?php
    include "../connectAdmin.php";
    ?>

    <form class="selectCheck" style="height:50px; border:1px #eee solid;" action="adminIndex.php" method="post">
         <i>组别</i>
        <select class="selectTeam" name="F-team">
            <option value="" <?php if( @$_POST['F-team'] == null){ echo 'selected="selected"';}?>>[不指定组]</option>
            <option value="100" <?php if( @$_POST['F-team'] == 100){ echo 'selected="selected"';}?>>肖右生组</option>
            <option value="200" <?php if( @$_POST['F-team'] == 200){ echo 'selected="selected"';}?>>柴慧组</option>
        </select>
        <i>客服</i>
        <select class="selectCustomer" name="F-customer">
            <option value="">[不指定客服]</option>
    <?php
        if(@$_POST['F-team'] == 100){
            echo '<option value="肖右生">肖右生</option>
                <option value="曾漂亮">曾漂亮</option>
                <option value="涂品品">涂品品</option>';
        }else if(@$_POST['F-team'] == 200){
            echo '<option value="柴慧">柴慧</option>
                <option value="谢蓉">谢蓉</option>
                <option value="彭靖">彭靖</option>';
        }
    ?>
        </select>


        <!-- 根据选定组 JS控制加载不同客服-->
        <?php
        /* 若选择 客服 则传值 PHP变量保存到 JS 变量 fcust */
        if(@$_POST['F-customer']){
            echo '<script>var fcust = "'.$_POST['F-customer'].'" </script>';
        }else{
        /* 若没有选择客服 JS 变量 fcust 为空 */
            echo '<script>var fcust = "";</script>';
        }







        /*  高级选择  选中组 */
        if( @$_POST['F-team']){
            $f_team = ' where team = '.@$_POST['F-team'];
        }else{
            $f_team ='';
        }

        /*  高级选择  选中客服 */
        if( @$_POST['F-customer']){
            /* 若选中客服 清空 选中组的条件*/
            $f_team ='';
            $f_customer = ' where customer = "'.@$_POST['F-customer'].'"';
        }else{
            $f_customer ='';
        }

        /* 高级选择 选中客户状态 status*/

        if( @$_POST['F-status']){

            //  若高级选择选中 组别 或者 客服
            if( @$_POST['F-team'] || @$_POST['F-customer']){
                $f_status = ' and status = '.@$_POST['F-status'];
            }else{
                $f_status = ' where status = '.@$_POST['F-status'];
            }
            /* JS 传值*/
            echo '<script>var fstatus = "'.$_POST['F-status'].'"</script>';
        }else{
            /*  若 未选 客户状态 状态值为 空*/
            $f_status = '';
            echo '<script>var fstatus = "";</script>';
        }


        /* 高级选择  选中来源渠道*/
        if( @$_POST['F-from']){

            // 若 前面有设置搜索条件
            if( @$_POST['F-team'] || @$_POST['F-customer'] || @$_POST['F-status']){
                $f_from = ' and infoFrom = "'.$_POST['F-from'].'"';

            }else{

                $f_from = ' where infoFrom = "'.$_POST['F-from'].'"';
            }
            /* 利用 H5 localStorage 缓存 使刷新页面后 select 默认选中之前的*/

        }else{
            //
            $f_from = '';
        }
        echo $f_from;
        ?>

        <i>状态</i>

        <select name="F-status">
            <option value="">[不指定状态]</option>
            <option value="1">待跟进..</option>
            <option value="2">跟进中..</option>
            <option value="3">已订单..</option>
            <option value="4">客户流失</option>

        </select>

        <i>来源</i>
        <select name="F-from">
            <option value="">[不指定来源]</option>
            <option value="官网">官网</option>
            <option value="天猫">天猫</option>
            <option value="淘宝">淘宝</option>
            <option value="京东">京东</option>
            <option value="400电话">400电话</option>
            <option value="其他">其他</option>
        </select>

        <input type="submit" value="查询" />

    </form>

    <!--高级查询, select框 前端JS 控制-->
    <script src="../js/selectCheck.js"></script>





    <!-- 根据登录的不同权限用户 加载显示不同的客户信息列表-->
    <h4>
        客户信息列表

    <?php

    //  根据管理人员ID 是否赋予 [添加用户] 权限
    include '../poweLv/addInfoButton.php';
    //  根据登录角色不同加载不同数据
    include 'loadDataList.php';
    ?>

    </h4>






    <?php
    echo "
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
        $urlencodename = urlencode($data['name']);

    //  根据管理人员ID 是否赋予 [备注] 权限
    include '../poweLv/commentButton.php';

    $statusNote = Array('', '未跟进', '跟进中', '已成单', '客户流失');
    echo $statusNote[$data['status']];

    $commentNew = stripos($data['comment'],'<hr/>');
    $commentNew2 = substr($data['comment'],0,$commentNew);
    if($commentNew2 == ''){
        $commentNew2 = '[暂无备注]';
    }

    echo "</div>
        </div>
        <div class=\"info hiddeInfo\">
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
                所属团队: ";
                //  根据 工作人员ID值范围 转换成对应中文的 组别
                include '../teamTransform/teamTs.php';
        echo "   
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
        <div class=\"from hiddeInfo2\">
            <div>
                访问网页地址：
                <span class=\"href\">
                    <a href='$data[href]'>$data[href]</a>
                </span>
            </div>
        </div>
        <div class='comment'>
            
                最新备注 : $commentNew2
                <i class='clearFl'></i>
        </div>
    </div>";
    }

    ?>
</div>
</body>
<!--页面(数据)加载完毕后 根据是否存在data-dealer值 中文显示经销商名称 -->
<script src="../js/dealer.js"></script>
<script src="../js/hiddenInfo.js"></script>
</html>
