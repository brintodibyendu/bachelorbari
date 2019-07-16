@extends('layouts.app')
@section('content')
<div class="container">

    <div class="row justify-content-center">
        @if(count($posts)<1)
           <h1>No Room in Use</h1>
        @else 
       @php
       $nl = 0
       @endphp
          @foreach($results as $post)
        <div class="col-md-6">
           <div class="card" style="width:350px">
            <div class="card-body">
        <div class="card-title">{{$post->name}}</div>
        <p class="card-text">{{$post->email}}</p>
        <p class="card-text">{{$post->age}}</p>
    </div>
</div>
</br>
        </div>
        @endforeach
        @endif
    </div>
</div>
@endsection
