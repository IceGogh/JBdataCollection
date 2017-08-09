<!DOCTYPE html>
<?php
include "../lgCheck.php";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="../css/table.css" rel="stylesheet"/>
    <script src="../../js/jquery.min.js"></script>
    <style>
        input[readonly]{  background:#777; padding:0; border:0;}
    </style>
</head>
<body>
<h2>修改客户信息</h2>
<?php
$id =  $_GET['id'];
include '../connectAdmin.php';
$query = mysqli_query($con,"select * from user where id = $id");
$data = mysqli_fetch_assoc($query);
$team = substr($_SESSION['uid'], 0 , 1);
echo "<form class=\"wrap\" action='updataSend.php' method='post'>
        <div class=\"item\">
            <div class=\"title\">
                编号：<input class=\"number\" type='text' name='id' value='$data[id]' readonly>
                星期：<span class=\"date\">$data[week]</span>
                时间：<span class=\"time\">$data[time]</span>
                状态：<span class=\"orno$data[status]\" data-color=$data[status]></span>
     
                
                <a href='../admin/adminIndex.php' style='float:right;'>返回首页</a>
            </div>
        </div>

        <div class=\"info\">
        
            <div>
            <!--<input type='text' name='name' value=''/>-->
                信息渠道：
                <span class=\"infoFrom\">
                    <label>
                        <input type='radio' name='from' value='官网'/>官网
                    </label>
                    <label>
                        <input type='radio' name='from' value='天猫'/>天猫
                    </label>
                    <label>
                        <input type='radio' name='from' value='淘宝'/>淘宝
                    </label>
                    <label>
                        <input type='radio' name='from' value='京东'/>京东
                    </label>
                    <label>
                        <input type='radio' name='from' value='400电话'/>400电话
                    </label>
                    <label>
                        <input type='radio' name='from' value='其他'/>其他
                        </label>                
                </span>
            <script>
            /*JS 控制信息来源 checked*/
                function checked(elm){
                    if(elm.val() == '$data[infoFrom]'){
                        elm.attr('checked', 'checked')
                    }
                }
                for(var i=0; i<$('.infoFrom > label').length; i++){
                    checked($('.infoFrom').find('input').eq(i));
                }
            </script>
            </div>
            <div>
                
            </div>
            <div>
                客户姓名：<input type='text' name='name' value='$data[name]'/>
            </div>
            <div>
                责任客服：<span class=\"name\">$_SESSION[name]</span>
            </div>
            <div>
                手机号码 : <input type='text' name=\"phone\" value='$data[phone]'>
            </div>
            <div>
                所属团队 : $team
            </div>

            <div>
                所在城市 : <input type='text' name=\"city\" value='$data[location]'>
            </div>
            <div>
                楼盘名称：<input type='text' name=\"house\" value='$data[house]'>
            </div>
            <div>
                QQ/微信：<input type='text' name=\"weico\" value='$data[weico]'>
            </div>
           
            <div>
                跟进导购：<input type='text' name=\"guide\" value='$data[guide]'>
            </div>
            <i class=\"clearFl\"></i>
        </div>
        <div class=\"from\">
            <div>
                访问网页地址：<span class=\"href\">$data[href]</span>
            </div>
            
        </div>
        <input type='submit' value='确认修改'/>
        
    </form>
    ";

?>
</body>
</html>
