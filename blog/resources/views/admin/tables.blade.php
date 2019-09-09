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
     <a href="{{ url('/admin/table/pdf') }}" class="btn btn-primary">PDF REPORT</a>
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
                    <th>Block</th>
                    <th>SHOW DETAILS</th>
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
                    <th>Block</th>
                    <th>SHOW DETAILS</th>
                  </tr>
                </tfoot>
                <tbody>
                  @foreach($users as $user)
                  @if($user->admin=="yes")
                  <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->phone_number}}</td>
                    <td>{{$user->age}}</td>
                    <td>{{$user->nid}}</td>
                    <td>{{$user->created_at}}</td>
                       <td><a href="/admin/showuser/{{$user->id}}" class="btn btn-info">Show</a></td>
                    <th>
                      @if($user->BLOCK==0)
                     {{ Form::open(['action'=>['AdminController@Blockuser',$user->id],'method' => 'POST']) }}
                {{Form::submit('Block',['class'=>'btn btn-danger','id'=>'blockbut'])}}
                {{ Form::close() }}
                @endif
                 @if($user->BLOCK==1)
                     {{ Form::open(['action'=>['AdminController@UnBlockuser',$user->id],'method' => 'POST']) }}
                {{Form::submit('UnBlock',['class'=>'btn btn-primary','id'=>'blockbut'])}}
                {{ Form::close() }}
                @endif
                    </th>
                  </tr>
                  @endif
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>

        <p class="small text-center text-muted my-5">
          <em>More table examples coming soon...</em>
        </p>

      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      @include('/admin/partials/footer')
  