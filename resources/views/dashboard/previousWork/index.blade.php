@extends('dashboard.partial.layout')
@section('content')

<section class="content">
   <div class="container-fluide">
      <div class="row">
          <div class="col-lg-12">
              <div class="card">
              <div class="card-header">
                <h3 class="card-title">All Users Albums </h3>
              
                <a type="button" class="btn bg-lightblue color-palette btn-sm float-right" data-toggle="modal" data-target="#exampleModal">
                   Add New Image
                </a>
             
           
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example" class="table table-bordered table-striped" style="font-size:15px;">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($previous_works as $key=>$previous_work)
                    <tr>
                    <td>{{++$key}}</td>
                    <td><img src="{{$previous_work->image}}" alt="" style="width:100px;height:100px;"></td>
                      <td>
                        <a href="{{route('delete-previous-work',$previous_work->id )}}" class="btn btn-warning btn-sm"><i class="fas fa-trash"></i></a>     
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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('save-previous-work')}}" method="post" method="post" enctype="multipart/form-data">
      @csrf
      <div class="modal-body">
      <div class="col-lg-6">
            <label for="example-fileinput"
                class="form-label">Previous Works Section Images</label>
            <input type="file" id="example-fileinput" class="form-control" name="image[]"
                multiple>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Upload Images</button>
      </div>
      </form>
    </div>
  </div>
</div>


@endsection