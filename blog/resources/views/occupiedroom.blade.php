@extends('layouts.app')
 $items = array();
@section('content')
<div class="container">

    <div class="row justify-content-center">
        @if(count($posts)<1)
           <h1>No Room in Use</h1>
        @else   
          @foreach($userid as $uid)
             {{$items[]=$uid->taken}}
          @endforeach
          @foreach($posts as $post)
        <div class="col-md-6">
           <div class="card" style="width:350px">
            <div class="card-body">
        <div class="card-title">{{$post->title}}</div>
        <p class="card-text">{{$post->location}}</p>
         <p class="card-text">{{$items[0]}}</p>
    </div>
</div>
</br>
        </div>
        @endforeach
        @endif
    </div>
</div>
@endsection
