@extends('layouts.app') 

@section('content')
<div class row>
   <div class="col-md-6">
      <h1>Rooms Available</h1>
   </div>
   <div class="col-md-4">
      <form action="/search" method="get">
         <div class="input-group">
            <input type="search" name="search" class="form-control">
            <span class="input-group-prepend">
               <button type="submit" class="btn btn-primary">Search</button>
            </span>
         </div>
      </form>
   </div>
</div>
<center> <h1>Rooms</h1></center>
   <table class="table table-bordered">
   	<thead>
   		<tr>
   			<th>Name</th>
   			<th>Type</th>
   			<th>Max Person</th>
   			<th>Cost</th>
   			<th>Date</th>
            <th>Action</th>
   		</tr>
   	</thead>
   	<tbody>
   		@foreach($posts as $post)
         @if($post->booking!=="booked")
   		<tr>
   			<td>{{$post->title}}</td>
   			<td>{{$post->type}}</td>
   			<td>{{$post->max_people}} people</td>
   			<td>{{$post->cost}}/{{$post->cost_basis}}</td>
   			<td>{{$post->from_date}}-{{$post->to_date}}</td>
            <td>
               <a href="/posts/{{$post->id}}" class="btn btn-info">Show</a>
            </td>
   		</tr>
         @endif
   		@endforeach
        
   	</tbody>
   </table>
	 {{$posts->links()}}
@endsection