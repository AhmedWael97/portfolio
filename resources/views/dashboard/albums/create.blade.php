@extends('Dashboard.partial.layout')
@section('content')
<section class="content mt-2">
   <div class="container-fluid">
      <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                    Add New Album
                </h3>
              </div>

              <div class="card-body">
                <form action="{{ route('album-store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group" data-select2-id="62">
                                <label>Client Name</label>
                                <select class="form-control select2 select2-hidden-accessible" name="user_id"style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" > {{$user->id}} - {{ $user->name }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>
                                Album Name
                            </label>
                            <input type="text" name="name" class="form-control mb-2" required />
                        </div>

                        <div class="col-md-6">
                            <label>
                                Date Of Session
                            </label>
                            <input type="date" name="date" class="form-control mb-2" required />
                        </div>



                    </div>
                    <button class="btn btn-danger " type="submit"> <i class="fas fa-camera-retro"></i> Upload Album</button>
                </form>
            </div>
          </div>
      </div>
   </div>
</section>

@endsection
