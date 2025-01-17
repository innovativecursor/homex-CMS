@extends('Admin.master')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Team Edit</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin-dashbord')}}">Home</a></li>
                <li class="breadcrumb-item active">Team Edit</li>
            </ol>
        </nav>
    </div>

    <section>
        <form action="{{route('team-update', ['id' => $team->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mt-3">
                <label for="name" class="mb-2">Team Member Name <span style="color: red">*</span></label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Team Member Name" value="{{ old('name', $team->name) }}">
                @error('name')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label for="designation" class="mb-2">Team Member Designation <span style="color: red">*</span></label>
                <input type="text" name="designation" id="designation" class="form-control" placeholder="Team Member Designation" value="{{ old('designation', $team->designation) }}">
                @error('designation')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label for="team_image" class="mb-2">Team Member Image</label>

                <!-- Show the current image if it exists -->


                <!-- Allow the user to upload a new image -->
                <input type="file" name="team_image" id="team_image" class="form-control imagevalidation" placeholder="Choose Team Image" >

                @if ($team->team_image)
                <div>
                    <img src="{{ $team->team_image }}" class="mt-2" alt="Current Team Image" style="border-radius: 10px" width="100" height="100">
                </div>
                 @endif
                @error('team_image')
                    <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update</button>
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
