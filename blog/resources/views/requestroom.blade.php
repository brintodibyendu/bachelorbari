@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        @if(count($posts)<1)
           <h1>No Pending Request</h1>
        @else  
        <div class row>
          <h1>Requested Rooms</h1>
        </div>
      <table class="table table-bordered table-dark">
  <thead>
    <tr>
      <th scope="col">Room Name</th>
      <th scope="col">From date</th>
      <th scope="col">To Date</th>
       <th scope="col">Requested By</th>
      <th scope="col">Confirm</th>
      <th scope="col">Cancel</th>
    </tr>
  </thead>
          @foreach($posts as $post)
  <tbody>
    <tr>
      <td>{{$post->rpname}}</td>
      <td>From: {{$post->from_date}}</td>
      <td>Till: {{$post->to_date}}</td>
      <td>{{$post->host_name}}</td>
      <td>{{ Form::open(['action'=>['DashboardController@confirmroom',$post->id],'method' => 'POST']) }}
                {{Form::submit('Confirm',['class'=>'btn btn-primary'])}}
                {{ Form::close() }}</td>
                <td>
                {{ Form::open(['action'=>['DashboardController@cancelroom',$post->id],'method' => 'POST']) }}
                {{Form::submit('Cancel',['class'=>'btn btn-primary'])}}
                {{ Form::close() }}</td>
    </tr>
        @endforeach
        </tbody>
</table>
        @endif
        @endsection
