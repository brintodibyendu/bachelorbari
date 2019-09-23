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
        <a class="nav-link" href="useroom">
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
        @if($cnt<1)
           <h1>No Room in Use</h1>
        @else
         <div class row>
          <h1>My using Rooms</h1>
        </div>
         <div class="col-md-5" align="right">
     <a href="{{ url('/dashboard/occupiedroom/pdf') }}" class="btn btn-danger">Convert into PDF</a>
    </div>

        @foreach($posts as $post)
        <div class="col-md-6">
           <div class="card" style="width:350px">
    <div class="card-body">
        <div class="card-title">{{$post->room_name}}</div>
        <p class="card-text">{{$post->flat_name}}</p>
        <p class="card-text">{{$post->requested_from_date}}</p>
        <p class="card-text">{{$post->requested_to_date}}</p>
        @if($todayDate==$post->requested_to_date && $post->status == "CONFIRM")
        {{ Form::open(['action'=>['PostsController@checkout',$post->room_id,$post->id],'method' => 'POST']) }}
    			<div class="col-md-4 text-left">

    				{{Form::submit('Checkout',['class'=>'btn btn-primary'])}}
    				{{ Form::close() }}
    			</div>
        @endif
        @if($post->status == "CHECKOUT")
        <div class="item-wrapper">
          <button class="btn btn-primary" onclick="openForm()">Review</button>
              <div class="form-popup" id="myForm">
                {{ Form::open(['action'=>['PostsController@review_room',$post->room_id,$post->id],'method' => 'POST','class'=>'form-container']) }}
                  <div class="form-group">
                    <input type="text" class="form-control" name="headline" id="" placeholder="Headline">
                    <input type="text" class="form-control" name="description" id="" placeholder="Description">
                    <div class="rate">
                      <input type="radio" id="star5" name="rate" value="5" class="mt_star" />
                      <label for="star5" title="text">5 stars</label>
                      <input type="radio" id="star4" name="rate" value="4" class="mt_star"/>
                      <label for="star4" title="text">4 stars</label>
                      <input type="radio" id="star3" name="rate" value="3" class="mt_star"/>
                      <label for="star3" title="text">3 stars</label>
                      <input type="radio" id="star2" name="rate" value="2" class="mt_star"/>
                      <label for="star2" title="text">2 stars</label>
                      <input type="radio" id="star1" name="rate" value="1" class="mt_star"/>
                      <label for="star1" title="text">1 star</label>
                    </div>

                    <input type="text" class="form-control" name="owner_review" id="" placeholder="owner_review">
                    <div class="rate">
                      <input type="radio" id="star55" name="rate1" value="5" class="mt_star" />
                      <label for="star55" title="text">5 stars</label>
                      <input type="radio" id="star44" name="rate1" value="4" class="mt_star"/>
                      <label for="star44" title="text">4 stars</label>
                      <input type="radio" id="star33" name="rate1" value="3" class="mt_star"/>
                      <label for="star33" title="text">3 stars</label>
                      <input type="radio" id="star22" name="rate1" value="2" class="mt_star"/>
                      <label for="star22" title="text">2 stars</label>
                      <input type="radio" id="star11" name="rate1" value="1" class="mt_star"/>
                      <label for="star11" title="text">1 star</label>
                    </div>
                    {{Form::submit('Submit Review',['class'=>'btn btn-primary'])}}
                    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
                  </div>
                </form>
              </div>

            </div>
            @endif
    </div>
</div>
</br>
        </div>
        @endforeach
        @endif



    </div>
</div>
@endsection
