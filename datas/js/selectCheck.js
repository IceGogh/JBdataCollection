$(function(){

    showCustomerSelectForm();

    $('.selectTeam').on('change', function(){
        showCustomerSelectForm();
    });


    function showCustomerSelectForm(){

        //  根据选择的不同组 加载不同的客服
        var Custer = $('.selectCustomer');

        if($('.selectTeam').val() == 100 ){

            Custer.html(
                '<option value="">[不指定客服]</option>' +
                '<option value="肖右生">肖右生</option>' +
                '<option value="曾漂亮">曾漂亮</option>' +
                '<option value="涂品品">涂品品</option>')

        }else if($('.selectTeam').val() == 200 ){

            Custer.html(

                '<option value="">[不指定客服]</option>' +
                '<option value="柴慧">柴慧</option>' +
                '<option value="谢蓉">谢蓉</option>'+
                '<option value="彭靖">彭靖</option>')
        }else {

            Custer.html(
                '<option value="">[不指定客服]</option>')
        }


        //  根据前一次选择的 客服 遍历 option客服  选中的客服 附加 selected属性
        for(var i=0; i<$('.selectCustomer option').length; i++){
            (function(i){
                if($('.selectCustomer option').eq(i).val() == fcust){
                    $('.selectCustomer option').eq(i).attr('selected',true)
                }
            })(i)
        }


        //   选中的 状态
        var statusOp = $('select[name="F-status"]  > option');
        for(var i=0; i<statusOp.length; i++){
            (function(i){
                if( statusOp.eq(i).val() == fstatus ){
                    statusOp.eq(i).attr('selected', true)
                }
            })(i)
        };


        // 选中的 来源渠道  localStorage 本地存储
        var fromOp = $('select[name="F-from"]');

        if(sessionStorage.getItem("f-from")){
            var fFrom = sessionStorage.getItem("f-from");
            for(var i=0; i<fromOp.find('option').length; i++){
                (function(i){
                    if( fromOp.find('option').eq(i).val() == fFrom){
                        fromOp.find('option').eq(i).attr('selected', true)
                    }
                })(i)
            }
        };

        fromOp.on('change', function(){

            sessionStorage.setItem("f-from", fromOp.val());

        })

    }

});
