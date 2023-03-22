@extends('guest.dashboard.dashboard_master')
@section('content')
<div class="contianer">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Work Details</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="" class="form-label">Work Name</label>
                        <input type="text" class="form-control" value="{{$work_details->Work_Name}}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Work Description</label>
                        {!!$work_details->Work_Description !!}
                    </div>
                    <div class="mb-3">
                        Preview Images:
                        @php
                            $asd = explode('|',$work_details->Work_Images)
                        @endphp
                        @foreach ($asd as $as)
                        <img src="{{asset('image')}}/{{$as}}" alt="">
                            
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection