@extends('layouts.app')

@section('additional_css')
<link href="{{ asset('templates/global/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('templates/global/plugins/dropzone/basic.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('templates/global/css/plugins.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
    <!-- BEGIN PAGE HEADER-->

        <div class="row">
            <div class="col-md-12">
            	@if(Session::get('message'))
            	<p class="alert alert-danger fade in">{{ Session::get('message') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            	@endif

            	<form method='post' action='{{ route("aws_customer_csv") }}' enctype='multipart/form-data' class="dropzone dropzone-file-area" id="my-dropzone" style="width: 60%; margin-top: 50px;">
                    {{ csrf_field() }}
                    <!-- <div class="fileinput fileinput-new" data-provides="fileinput">
                        <span class="btn green btn-file">
                            <span class="fileinput-new"> {{ trans("dashboard.csv_upload") }} </span>
                            <span class="fileinput-exists"> {{ trans("dashboard.change") }} </span>
                            <input type="file" name="po_csv" accept=".csv"> </span>
                        <span class="fileinput-filename"> </span> &nbsp;
                        <a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput"> </a>
                    </div> -->                    
                    
                    <i class="fa fa-plus-circle dropzone_icon"></i>                    
                    <h3 class="sbold">Amazon API Master_配送センター</h3>                    

                <!-- <div class="text-center mt-30" style="margin-top: 50px;"><button type="button" id="dropzone-fileupload" class="btn btn-lg blue">輸入する</button></div> -->
            </div>
        </div>
    </div>
</div> 	
@endsection

@section('additional_javascript')
	<script src="{{ asset('templates/global/plugins/dropzone/dropzone.js') }}" type="text/javascript"></script>
	<script src="{{ asset('templates/pages/scripts/form-dropzone.js') }}" type="text/javascript"></script>
@endsection
