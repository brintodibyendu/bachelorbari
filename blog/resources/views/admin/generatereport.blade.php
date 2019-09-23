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
            User Report</div>
     <a href="{{ url('/admin/table/pdf') }}" class="btn btn-primary">USER PDF REPORT</a>
      </div>

       <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Room Book Report</div>
     <a href="{{ url('/admin/table/pdf') }}" class="btn btn-primary">USER PDF REPORT</a>
      </div>
  </div>
</div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
   
  