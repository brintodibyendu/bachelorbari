@extends('layouts.app')

@section('content')
    <h1>Rooms</h1>
	@if(count($posts)>0)
	@foreach($posts as $post)
	<div class="well">
		<div class="row">
			<div class="col-md-4 col-sm-4">
				<img style="width:80%" src="http://localhost/laravelapps/blog/public/storage/cover_images/{{$post->cover_image}}">
			</div>
			<div class="col-md-8 col-sm-8">
				<h3><a href="http://localhost/laravelapps/blog/public/posts/{{$post->id}}">{{$post->title}}</a></h3>
				{{Form::submit('Book',['class'=>'btn btn-primary'])}}
		<small>Created at {{$post->created_at}}</small>
			</div>
		</div>
		
	<div>
	@endforeach
	{{$posts->links()}}
	@else
	<p>No Room Found</p>
	@endif
@endsection