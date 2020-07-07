<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>   
    <meta charset="utf-8" />
    <title>{{ config('app.name') }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->    
    <link href="{{ asset('css/font.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('templates/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('templates/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('templates/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('templates/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('templates/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('templates/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{ asset('templates/global/plugins/bootstrap-toastr/toastr.min.css') }}" rel="stylesheet" type="text/css" />
    
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{ asset('templates/global/plugins/morris/morris.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('templates/global/css/components.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{ asset('templates/global/css/plugins.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="{{ asset('templates/layouts/layout2/css/layout.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('templates/layouts/layout2/css/themes/blue.min.css') }}" rel="stylesheet" type="text/css" id="style_color" />

    @yield('additional_css')

    <link href="{{ asset('templates/layouts/layout2/css/custom.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" /> 
</head>
    <!-- END HEAD -->

<body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid">
    <!-- BEGIN HEADER -->
    <div class="page-header navbar navbar-fixed-top">
        <!-- BEGIN HEADER INNER -->
        <div class="page-header-inner ">
            <!-- BEGIN LOGO -->
            <div class="page-logo">
                <a href="javascript:;">
                    <img src="{{ asset('images/admin_logo.png') }}" srcset="{{ asset('images/admin_logo@2x.png') }} 2x, {{ asset('images/admin_logo@3x.png') }} 3x, {{ asset('images/admin_logo@4x.png') }} 4x" alt="logo" class="logo-default" /> </a>
                <!-- <div class="menu-toggler sidebar-toggler">                        
                </div> -->
            </div>
            <!-- END LOGO -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
            <!-- END RESPONSIVE MENU TOGGLER -->        
            <!-- BEGIN PAGE TOP -->
            <div class="page-top">               
                <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="top-menu">
                    <ul class="nav navbar-nav"> 
                        <li class="lang-flag">
                            <a href="javascript:;"><img src="{{ asset('images/flags/jp.png') }}" srcset="{{ asset('images/flags/jp@2x.png') }} 2x, {{ asset('images/flags/jp@3x.png') }} 3x"></a>                         
                        </li> 
                        <li class="lang-flag">
                               <a href="javascript:;"><img src="{{ asset('images/flags/uk.png') }}" srcset="{{ asset('images/flags/uk@2x.png') }} 2x, {{ asset('images/flags/uk@3x.png') }} 3x"></a>    
                        </li>
                    </ul>    
                    <ul class="nav navbar-nav pull-right"> 
                        <li class="dropdown dropdown-user">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">                                
                                @if( Auth::user()->avatar && file_exists( public_path() .'/images/avatar/'. Auth::user()->avatar ))
                                    <img alt="" class="img-circle" src="{{ asset('images/avatar/'. Auth::user()->avatar) }}">
                                @else
                                    <img alt="" class="img-circle" src="{{ asset('images/avatar/default.png') }}" />
                                @endif

                                <span class="username username-hide-on-mobile"> {{ Auth::user()->last_name . ' '. Auth::user()->first_name }} </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <a href="javascript:;">
                                        <i class="icon-user"></i> ユーザー情報 </a>
                                </li>                                   
                                <li>
                                    <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="icon-key"></i> ログアウト </a>
                                </li>
                            </ul>
                        </li>
                        <!-- END USER LOGIN DROPDOWN -->
                        <!-- BEGIN QUICK SIDEBAR TOGGLER -->                            
                        <li class="dropdown dropdown-extended quick-sidebar-toggler">                               
                            <a class="logout" href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="icon-logout"></i>
                            </a>

                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>                           
                        </li>
                        <!-- END QUICK SIDEBAR TOGGLER -->
                    </ul>
                </div>
                <!-- END TOP NAVIGATION MENU -->
            </div>
            <!-- END PAGE TOP -->
        </div>
        <!-- END HEADER INNER -->
    </div>
    <!-- END HEADER -->
    <!-- BEGIN HEADER & CONTENT DIVIDER -->
    <div class="clearfix"> </div>
    <!-- END HEADER & CONTENT DIVIDER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar-wrapper">
            <!-- END SIDEBAR -->                
            <div class="page-sidebar navbar-collapse collapse">
                <!-- BEGIN SIDEBAR MENU -->
                <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">                    
                    @if(Auth::user()->user_type <= App\Enums\UserType::Admin)
                    <li class="nav-item start @if(request()->routeIs('dashboard')) active open @endif">
                        <a href="{{ route('dashboard') }}" class="nav-link nav-toggle">
                            <i class="icon-docs"></i>
                            <span class="title">{{ trans('dashboard.po_order_list') }}</span>
                            <span class="selected"></span>
                            <span class="arrow @if(request()->routeIs('dashboard')) open @endif"></span>
                        </a>                           
                    </li>
                    @endif
                    @if(Auth::user()->user_type >= App\Enums\UserType::Warehouse)
                    <li class="nav-item @if(request()->routeIs('orders')) active open @endif">
                        <a href="{{ route('orders') }}" class="nav-link nav-toggle">
                            <i class="icon-briefcase"></i>
                            <span class="title">{{ trans('dashboard.order_list') }}</span>
                            <span class="selected"></span>
                            <span class="arrow @if(request()->routeIs('orders')) open @endif"></span>
                        </a>                           
                    </li>
                    @endif
                    @if(Auth::user()->user_type <= App\Enums\UserType::Admin)
                    <li class="nav-item @if(request()->routeIs('print')) active open @endif">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="icon-printer"></i>
                            <span class="title">{{ trans('dashboard.label_print') }}</span>
                            <span class="selected"></span>
                            <span class="arrow @if(request()->routeIs('print')) open @endif"></span>
                        </a>                           
                    </li>
                    @endif
                    <li class="nav-item @if(request()->routeIs(['management.user', 'management.po_csv_import', 'management.direct_csv_import'])) active open @endif">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="icon-settings"></i>
                            <span class="title">{{ trans('dashboard.management') }}</span>
                            <span class="selected"></span>                            
                            <span class="arrow @if(request()->routeIs(['management.user', 'management.po_csv_import', 'management.direct_csv_import'])) open @endif"></span>
                        </a>                            
                        <ul class="sub-menu">
                            @if(Auth::user()->user_type <= App\Enums\UserType::Admin)
                            <li class="nav-item">
                                <a href="{{ route('management.user') }}" class="nav-link ">
                                    <span class="title">{{ trans('dashboard.user_list') }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <!-- <a href="{{ route('management.direct_csv_import') }}" class="nav-link "> -->
                                <a href="javascript:;" class="nav-link ">
                                    <span class="title">{{ trans('dashboard.direct_csv_import') }}</span>
                                </a>
                            </li>    
                            <li class="nav-item">
                                <a href="{{ route('management.po_csv_import') }}" class="nav-link ">
                                    <span class="title">{{ trans('dashboard.po_csv_import') }}</span>
                                </a>
                            </li>
                            @endif 
                            @if(Auth::user()->user_type == App\Enums\UserType::Warehouse)                           
                            <li class="nav-item  ">
                                <a href="{{ route('management.po_csv_import') }}" class="nav-link ">
                                    <span class="title">{{ trans('dashboard.csv_import') }}</span>
                                </a>
                            </li> 
                            @endif
                        </ul>
                    </li>              
                    @if(Auth::user()->user_type <= App\Enums\UserType::Admin)    
                    <li class="nav-item @if(request()->routeIs(['api'])) active open @endif">
                        <a href="{{route('api')}}" class="nav-link nav-toggle">
                            <i class="icon-puzzle"></i>
                            <span class="title">API状況</span>
                            <span class="arrow"></span>
                        </a>                            
                    </li>                  
                    @endif
                </ul>
                <!-- END SIDEBAR MENU -->
            </div>
            <!-- END SIDEBAR -->
        </div>
        <!-- END SIDEBAR -->
        <!-- BEGIN CONTENT -->
           
        @yield('content')
        
        <!-- END CONTENT -->            
    </div>
    <!-- END CONTAINER -->

    <!--[if lt IE 9]>
    <script src="{{ asset('templates/global/plugins/respond.min.js') }}"></script>
    <script src="{{ asset('templates/global/plugins/excanvas.min.js') }}"></script> 
    <script src="{{ asset('templates/global/plugins/ie8.fix.min.js') }}"></script> 
    <![endif]-->
    <!-- BEGIN CORE PLUGINS -->
    <!-- BEGIN CORE PLUGINS -->
    <script src="{{ asset('templates/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('templates/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('templates/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('templates/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('templates/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('templates/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('templates/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{ asset('templates/global/plugins/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('templates/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('templates/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>    
    <script src="{{ asset('templates/global/plugins/morris/morris.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('templates/global/plugins/morris/raphael-min.js') }}" type="text/javascript"></script>    
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="{{ asset('templates/global/scripts/app.js') }}" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset('templates/pages/scripts/dashboard.min.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="{{ asset('templates/layouts/layout2/scripts/layout.min.js') }}" type="text/javascript"></script>    
    
    <!-- END THEME LAYOUT SCRIPTS -->

    @yield('additional_javascript')

    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>    

    <script>
        $(document).ready(function()
        {
            $('#clickmewow').click(function()
            {
                $('#radio1003').attr('checked', 'checked');
            });
        })
    </script>
    
</body>
</html>
