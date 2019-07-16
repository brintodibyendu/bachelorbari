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
            <th>Location</th>
            <th>Contact Number</th>
            <th>Action</th>
   		</tr>
   	</thead>
   	<tbody>
   		@foreach($posts as $post)
   		<tr>
   			<td>{{$post->title}}</td>
   			<td>{{$post->type}}</td>
            <td>{{$post->location}}</td>
            <td>{{$post->contact}}</td>
            <td>
               <a href="/posts/{{$post->id}}" class="btn btn-info">Show</a>
            </td>
   		</tr>
   		@endforeach
        
   	</tbody>
   </table>
	 {{$posts->links()}}
@endsection