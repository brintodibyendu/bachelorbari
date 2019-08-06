@include('/admin/partials/header')
@include('/admin/partials/sidebar')
    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{url('admin')}}">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Overview</li>
        </ol>

        <!-- Icon Cards-->
            <!-- Area Chart Example-->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Types of Rooms</div>
          <div class="card-body">
            {!! $chart->container() !!}
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>

         <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Joining date of users</div>
          <div class="card-body">
            {!! $linechart->container() !!}
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>

         <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Rooms</div>
          <div class="card-body">
            {!! $roomchart->container() !!}
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>


        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Data Table Example</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>E-mail</th>
                    <th>Phone Number</th>
                    <th>Age</th>
                    <th>National ID</th>
                    <th>Start Date</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>E-mail</th>
                    <th>Phone Number</th>
                    <th>Age</th>
                    <th>National ID</th>
                    <th>Start Date</th>
                    <th>Status</th>
                  </tr>
                </tfoot>
                <tbody>
                  @foreach($admin as $user)
                  <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->phone_number}}</td>
                    <td>{{$user->age}}</td>
                    <td>{{$user->nid}}</td>
                    <td>{{$user->created_at}}</td>
                    <td>{{$user->admin}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>

      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
@include('/admin/partials/footer')     