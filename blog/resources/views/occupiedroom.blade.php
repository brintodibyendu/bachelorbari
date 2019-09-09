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
    </ul>


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
      <table  class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">Room Name</th>
      <th scope="col">From date</th>
      <th scope="col">To Date</th>
       <th scope="col">Booked By</th>
       <th scope="col">People &nbsp &nbsp &nbsp &nbsp Advertise</th>
    </tr>
  </thead>
  <tbody>

          @foreach($posts as $post)
    <tr>
      <td>{{$post->rpname}}</td>
      <td>From: {{$post->from_date}}</td>
      <td>Till: {{$post->to_date}}</td>
      <td>{{$post->host_name}}</td>
      @if($isblock==0)
      <td>{{ Form::open(['action'=>['DashboardController@advertise',$post->rid,$post->hostid,$post->max_people,$post->rpname],'method' => 'POST']) }}
      <input type="text" name="maxpeople{{$post->rid}}" id="maxpeople" value="{{$post->max_people}}" size="7">&nbsp &nbsp
      {{Form::submit('Advertise',['class'=>'btn btn-primary'])}}{{ Form::close() }}</td>
      @elseif($isblock==1)
      <td><button type="button" class="btn btn-primary" disabled>Advertise</button></td>
      @endif
    </tr>
        @endforeach
       
        </tbody>
</table>
@endif
    </div>
</div>
@endsection
