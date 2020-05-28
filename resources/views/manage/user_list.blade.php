@extends('layouts.app')

@section('content')

<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
    <!-- BEGIN PAGE HEADER-->

        <div class="row">
            <div class="col-md-12">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase">{{ trans("dashboard.user_list") }}</span>
                        </div>
                        <div class="pull-right">
                          <button class="btn green" data-toggle="modal" data-target="#add_user_modal">{{ trans("dashboard.add_customer") }}<i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="user_table">
                            <thead>
                                <tr>
                                    <th> </th>
                                    <th> {{ trans("dashboard.email") }} </th>                                    
                                    <th> {{ trans("dashboard.last_name") }} </th>
                                    <th> {{ trans("dashboard.first_name") }} </th>
                                    <!-- <th> {{ trans("dashboard.password") }} </th> -->
                                    <th> {{ trans("dashboard.phone") }} </th>
                                    <th> {{ trans("dashboard.company") }} </th>
                                    <th align="center" width="5%"> {{ trans("dashboard.action") }} </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($users) > 0)
                                    @foreach($users as $key => $value)
                                        <tr class="odd gradeX" data-id="<?= $value['id'] ?>">
                                            <td> 
                                                @if( $value['avatar'] && file_exists( public_path() .'/images/avatar/'. $value['avatar'] ))
                                                    <img src="{{ asset('images/avatar/'. $value['avatar']) }}">
                                                @else
                                                    <img class="img" src="{{ asset('images/avatar/default.png') }}" />
                                                @endif
                                            </td>
                                            <td> {{ $value['email'] }} </td>
                                            <td> {{ $value['last_name'] }} </td>
                                            <td> {{ $value['first_name'] }} </td>
                                            <!-- <td> {{ $value['username'] }} </td>-->
                                            <td> {{ $value['phone_number'] }}</td>
                                            <td> {{ $value['company'] }}</td>
                                           <td>
                                                <!-- <div class="btn-group pull-right">
                                                    <button class="btn green btn-xs btn-outline dropdown-toggle" data-toggle="dropdown">{{ trans("dashboard.action") }}
                                                        <i class="fa fa-angle-down"></i>
                                                    </button>
                                                    <ul class="dropdown-menu pull-right">
                                                        <li>
                                                            <a href="javascript:;">
                                                                <i class="fa fa-edit"></i> {{ trans("dashboard.edit") }} </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;" data-title="{{ trans('dashboard.remove_confirm') }}" data-type="warning" data-allow-outside-click="true" data-show-confirm-button="true" data-show-cancel-button="true" data-cancel-button-class="btn-danger" data-cancel-button-text='{{ trans("dashboard.cancel") }} ' data-confirm-button-text='{{ trans("dashboard.confirm") }} ' data-confirm-button-class="btn-info">
                                                                <i class="fa fa-remove"></i> {{ trans("dashboard.remove") }} </a>
                                                        </li>                                                        
                                                    </ul>
                                                </div>    -->     

                                                                                        
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- END CONTENT -->
<div id="add_user_modal" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="register-form" action="/user/register" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">{{ trans("dashboard.customer_info") }}</h4>
                </div>
                <div class="modal-body">
                    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto;">
                        <div class="scroller" style="overflow: hidden; width: auto;" data-always-visible="1" data-rail-visible1="1" data-initialized="1">
                            <div class="form-group">
                                <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                                <label class="control-label visible-ie8 visible-ie9">{{ trans('dashboard.email') }}</label>
                                <div class="input-icon">
                                    <i class="fa fa-envelope"></i>
                                    <input class="form-control placeholder-no-fix" type="text" placeholder="{{ trans('dashboard.email') }}" name="email" /> </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label visible-ie8 visible-ie9">{{ trans("dashboard.first_name") }}</label>
                                <div class="input-icon">
                                    <i class="fa fa-font"></i>
                                    <input class="form-control placeholder-no-fix" type="text" placeholder="{{ trans('dashboard.first_name') }}" name="first_name" /> </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label visible-ie8 visible-ie9">{{ trans("dashboard.last_name") }}</label>
                                <div class="input-icon">
                                    <i class="fa fa-font"></i>
                                    <input class="form-control placeholder-no-fix" type="text" placeholder="{{ trans('dashboard.last_name') }}" name="last_name" /> </div>
                            </div>                           
                            <div class="form-group">
                                <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                                <label class="control-label visible-ie8 visible-ie9">{{ trans("dashboard.position") }}</label>
                                <div class="input-icon">
                                    <i class="fa fa-envelope"></i>
                                    <input class="form-control placeholder-no-fix" type="text" placeholder="{{ trans('dashboard.position') }}" name="position" /> </div>
                            </div>                                                    
                            <div class="form-group">
                                <label class="control-label visible-ie8 visible-ie9">{{ trans("dashboard.password") }}</label>
                                <div class="input-icon">
                                    <i class="fa fa-lock"></i>
                                    <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="{{ trans('dashboard.password') }}" name="password" /> </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label visible-ie8 visible-ie9">{{ trans("dashboard.password_confirm") }}</label>
                                <div class="controls">
                                    <div class="input-icon">
                                        <i class="fa fa-check"></i>
                                        <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="{{ trans('dashboard.password_confirm') }}" name="rpassword" /> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn dark btn-outline">{{ trans("dashboard.return") }}</button>
                    <button type="submit" class="btn green" id="add_user">{{ trans("dashboard.register") }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="edit_role_modal" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="javascript:;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Edit Role</h4>
                </div>
                <div class="modal-body">
                    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto;">
                        <div class="scroller" style="overflow: hidden; width: auto;" data-always-visible="1" data-rail-visible1="1" data-initialized="1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-danger" role="alert" style="display:none" id="error_msg">
                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                        <span class="sr-only">Error:</span>
                                        User already exists
                                    </div>
                                    <div class="form-group">
                                        <label>User Name</label>
                                        <input type="text" name="username" class="form-control" disabled />
                                    </div>
                                    <div class="form-group">                                        
                                    </div>

                                    <input type="hidden" name="id" class="form-control" />
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
                    <button type="submit" class="btn green" id="edit_role">Edit User</button>
                </div>
            </form>
        </div>
    </div>
</div>
    
<script type="text/javascript">
    $(".role").change(function(){
        if( $(this).val() == 2 ){
            $(".type_role").show();
        }else{
           $(".type_role").hide();
        }
    });

    $("#add_user").on('click', function(e){
        e.preventDefault();

        if ($('.register-form').validate().form()) {
           // $('.register-form').submit();
            console.log("ttt");
        }else{
            console.log("eeee");
            return false;
        }


        $username = $(this).find('input[name="username"]');

        var url = '/user/register';

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
</script>

@endsection
