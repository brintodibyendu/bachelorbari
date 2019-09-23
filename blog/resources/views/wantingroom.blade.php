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
          <h1>My pending Rooms</h1>
        </div>

    @if(count($posts)<1)
       <h1>No Pending Request of Mine</h1>
    @else
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Title</th>
            <th>Cost</th>
            <th>Date</th>
         <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($posts as $post)
      @if($post->booking == "pending")
        <tr>
            <td>{{$post->rpname}}</td>
            <td>{{$post->cost}}</td>
            <td>{{$post->from_date}}-{{ $post->to_date }}</td>
         <td>
            <div class="col-md-4 text-left">
                {{ Form::open(['action'=>['DashboardController@cancelwantingroom',$post->id],'method' => 'POST']) }}
                {{Form::submit('Cancel Request',['class'=>'btn btn-primary'])}}
                {{ Form::close() }}
            </div>
         </td>
        </tr>
      @endif
        @endforeach
    </tbody>
</table>
@endif
@endsection
