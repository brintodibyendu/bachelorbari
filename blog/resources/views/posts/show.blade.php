@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
	<div class="col-md-6">
<div class="card" style="width:560px">
	<img style="width:100%" src="http://localhost/laravelapps/blog/public/storage/cover_images/{{$post->cover_image}}">
	<div class="card-body">
		<h3><div class="card-title">{{$post->title}}</div></h3>
		<p class="card-text">{{$post->body}}</p>
		<p class="card-text">{{$post->location}}</p>
		
<input type="radio" id="brinto555" name="nac" value="AC" onclick="ddlselect99()">AC
<input type="radio" id="brinto5552" name="nac" value="non" onclick="ddlselect991()">NON-AC
<input type="text" id="myInput" placeholder="Search for names.." style="display:none">


<input type="radio" id="brinto55" name="rtype" value="COMPLETE" onclick="ddlselect95()">FAMILY
<input type="radio" id="brinto552" name="rtype" value="SHARED" onclick="ddlselect951()">SHARED
<input type="text" id="myInput1" placeholder="Search for names.." style="display:none">





		<div class="row">
		 <table id="table" border="1" class="table table-bordered">
   		<tr>
   			<th style="display:none">AC</th>
   			<th style="display:none">RTYPE</th>
   			<th>Name</th>
   			<th>People</th>
   			<th>Cost</th>
   			<th>Avilable From</th>
   			<th>Available till</th>
   			<th>SHOW AVAILABILITY</th>
   		</tr>
   		@foreach($indi_rooms as $room)
   		<tr onclick="myFunction(this)" id="row{{$room->id}}" class="clickable" data-toggle="collapse" data-target=".row{{$room->id}}">
   			<td style="display:none">{{$room->AIR}}</td>
   			<td style="display:none">{{$room->RTYPE}}</td>
   			<td>{{$room->rpname}}</td>
   			<td>{{$room->max_people}}</td>
   			<td>{{$room->cost}}</td>
   			<td>{{$room->from_date}}</td>
   			<td>{{$room->to_date}}</td>
   			<td><i class="glyphicon glyphicon-plus"><button class="btn btn-primary">Show Availability</button></i></td>
   		</tr>
   		 <tr class="collapse row{{$room->id}}">
                              <th>FROM</th><th>TO</th>
                              
                             </tr>
                            @foreach($avilable as $shows)
                             @if($room->id==$shows->room_id)
                             <tr class="collapse row{{$room->id}}">
                            <td>{{$shows->requested_from_date}}</td>
                            <td>{{$shows->requested_to_date}}</td>
                        </tr>
        @endif
                            @endforeach
   		@endforeach
   </table>
</div>





<div class="row">

	</div>
		{{ Form::open(['action'=>['PostsController@book_room',$post->id],'method' => 'POST']) }}

		 @if(Auth::check())
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
	    		<table class="table table-bordered">
	    			<thead>
	    				<tr>
	    					<th>Room</th>
	    					<th>Description</th>
	    					<th>Rating</th>
	    				</tr>
	    			</thead>
	    			<tbody>
	    				@foreach($reviews as $review)
	    				<tr>
	    					<td>{{$review->room_name}}</td>
	    					<td>{{$review->room_review}}</td>
	    					<td>{{$review->room_rating}}</td>
	    				</tr>
	    				@endforeach
	    			</tbody>
	    		</table>
	    	</div>
	    </div>
</div>
</div>
<div class="col-md-6">
        <div class="row">
            <div class="offset-3 col-6">
                <h5>Similar Products</h5>
            </div>
        </div>
        @foreach ($products as $product)
        <div class="row mb-5">
            <div class="offset-3 col-6">
                <div class="card">
                    <div class="card-body">
                    	<a href="/posts/{{$product['id']}}">
                        <img style="width:100%" src="http://localhost/laravelapps/blog/public/storage/cover_images/{{$product['cover_image']}}">  	
                        <h5 class="card-title">Similarity: {{ round($product['similarity'] * 100, 1) }}%</h5>
                        <p class="card-text text-muted">{{ $product['title'] }} (${{ $product['total_cost'] }})</p>
                    </a>
                    </div>
                    
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection