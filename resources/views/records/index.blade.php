@extends('layouts.master')

@section('content')

@endsection

{{-- Soz --}}
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
