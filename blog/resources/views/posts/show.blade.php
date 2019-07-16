@extends('layouts.app')
@section('content')
<div class="card" style="width:420px">
	<img style="width:100%" src="http://localhost/laravelapps/blog/public/storage/cover_images/{{$post->cover_image}}">
	<div class="card-body">
		<div class="card-title">{{$post->title}}</div>
		<p class="card-text">{{$post->body}}</p>
		<p class="card-text">{{$post->location}}</p>
		<div class="row">
		 <table id="table" border="1" class="table table-bordered">
   		<tr>
   			<th>Name</th>
   			<th>People</th>
   			<th>Cost</th>
   			<th>Avilable From</th>
   			<th>Available till</th>
   		</tr>
   		@foreach($indi_rooms as $room)
          @if($room->booking!="pending" && $room->booking!="booked")
   		<tr onclick="myFunction(this)">
   			<td>{{$room->rpname}}</td>
   			<td>{{$room->max_people}}</td>
   			<td>{{$room->cost}}</td>
   			<td>{{$room->from_date}}</td>
   			<td>{{$room->to_date}}</td>
   			
   		</tr>
       @endif
   		@endforeach
   </table>
</div>
<div class="row">

	</div>
		{{ Form::open(['action'=>['PostsController@book_room',$post->id],'method' => 'POST']) }}

		 @if($post->user_id != auth()->user()->id)
		<div class="row">
			<div class="col-md-7 text-left">
				<label for="name">Name :
				 <input id="fname" min="0" type="text" class="form-control" name="fname" required autocomplete="fname">
			</div>
			<div class="col-md-7 text-left">
				<label for="people">People :
				 <input id="fpeople" min="0" type="text" class="form-control" name="fpeople" required autocomplete="fpeople">
			</div>
			<div class="col-md-7 text-left">
				<label for="cost">Cost :
				 <input id="fcost" min="0" type="text" class="form-control" name="fcost" required autocomplete="fcost">
			</div>
			<div class="col-md-7 text-left">
				<label for="from_date">From :
				 <input id="rfrom_date" min="0" type="date" class="form-control" name="rfrom_date" required autocomplete="from_date">
			</div>
			<div class="col-md-7 text-left">
				<label for="from_date">To :
				 <input id="rto_date" min="0" type="date" class="form-control" name="rto_date" required autocomplete="from_date">
			</div>
		</div>
		
	    </br>

	    
		<div class="row">
			<div class="col-md-4 text-left">
				
				{{Form::submit('Book',['class'=>'btn btn-primary'])}}
				{{ Form::close() }}
			</div>
			@endif
			<div class="col-md-4">
				<a href="{{action('PostsController@index')}}" class="btn btn-primary">Back</a>
			</div>
		</div></br>
		<div class="item-wrapper">
			<button class="btn btn-primary" onclick="openForm()">Review</button>
	    		<div class="form-popup" id="myForm">
	    			{{ Form::open(['action'=>['PostsController@review_room',$post->id],'method' => 'POST','class'=>'form-container']) }}
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
	    					{{Form::submit('Submit Review',['class'=>'btn btn-primary'])}}
	    					<button type="button" class="btn cancel" onclick="closeForm()">Close</button>
	    				</div>
	    			</form>
	    		</div>
	    		<table class="table table-bordered">
	    			<thead>
	    				<tr>
	    					<th>Headline</th>
	    					<th>Description</th>
	    					<th>Rating</th>
	    				</tr>
	    			</thead>
	    			<tbody>
	    				@foreach($reviews as $review)
	    				<tr>
	    					<td>{{$review->headline}}</td>
	    					<td>{{$review->description}}</td>
	    					<td>{{$review->rating}}</td>
	    				</tr>
	    				@endforeach
	    			</tbody>
	    		</table>
	    	</div>
	    </div>
</div>
@endsection