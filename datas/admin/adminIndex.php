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
    <!--日历插件-->
    <script src="../js/laydate.dev.js"></script>
</head>
<body>
<div class="bodyinner">

    <h2>嘉宝网络客户信息系统</h2>

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
    $team = floor($_SESSION['uid']/10);
    include "../connectAdmin.php";


    //  初始化 sessionWord  判断是否为 翻页方式 重载  如果是 则 不重置 sessionWord值
    if( !$_SERVER["QUERY_STRING"] ){
        $_SESSION['timeStartWord'] = $_SESSION['timeEndWord'] = $_SESSION['f_teamWord'] = $_SESSION['f_customerWord'] = $_SESSION['f_statusWord'] = $_SESSION['f_fromWord'] = ' ';
    }





//  根据 登录的管理人员 权限等级
if( $_SESSION['power'] == 0){



    /*  高级选择  选中组 */

    if( @$_POST['F-team'] ){

        $_SESSION['f_team'] = $_POST['F-team'];

        // 若选空 team 值
        if($_POST['F-team'] == " " ){
            $_SESSION['f_teamWord'] = ' ';
            // 若选中 team 值
        }else{
            $_SESSION['f_teamWord'] = ' where team = "'.$_POST['F-team'].'"';
        }
    }


}else if( $_SESSION['power'] == 1 ){

    $_SESSION['f_teamWord'] = " where team = ".$team;

}else if( $_SESSION['power'] == 2 ){

    $_SESSION['f_customerWord'] = ' where customer = "'.$customer.'"';

}




    /*  高级选择  选中客服 */


