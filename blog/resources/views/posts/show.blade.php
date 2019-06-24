@extends('layouts.app')
@section('content')
<div class="card" style="width:350px">
	<img style="width:100%" src="http://localhost/laravelapps/blog/public/storage/cover_images/{{$post->cover_image}}">
	<div class="card-body">
		<div class="card-title">{{$post->title}}</div>
		<p class="card-text">{{$post->body}}</p>
		<p class="card-text">{{$post->location}}</p>
		{{ Form::open(['action'=>['PostsController@book_room',$post->id],'method' => 'POST']) }}

		 @if($post->user_id != auth()->user()->id)
         
		<div class="row">
			<div class="col-md-7 text-left">
				<label for="from_date">From :
				 <input id="rfrom_date" min="0" type="date" class="form-control" name="rfrom_date" required autocomplete="from_date">
			</div>
			<div class="col-md-7 text-left">
				<label for="from_date">To :
				 <input id="rto_date" min="0" type="date" class="form-control" name="rto_date" required autocomplete="from_date">
			</div>
		</div>
		
	    </br>

		<div class="row">
			<div class="col-md-4 text-left">
				
				{{Form::submit('Book',['class'=>'btn btn-primary'])}}
				{{ Form::close() }}
			</div>
			@endif
			<div class="col-md-4">
				<a href="{{action('PostsController@index')}}" class="btn btn-primary">Back</a>
			</div>
		</div>
	</div>
</div>
@endsection

