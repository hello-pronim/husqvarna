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
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('templates/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('templates/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('templates/pages/css/error.min.css') }}" rel="stylesheet" type="text/css" />
    
    <link href="{{ asset('templates/global/css/components.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
<!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" /> 
</head>
    <!-- END HEAD -->

<body>
     <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content">
                <div class="row">   
                    <div class="col-md-12 page-404" style="margin-top: 10%;">
                        <div class="number font-green"> 404 </div>
                        <div class="details">
                            <h3>Oops! You're lost.</h3>
                            <p> We can not find the page you're looking for.
                                <br>
                                <a href="/"> Return home </a> or try the search bar below. </p>
                                <form action="#">
                                    <div class="input-group input-medium">
                                        <input type="text" class="form-control" placeholder="keyword...">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn green">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </span>
                                    </div>
                                    <!-- /input-group -->
                                </form>
                        </div>
                    </div>  
                </div>
            </div>
            <!-- END CONTENT BODY -->
        </div>
    </div>
</body>        
