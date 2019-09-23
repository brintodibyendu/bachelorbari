@extends('layouts.app')
@section('content')
<div class="card" style="width:350px">
	<div class="card-body">
    <p class="card-text">Host Profile :</p>
    <p class="card-text">ID   : {{$user->id}}</p>
    <p class="card-text">Name : {{$user->name}}</p>
    <p class="card-text">Email:{{$user->email}}</p>
    <p class="card-text">no   :{{$user->phone_number}}</p>
    <p class="card-text">age  :{{$user->age}}</p>
    <p class="card-text">nid  :{{$user->nid}}</p>
		<p class="card-text">Rating as user  :{{$user->user_avg_rate}}</p>


		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Review as user</th>
					<th>Rating</th>
				</tr>
			</thead>
			<tbody>
				@foreach($review as $reviews)
				<tr>
					<td>{{$reviews->user_review}}</td>
					<td>{{$reviews->user_rating}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>




			<div class="col-md-4">
				<a href="{{action('DashboardController@requestroom')}}" class="btn btn-primary">Back</a>
			</div>


		</div>
</div>
@endsection
