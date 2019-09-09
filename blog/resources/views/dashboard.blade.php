@extends('layouts.app')

@section('content')

<div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="posts/create">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Create New Apartment</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="dashboard/requestroom" >
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Rooms Waiting For Approval</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="dashboard/wantingroom">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>My requested Rooms</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="dashboard/occupiedroom">
          <i class="fas fa-fw fa-table"></i>
          <span>Rooms Currently Using</span></a>
      </li>
    </ul>




<div class="container">
    <div class="row-2">
        <div class="col-md-14">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <center><h3>Your Apartments</h3></center>
                    <table class="table table-striped">
                        <tr>
                            <th>Apartment</th>
                            <th>Action</th>
                            <th>Action</th>
                            <th>ROOM</th>
                        </tr>
                        @foreach($posts as $post)
                        <tr id="row{{$post->id}}" class="clickable" data-toggle="collapse" data-target=".row{{$post->id}}">
                            <th>{{$post->title}}</th>
                            <th><a href="posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a></th>
                            <th>
                                {{Form::open(['action'=>['PostsController@destroy',$post->id],'method'=>'POST','class'=>'pull-right'])}}
                                {{Form::hidden('_method','DELETE')}}
                                {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                                {{Form::close()}}
                            </th>
                            <td><i class="glyphicon glyphicon-plus"><button class="btn btn-primary">Show Rooms</button></i></td>
                        </tr>
                         <tr class="collapse row{{$post->id}}">
                              <th>Flat Name</th><th>People</th><th>Cost</th><th>From</th><th>To</th>
                              
                             </tr>
                            @foreach($indiroom as $room)
                             @if($room->flat_name==$post->title)
                             <tr class="collapse row{{$post->id}}">
                            <td>{{$room->rpname}}</td>
                            <td>{{$room->max_people}}</td>
                            <td>{{$room->cost}}</td>
                            <td>{{$room->from_date}}</td>
                            <td>{{$room->to_date}}</td>
                        </tr>
                            @endif
                            @endforeach
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
