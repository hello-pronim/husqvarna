jQuery(document).ready(function() {   
    jQuery.validator.setDefaults({
      debug: true,
      success: "valid"
    }); 

    $(".role").change(function(){
        if( $(this).val() == 2 ){
            $(".type_role").show();
        }else{
           $(".type_role").hide();
        }
    });

    $("#add_user").on('click', function(e){
        e.preventDefault();

        if ($('.register-form').validate({          
            rules : {
                'email': {
                    email:true
                },
                'password' : {
                    minlength : 8
                },
                'password_confirmation' : {
                    minlength : 8,
                    equalTo : "#password"
                }
            }
        }).form()) {
           
        }else{
            console.log("eeee");
            return false;
        }

        $username = $(this).find('input[name="username"]');

        var url = '/register_nl';

        $.ajax({
            type: "post",
            url: url,
            data: $(this).closest("form.register-form").serialize(),
            dataType: "json",
            success: function(res){
                console.log(res);
                if(res.status){
                    window.location.reload();
                } else {
                    window.alert(res.msg);
                }
            }
        });
        return false;
    });

    $(".usertype").change(function(e){
        e.preventDefault();
        if( $(this).val() ){
            var the = $(this);
            swal({
                title: "",
                text: "更新しますか？",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "確認",
                cancelButtonText: "キャンセル",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function(isConfirm) {
                if (isConfirm) {
                   $.ajax({
                        type: "post",
                        url: '/user/change_usertype',
                        data: {user_type: the.val(), user_id: the.attr('user-id'), _token: $("input[name='_token']").val()},
                        dataType: "json",
                        success: function(res){
                            console.log(res);
                            if(res.success){
                                toastr["success"]("更新されました", "成功!")                                
                            } else {                                
                                toastr["error"]("失敗した!", "失敗!")
                            }
                        }
                    });                     
                }             
            });
        }
        return false;           
    });

    $("#user_table").on('click', '.delete', function (e) {
            e.preventDefault();

            var nRow = $(this).parents('tr');
            var data_id = $(nRow).attr("data-id") ;

            swal({
                title: "",
                text: "削除しますか？",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "確認",
                cancelButtonText: "キャンセル",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function(isConfirm) {
                if (isConfirm) {

                    $.ajax({
                        type: "post",
                        url: '/user/delete',
                        data: {'user_id': data_id, _token: $("input[name='_token']").val()},
                        dataType: "json",
                        success: function(res){                            
                            if(res.success){
                                toastr["success"](res.msg, "成功!")
                                window.location.reload();
                            } else {
                                toastr["error"](res.msg, "失敗!")
                            }
                        }
                    });
                } 
            });
        });

});