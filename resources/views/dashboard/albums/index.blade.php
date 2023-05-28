@extends('Dashboard.partial.layout')
@section('content')

<section class="content">
   <div class="container-fluide">
      <div class="row">
          <div class="col-lg-12">
              <div class="card">
              <div class="card-header">
                <h3 class="card-title">All Users Albums </h3>

                <a href="{{ route('album-create') }}" class="btn bg-lightblue color-palette btn-sm float-right">
                   Send a New Album For User
                </a>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example" class="table table-bordered table-striped" style="font-size:15px;">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>User Name</th>
                    <th>Mobil No.</th>
                    <th>Date</th>
                    <th>Album</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($user_albums as $album)
                    <tr>
                    <td>{{$album->id}}</td>
                    <td>{{$album->user->name}}</td>
                    <td>{{$album->user->phone}}</td>
                    <td>{{$album->date}}</td>
                    <td>
                       <a href="{{route('album-view',['id'=> $album->id])}}" class="btn bg-pink"><i class="fas fa-images"></i> Open</a>
                       </td>
                      <td>
                        <a href="{{route('album-delete',$album->id )}}" class="btn btn-warning btn-sm"><i class="fas fa-trash"></i></a>
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
