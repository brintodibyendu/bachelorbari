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
          <h1>Checkout Rooms</h1>
        </div>

        @foreach($posts as $post)
        <div class="col-md-6">
           <div class="card" style="width:350px">
    <div class="card-body">
        <div class="card-title">{{$post->room_name}}</div>
        <p class="card-text">{{$post->flat_name}}</p>
        <p class="card-text">{{$post->user_name}}</p>

        @if($post->status == "checkout")
        <div class="item-wrapper">
          <button class="btn btn-primary" onclick="openForm()">Review</button>
              <div class="form-popup" id="myForm">
                {{ Form::open(['action'=>['PostsController@review_user',$post->id],'method' => 'POST','class'=>'form-container']) }}
                  <div class="form-group">
                    <input type="text" class="form-control" name="Udescription" id="" placeholder="Description">
                    <div class="rate">
                      <input type="radio" id="star51" name="Urate" value="5" class="mt_star" />
                      <label for="star51" title="text">5 stars</label>
                      <input type="radio" id="star41" name="Urate" value="4" class="mt_star"/>
                      <label for="star41" title="text">4 stars</label>
                      <input type="radio" id="star31" name="Urate" value="3" class="mt_star"/>
                      <label for="star31" title="text">3 stars</label>
                      <input type="radio" id="star21" name="Urate" value="2" class="mt_star"/>
                      <label for="star21" title="text">2 stars</label>
                      <input type="radio" id="star110" name="Urate" value="1" class="mt_star"/>
                      <label for="star110" title="text">1 star</label>
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
