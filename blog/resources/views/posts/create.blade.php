@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
   <center> <h1>New Room Creation</h1></center></br>
   <div class="card-body">
    {{ Form::open(['action'=>'PostsController@store','method' => 'POST','enctype'=>'multipart/form-data']) }}
    <div class="form-group row">
        <div class="col-md-4">
    	{{Form::text('title','',['class'=>'form-control','placeholder'=>'Room Name'])}}
        </div>
    </div>
    <div class="form-group row">
         <div class="col-md-3">
            <input id="room_no" min="0" type="Number" class="form-control" name="room_no" required autocomplete="room_no" placeholder="Number of room">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-6">
             <label for="room_type">Room Type :
             </label>
            <select id="brinto1" onclick="ddlselect1();">
                <option>Resident</option>
                <option>Hostel</option>
            </select>
        </div>
    </div>
    <input type="text" id="type" name="type" hidden/>

    <div class="form-group row">
         <div class="col-md-3">
            <input id="max_people" min="0" type="Number" class="form-control" name="max_people" required autocomplete="max_people" placeholder="Max People">
        </div>
    </div>

     <div class="form-group row">
        <div class="col-md-4">
        {{Form::text('location','',['class'=>'form-control','placeholder'=>'Location'])}}
        </div>
    </div>

     <div class="form-group row">
        <div class="col-md-6">
             <label for="cost_basis">Cost Basis :
             </label>
            <select id="brinto2" onclick="ddlselect2();">
                <option>Per Day</option>
                <option>Per Month</option>
            </select>
        </div>
    </div>
    <input type="text" id="cost_basis" name="cost_basis" hidden/>

    <div class="form-group row">
         <div class="col-md-3">
            <input id="cost" min="0" type="Number" class="form-control" name="cost" required autocomplete="cost" placeholder="Cost">
        </div>
    </div>

     <div class="form-group row">
         <div class="col-md-3">
             <label for="from_date">From :
             </label>
            <input id="from_date" min="0" type="date" class="form-control" name="from_date" required autocomplete="from_date">
        </div>
    </div>

    <div class="form-group row">
         <div class="col-md-3">
             <label for="to_date">To :
             </label>
            <input id="to_date" min="0" type="date" class="form-control" name="to_date" required autocomplete="to_date">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-3">
        <input id="contact" min="0" max="01999999999" type="Number" class="form-control" name="contact" required autocomplete="phone-number" placeholder="11 digit">
        </div>
    </div>
	<div class="form-group row">
        <div class="col-md-6">
    	{{Form::textarea('body','',['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'Short Description'])}}
    </div>
	</div>
    <div class="form-group row">
        <div class="col-md-4">
       {{Form::file('cover_image')}}
   </div>
    </div>
	{{Form::submit('Submit',['class'=>'btn btn-primary'])}}
{{ Form::close() }} 
</div>
</div>
</div>
</div>
</div>
@endsection