@include('/admin/partials/header')
@include('/admin/partials/sidebar')
    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{url('admin')}}">Admin Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Tables</li>
        </ol>
        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            User Table</div>
           
     <a href="/admin/pdfini/{{$uuid}}" class="btn btn-primary">PDF REPORT</a>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Apartment Name</th>
                    <th>Description</th>
                    <th>No of Rooms</th>
                    <th>Apartment Type</th>
                    <th>Contact</th>
                    <th>Location</th>
                </thead>
                <tfoot>
                  <tr>
                   <th>Apartment Name</th>
                    <th>Description</th>
                    <th>No of Rooms</th>
                    <th>Apartment Type</th>
                    <th>Contact</th>
                    <th>Location</th>
                  </tr>
                </tfoot>
                <tbody>
                  @foreach($posts as $user)
                 
                  <tr>
                    <td>{{$user->title}}</td>
                    <td>{{$user->body}}</td>
                    <td>{{$user->room_no}}</td>
                    <td>{{$user->type}}</td>
                    <td>{{$user->contact}}</td>
                    <td>{{$user->location}}</td>
                  
                 
                    
                  </tr>
                 
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
         
        </div>

        <p class="small text-center text-muted my-5">
       
        </p>

      </div>
      @include('/admin/partials/footer')
  