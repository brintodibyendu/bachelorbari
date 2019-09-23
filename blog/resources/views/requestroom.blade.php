@extends('layouts.app')

@section('content')

<div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="/posts/create">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Create New Apartment</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="requestroom" >
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Rooms Waiting For Approval</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="wantingroom">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>My requested Rooms</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="occupiedroom">
          <i class="fas fa-fw fa-table"></i>
          <span>Rooms Currently Using</span></a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="usingroom">
          <i class="fas fa-fw fa-table"></i>
          <span>Rooms I am Using</span></a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="own">
          <i class="fas fa-fw fa-table"></i>
          <span>Owner_rating</span></a>
      </li>
    </ul>


<div class="container">
    <div class="row justify-content-center">
        @if(count($posts)<1)
           <h1>No Pending Request</h1>
        @else  
        <div class row>
          <h1>Requested Rooms</h1>
        </div>
      <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">Room Name</th>
      <th scope="col">From date</th>
      <th scope="col">To Date</th>
       <th scope="col">Requested By</th>
      <th scope="col">Confirm</th>
      <th scope="col">Cancel</th>
      <th scope="col">Show Profile</th>
    </tr>
  </thead>
          @foreach($posts as $post)
  <tbody>
    @if($post->status==NULL)
    <tr>
      <td>{{$post->room_name}}</td>
      <td>From: {{$post->requested_from_date}}</td>
      <td>Till: {{$post->requested_to_date}}</td>
      <td>{{$post->requested_by}}</td>
      @if($isblock==0)
      <td>{{ Form::open(['action'=>['DashboardController@confirmroom',$post->room_id,$post->id],'method' => 'POST']) }}
                {{Form::submit('Confirm',['class'=>'btn btn-primary'])}}
                {{ Form::close() }}</td>
                <td>
                {{ Form::open(['action'=>['DashboardController@cancelroom',$post->room_id,$post->id],'method' => 'POST']) }}
                {{Form::submit('Cancel',['class'=>'btn btn-primary'])}}
                {{ Form::close() }}</td>
                <td>
                   <a href="/dashboard/want/{{$post->requested_by_id}}" class="btn btn-info">Show Profile</a>
                </td>
      @elseif($isblock==1)
      <td><button type="button" class="btn btn-primary" disabled>Confirm</button></td>
      <td><button type="button" class="btn btn-primary" disabled>Cancel</button></td>
      @endif
    </tr>
    @endif
        @endforeach
        </tbody>
</table>
        @endif
        @endsection
