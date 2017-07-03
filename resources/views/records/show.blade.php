@extends('layouts.master')

@section('content')
	<section class="show">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<img class="img-responsive" src="{{ $record->data }}" style="background-image:url('imgs/base.png'); background-size:contain;">
					<button onclick="upvote({{ $record->id }})">Upvote</button>
					<button onclick="downvote({{ $record->id }})">Downvote</button>
					<a href="/{{ $record->id }}">View</a>
					<a href="/{{ $record->id }}/next">next</a>
					<a href="/{{ $record->id }}/prev">prev</a>
				</div>
			</div>
		</div>
	</section>

	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<script>
	function upvote(id){
		axios.post('/' + id + '/upvote', {
				upvote: upvote,
			})
			.then(function (response) {
				console.log(response);
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
				console.log(response);
			})
			.catch(function (error) {
				console.log(error);
		});
	}

	</script>

@endsection
