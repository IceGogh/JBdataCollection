/**
 * Created by Administrator on 2017/8/15.
 */
$(function(){
    $('.bodyinner').on('click', '.wrap' ,function(){
        // 收起所有
        $('.info').addClass('hiddeInfo');
        $('.from').addClass('hiddeInfo2');
        // 展开点击的信息
        $(this)
            .find('.info').removeClass('hiddeInfo')
            .next('.from').removeClass('hiddeInfo2')
    })
});