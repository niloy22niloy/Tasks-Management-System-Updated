@extends('guest.dashboard.dashboard_master')
@section('content')
This Page is now In developing 
{{-- <div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Work Add</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('work.upload.success')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Work Name</label>
                        <input type="text" name="work_name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Work Description</label>
                    <textarea id="summernote" name="work_description"></textarea>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Add Work Images</label>
                    
                </div>
                <div class="mb-3">
                    <input type="file"  name="images[]" multiple onchange="previewMultiple(event)" id="adicionafoto">
                </div>
                <div id="galeria">
        
                </div>
                

                <div class="mt-3">
                    <button class="btn btn-success">Insert</button>
                </div>

            </form>
                </div>
            </div>
        </div>
    </div>
    
    
</div>
<script>
    $(document).ready(function() {
  $('#summernote').summernote();
});
</script>
<script>
   function previewMultiple(event){
        var saida = document.getElementById("adicionafoto");
        var quantos = saida.files.length;
        for(i = 0; i < quantos; i++){
            var urls = URL.createObjectURL(event.target.files[i]);
            document.getElementById("galeria").innerHTML += '<img src="'+urls+'">';
        }
    }
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
<style>
    #galeria{
        display: flex;
    }
    #galeria img{
        width: 85px;
        height: 85px;
        border-radius: 10px;
        box-shadow: 0 0 8px rgba(0,0,0,0.2);
        opacity: 85%;
    }
</style> --}}
@endsection