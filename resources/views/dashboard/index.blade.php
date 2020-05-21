@extends('layouts.app')

@section('content')
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <img src="{{ asset('images/amazon-logo.png')}}">
                            <span class="caption-subject bold uppercase">アマゾンPO</span>
                        </div>
                        <div class="actions">
                            <form method='post' action='{{ route("po_uploadcsv") }}' enctype='multipart/form-data' >
                                {{ csrf_field() }}
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <span class="btn green btn-file">
                                        <span class="fileinput-new"> {{ trans("dashboard.csv_upload") }} </span>
                                        <span class="fileinput-exists"> {{ trans("dashboard.change") }} </span>
                                        <input type="file" name="po_csv" accept=".csv"> </span>
                                    <span class="fileinput-filename"> </span> &nbsp;
                                    <a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput"> </a>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
                            <thead>
                                <tr>
                                    <th class="all">{{ trans('dashboard.po') }}</th>
                                    <th class="min-phone-l">{{ trans('dashboard.vendor') }}</th>
                                    <th class="min-tablet">{{ trans('dashboard.ordered_on') }}</th>
                                    <th class="none">{{ trans('dashboard.ship_location') }}</th>
                                    <th class="none">{{ trans('dashboard.window_type') }}</th>
                                    <th class="none">{{ trans('dashboard.window_start') }}</th>
                                    <th class="none">{{ trans('dashboard.window_end') }}</th>
                                    <th class="desktop">{{ trans('dashboard.total_cases') }}</th>
                                    <th class="all">{{ trans('dashboard.total_cost') }}</th>
                                    <th class="all">{{ trans('dashboard.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->po }}</td>
                                    <td>{{ $order->vendor }}</td>
                                    <td>{{ $order->ordered_on }}</td>
                                    <td>{{ $order->ship_location }}</td>
                                    <td>{{ $order->window_type }}</td>
                                    <td>{{ $order->window_start }}</td>
                                    <td>{{ $order->window_end }}</td>
                                    <td>{{ $order->total_cases }}</td>
                                    <td>{{ $order->total_cost }}</td>
                                    <td>
                                        <div class="btn-group pull-right">
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
                                        </div>                                                
                                    </td>
                                </tr> 
                                @endforeach                               
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
@endsection
