<?php
$subject = "新客户：".$name.' 手机号码:'.$phone;
$message = "新客户：".$name."\n".'手机号码:'.$phone."\n".
    "客服访问地址： ".$href."\n".'客户所在地：'.$location.' 小区名字: '.$house."\n"."客户留言时间： ".$time;


if(mail($to, $subject, $message)){
    echo "Ok.";
}else{
    echo "send mail fail.";
};

?>