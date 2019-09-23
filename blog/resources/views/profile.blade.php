@extends('layouts.app')
@section('content')
<div class="card" style="width:350px">
	<div class="card-body">
    <h3 class="card-text">Profile :</h3>
    <p class="card-text">Name : {{auth()->user()->name}}</p>
    <p class="card-text">Email:{{auth()->user()->email}}</p>
    <p class="card-text">no   :{{auth()->user()->phone_number}}</p>
    <p class="card-text">age  :{{auth()->user()->age}}</p>
    <p class="card-text">nid  :{{auth()->user()->nid}}</p>
		<p class="card-text">nid  :{{auth()->user()->nid}}</p>
		<p class="card-text">Owner_rating  :{{auth()->user()->owner_avg_rate}}</p>
		<p class="card-text">user_rating  :{{auth()->user()->user_avg_rate}}</p>




			<div class="col-md-4">
				<a href="{{action('PostsController@index')}}" class="btn btn-primary">Back</a>
			</div>
      

		</div>
</div>
@endsection
