@extends('layouts.app')

@section('content')
  <div class row>
          <h1>My pending Rooms</h1>
        </div>
{{-- <div class="container">

    <div class="row justify-content-center">
        @if(count($posts)<1)
           <h1>No Pending Request</h1>
        @else
          @foreach($posts as $post)
        <div class="col-md-6">
           <div class="card" style="width:350px">
    <div class="card-body">
       {{--  @if($post->booking == "pending")
        <div class="card-title">{{$post->title}}</div>
        <p class="card-text">{{$post->hostid}}</p>
        <div class="row">
            <div class="col-md-4 text-left">
                {{ Form::open(['action'=>['DashboardController@cancelwantingroom',$post->id],'method' => 'POST']) }}
                {{Form::submit('Cancel',['class'=>'btn btn-primary'])}}
                {{ Form::close() }}
            </div>
        </div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Host Id</th>
                    <th>Cost</th>
                    <th>Date</th>
                 <th>Location</th>
                 <th>Contact Number</th>
                 <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
              @if($post->booking == "pending")
                <tr>
                    <td>{{$post->title}}</td>
                    <td>{{$post->type}}</td>
                    <td>{{$post->cost}}/{{$post->cost_basis}}</td>
                    <td>{{$post->from_date}}-{{$post->to_date}}</td>
                 <td>{{$post->location}}</td>
                 <td>{{$post->contact}}</td>
                 <td>
                    <div class="col-md-4 text-left">
                        {{ Form::open(['action'=>['DashboardController@cancelwantingroom',$post->id],'method' => 'POST']) }}
                        {{Form::submit('Cancel',['class'=>'btn btn-primary'])}}
                        {{ Form::close() }}
                    </div>
                 </td>
                </tr>
              @endif
                @endforeach

            </tbody>
        </table>
    </div>
</div>
</br>
        </div>
        @endforeach
        @endif

    </div>
</div> - --}}

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
