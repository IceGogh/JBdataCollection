

$(function(){
    var statusElm = $('.title span:nth-of-type(3)');
    var cls = statusElm.attr('class');
    var oldNub = cls[4];
    //  初始 status 状态灯及状态说明select选框
    $('.title select option').eq(oldNub-1).attr('selected','true');
    $('.title select').on('change', function(){
        //  根据选框变换 更换status状态灯颜色
        cls = statusElm.attr('class');
        oldNub = cls[4];
        var newcls = cls.slice(0,4) + $('.title select').val();
        statusElm
            .removeClass('orno' + oldNub)
            .addClass(newcls);
    })
});
