@extends('super_admin.master')
@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-lg-12 m-auto">
            <div class="card">
                <div class="card-header">
                    Category_list
                </div>
                <div class="card-body">
                    <table class="table table-striped text-center">
                        @if ($categories)
                        <tr>
                            <th>Serial</th>
                            <th>Category_Name</th>
                            <th>Added By</th>
                            <th>Action</th>
                            <th>Created_at</th>

                        </tr>
                        
                        
                        @foreach ($categories as $key=>$category )
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$category->category_name}}</td>
                            <td>{{$category->rel_to_user->name}}</td>
                            <td>{{$category->created_at}}</td>
                            <td>
                                <a href="{{route('category.edit',$category->id)}}" class="btn btn-primary">Edit</a>
                                <a href="#" class="btn btn-danger del" data-link="{{route('category.delete',$category->id)}}">Delete</a>
                            </td>
                            
                        </tr>
                        @endforeach
                        @else
                        {{'no category Add Yet'}}
                        @endif
                       
                       
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
     $(document).ready(function () {
        $(".del").click(function () {
            Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
   var link = $(this).attr('data-link');
   window.location.href = link;
  }
})
            
        })
    });
   
   
</script>
@if(session('success'))
<script>
    Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: '{{session('success')}}',
  showConfirmButton: false,
  timer: 1500
})
</script>
@endif
@endsection