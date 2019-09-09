@extends('layouts.app')

      <!-- Main jumbotron for a primary marketing message or call to action -->
      @section('content')

      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
           <div class="carousel-item">
            <img class="d-block w-100" src="http://localhost/laravelapps/blog/public/storage/cover_images/image3_1559414667.jpg" alt="Third slide" height="300" width="200">
          </div>

          <div class="carousel-item active">
            <img class="d-block w-100" src="http://localhost/laravelapps/blog/public/storage/cover_images/image3_1559310324.jpg" alt="First slide" height="300" width="200">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="http://localhost/laravelapps/blog/public/storage/cover_images/oakImage-1536872349845-articleLarge_1561361021.jpg" alt="Second slide" height="300" width="200">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>

      <div class="jumbotron">
        <div class="container">
          <h1 class="display-3">Welcome to Bachelor Bari.com</h1>


          <div class="modal fade" id="modalContactForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">WELCOME!</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form action="/advancesearch" method="get">
      <div class="modal-body mx-3">
        <div class="md-form mb-3">
          <i class="fas fa-envelope prefix grey-text"></i>
            <input type="text" name="namesearch" class="form-control">
            <h5><label data-error="wrong" data-success="right" for="form34">Apartment name</label></h5>
        </div>

        <div class="md-form mb-3">
          <h5><label data-error="wrong" data-success="right" for="form29">Area</label></h5>
          <i class="fas fa-envelope prefix grey-text"></i>
           <select id="areas" onclick="selectarea();">
            <option>uttora</option> 
            <option>adabor</option>
            <option>azimpur</option>
            <option>motijheel</option>
            <option>farmgate</option>
            <option>dhanmondi</option>
            <option>polasi</option>
            <option>arambag</option>
            <option>mohammadpur</option>
          </select>
          <input type="text" id="areasearch" name="areasearch" hidden/>
        </div>

         <div class="md-form mb-3">
           <input onclick="selectkeyword1();" type="checkbox" id="familysearch" value="family"><big>Family</big>
           &nbsp &nbsp &nbsp &nbsp &nbsp
           <input onclick="selectkeyword1();" type="checkbox" id="friendssearch" value="friends"><big>Friends</big>
           &nbsp &nbsp &nbsp &nbsp 
           <input onclick="selectkeyword1();" type="checkbox" id="petsearch" value="pet"><big>Pet Allowed</big></br>
           <input onclick="selectkeyword1();" type="checkbox" id="studentsearch" value="student"><big>student</big>
           &nbsp &nbsp &nbsp &nbsp
           <input onclick="selectkeyword1();" type="checkbox" id="job_seekersearch" value="job_seeker"><big>job_seeker</big></br>
           <input onclick="selectkeyword1();" type="checkbox" id="late_nightsearch" value="late_night"><big>late_night</big>
           &nbsp &nbsp
           <input onclick="selectkeyword1();" type="checkbox" id="hard_drinkssearch" value="hard_drinks"><big>hard_drinks</big>

           <input type="text" id="is_familysearch" name="is_familysearch" hidden/>
           <input type="text" id="is_friendsearch" name="is_friendsearch" hidden/>
           <input type="text" id="is_petsearch" name="is_petsearch" hidden/>
           <input type="text" id="is_studentsearch" name="is_studentsearch" hidden/>
           <input type="text" id="is_jobseekersearch" name="is_jobseekersearch" hidden/>
           <input type="text" id="is_latenightsearch" name="is_latenightsearch" hidden/>
           <input type="text" id="is_harddrinkssearch" name="is_harddrinkssearch" hidden/>
        </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" class="btn btn-primary">Search Apatment</button>
      </div>
       </form>
    </div>
  </div>
</div>

<div class="text-center">
  
  <a href="" class="btn btn-primary" data-toggle="modal" data-target="#modalContactForm"><h1>SEARCH FOR APARTMENT</h1></a>
</div>







        </div>
      </div>

      <div class="container">
        <!-- Example row of columns -->
        <div class="row">
          <div class="col-md-4">
            <h2>Ambition</h2>
            <p>it is established due to the necessity of bachelors. As population is increasing, it is getting really difficult to find accomodations for bachelors. Some social misinterpretation lies behind it. </p>
            <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
          </div>
          <div class="col-md-4">
            <h2>Goal</h2>
            <p>New rooms are available here in dhanmondi,mdpur,mirpur rampura etc etc. you can find homelike environment here.  </p>
            <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
          </div>
          <div class="col-md-4">
            <h2>Vision</h2>
            <p>Our vision is to spead this facility across the country</p>
            <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
          </div>
        </div>

        <hr>
      </div> <!-- /container -->
      <html>
<body>

<h2>Our Parners</h2>
<p><a href="https://www.w3schools.com/html/">Visit our Global Parners</a></p>
<p><a href="https://www.booking.com/"><img src="https://seeklogo.net/wp-content/uploads/2015/09/bookingcom-logo-vector-download.jpg" width="200" height="200"></a></p>
</body>
</html>

      @endsection
