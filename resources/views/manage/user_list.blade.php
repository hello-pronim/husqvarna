@extends('layouts.app')

@section('content')

<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
    <!-- BEGIN PAGE HEADER-->
        @csrf
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
                                    <th> {{ trans("dashboard.username") }} </th>
                                    <th> {{ trans("dashboard.phone") }} </th>
                                    <th> {{ trans("dashboard.company") }} </th>
                                    <th width="150"> {{ trans("dashboard.user_type") }} </th>
                                    <th width="50"> {{ trans("dashboard.action") }} </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($users) > 0)
                                    @foreach($users as $key => $value)
                                        <tr class="odd gradeX" data-id="{{$value['id']}}">
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
                                            <td> {{ $value['username'] }} </td>
                                            <td> {{ $value['phone'] }}</td>
                                            <td> {{ $value['company'] }}</td>
                                           <td>
                                                @if( App\Enums\UserType::Superadmin == Auth::user()->user_type )
                                                    @csrf
                                                    <select user-id="{{$value['id']}}" name="user_type" class="form-control usertype form-filter input-sm">
                                                        <option value="">{{ trans('dashboard.select') }}</option>
                                                        {!! App\Enums\UserType::toOptions($value['user_type']) !!}
                                                    </select>   
                                                @else
                                                    {{ trans('dashboard.'.$value['user_type']) }} 
                                                @endif
                                                <se>                                        
                                            </td>
                                            <td>
                                                <div class="btn-group pull-right">
                                                    <button class="btn green btn-xs btn-outline dropdown-toggle" data-toggle="dropdown">{{ trans('dashboard.action') }}<i class="fa fa-angle-down"></i>
                                                    </button>
                                                    <ul class="dropdown-menu pull-right">
                                                        <li>
                                                            <a href="javascript:;" class="edit" data-toggle="modal" data-target="#edit_role_modal">
                                                                <i class="fa fa-edit"></i>{{ trans('dashboard.edit') }}</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;" class="delete" >
                                                                <i class="fa fa-remove"></i>{{ trans('dashboard.remove') }}</a>
                                                        </li>                                                       
                                                    </ul>
                                                </div>

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
            <form id="user-register" class="register-form" action="/user/register" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">{{ trans("dashboard.customer_info") }}</h4>
                </div>                
                <div class="modal-body">
                    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto;">
                        <div class="scroller" style="overflow: hidden; width: auto;" data-always-visible="1" data-rail-visible1="1" data-initialized="1">
                            <div class="form-group">
                                <div class="input-icon">
                                    <i class="fa fa-envelope"></i>
                                    <input class="form-control placeholder-no-fix" type="text" placeholder="{{ trans('dashboard.email') }} *" name="email" required /> </div>
                            </div>
                            <div class="form-group row">                                
                                <div class="col-md-6">                                    
                                    <div class="input-icon">
                                        <i class="fa fa-font"></i>
                                        <input class="form-control placeholder-no-fix" type="text" placeholder="{{ trans('dashboard.username') }} *" name="username" required /> </div>
                                </div>
                                <div class="col-md-6">                                                                        
                                    <select user-id="{{$value['id']}}" name="user_type" class="form-control" required >
                                        <option value="">{{ trans('dashboard.select') }} *</option>
                                        {!! App\Enums\UserType::toOptions() !!}
                                    </select> 
                                </div>                  
                            </div>
                            <div class="form-group row">                                    
                                <div class="col-md-6">
                                    <div class="input-icon">
                                        <i class="fa fa-font"></i>
                                        <input class="form-control placeholder-no-fix" type="text" placeholder="{{ trans('dashboard.first_name') }} *" name="first_name" required /> </div>
                                    </div>                                    
                                <div class="col-md-6">
                                    <div class="input-icon">
                                        <i class="fa fa-font"></i>
                                        <input class="form-control placeholder-no-fix" type="text" placeholder="{{ trans('dashboard.last_name') }} *" name="last_name" required /> </div>
                                    </div>                                    
                            </div>                           
                            <div class="form-group">                                
                                <div class="input-icon">
                                    <i class="fa fa-envelope"></i>
                                    <input class="form-control placeholder-no-fix" type="text" placeholder="{{ trans('dashboard.position') }}" name="position" /> </div>
                            </div>       
                            <div class="form-group row">                                    
                                <div class="col-md-6">
                                    <div class="input-icon">
                                        <i class="fa fa-font"></i>
                                        <input class="form-control placeholder-no-fix" type="text" placeholder="{{ trans('dashboard.phone') }}" name="phone" /> </div>
                                    </div>                                    
                                <div class="col-md-6">
                                    <div class="input-icon">
                                        <i class="fa fa-font"></i>
                                        <input class="form-control placeholder-no-fix" type="text" placeholder="{{ trans('dashboard.company') }}" name="company" /> </div>
                                    </div>                                    
                            </div>                           
                            <div class="form-group row">                                    
                                <div class="col-md-6">
                                    <div class="input-icon">
                                        <i class="fa fa-font"></i>
                                        <input class="form-control placeholder-no-fix" type="password" placeholder="{{ trans('dashboard.password') }} *" name="password" id="password" required /> </div>
                                    </div>                                    
                                <div class="col-md-6">
                                    <div class="input-icon">
                                        <i class="fa fa-font"></i>
                                        <input class="form-control placeholder-no-fix" type="password" placeholder="{{ trans('dashboard.password_confirm') }} *" name="password_confirmation" required /> </div>
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
            <form id="user-edit" class="edit-form" action="/user/edit" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">{{ trans("dashboard.customer_info") }}</h4>
                </div>                
                <div class="modal-body">
                    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto;">
                        <div class="scroller" style="overflow: hidden; width: auto;" data-always-visible="1" data-rail-visible1="1" data-initialized="1">
                            <input type="hidden" name="user_id" value="" />
                            <div class="form-group">
                                <div class="input-icon">
                                    <i class="fa fa-envelope"></i>
                                    <input class="form-control placeholder-no-fix" type="text" placeholder="{{ trans('dashboard.email') }} *" name="email" required /> </div>
                            </div>
                            <div class="form-group row">                                
                                <div class="col-md-6">                                    
                                    <div class="input-icon">
                                        <i class="fa fa-font"></i>
                                        <input class="form-control placeholder-no-fix" type="text" placeholder="{{ trans('dashboard.username') }} *" name="username" required /> </div>
                                </div>
                                <div class="col-md-6">                                                                        
                                    <select user-id="{{$value['id']}}" name="user_type" class="form-control" required >
                                        <option value="">{{ trans('dashboard.select') }} *</option>
                                        {!! App\Enums\UserType::toOptions() !!}
                                    </select> 
                                </div>                  
                            </div>
                            <div class="form-group row">                                    
                                <div class="col-md-6">
                                    <div class="input-icon">
                                        <i class="fa fa-font"></i>
                                        <input class="form-control placeholder-no-fix" type="text" placeholder="{{ trans('dashboard.first_name') }} *" name="first_name" required /> </div>
                                    </div>                                    
                                <div class="col-md-6">
                                    <div class="input-icon">
                                        <i class="fa fa-font"></i>
                                        <input class="form-control placeholder-no-fix" type="text" placeholder="{{ trans('dashboard.last_name') }} *" name="last_name" required /> </div>
                                    </div>                                    
                            </div>                           
                            <div class="form-group">                                
                                <div class="input-icon">
                                    <i class="fa fa-envelope"></i>
                                    <input class="form-control placeholder-no-fix" type="text" placeholder="{{ trans('dashboard.position') }}" name="position" /> </div>
                            </div>       
                            <div class="form-group row">                                    
                                <div class="col-md-6">
                                    <div class="input-icon">
                                        <i class="fa fa-font"></i>
                                        <input class="form-control placeholder-no-fix" type="text" placeholder="{{ trans('dashboard.phone') }}" name="phone" /> </div>
                                    </div>                                    
                                <div class="col-md-6">
                                    <div class="input-icon">
                                        <i class="fa fa-font"></i>
                                        <input class="form-control placeholder-no-fix" type="text" placeholder="{{ trans('dashboard.company') }}" name="company" /> </div>
                                    </div>                                    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn dark btn-outline">{{ trans("dashboard.return") }}</button>
                    <button type="submit" class="btn green" id="edit_user">{{ trans("dashboard.update") }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('additional_javascript')    
    <script src="{{ asset('templates/global/plugins/jquery-validation/js/jquery.validate.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/user.js') }}" type="text/javascript"></script>    
@endsection
