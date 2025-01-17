@extends('Admin.master')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Testimonials Edit</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin-dashbord')}}">Home</a></li>
                <li class="breadcrumb-item active">Testimonials Create</li>
            </ol>
        </nav>
    </div>

    <section>
        <form action="{{route('testimonials-update', ['id' => $testimonials->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mt-3">
                <label for="testimonials_image" class="mb-2">Testimonials Image</label>

                <!-- Show the current image if it exists -->


                <!-- Allow the user to upload a new image -->
                <input type="file" name="testimonials_image" id="testimonials_image" class="form-control imagevalidation" placeholder="Choose Testimonials Image" >

                @if ($testimonials->testimonials_image)
                <div>
                    <img src="{{ $testimonials->testimonials_image }}" class="mt-2" alt="Current Team Image" style="border-radius: 10px" width="100" height="100">
                </div>
                 @endif
                @error('testimonials_image')
                    <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label for="testimonials_name" class="mb-2">Clients Name <span style="color: red">*</span></label>
                <input type="text" name="testimonials_name" id="testimonials_name" class="form-control" placeholder="Enter Clients Name" value="{{ old('testimonials_name', $testimonials->testimonials_name) }}">
                @error('testimonials_name')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label for="testimonials_location" class="mb-2">Clients Location <span style="color: red">*</span></label>
                <input type="text" name="testimonials_location" id="testimonials_location" class="form-control" placeholder="Enter Clients Location" value="{{ old('testimonials_location', $testimonials->testimonials_location) }}">
                @error('testimonials_location')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label for="testimonials_review" class="mb-2">Clients Rating <span style="color: red">*</span></label>
                <input type="number" name="testimonials_review" id="testimonials_review" max="5" min="1" class="form-control" placeholder="Enter Clients Rating"  value="{{ old('testimonials_review', $testimonials->testimonials_review) }}">
                @error('testimonials_review')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label for="testimonials_description" class="mb-2">Clients Review <span style="color: red">*</span></label>
                <textarea name="testimonials_description" id="testimonials_description" cols="100" rows="6" class="form-control" placeholder="Enter Clients Review" >{{ old('testimonials_description', $testimonials->testimonials_description) }}</textarea>
                @error('testimonials_name')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">  Update</button>
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
                  alert("Image File size should not exceed 5MB");
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
                  alert("Video File size should not exceed 50MB");
                  $(this).val(''); // Clear the file input field
              }
          }
      });
  });
  </script>
@endpush
