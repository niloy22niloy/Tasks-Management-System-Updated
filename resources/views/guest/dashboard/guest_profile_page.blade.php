@extends('guest.dashboard.dashboard_master')
@section('content')

  <div class="main-content position-relative max-height-vh-100 h-100">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Profile</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Profile</h6>
        </nav>
        
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid ">
        
      
       
      <div class="card card-body ">
        <div class="row gx-4 mb-2">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
                @if($guest->photo)
                <img src="{{asset('guest_image')}}/{{$guest->photo}}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                @else
                
                <img src="{{Avatar::create($guest->name)->toBase64()}}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                @endif
              
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                {{$guest->name}}
              </h5>
              <p class="mb-0 font-weight-normal text-sm">
                {{$guest->email}}
              </p>
              <p class="mb-0 font-weight-normal text-sm">
                {{$guest->designation}}
              </p>
            </div>
          </div>
          
        </div>
        <div class="row">
          <div class="row">
            
            <div class="col-lg-12 text-center">
              <div class="card card-plain h-100">
                <div class="card-header pb-0 p-3">
                  <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                      <h6 class="mb-0">Profile Information</h6>
                    </div>
                    <div class="col-md-4 text-end">
                      <a href="{{route('profile.page',$guest->id)}}">
                        <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="card-body p-3">
                  <p class="text-sm">
                    {!! $guest->description !!}
                  </p>
                  <hr class="horizontal gray-light my-4">
               
                </div>
              </div>
            </div>
            
            
          </div>
        </div>
      </div>
    </div>
</div>
    
  </div>
  
@endsection