@extends('Admin.master')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>About </h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin-dashbord')}}">Home</a></li>
                <li class="breadcrumb-item active">About Create</li>
            </ol>
        </nav>
    </div>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <section>
        <form action="{{route('about-store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mt-3">
                <label for="about_image1" class="mb-2">About Image 1 <span style="color: red">*</span></label>
                <input type="file" name="about_image1" id="about_image1" class="form-control imagevalidation" placeholder="Enter About 1 Image">

                <!-- Show current image if it exists -->
                @if ($about->about_image1)
                    <div class="mt-2">
                        <img src="{{ $about->about_image1 }}" alt="Current About Image 1" style="max-width: 200px;">
                    </div>
                @endif

                @error('about_image1')
                    <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-3">
                <label for="about_image2" class="mb-2">About Image 2 <span style="color: red">*</span></label>
                <input type="file" name="about_image2" id="about_image2" class="form-control imagevalidation" placeholder="Enter About 2 Image">

                <!-- Show current image if it exists -->
                @if ($about->about_image2)
                    <div class="mt-2">
                        <img src="{{ $about->about_image2 }}" alt="Current About Image 2" style="max-width: 200px;">
                    </div>
                @else
                    <!-- Fallback image if about_image2 doesn't exist -->
                    <div class="mt-2">
                        <img src="path/to/your/default-image.jpg" alt="Default About Image 2" style="max-width: 200px;">
                    </div>
                @endif

                @error('about_image2')
                    <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>



            <div class="mt-3">
                <label for="about_title" class="mb-2">About Title <span style="color: red">*</span></label>
                <input type="text" name="about_title" id="about_title" class="form-control" placeholder="Enter About Title" value="{{ old('about_title', $about->about_title ?? '') }}">
                @error('about_title')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label for="description" class="mb-2">Description <span style="color: red">*</span></label>
                <textarea name="description" id="description" class="form-control" placeholder="Enter Description" cols="30" rows="5">{{ old('description', $about->description ?? '') }}</textarea>
                @error('description')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-3">
                <label for="subdescription" class="mb-2">Sub Description <span style="color: red">*</span></label>
                <textarea name="subdescription" id="subdescription" class="form-control" placeholder="Enter Sub Description" cols="30" rows="5">{{ old('subdescription', $about->subdescription ?? '') }}</textarea>

                @error('subdescription')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label for="our_values1" class="mb-2">Our Values 1 <span style="color: red">*</span></label>
                <input type="text" name="our_values1" id="our_values1" class="form-control" placeholder="Enter Our Values 1" value="{{ old('our_values1', $about->our_values1 ?? '') }}">
                @error('our_values1')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label for="our_values2" class="mb-2">Our Values 2 <span style="color: red">*</span></label>
                <input type="text" name="our_values2" id="our_values2" class="form-control" placeholder="Enter Our Values 2" value="{{ old('our_values2', $about->our_values2 ?? '') }}">
                @error('our_values2')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label for="our_values3" class="mb-2">Our Values 3 <span style="color: red">*</span></label>
                <input type="text" name="our_values3" id="our_values3" class="form-control" placeholder="Enter Our Values 3" value="{{ old('our_values3', $about->our_values3 ?? '') }}">
                @error('our_values3')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label for="our_values4" class="mb-2">Our Values 4 <span style="color: red">*</span></label>
                <input type="text" name="our_values4" id="our_values2" class="form-control" placeholder="Enter Our Values 4" value="{{ old('our_values4', $about->our_values4 ?? '') }}">
                @error('our_values4')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-3">Save</button>
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
