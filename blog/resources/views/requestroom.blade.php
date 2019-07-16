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
        <div class="card-title">{{$post->rpname}}</div>
        <p class="card-text">From: {{$post->from_date}}</p>
        <p class="card-text">Till: {{$post->to_date}}</p>
        <p class="card-text"></p>
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
