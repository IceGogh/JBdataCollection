<?php
if($_SESSION['uid'] >= 1000 && $_SESSION['uid'] < 3000){
    echo "<a href='../addInfo/addInfo.php?id=$_SESSION[uid]' style='float:right;'>添加客户</a>";
}
?>