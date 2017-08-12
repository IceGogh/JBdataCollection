<?php
if($_SESSION['uid'] >= 1000){
    echo "<a class=\"renew\" href='../updata/updata.php?id=$data[id]'>修改客户资料</a>";
}
?>