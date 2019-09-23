@include('/admin/partials/header')
@include('/admin/partials/sidebar')
<div class="container">

      <!-- Page Heading -->
      <h1 class="my-4">APARTMENT REQUEST
      </h1>

      <!-- Project One -->
       @foreach($posts as $post)
       @if($post->isapproved=="PENDING")
      <div class="row">
        <div class="col-md-5">
          <a href="#">
            <img class="img-fluid rounded mb-3 mb-md-0" src="http://localhost/laravelapps/blog/public/storage/cover_images/{{$post->cover_image}}">
          </a>
          <p>{{$post->body}}</p>
          <p>{{$post->location}}</p>
          <h5>REQUESTED BY</h5>
          <p>{{$post->user_name}}</p>
           <h5>FORWARDED BY</h5>
          <p>Ucwash Talukder</p>
        </div>
         <div class="col-md-7">
          <h3>{{$post->title}}</h3>
         <table class="table table-striped">
                        <tr>
                            <th>ROOM NAME</th>
                            <th>MAX PEOPLE</th>
                            <th>COST</th>
                            <th>FROM</th>
                             <th>TO</th>
                            
                        </tr>
          @foreach($indiroom as $room)
                             @if($room->flat_name==$post->title)
                             <tr>
                            <td>{{$room->rpname}}</td>
                            <td>{{$room->max_people}}</td>
                            <td>{{$room->cost}}</td>
                            <td>{{$room->from_date}}</td>
                            <td>{{$room->to_date}}</td>
                           
                        </tr>
                        @endif
                            @endforeach
                            </table>
                            <p>  {{ Form::open(['action'=>['AdminController@confirroomadmin',$post->id],'method' => 'POST']) }}
                {{Form::submit('CONFIRM APARTMENT',['class'=>'btn btn-primary'])}}
                {{ Form::close() }}</p><p>
                {{ Form::open(['action'=>['AdminController@cancelroomadmin',$post->id],'method' => 'POST']) }}
                {{Form::submit('CANCEL APARTMENT',['class'=>'btn btn-danger'])}}
                {{ Form::close() }}</p>

        </div>
      </div>
      <hr>
      @endif
                        @endforeach
      <!-- /.row -->

      
      <!-- Pagination -->
    

    </div>