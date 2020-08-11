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
                        <a href="#api_check" data-toggle="tab"> {{ trans('api.checks') }} </a>
                    </li>
                    <li>
                        <a href="#api" data-toggle="tab"> {{ trans('api.api') }} </a>
                    </li>                    
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="api_check">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet light ">
                            <div class="portlet-title">
                            </div>
                            <div class="portlet-body">
                                <div class="table-container">
                                    <table class="table table-striped table-bordered table-hover dt-responsive order" width="100%" id="apis">
                                        <thead>
                                            <tr>
                                                <th class="all"></th>
                                                <th class="all">{{ trans('api.status') }}</th>
                                                <th class="all">{{ trans('api.alert') }}(EML)</th>
                                                <th class="all">{{ trans('api.alert') }}(TEL)</th>
                                                <th class="all">{{ trans('api.alert') }}(SMS)</th>    
                                                <th class="all"></th>                               
                                                <th class="all">{{ trans('api.api_name') }}</th>
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
                    <div class="tab-pane" id="api">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet light ">
                            <div class="portlet-title">
                            </div>
                            <div class="portlet-body">
                                <div class="panel-group" id="accordion-apis">
                                    @foreach($apis as $api)
                                        @if($api->method)
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" href="#collapse{{$api->id}}">
                                                    <button class="btn btn-sm {{$api->method==='POST'?'blue':($api->method==='GET'?'green':'')}} mr-10"><b>{{$api->method}}</b></button>
                                                    <span><b>{{$api->api_name}}</b></span>
                                                    <small>{{$api->api_url}}</small>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapse{{$api->id}}" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="form-params-container">
                                                    <form>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="flex-row align-items-center justify-content-between">
                                                                    <h5>パラメーター</h5>
                                                                    <button type="submit" class="btn btn-sm blue btn-try">実行</button>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input type="hidden" name="method" value="{{$api->method}}">
                                                                <input type="hidden" name="api_id" value="{{$api->id}}">
                                                                <input type="hidden" name="api_url" value="{{$api->api_url}}">
                                                                <table class="table table-borderless">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Name</th>
                                                                            <th>Description</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td><label class="fs-14">_token*</label></td>
                                                                            <td>
                                                                                <input type="text" name="_token" class="form-control" required>
                                                                            </td>
                                                                        </tr>
                                                                        @if($api->api_name=="Amazon Vendor Central PO Collector")
                                                                        <tr>
                                                                            <td><label class="fs-14">CSV*</label></td>
                                                                            <td>
                                                                                <input type="file" name="file" accept=".csv" required>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><label class="fs-14">PO操作状況*</label></td>
                                                                            <td>
                                                                                <input type="text" name="status" class="form-control" required>
                                                                            </td>
                                                                        </tr>
                                                                        @elseif($api->api_name=="Amazon Vendor Central PO Detail Collector")
                                                                        <tr>
                                                                            <td><label class="fs-14">CSV*</label></td>
                                                                            <td>
                                                                                <input type="file" name="file" accept=".csv" required>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><label class="fs-14">Order Id*</label></td>
                                                                            <td>
                                                                                <input type="text" name="order_id" class="form-control" required>
                                                                            </td>
                                                                        </tr>
                                                                        @elseif($api->api_name=="Amazon Vendor Central Tracking Status Checker")
                                                                        <tr>
                                                                            <td><label class="fs-14">Check(optional)</label></td>
                                                                            <td>
                                                                                <input type="text" name="check" class="form-control" value="">
                                                                            </td>
                                                                        </tr>
                                                                        @endif
                                                                    </tbody>
                                                                </table>                                                        
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="form-response-container">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <h5>応答</h5>
                                                            <pre class="form-response">
                                                            </pre>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        @endif
                                    @endforeach
                                </div> 
                            </div>
                        </div>
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
    <script src="{{ asset('templates/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/api.js') }}" type="text/javascript"></script>
@endsection