@extends('layouts.app')
@section('content')
<div class="card" style="width:350px">
	<img style="width:100%" src="http://localhost/laravelapps/blog/public/storage/cover_images/{{$post->cover_image}}">
	<div class="card-body">
		<div class="card-title">{{$post->title}}</div>
		<p class="card-text">{{$post->body}}</p>
		<p class="card-text">{{$post->location}}</p>
		<a href="{{action('PostsController@index')}}" class="btn btn-primary">Back</a>
	</div>
</div>
@endsection

