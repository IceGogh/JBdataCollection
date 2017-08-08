<!DOCTYPE html>
<?php
include "../lgCheck.php";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="../css/table.css" rel="stylesheet"/>
    <style>
        input[readonly]{  background:#777; padding:0; border:0;}
    </style>
</head>
<body>
<?php
$id =  $_GET['id'];
include '../connectAdmin.php';
$query = mysqli_query($con,"select * from user where id = $id");
$data = mysqli_fetch_assoc($query);
echo "<form class=\"wrap\" action='updataSend.php' method='post'>
        <div class=\"item\">
            <div class=\"title\">
                编号：<input class=\"number\" type='text' name='id' value='$data[id]' readonly>
                星期：<span class=\"date\">$data[week]</span>
                时间：<span class=\"time\">$data[time]</span>
                是否查看：<span class=\"orno\" data-color=$data[checkOr]></span>
                是否派单：<span class=\"orno\" data-color=$data[sendOr]></span>
                信息渠道：<span class=\"infoFrom\">$data[infoFrom]</span>
                <a href='../admin/adminIndex.php' style='float:right;'>返回首页</a>
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
                所在城市 :  <input type='text' name='location' value='$data[location]'/>
            </div>
            <div>
                QQ/微信：<input type='text' name='weico' value='$data[weico]'/>
            </div>
            <div>
                楼盘名称：<input type='text' name='house' value='$data[house]'/>
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
        </div>
        <input type='submit' value='确认修改'/>
        
    </form>
    ";

?>
</body>
</html>
