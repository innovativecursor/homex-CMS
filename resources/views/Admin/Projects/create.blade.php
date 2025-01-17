@extends('Admin.master')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Project Create</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin-dashbord')}}">Home</a></li>
                <li class="breadcrumb-item active">Project Create</li>
            </ol>
        </nav>
    </div>

    <section>
        <form action="{{route('project-store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mt-3">
                <label for="project_video" class="mb-2">Project Video <span style="color: red">*</span></label>
                <input type="file" name="project_video" id="project_video" class="form-control videovalidation" value="{{ old('project_video') }}"
                accept="video/*">
                @error('project_video')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-3">
                <label for="project_image" class="mb-2">Project Image <span style="color: red">*</span></label>
                <input type="file" name="project_image" id="project_image" class="form-control imagevalidation" placeholder="Enter Project Image" value="{{ old('project_image') }}">
                @error('project_image')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label for="title" class="mb-2">Title<span style="color: red">*</span></label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title" value="{{ old('title') }}">
                @error('title')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label for="description" class="mb-2">Description <span style="color: red">*</span></label>
                <textarea name="description" id="description" cols="100" rows="6" class="form-control" placeholder="Enter Description" value="{{ old('description') }}"></textarea>
                @error('description')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label for="loction" class="mb-2">Loction<span style="color: red">*</span></label>
                <input type="text" name="loction" id="loction"  class="form-control" loction="Enter Loction" value="{{ old('loction') }}">
                @error('Loction')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label for="features" class="mb-2">Key Features<span style="color: red">*</span></label>
                <input type="text" name="features" id="features" class="form-control" placeholder="Enter Key Features" value="{{ old('features') }}">
                @error('features')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label for="exuctiontime" class="mb-2">Exuction Time <span style="color: red">*</span></label>
                <input type="text" name="exuctiontime" id="exuctiontime" class="form-control" placeholder="Enter Exuction Time" value="{{ old('exuctiontime') }}">
                @error('exuctiontime')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label for="turnover" class="mb-2">Turn Over<span style="color: red">*</span></label>
                <input type="text" name="turnover" id="turnover" class="form-control" placeholder="Enter Turn Over" value="{{ old('turnover') }}">
                @error('turnover')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">Add Project</button>
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
