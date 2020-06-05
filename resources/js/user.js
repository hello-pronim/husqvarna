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
                                swal("更新されました!", "", "success");
                            } else {
                                swal("失敗した!", "", "error");
                            }
                        }
                    });                     
                }             
            });
        }
        return false;           
    });

});