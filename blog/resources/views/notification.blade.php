@extends('layouts.app')

@section('content')
@if(Auth::check())
<div class="container">

    <div class="row justify-content-center">
        @if(count($posts)<1)
           <h1>No Notifications</h1>
        @else  
        <div class row>
          <h1>Notifications</h1>
        </div>
      <table class="table table-bordered table-dark">
  <thead>
    <tr>
      <th scope="col">News</th>
    </tr>
  </thead>
          @foreach($posts as $post)
  <tbody>
    @if($post->status=='confirm')
    <tr>
      <td><div class="alert alert-info">{{$post->user_name}} has accepted your {{$post->room_name}} request</div></td>
    </tr>
    @endif
     @if($post->status=='cancel')
    <tr>
      <td><div class="alert alert-info">{{$post->user_name}} has denied your {{$post->room_name}} request</div></td>
    </tr>
    @endif
        @endforeach
        </tbody>
</table>
        @endif
        @endif
        @endsection
