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
$team = $data['team'];
echo "<form class=\"wrap\" action='updataSend.php' method='post'>
        <div class=\"item\">
            <div class=\"title\">
                编号：<input class=\"number\" type='text' name='id' value='$data[id]' readonly>
                星期：<span class=\"date\">$data[week]</span>
                时间：<span class=\"time\">$data[time]</span>
                状态：<span class=\"orno$data[status]\"></span>
                    <select name='status'>
                        <option value='1'>待跟进..</option>
                        <option value='2'>跟进中..</option>
                        <option value='3'>已订单..</option>
                        <option value='4'>客户流失</option>
                    </select>
                    <!--引入 JS 控制状态灯颜色 -->
                    <script src='../js/changeStatus.js'></script>
                    <span style='margin:0 0 0 30px;'>指定经销商:</span>";?>
<?php //if($_SESSION['uid'] > 3000){ echo "disabled=\"disabled\"";}?>
                    <select class="dealerList" name="dealer">
                        <option value="" <?php if($data['dealer'] == null){ echo 'selected="selected"';}?>>	--未选定--</option>
                        <option value="310" <?php if($data['dealer'] == 310){ echo 'selected="selected"';}?>>	邵阳旗舰店	</option>
                        <option value="311" <?php if($data['dealer'] == 311){ echo 'selected="selected"';}?>>	衡阳旗舰店	</option>

                        <option value="312" <?php if($data['dealer'] == 312){ echo 'selected="selected"';}?>>	岳阳旗舰店	</option>
                        <option value="313" <?php if($data['dealer'] == 313){ echo 'selected="selected"';}?>>	株洲旗舰店	</option>
                        <option value="314" <?php if($data['dealer'] == 314){ echo 'selected="selected"';}?>>	益阳旗舰店	</option>
                        <option value="315" <?php if($data['dealer'] == 315){ echo 'selected="selected"';}?>>	常德旗舰店	</option>
                        <option value="316" <?php if($data['dealer'] == 316){ echo 'selected="selected"';}?>>	永州旗舰店	</option>
                        <option value="317" <?php if($data['dealer'] == 317){ echo 'selected="selected"';}?>>	张家界旗舰店	</option>
                        <option value="318" <?php if($data['dealer'] == 318){ echo 'selected="selected"';}?>>	湘潭旗舰店	</option>
                        <option value="319" <?php if($data['dealer'] == 319){ echo 'selected="selected"';}?>>	娄底旗舰店	</option>
                        <option value="320" <?php if($data['dealer'] == 320){ echo 'selected="selected"';}?>>	怀化旗舰店	</option>
                        <option value="321" <?php if($data['dealer'] == 321){ echo 'selected="selected"';}?>>	吉首旗舰店	</option>
                        <option value="322" <?php if($data['dealer'] == 322){ echo 'selected="selected"';}?>>	双峰店	</option>
                        <option value="323" <?php if($data['dealer'] == 323){ echo 'selected="selected"';}?>>	衡东店	</option>
                        <option value="324" <?php if($data['dealer'] == 324){ echo 'selected="selected"';}?>>	新田店	</option>
                        <option value="325" <?php if($data['dealer'] == 325){ echo 'selected="selected"';}?>>	桃江店	</option>
                        <option value="326" <?php if($data['dealer'] == 326){ echo 'selected="selected"';}?>>	临武店	</option>
                        <option value="327" <?php if($data['dealer'] == 327){ echo 'selected="selected"';}?>>	安仁店	</option>
                        <option value="328" <?php if($data['dealer'] == 328){ echo 'selected="selected"';}?>>	祁东店	</option>
                        <option value="329" <?php if($data['dealer'] == 329){ echo 'selected="selected"';}?>>	通道店	</option>
                        <option value="330" <?php if($data['dealer'] == 330){ echo 'selected="selected"';}?>>	保靖店	</option>
                        <option value="331" <?php if($data['dealer'] == 331){ echo 'selected="selected"';}?>>	靖州店	</option>
                        <option value="332" <?php if($data['dealer'] == 332){ echo 'selected="selected"';}?>>	麻阳店	</option>
                        <option value="333" <?php if($data['dealer'] == 333){ echo 'selected="selected"';}?>>	临澧店	</option>
                        <option value="334" <?php if($data['dealer'] == 334){ echo 'selected="selected"';}?>>	武冈店	</option>
                        <option value="335" <?php if($data['dealer'] == 335){ echo 'selected="selected"';}?>>	古丈店	</option>
                        <option value="336" <?php if($data['dealer'] == 336){ echo 'selected="selected"';}?>>	望城店	</option>
                        <option value="337" <?php if($data['dealer'] == 337){ echo 'selected="selected"';}?>>	宁乡店	</option>
                        <option value="338" <?php if($data['dealer'] == 338){ echo 'selected="selected"';}?>>	平江店	</option>
                        <option value="339" <?php if($data['dealer'] == 339){ echo 'selected="selected"';}?>>	湘阴店	</option>
                        <option value="340" <?php if($data['dealer'] == 340){ echo 'selected="selected"';}?>>	醴陵店	</option>
                        <option value="341" <?php if($data['dealer'] == 341){ echo 'selected="selected"';}?>>	汝城店	</option>
                        <option value="342" <?php if($data['dealer'] == 342){ echo 'selected="selected"';}?>>	浏阳店	</option>
                        <option value="343" <?php if($data['dealer'] == 343){ echo 'selected="selected"';}?>>	沅陵店	</option>
                        <option value="344" <?php if($data['dealer'] == 344){ echo 'selected="selected"';}?>>	宜章店	</option>
                        <option value="345" <?php if($data['dealer'] == 345){ echo 'selected="selected"';}?>>	洪江店	</option>
                        <option value="346" <?php if($data['dealer'] == 346){ echo 'selected="selected"';}?>>	汉寿店	</option>
                        <option value="347" <?php if($data['dealer'] == 347){ echo 'selected="selected"';}?>>	石门店	</option>
                        <option value="348" <?php if($data['dealer'] == 348){ echo 'selected="selected"';}?>>	桂阳店	</option>
                        <option value="349" <?php if($data['dealer'] == 349){ echo 'selected="selected"';}?>>	华容店	</option>
                        <option value="350" <?php if($data['dealer'] == 350){ echo 'selected="selected"';}?>>	龙山店	</option>
                        <option value="351" <?php if($data['dealer'] == 351){ echo 'selected="selected"';}?>>	祁阳店	</option>
                        <option value="352" <?php if($data['dealer'] == 352){ echo 'selected="selected"';}?>>	常宁店	</option>
                        <option value="353" <?php if($data['dealer'] == 353){ echo 'selected="selected"';}?>>	邵东店	</option>
                        <option value="354" <?php if($data['dealer'] == 354){ echo 'selected="selected"';}?>>	茶陵店	</option>
                        <option value="355" <?php if($data['dealer'] == 355){ echo 'selected="selected"';}?>>	嘉禾店	</option>
                    </select>
