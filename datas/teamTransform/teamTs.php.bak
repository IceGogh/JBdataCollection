<?php
if($team == 100){
    echo "<span class=\"team\">肖右生组</span>";
}else if($team ==200){
    echo "<span class=\"team\">柴慧组</span>";
}
if($data['dealer']){
    $dealer = $data['dealer'] * 10;
/*中间插入 另外的数据表 抓取数据 影响后续的 $data[???] 值 ........ 先赋值到 data-dealer 渲染完成后 JS (dealer.js) 根据对应数据 更换对应中文名称*/

//    $sql = "select name from adminuser where phone = '$dealer'";
//    $query = mysqli_query($con, $sql);
//    $result = mysqli_fetch_assoc($query);
//    $dealerName =  $result['name'];
    echo "分配经销商:<span class='dealer' data-dealer='$dealer'></span>";
}
?>