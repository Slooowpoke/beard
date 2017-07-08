@extends('layouts.master')

@section('content')
	<section class="creator">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="editor">
						<button id="save" onclick="reset()">Reset</button>
						<img id="beard" src="imgs/beard.png" style="display:none;">

						<canvas id="beard-creator" style="background-image:url('imgs/base.png')"></canvas>

						<p id="brush-label">BRUSH SIZE: 10</p>
						<input id="slider" type="range" min="0" max="20" step="1" onchange="changeBrushSize(this.value)"/>
						<button id="save" onclick="save()">Save</button>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="show">
		<div class="container">
			<div class="row">
				@foreach ($records as $record)
					<div class="col-xs-12 col-sm-3">
						<div class="face">
							<img class="img-responsive" src="{{ $record->data }}" style="background-image:url('imgs/base.png'); background-size:contain">

							<button class="upvote" onclick="upvote({{ $record->id }})">Upvote</button>
							<button class="downvote" onclick="downvote({{ $record->id }})">Downvote</button>
							<a href="/show/{{ $record->id }}">VIEW</a>
						</div>

					</div>

				@endforeach
			</div>
		</div>
	</section>

	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<script>
	var width = 500, height = 500;
	var canvas = document.getElementById('beard-creator');
	canvas.width = width;
	canvas.height = height;

	// context
	var ctx = canvas.getContext("2d");
	var beard = document.getElementById("beard");
	var size = 10;

	function reset(){
		// cba
		location.reload();
	}

	function changeBrushSize(v) {
		size = v;
		document.getElementById("brush-label").innerHTML = "BRUSH SIZE: " + size;
	}

	var loadImage = function (url, ctx) {
	  var img = new Image();
	  img.src = url
	  img.onload = function () {
	    ctx.drawImage(img, 0, 0);
	  }
	}

	function save(){
		var data = canvas.toDataURL('image/png');
		axios.post('/save', {
			data: data,
		})
		.then(function (response) {
			console.log(response);
			location.reload();
		})
		.catch(function (error) {
			console.log(error);
		});
	}


	// Set up mouse events for drawing
	var drawing = false;
	var mousePos = { x:0, y:0 };
	var lastPos = mousePos;

	canvas.addEventListener("mousedown", function (e) {
	        drawing = true;
	  lastPos = getMousePos(canvas, e);
	}, false);
	canvas.addEventListener("mouseup", function (e) {
	  drawing = false;
	}, false);
	canvas.addEventListener("mousemove", function (e) {
	  mousePos = getMousePos(canvas, e);
	}, false);

	// Get a regular interval for drawing to the screen
	window.requestAnimFrame = (function (callback) {
		return window.requestAnimationFrame ||
			window.webkitRequestAnimationFrame ||
			window.mozRequestAnimationFrame ||
			window.oRequestAnimationFrame ||
			window.msRequestAnimaitonFrame ||
			function (callback) {
				window.setTimeout(callback, 1000/60);
			};
	})();

	// Draw to the canvas
	function renderCanvas() {
		if (drawing) {
			ctx.globalCompositeOperation="destination-out";

			// brush size
			ctx.lineWidth=size;

			// someone go ahead and change the style
			ctx.moveTo(lastPos.x, lastPos.y);
			ctx.lineTo(mousePos.x, mousePos.y);
			ctx.stroke();
			lastPos = mousePos;
		}
	}

	setTimeout(function(){
		ctx.globalCompositeOperation="source-over";
		ctx.drawImage(beard,0,0);
	},50);

	// Allow for animation
	(function drawLoop () {
		requestAnimFrame(drawLoop);
		renderCanvas();
	})();

	// Set up touch events for mobile, etc
	canvas.addEventListener("touchstart", function (e) {
		mousePos = getTouchPos(canvas, e);
	  	var touch = e.touches[0];

	  	var mouseEvent = new MouseEvent("mousedown", {
	    	clientX: touch.clientX,
	    	clientY: touch.clientY
		});
	  	canvas.dispatchEvent(mouseEvent);
	}, false);

	canvas.addEventListener("touchend", function (e) {
		var mouseEvent = new MouseEvent("mouseup", {});
		canvas.dispatchEvent(mouseEvent);
	}, false);
	canvas.addEventListener("touchmove", function (e) {
	  var touch = e.touches[0];
	  var mouseEvent = new MouseEvent("mousemove", {
	    clientX: touch.clientX,
	    clientY: touch.clientY
	  });
	  canvas.dispatchEvent(mouseEvent);
	}, false);

	// Get the position of a touch relative to the canvas
	function getTouchPos(canvasDom, touchEvent) {
		var rect = canvasDom.getBoundingClientRect();
			return {
				x: touchEvent.touches[0].clientX - rect.left,
				y: touchEvent.touches[0].clientY - rect.top
		};
	}
	// Get the position of the mouse relative to the canvas
	function getMousePos(canvasDom, mouseEvent) {
		var rect = canvasDom.getBoundingClientRect();
			return {
				x: mouseEvent.clientX - rect.left,
				y: mouseEvent.clientY - rect.top
		};
	}

	// Prevent scrolling when touching the canvas
	document.body.addEventListener("touchstart", function (e) {
		if (e.target == canvas) {
			e.preventDefault();
		}
	}, false);
	document.body.addEventListener("touchend", function (e) {
		if (e.target == canvas) {
			e.preventDefault();
		}
	}, false);
	document.body.addEventListener("touchmove", function (e) {
		if (e.target == canvas) {
			e.preventDefault();
		}
	}, false);

	</script>
@endsection