if( $_SESSION['power'] == 0 ||  $_SESSION['power'] == 1 ) {
    if( @$_POST['F-customer'] ){

        $_SESSION['f_customer'] = $_POST['F-customer'];

        // 若选空 customer 值
        if($_POST['F-customer'] == " " ){
            $_SESSION['f_customerWord'] =  ' ';

            // 若选中 customer 值

        }else{

            // 若 前面 team 值为空
            if( @$_SESSION['f_teamWord'] == ' '){

                if( $_SESSION['power'] == 0 ){
                    $_SESSION['f_customerWord'] = ' where customer = "'.$_POST['F-customer'].'"';
                }else{
                    $_SESSION['f_customerWord'] = ' and customer = "'.$_POST['F-customer'].'"';
                };

                // 若 前面 team 值选中
            }else{
                $_SESSION['f_customerWord'] = ' and customer = "'.$_POST['F-customer'].'"';
            }

        }
    }

}



    /* 高级选择 选中客户状态 status*/
    if( @$_POST['F-status'] ){

        $_SESSION['f_status'] = @$_POST['F-status'];

        // 若 status 为空
        if( $_POST['F-status'] == " "){
            $_SESSION['f_statusWord'] = " ";

        // 若 status 选中值
        }else{

            // 若 team 与 customer 两个中任意一个不为空
            if( @$_SESSION['f_teamWord'] != ' ' || @$_SESSION['f_customerWord'] != ' '){

                $_SESSION['f_statusWord'] = ' and status = "'.$_SESSION['f_status'].'"';

            // 若 team 与 customer 两个都为空
            }else{

                $_SESSION['f_statusWord'] = ' where status = "'.$_SESSION['f_status'].'"';

            }
        }
    }




    /* 高级选择  选中来源渠道*/
    if( @$_POST['F-from'] ){
        $_SESSION['f_from'] = $_POST['F-from'];
        // 若 from 选中为空
        if( $_POST['F-from'] == " "){
            $_SESSION['f_fromWord'] = ' ';

        // 若 from 选择值
        }else{
            // 若前面 team / customer / status 中 任意一个不为空
            if( @$_SESSION['f_teamWord'] != ' ' || @$_SESSION['f_customerWord'] != ' ' || @$_SESSION['f_statusWord'] != ' '){

                $_SESSION['f_fromWord'] = ' and infoFrom = "'.$_SESSION['f_from'].'"';

            //  若前面 team / customer / status 全部都为空
            }else{
                $_SESSION['f_fromWord'] = ' where infoFrom = "'.$_SESSION['f_from'].'"';
            }
        }
    }

    /* 高级选择 选中起 - 止时间*/
    if(@$_POST['timeStart'] || @$_POST['timeEnd']){
        $_SESSION['timeStart'] = @$_POST['timeStart'];
        $_SESSION['timeEnd'] = @$_POST['timeEnd'];

        // 若选择时间为空
        if ( $_SESSION['timeStart'] == " " || $_SESSION['timeEnd'] == " " ){
            $_SESSION['timeStartWord'] =  $_SESSION['timeEndWord'] = " ";

        // 若有选择时间
        }else{
            // 若前面 team / customer / status / from 中全部为空
            if( $_SESSION['f_teamWord'] == ' ' && $_SESSION['f_customerWord'] == ' ' && $_SESSION['f_statusWord'] == ' ' && $_SESSION['f_fromWord'] == " " ){

                $_SESSION['timeStartWord'] = ' where time between "'.$_SESSION['timeStart'].'"';
            }else{
                $_SESSION['timeStartWord'] = ' and time between "'.$_SESSION['timeStart'].'"';
            }

            $_SESSION['timeEndWord'] = ' and "'.$_SESSION['timeEnd'].' 23:59:59"';

        }
    }

    /* 高级选择 选中客户到店情况*/
    if(@$_POST['F-arrive']){
        $_SESSION['f_arrive'] = $_POST['F-arrive'];

        // 若到店情况放 空
        if( $_POST['F-arrive'] == " "){
            $_SESSION['f_arriveWord'] = " ";

            // 若选中 到店情况
        }else{
            // 若其他筛选条件 team / customer / status / from / timeEnd 全部为空
            if( $_SESSION['f_teamWord'] == ' ' &&
                $_SESSION['f_customerWord'] == ' ' &&
                $_SESSION['f_statusWord'] == ' ' &&
                $_SESSION['f_fromWord'] == " " &&
                $_SESSION['timeEndWord'] == ' ')
            {

                $_SESSION['f_arriveWord'] = ' where arrive ="'.$_SESSION['f_arrive'].'"';
            }else{
                $_SESSION['f_arriveWord'] = ' and arrive ="'.$_SESSION['f_arrive'].'"';
            }

        }
    }

    /* 高级选择 选中客户咨询内容*/
    if(@$_POST['F-consult']){
        $_SESSION['f_consult'] = $_POST['F-consult'];

        // 若客户咨询内容 放 空
        if( $_POST['F-consult'] == " "){
            $_SESSION['f_consultWord'] = " ";

        // 若客户咨询内容选中
        }else{
            // 若其他筛选条件 team / customer / status / from / timeEnd / arrive 全部为空
            if( $_SESSION['f_teamWord'] == ' ' &&
                $_SESSION['f_customerWord'] == ' ' &&
                $_SESSION['f_statusWord'] == ' ' &&
                $_SESSION['f_fromWord'] == " " &&
                $_SESSION['timeEndWord'] == ' ' &&
                $_SESSION['f_arriveWord'] == ' '
            )
            {
                $_SESSION['f_consultWord'] = ' where consult = "'.$_SESSION['f_consult'].'"';

            }else{
                $_SESSION['f_consultWord'] = ' and consult = "'.$_SESSION['f_consult'].'"';
            }
        }
    }



    if( $_SESSION['uid'] < 3000){
        echo "<form class=\"selectCheck\" style=\"height:130px; border:1px #eee solid;\" action=\"adminIndex.php\" method=\"post\">
        <div>
            开始日期：<input type=\"text\" name='timeStart' id=\"J-xl\">
            结束日期：<input type=\"text\" name='timeEnd' id=\"J-xl-3\">
            <span class='timeErr' style='color:red; visibility:hidden;'>时间段选择错误！！</span>
        </div>
        <br/>
        
        <div>
            到店状态:
                <select class='selectArrive' name='F-arrive' style='margin-right:80px;'>
                    <option value=' '>[不指定状态]</option>
                    <option value='未到'>未到</option>
                    <option value='已到店'>已到店</option>
                </select>
            
            咨询内容：
                <select class='selectConsult' name='F-consult'>
                    <option value=' '>[不指定内容]</option>
                    <option value='橱柜'>橱柜</option>
                    <option value='衣柜集成'>衣柜集成</option>
                    <option value='橱柜衣柜集成'>橱柜衣柜集成</option>
                </select>
        </div>
        <br/>";


        if( $_SESSION['uid'] < 1000 ){
            echo "
        <i>组别</i>
        <select class=\"selectTeam\" name=\"F-team\">
            <option value=\" \">[不指定组]</option>
            <option value=\"100\">肖右生组</option>
            <option value=\"200\">柴慧组</option>
        </select>";
        }else if ($_SESSION['uid'] == 1000 ){
            echo "<i>组别</i>
            <select class=\"selectTeam\" name=\"F-team\">
               
                <option value=\"100\">肖右生组</option>
              
            </select>";
        }else if ( $_SESSION['uid'] == 2000){
            echo "<i>组别</i>
            <select class=\"selectTeam\" name=\"F-team\">
            
                <option value=\"200\">柴慧组</option>
              
            </select>";
        }
        echo " <i>客服</i>
        <select class=\"selectCustomer\" name=\"F-customer\">
            <option value=\" \">[不指定客服]</option>
        </select>


        <i>状态</i>

        <select class=\"selectStatus\" name=\"F-status\">
            <option value=\" \">[不指定状态]</option>
            <option value=\"1\">待跟进..</option>
            <option value=\"2\">跟进中..</option>
            <option value=\"3\">已订单..</option>
            <option value=\"4\">客户流失</option>

        </select>

        <i>来源</i>
        <select class=\"selectFrom\" name=\"F-from\">
            <option value=\" \">[不指定来源]</option>
            <option value=\"官网\">官网</option>
            <option value=\"天猫\">天猫</option>
            <option value=\"淘宝\">淘宝</option>
            <option value=\"京东\">京东</option>
            <option value=\"400电话\">400电话</option>
            <option value=\"其他\">其他</option>
        </select>

        <input type=\"submit\" value=\"查询\" />

        <input type=\"button\" class=\"clearSelect\" style=\"display:inline-block; width:120px; float:right; margin-right:20px;\" value=\"清空查询条件\"/>
    </form>


    <!--高级查询, select框 前端JS 控制-->
    <script src=\"../js/selectCheck.js\"></script>";

    }






    ?>
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
                到店情况: <span style='color:blue'>$data[arrive]</span>
                状态：<span class=\"orno$data[status]\" data-color=$data[status]></span>
                
                ";

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
                咨询内容：<span class=\"weico\">$data[consult]</span>
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
<!--日历插件运行-->
<script type="text/javascript">
    laydate({

        elem: '#J-xl'

    });
    laydate({

        elem: '#J-xl-3'

    });

</script>
</html>
