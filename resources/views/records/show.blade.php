@extends('layouts.master')

@section('content')
	<section class="creator show">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="editor face">
						<img id="beard" class="img-responsive" src="{{ $record->data }}" style="background-image:url('/imgs/base.png'); background-size:contain;">
						<button id="upvote" class="upvote" onclick="upvote({{ $record->id }})">Upvote</button>
						<button id="downvote" class="downvote" onclick="downvote({{ $record->id }})">Downvote</button>

						<a class="prev" id="prev" onclick="view({{ ($record->id)-1 }})">PREV</a>
						<a class="next" id="next" onclick="view({{ ($record->id)+1 }})">NEXT</a>

						{{-- <a class="next" href="/{{ $record->id }}/next">next</a>
						<a class="prev" href="/{{ $record->id }}/prev">prev</a> --}}
					</div>
				</div>
			</div>
		</div>
	</section>

	<script>
	var total = {{ $total }};

	function view(id){
		if(id < 1){
			id = total;
		}else if(id > total){
			id = 1;
		}

		axios.post('/show', {
			id: id,
		})
		.then(function (response) {
			console.log(response);
			window.history.pushState({page: "another"}, "another page", id);

			var next = document.getElementById('next');
			next.setAttribute('onclick',  'view('+ (id+1) +')');

			var prev = document.getElementById('prev');
			prev.setAttribute('onclick',  'view('+ (id-1) +')');

			var upvote = document.getElementById('upvote');
			upvote.setAttribute('onclick',  'upvote('+ (id) +')');

			var downvote = document.getElementById('downvote');
			downvote.setAttribute('onclick',  'downvote('+ (id) +')');

			var beard = document.getElementById('beard');
			beard.setAttribute('src',  response.data.data);
		})
		.catch(function (error) {
			console.log(error);
		});
	}
	</script>


	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

@endsection
