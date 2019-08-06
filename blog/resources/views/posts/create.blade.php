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
            <label for="Contact No">Contact No :
             </label>
        <input id="contact" min="0" max="01999999999" type="Number" class="form-control" name="contact" required autocomplete="phone-number" placeholder="11 digit">
        </div>
    </div>
     <div class="form-group row">
        <div class="col-md-3">
           <input onclick="selectkeyword();" type="checkbox" id="family" value="family">Family</br>
           <input onclick="selectkeyword();" type="checkbox" id="friends" value="friends">Friends</br>
           <input onclick="selectkeyword();" type="checkbox" id="pet" value="pet">Pet Allowed</br>
           <input onclick="selectkeyword();" type="checkbox" id="student" value="student">student</br>
           <input onclick="selectkeyword();" type="checkbox" id="job_seeker" value="job_seeker">job_seeker</br>
           <input onclick="selectkeyword();" type="checkbox" id="late_night" value="late_night">late_night</br>
           <input onclick="selectkeyword();" type="checkbox" id="hard_drinks" value="hard_drinks">hard_drinks</br>

           <input type="text" id="is_family" name="is_family" hidden/>
           <input type="text" id="is_friend" name="is_friend" hidden/>
           <input type="text" id="is_pet" name="is_pet" hidden/>
           <input type="text" id="is_student" name="is_student" hidden/>
           <input type="text" id="is_jobseeker" name="is_jobseeker" hidden/>
           <input type="text" id="is_latenight" name="is_latenight" hidden/>
           <input type="text" id="is_harddrinks" name="is_harddrinks" hidden/>
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