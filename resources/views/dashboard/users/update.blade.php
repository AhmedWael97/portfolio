@extends('dashboard.partial.layout')
@section('content')
<section class="content mt-2">
   <div class="container-fluid">
      <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                    Updated {{$user->name}} Informations
                </h3>
              </div>

              <div class="card-body">
                <form action="{{ route('user-update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <div class="row">
                        <div class="col-md-4">
                            <label>
                                Client Name
                            </label>
                            <input type="text" name="name" value="{{$user->name}}"class="form-control mb-2" required />
                        </div>
                        
                        <div class="col-md-4">
                            <label>
                                Mobil No.
                            </label>
                            <input type="text" name="phone" value="{{$user->phone}}" class="form-control mb-2" required />
                        </div>
                        <div class="col-md-4">
                            <label>
                                Session Date
                            </label>
                            <input type="date" name="session_date" value="{{$user->session_date}}"class="form-control mb-2" required />
                        </div>
                       
                       
                        <div class="col-md-6">
                            <label>
                                User Email
                            </label>
                            <input type="email" name="email" value="{{$user->email}}" class="form-control mb-2" required />
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                                <label for="password">Password</label>
                                <input name="password" type="password" class="form-control" placeholder="Enter Password">
                                <small class="text-danger">**password must be more thank 8 character</small>
                            </div>
                        </div>
                        </div>
      
                    </div>
                    <button class="btn btn-danger " type="submit">Submit</button>
                </form>
            </div>
          </div>
      </div>
   </div>
</section>

@endsection