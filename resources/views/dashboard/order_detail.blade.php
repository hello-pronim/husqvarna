@extends('layouts.app')

@section('additional_css')    
    <link href="{{ asset('templates/global/plugins/bootstrap-toggle/bootstrap-toggle.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" id="detail">
        <div class="row">   
            <div class="col-md-12">
            	<div class="portlet light">
            		<div class="portlet-title">
            			<div class="caption">
                            <i class="icon-share font-red-sunglo"></i>
                            <span class="caption-subject font-red-sunglo bold uppercase">PO: {{ $po }}</span>
                        </div>                        
            		</div>
            		<div class="portlet-body">
            			<div class="row">
            				<div class="col-md-6">
            					<div class="panel panel-success">
		                            <!-- Table -->
		                            <table class="table table-striped table-bordered table-hover detail">
		                                <tbody>
		                                    <tr>
		                                        <td class="bold">{{ trans('detail.status') }}</td>
		                                        <td>確認済み</td>
		                                    </tr>
		                                    <tr>
		                                        <td class="bold">{{ trans('detail.vendor') }}</td>
		                                        <td>WP1A4</td>
		                                    </tr>
		                                    <tr>
		                                        <td class="bold">{{ trans('detail.ship_to_location') }}</td>
		                                        <td>NGO2 - 多治見市, Gifu</td>
		                                    </tr>
		                                    <tr>
		                                        <td class="bold">{{ trans('detail.order_on') }}</td>
		                                        <td>2020/05/19</td>
		                                    </tr>
		                                    <tr>
		                                        <td class="bold">{{ trans('detail.ship_window') }}</td>
		                                        <td>2020/05/19 - 2020/05/22</td>
		                                    </tr>
		                                    <tr>
		                                        <td class="bold">{{ trans('detail.freight_terms') }}</td>
		                                        <td>元払い</td>
		                                    </tr>	
		                                    <tr>
		                                        <td class="bold">{{ trans('detail.payment_method') }}</td>
		                                        <td>請求書</td>
		                                    </tr>	
		                                    <tr>
		                                        <td class="bold">{{ trans('detail.payment_terms') }}</td>
		                                        <td>INVOICE DUE 65 DAYS FROM THE END OF THE MONTH</td>
		                                    </tr>
		                                    <tr>
		                                        <td class="bold">{{ trans('detail.purchasing_entity') }}</td>
		                                        <td>Amazon Japan G.K.</td>
		                                    </tr>
		                                </tbody>
		                            </table>
		                        </div>
            				</div>

            				<div class="col-md-6">
            					<div class="panel panel-danger">		                           
		                            <!-- Table -->
		                            <table class="table table-striped table-bordered table-hover detail">
		                            	<thead>
		                            		<tr>
		                            			<th></th>
		                            			<th>{{ trans('detail.items') }}</th>
		                            			<th>{{ trans('detail.quantity_submitted') }}</th>
		                            			<th>{{ trans('detail.total_cost') }}</th>
		                            		</tr>
		                            	</thead>
		                                <tbody>		                                	
		                                    <tr>
		                                        <td class="bold"> {{ trans('detail.submitted') }} </td>
		                                        <td> 6 </td>
		                                        <td> 6 </td>
		                                        <td> 6602.00 JPY </td>
		                                    </tr>
		                                    <tr>
		                                        <td class="bold"> {{ trans('detail.accepted') }} </td>
		                                        <td> 6 </td>
		                                        <td> 6 </td>
		                                        <td> 6602.00 JPY </td>
		                                    </tr>
		                                     <tr>
		                                        <td class="bold"> {{ trans('detail.cancelled') }} </td>
		                                        <td> 0 </td>
		                                        <td> 0 </td>
		                                        <td> 0.00 JPY </td>
		                                    </tr>
		                                     <tr>
		                                        <td class="bold"> {{ trans('detail.received') }} </td>
		                                        <td> 0 </td>
		                                        <td> 0 </td>
		                                        <td> 0.00 JPY </td>
		                                    </tr>
		                                </tbody>
		                            </table>
		                        </div>    
		                        <div class="panel panel-warning w-50">		     
		                            <!-- Table -->
		                            <table class="table table-striped table-bordered table-hover detail">
		                            	<thead>
		                            		<tr>
		                            			<th>{{ trans('detail.delivery_address') }} NGO2</th>		                            			
		                            		</tr>
		                            	</thead>
		                                <tbody>		                                	
		                                    <tr>
		                                        <td> 
		                                        	507-8585 <br>
													Gifu, 多治見市 旭ヶ丘10-6-136 <br>
													Amazon Japan G.K.
												</td>
		                                    </tr>		                                   
		                                </tbody>
		                            </table>
		                        </div>    
            				</div>
            			</div>

                        <div class="panel panel-primary">
                            <!-- Default panel contents -->
                            <div class="panel-heading">
                                <h3 class="panel-title bold">{{ trans('detail.po_product') }} (<span>{{ 4 }}</span>)</h3>
                            </div>                            
                            <!-- List group -->
                            <table class="table table-striped table-bordered table-hover">
                            	<thead>
                            		<tr>
                            			<th class="nowrap">{{ trans('detail.asin') }} </th>
                            			<th class="nowrap">{{ trans('detail.external_id') }} </th>
                            			<th class="nowrap">{{ trans('detail.mordel_number') }} </th>
                            			<th class="nowrap">{{ trans('detail.title') }} </th>
                            			<th class="nowrap">{{ trans('detail.blockordered') }} </th>
                            			<th class="nowrap">{{ trans('detail.window_type') }} </th>
                            			<th class="nowrap">{{ trans('detail.expected_date') }} </th>
                            			<th class="nowrap">{{ trans('detail.quantity_request') }} </th>
                            			<th class="nowrap">{{ trans('detail.accepted_quantity') }} </th>
                            			<th class="nowrap">{{ trans('detail.quantity_received') }} </th>
                            			<th class="nowrap">{{ trans('detail.quantity_outstand') }} </th>
                            			<th class="nowrap">{{ trans('detail.unit_cost') }} </th>
                            			<th class="nowrap">{{ trans('detail.total_cost') }} </th>
                            		</tr>
                            	</thead>
                                <tbody>		                                	
                                    <tr>
                                        <td class="bold"> B01M361GRY </td>
                                        <td> 4078500023658 </td>
                                        <td> 08951-20.000.00 </td>
                                        <td> GARDENA(ガルデナ) ハンドスコップ 6cm 08951-20 </td>
                                        <td> 不可</td>
                                        <td> 着荷ウィンドウ (元払い) </td>
                                        <td> 2020/05/29 </td>
                                        <td> 1 </td>
                                        <td> 1 </td>
                                        <td> 0 </td>
                                        <td> 1 </td>
                                        <td> 386 </td>
                                        <td> 386 </td> 
                                    </tr>
                                    <tr>
                                        <td class="bold"> B01FE8M1QI </td>
                                        <td> 4078500018746 </td>
                                        <td> 08904-20.000.00 </td>
                                        <td> GARDENA(ガルデナ) 園芸用はさみ (直径24mmまでの枝や花を楽にカット) 08904-20 </td>
                                        <td> 不可</td>
                                        <td> 着荷ウィンドウ (元払い) </td>
                                        <td> 2020/05/29 </td>
                                        <td> 1 </td>
                                        <td> 1 </td>
                                        <td> 0 </td>
                                        <td> 1 </td>
                                        <td> 1831 </td>
                                        <td> 1831 </td> 
                                    </tr>
                                </tbody>
                            </table>
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
    
@endsection