@extends('layouts.app')

@section('content')
    <h1>Edit Room Information</h1>
    {{ Form::open(['action'=>['PostsController@update',$post->id],'method' => 'POST','enctype'=>'multipart/form-data']) }}
    <div class="form-group">
    	{{Form::label('title','Title')}}
    	{{Form::text('title',$post->title,['class'=>'form-control','placeholder'=>'Title'])}}
	</div>

<div class="form-group">
    {{Form::label('room_no','Rooms to be added')}}
    {{Form::text('room_no',0,['class'=>'form-control','placeholder'=>'Room'])}}
</div>


    <div class="form-group row">
  <table id="myTable"  class="table table-bordered">
     <tr>

         <td><input id="rpname[]" min="0" type="text" class="form-control" name="rpname[]" required autocomplete="Name" placeholder="Name"></td>
         <td><input id="max_people[]" min="0" type="Number" class="form-control" name="max_people[]" required autocomplete="max_people" placeholder="People"></td>
         <td><input id="cost[]" min="0" type="Number" class="form-control" name="cost[]" required autocomplete="cost" placeholder="Cost"></td>
         <td><input id="from_date[]" min="0" type="date" class="form-control" name="from_date[]" required autocomplete="from_date"></td>
         <td><input id="to_date[]" min="0" type="date" class="form-control" name="to_date[]" required autocomplete="to_date"></td>
         <td><input type="button" class="button" value="Add Room" onclick="addField();"></td>
     </tr>
 </table>
 </div>





	<div class="form-group">
    	{{Form::label('body','Body')}}
    	{{Form::textarea('body',$post->body,['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'Body Text'])}}
	</div>
     <div class="form-group">
       {{Form::file('cover_image')}}
    </div>
    {{Form::hidden('_method','PUT')}}
	{{Form::submit('Submit',['class'=>'btn btn-primary'])}}
{{ Form::close() }} 
@endsection