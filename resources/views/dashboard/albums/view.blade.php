@extends('Dashboard.partial.layout')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.css" />
<section class="content mt-2">
   <div class="container-fluid">
      <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                <i class="fas fa-baby"></i> All Photos For Album : {{$user->name}}
                </h3>
              </div>

              <div class="card-body">

            <div class="col-md-12">
                <p>
                    Upload Images
                </p>
                {{-- <form action="{{ route('upload-images',$album->id) }}" method="POST" enctype="multipart/form-data" class="dropzone">
                    @csrf
                </form> --}}

                <form action="{{ route('upload-image-using-drive') }}" method="post">
                    @csrf
                    <label>
                        Folder Id
                    </label>
                    <input type="hidden" name="album_id" value="{{ $album->id }}" />
                    <input type="text" name="folder_id" />
                    <input type="submit" />
                </form>
            </div>
            <hr />
              <div class="col-lg-12">
               <div class="row">
                    <table class="table table-borderd">
                        <thead>
                            <th>
                                Image
                            </th>
                            <th>
                                Delete
                            </th>
                        </thead>
                        <tbody>
                            @foreach($images as $image)
                                <tr>
                                    <td>
                                         <a id="single_image" data-fancybox="gallery" rel="group1" href="{{$image->photo}}" > <img src="{{$image->photo}}" alt="" style="width:auto;height:50px;"></a>
                                    </td>
                                    <td>
                                        <a href="{{route('delete-image',$image->id)}}" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                 </div>
               </div>
            </div>
          </div>
      </div>
   </div>
</section>

@endsection

@section('script')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>
<script>
   $(document).ready(function(){
         Dropzone.autoDiscover = false;
         var myDropzone = new Dropzone(".dropzone", {
        // Limit upload size to 2 MB
        acceptedFiles: ".jpeg,.jpg,.png,.gif", // Only allow certain file types
        addRemoveLinks: true // Show remove button to delete uploaded files
    });
   });
</script>
@endsection
