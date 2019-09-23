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
            <th>Profile</th>
   		</tr>
   	</thead>
   	<tbody>
   		@foreach($posts as $post)
   		<tr>
        @foreach($usersb as $ub)
          @if($ub->id==$post->user_id && $post->isapproved=="CONFIRM")
   			<td>{{$post->title}}</td>
   			<td>{{$post->type}}</td>
            <td>{{$post->location}}</td>
            <td>{{$post->contact}}</td>
            <td>
               <a href="/posts/{{$post->id}}" class="btn btn-info">Show</a>
            </td>
            <td>
               <a href="/pos/{{$post->user_id}}" class="btn btn-info">Show Profile</a>
            </td>
            @endif
            @endforeach
   		</tr>
   		@endforeach
        
   	</tbody>
   </table>
	 {{$posts->links()}}
      <div class="row">
            <div class="col">
                <h3>You may also looking for</h3>
            </div>
        </div>
     <div class="row">
     @foreach ($products as $product)
            <div class="col">
                <div class="card" >
                    <div class="card-body">
                     <a href="/posts/{{$product['id']}}">
                        <img style="width:100%" src="http://localhost/laravelapps/blog/public/storage/cover_images/{{$product['cover_image']}}">   
                        <h5 class="card-title">Similarity: {{ round($product['similarity'] * 100, 1) }}%</h5>
                        <p class="card-text text-muted">{{ $product['title'] }} (${{ $product['total_cost'] }})</p>
                    </a>
                    </div>
                    
                </div>
            </div>
        @endforeach
        </div>
@endsection