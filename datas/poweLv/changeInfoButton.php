<?php
if($_SESSION['uid'] >= 1000){
    echo "<a class=\"renew\" href='../updata/updata.php?id=$data[id]'>修改资料/指定经销商</a>";
}
?>