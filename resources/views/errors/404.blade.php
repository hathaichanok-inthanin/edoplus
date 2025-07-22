<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>404 Page Not Found</title>
    <script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script> 
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/404.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" id="bootstrap-css">
</head>
<body>

<div id="particles-js">
    <div class="page-404">
        <div class="outer">
            <div class="middle">
                <div class="inner">
                    <!--BEGIN CONTENT-->
                    <div class="inner-circle">
                        <a href="{{url('/')}}"><i class="fa fa-home"></i></a><span>404</span>
                    </div>
                    <span class="inner-status">Page Not Found</span>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
