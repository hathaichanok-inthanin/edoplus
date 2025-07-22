<!DOCTYPE html>
<html class="no-js" lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no"/>
    	<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>Edo Plus+ | With You in Every Lifestyle</title>
		@include("/backend/layouts/css")
	</head>
	<body class="g-sidenav-show   bg-gray-100">
        @include("backend/layouts/adminStore/navbar-left")
		<main class="main-content position-relative border-radius-lg ">
            @include("backend/layouts/adminStore/navbar-top")
			<div class="container-fluid py-4">
				@yield("content")
			</div>
	    </main>
		@include("backend/layouts/js")
	</body>
</html>