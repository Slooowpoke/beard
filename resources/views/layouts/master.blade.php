<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BEARDDDDDD') }}</title>

    <!-- Styles -->
	<link href="https://fonts.googleapis.com/css?family=Rye|Poppins" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
    <body>
        <div class="container">
			<div class="row">
				<div class="col-xs-12">
					<h1 class="title">The Barbershop.</h1>
				</div>
			</div>
        </div>

		@yield('content')
    </body>
</html>
