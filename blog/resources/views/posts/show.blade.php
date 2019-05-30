@extends('layouts.app')

@section('content')
    <a href="http://localhost/laravelapps/blog/public/posts" class="btn btn-default">Go Back</a>
    <h1>{{$post->title}}</h1>
    <img style="width:100%" src="http://localhost/laravelapps/blog/public/storage/cover_images/{{$post->cover_image}}">
    <br><br>
    <div>
    	{{$post->body}}
    </div>
    <hr>
    <small>Written on {{$post->created_at}}</small>
    <hr>
    @if(!Auth::guest())
    @if(Auth::user()->id == $post->user_id)
    <a href="http://localhost/laravelapps/blog/public/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>
    {{Form::open(['action'=>['PostsController@destroy',$post->id],'method'=>'POST','class'=>'pull-right'])}}
    {{Form::hidden('_method','DELETE')}}
    {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
    {{Form::close()}}
    @endif
    @endif
@endsection