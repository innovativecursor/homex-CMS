@extends('Admin.master')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Service Create</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin-dashbord')}}">Home</a></li>
                <li class="breadcrumb-item active">Service Create</li>
            </ol>
        </nav>
    </div>

    <section>
        <form action="{{route('service-store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mt-3">
                <label for="service_image" class="mb-2">Service Image <span style="color: red">*</span></label>
                <input type="file" name="service_image" id="service_image" class="form-control imagevalidation" placeholder="Enter Service Image" value="{{ old('service_image') }}">
                @error('service_image')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label for="description" class="mb-2">Title <span style="color: red">*</span></label>
                <input type="text" name="description" class="form-control" cols="100" rows="6" value="{{ old('description') }}">
                @error('description')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-3">Add Service</button>
        </form>
    </section>
</main>

@endsection
@push('js')
<script>
    $(document).ready(function () {
   $('.imagevalidation').on('change', function () {
          var file = this.files[0]; // Get the selected file
          if (file) {
              console.log(file.size)
              var maxSize = 5 * 1024 * 1024; // 5 MB in bytes
              if (file.size > maxSize) {
                  alert("File size should not exceed 5MB");
                  $(this).val(''); // Clear the file input field
              }
          }
      });
      $('.videovalidation').on('change', function () {
          var file = this.files[0]; // Get the selected file
          if (file) {
              console.log(file.size)
              var maxSize = 50 * 1024 * 1024; // 5 MB in bytes
              if (file.size > maxSize) {
                  alert("File size should not exceed 50MB");
                  $(this).val(''); // Clear the file input field
              }
          }
      });
  });
  </script>
@endpush
