/**
 * Created by Administrator on 2017/8/6.
 */
$(function(){
    $('.closeLg').on('click', function(){
        $.ajax({
            url : '../lgOut.php',
            type : 'post',
            success : function(data){
                alert('注销成功!');
                window.location.href = 'http://localhost/Jiabao0519/datas/admin/checkIn.php';
            }
        })
    })

});