<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Beardinator</title>

    <!-- Styles -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans|Work+Sans" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
    <body>
		<header>
	        <div class="container">
				<div class="row">
					<div class="col-xs-12">
						<a href="/"><img class="img-responsive" src="/imgs/logo.png"></a>
					</div>
				</div>
	        </div>
		</header>

		@yield('content')
    </body>


	<script>
	function upvote(id){
		axios.post('/' + id + '/upvote', {
				upvote: upvote,
			})
			.then(function (response) {
				location.reload()
			})
			.catch(function (error) {
				console.log(error);
		});
	}

	function downvote(id){
		axios.post('/' + id + '/downvote', {
				downvote: downvote,
			})
			.then(function (response) {
				location.reload()
			})
			.catch(function (error) {
				console.log(error);
		});
	}

	</script>
</html>
