@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        @if(count($posts)<1)
           <h1>No Pending Request</h1>
        @else   
          @foreach($posts as $post)
        <div class="col-md-6">
           <div class="card" style="width:350px">
    <div class="card-body">
        <div class="card-title">{{$post->title}}</div>
        <p class="card-text">{{$post->body}}</p>
        <p class="card-text">{{$post->location}}</p>
        <div class="row">
            <div class="col-md-4 text-left">
                {{ Form::open(['action'=>['DashboardController@confirmroom',$post->id],'method' => 'POST']) }}
                {{Form::submit('Confirm',['class'=>'btn btn-primary'])}}
                {{ Form::close() }}
            </div>
            <div class="col-md-4 text-left">
                {{ Form::open(['action'=>['DashboardController@cancelroom',$post->id],'method' => 'POST']) }}
                {{Form::submit('Cancel',['class'=>'btn btn-primary'])}}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
</br>
        </div>
        @endforeach
        @endif
    </div>
</div>
@endsection
