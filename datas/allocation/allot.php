<?php
if( $_SESSION['uid'] == 1000){
    echo
    "<select name='customer'>
    <option value='肖右生'";
    if($data['customer'] == '肖右生'){
        echo "selected";
    }
    echo
    ">肖右生</option>";

    echo
    "<option value='曾漂亮'";
    if($data['customer'] == '曾漂亮'){
        echo "selected";
    }
    echo
    ">曾漂亮</option>";

    echo
    "<option value='涂品品'";
    if($data['customer'] == '涂品品'){
        echo "selected";
    }
    echo
    ">涂品品</option>";

    echo
    "<option value='肖玉洁'";
    if($data['customer'] == '肖玉洁'){
        echo "selected";
    }
    echo
    ">肖玉洁</option>";


    echo "
    </select>";
}else if ( $_SESSION['uid'] == 2000){
    echo
    "<select name='customer'>
                                    <option value='柴慧'";
    if($data['customer'] == '柴慧'){
        echo "selected";
    }
    echo
    ">柴慧</option>";

    echo
    "<option value='谢蓉'";
    if($data['customer'] == '谢蓉'){
        echo "selected";
    }
    echo
    ">谢蓉</option>";

    echo
    "<option value='彭靖'";
    if($data['customer'] == '彭靖'){
        echo "selected";
    }
    echo
    ">彭靖</option>";

    echo
    "<option value='黄丽'";
    if($data['customer'] == '黄丽'){
        echo "selected";
    }
    echo
    ">黄丽</option>";


    echo
    "</select>";
}else if( $_SESSION['uid'] > 3000){
    echo "<input type='text' name='customer' value='$data[customer]' readonly/>";

}else{
    echo "<input type='text' name='customer' value='$data[customer]' readonly/>";
}


?>