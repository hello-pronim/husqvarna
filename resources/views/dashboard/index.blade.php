@extends('layouts.app')

@section('additional_css')
    <link href="{{ asset('templates/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('templates/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('templates/global/plugins/daterangepicker/daterangepicker.css') }}" rel="
    stylesheet" type="text/css" />
    <link href="{{ asset('templates/global/plugins/bootstrap-toggle/bootstrap-toggle.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <div class="row">
            <div class="col-md-12 tabbable-line">
                <ul class="nav nav-tabs ">
                    <li class="active">
                        <a href="#po" data-toggle="tab"> {{ trans('dashboard.po_list') }} </a>
                    </li>
                    <li>
                        <a href="#direct" data-toggle="tab"> {{ trans('dashboard.direct_list') }} </a>
                    </li>                    
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="po">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet light ">
                            <div class="portlet-title">
                                <div class="caption font-dark">
                                    <img class="page-logo" src="{{ asset('images/amazon-logo.png')}}">
                                    <span class="caption-subject bold uppercase">{{ trans('dashboard.po_list') }}</span>
                                </div>                          
                                <div class="btn-group pull-right">
                                    <button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">{{ trans('dashboard.tools') }}
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                                            <a href="javascript:;">
                                                <i class="fa fa-print"></i> {{ trans('dashboard.print') }} </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <i class="fa fa-file-pdf-o"></i> {{ trans('dashboard.pdf') }} </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <i class="fa fa-file-excel-o"></i> {{ trans('dashboard.excel') }} </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-container">
                                    <table class="table table-striped table-bordered table-hover dt-responsive order" width="100%" id="order_po">
                                        <thead>
                                            <tr>
                                                <th class="all"></th>
                                                <th class="all">{{ trans('dashboard.scraping_status') }}</th>
                                                <th class="all">{{ trans('dashboard.delivery_status') }}</th>
                                                <th class="all">{{ trans('dashboard.po') }}</th>                                        
                                                <th class="min-phone-l">{{ trans('dashboard.vendor') }}</th>
                                                <th class="min-tablet">{{ trans('dashboard.ordered_on') }}</th>
                                                <th class="all">{{ trans('dashboard.ship_location') }}</th>
                                                <th class="all">{{ trans('dashboard.window_type') }}</th>
                                                <th class="all">{{ trans('dashboard.window_start') }}</th>
                                                <th class="all">{{ trans('dashboard.window_end') }}</th>
                                                <th class="all">{{ trans('dashboard.total_cases') }}</th>
                                                <th class="all">{{ trans('dashboard.total_cost') }}</th>
                                                <th class="all">{{ trans('dashboard.tracking_no') }}</th>
                                                <th class="all">{{ trans('dashboard.action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                                
                                        </tbody>
                                    </table>
                                </div>    
                            </div>
                        </div>
                        <!-- END EXAMPLE TABLE PORTLET-->
                    </div>                      
                    <div class="tab-pane" id="direct">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet light ">
                            <div class="portlet-title">
                                <div class="caption font-dark">
                                    <img class="page-logo" src="{{ asset('images/amazon-logo.png')}}">
                                    <span class="caption-subject bold uppercase">{{ trans('dashboard.direct_list') }}</span>
                                </div>                                                              
                            </div>
                            <div class="portlet-body">
                                <div class="table-container table-responsive">
                                    <table class="table table-striped table-bordered table-hover dt-responsive order" width="100%" id="order_direct">
                                        <thead>
                                            <tr>
                                                <th class="all"></th>
                                                <th class="all">{{ trans('dashboard.order_number') }}</th>
                                                <th class="all">{{ trans('dashboard.order_status') }}</th>
                                                <th class="all">{{ trans('dashboard.store_code') }}</th>
                                                <th class="all">{{ trans('dashboard.order_confirm_date') }}</th>
                                                <th class="all">{{ trans('dashboard.delivery_deadline') }}</th>
                                                <th class="all">{{ trans('dashboard.delivery_method') }}</th>
                                                <th class="all">{{ trans('dashboard.delivery_method_code') }}</th>
                                                <th class="all">{{ trans('dashboard.delivery_name') }}</th>
                                                <th class="all">{{ trans('dashboard.delivery_address1') }}</th>
                                                <th class="all">{{ trans('dashboard.delivery_address2') }}</th>
                                                <th class="all">{{ trans('dashboard.delivery_address3') }}</th>
                                                <th class="all">{{ trans('dashboard.delivery_city') }}</th>
                                                <th class="all">{{ trans('dashboard.delivery_prefecture') }}</th>
                                                <th class="all">{{ trans('dashboard.delivery_postal_code') }}</th>
                                                <th class="all">{{ trans('dashboard.delivery_country') }}</th>
                                                <th class="all">{{ trans('dashboard.phone_number') }}</th>
                                                <th class="all">{{ trans('dashboard.is_gift') }}</th>
                                                <th class="all">{{ trans('dashboard.purchase_price') }}</th>
                                                <th class="all">{{ trans('dashboard.sku') }}</th>
                                                <th class="all">{{ trans('dashboard.asin') }}</th>
                                                <th class="all">{{ trans('dashboard.product_name') }}</th>
                                                <th class="all">{{ trans('dashboard.product_quantity') }}</th>
                                                <th class="all">{{ trans('dashboard.gift_message') }}</th>
                                                <th class="all">{{ trans('dashboard.invoice_number') }}</th>
                                                <th class="all">{{ trans('dashboard.delivery_date') }}</th>
                                                <th class="all">{{ trans('dashboard.cash_delivery') }}</th>
                                                <th class="all">{{ trans('dashboard.payment_balance') }}</th>
                                                <th class="all">{{ trans('dashboard.delivery_quantity') }}</th>
                                                <th class="all">{{ trans('dashboard.action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                                
                                        </tbody>
                                    </table>
                                </div>    
                            </div>
                        </div>
                        <!-- END EXAMPLE TABLE PORTLET-->
                    </div>
                </div>                    
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
@endsection

@section('additional_javascript')
    <script src="{{ asset('templates/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('templates/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('templates/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('templates/global/plugins/daterangepicker/daterangepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('templates/global/plugins/bootstrap-toggle/bootstrap-toggle.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/po_dash.js') }}" type="text/javascript"></script>    
@endsection