@extends('guest.dashboard.dashboard_master')
@section('content')
This Page Is Now In Developing Mode
{{-- <div class="container">
    <div class="row">
        <div class="col-lg-10 m-auto">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach ($work_list as $work)
                <div class="col">
                    <div class="card">
                      
                      <div class="card-body">
                        <h5 class="card-title">{{$work->Work_Name}}</h5>
                        <p class="card-text">
                          {!! $work->Work_Description !!}
                        </p>
                        <a href="{{route('work.details',$work->id)}}" class="btn btn-success">Details</a>
                      </div>
                    </div>
                  </div>
                @endforeach
                
                
                
              </div>
        </div>
    </div>
</div> --}}
@endsection