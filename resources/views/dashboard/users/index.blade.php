@extends('Dashboard.partial.layout')
@section('content')

<section class="content">
   <div class="container-fluide">
      <div class="row">
          <div class="col-lg-12">
              <div class="card">
              <div class="card-header">
                <h3 class="card-title">My Users </h3>

                <a href="{{ route('user-create') }}" class="btn btn-danger btn-sm float-right">
                    Add New User
                </a>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example" class="table table-bordered table-striped" style="font-size:15px;">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Mobil No.</th>
                    <th>Email</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($users as $user)
                    <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->phone}}</td>
                    <td>{{$user->email}}</td>
                      <td>

                        <a href="{{route('user-edit',$user->id)}}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>


                        <a href="{{route('user-delete',$user->id)}}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>

                      </td>


                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->

             </div>
             </div>
             </div>
             </div>
</section>


@endsection