<?php
echo
 "                <!--若经销商进入修改页面, 则 select 框仅显示选中的 option-->
                <script>
                    $(function(){
                        var oPtion = $('.dealerList option');
                
                        for(var i=0; i< oPtion.length; i++){
                            
                            if(oPtion.eq(i).val() != $data[dealer]){
                                oPtion.eq(i).remove();
                            }
                        }
                
                    })
                </script>

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
            </div>"?>

            <div>
                                到店情况:   
                <select name='arrive'>
                    <option value="未到" <?php if($data['arrive'] == '未到'){ echo "selected";}?>>未到</option>
                    <option value="已到店" <?php if($data['arrive'] == '已到店'){ echo "selected";}?>>已到店</option>
                </select>
            </div>
        <?php
        echo "
        
            <div>
                客户姓名：<input type='text' style='color:#fff' name='name' value='$data[name]' readonly/>
            </div>
        
            <div>
                责任客服：";
            //  组长 分配信息给组员 根据不同组长 显示不同的组员
            include  "../allocation/allot.php";

        echo "
            </div>
        
        
            <div>
                手机号码 : <input type='text' style='color:#E7E7E7'name=\"phone\" value='$data[phone]' maxlength='11' minlength='11' readonly/>
            </div>
            <div>
                所属团队 : ";
            include  "../teamTransform/teamTs.php";
        echo "
            </div>
            <div>
                所在城市 : <input type='text' name=\"location\" value='$data[location]'>
            </div>
            <div>
                楼盘名称：<input type='text' name=\"house\" value='$data[house]'>
            </div>
            "?>
            <div>
                咨询内容：
                <select name='consult'>
                    <option value='待填写' <?php if( $data['consult'] == '待填写' ){ echo "selected";}?>>待填写</option>
                    <option value='橱柜' <?php if( $data['consult'] == '橱柜' ){ echo "selected";}?>>橱柜</option>
                    <option value='衣柜集成' <?php if( $data['consult'] == '衣柜集成' ){ echo "selected";}?>>衣柜集成</option>
                    <option value='橱柜&衣柜集成' <?php if( $data['consult'] == '橱柜&衣柜集成' ){ echo "selected";}?>>橱柜&衣柜集成</option>
                </select>
            </div>
<?php
    echo "
            <div>
                跟进导购/经销商客服：<input type='text' name=\"guide\" value='$data[guide]'>
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
