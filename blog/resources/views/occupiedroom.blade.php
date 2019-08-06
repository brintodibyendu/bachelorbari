@extends('layouts.app')
@section('content')
<div class="container">

    <div class="row justify-content-center">
        @if(count($posts)<1)
           <h1>No Room in Use</h1>
        @else 
         <div class row>
          <h1>Requested Rooms</h1>
        </div>
         <div class="col-md-5" align="right">
     <a href="{{ url('/dashboard/occupiedroom/pdf') }}" class="btn btn-danger">Convert into PDF</a>
    </div>
      <table class="table table-bordered table-dark">
  <thead>
    <tr>
      <th scope="col">Room Name</th>
      <th scope="col">From date</th>
      <th scope="col">To Date</th>
       <th scope="col">Booked By</th>
    </tr>
  </thead>
  <tbody>
          @foreach($posts as $post)
    <tr>
      <td>{{$post->rpname}}</td>
      <td>From: {{$post->from_date}}</td>
      <td>Till: {{$post->to_date}}</td>
      <td>{{$post->host_name}}</td>
    </tr>
        @endforeach
        </tbody>
</table>
@endif
    </div>
</div>
@endsection
