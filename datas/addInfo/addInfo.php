<!DOCTYPE html>
<?php
session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>信息收集</title>
    <link href="../css/table.css" rel="stylesheet"/>
</head>
<body>
<h2>后台信息添加</h2>
<?php

echo "<form class=\"wrap\" action='addInfoSend.php' method='post'>
      <h4>
        当前ID：
        <span>
           
             $_GET[id]
           
        </span>
        用户名:
        <span>
            
             $_SESSION[name]
            
        </span>

        <a class=\"changePW\" href='../admin/adminIndex.php?id=$_GET[id]'>返回</a>
      </h4>
        <div class=\"item\">
            <div class=\"title\">
                <span class=\"date\">
                信息渠道：
                    <span class=\"infoFrom\">
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
                                <input type='radio' name='from' class='qita' value='其他'/>其他
                            </label>
                
                       
                    </span>
                </span>
            </div>
        </div>
        <div class=\"info\">
            <div>
                客户姓名：<input type='text' name='name'/>
            </div>
            <div>
                责任客服：<span class=\"name\">$_SESSION[name]</span>
            </div>
            <div>
                手机号码 : <input type='text' name=\"phone\">
            </div>
            <div>
                所在城市 : <input type='text' name=\"city\">
            </div>
            <div>
                QQ/微信：<input type='text' name=\"weico\">
            </div>
            <div>
                楼盘名称：<input type='text' name=\"house\">
            </div>
            <i class=\"clearFl\"></i>
        </div>
        <div class=\"from\">
            <input type='submit' value='确认提交'/>
        </div>
    </form>"
?>
</body>
</html>
