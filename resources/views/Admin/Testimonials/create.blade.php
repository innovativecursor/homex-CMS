@extends('Admin.master')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Clients Create</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin-dashbord')}}">Home</a></li>
                <li class="breadcrumb-item active">Clients Create</li>
            </ol>
        </nav>
    </div>

    <section>
        <form action="{{route('testimonials-store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mt-3">
                <label for="testimonials_image" class="mb-2">Clients Image <span style="color: red">*</span></label>
                <input type="file" name="testimonials_image" id="testimonials_image" class="form-control" placeholder="Enter Clients Image" value="{{ old('testimonials_image') }}">
                @error('testimonials_image')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label for="testimonials_name" class="mb-2">Clients Name <span style="color: red">*</span></label>
                <input type="text" name="testimonials_name" id="testimonials_name" class="form-control" placeholder="Enter Clients Name" value="{{ old('testimonials_name') }}">
                @error('testimonials_name')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label for="testimonials_location" class="mb-2">Clients Location <span style="color: red">*</span></label>
                <input type="text" name="testimonials_location" id="testimonials_location" class="form-control" placeholder="Enter Clients Location" value="{{ old('testimonials_location') }}">
                @error('testimonials_location')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label for="testimonials_review" class="mb-2">Clients Rating <span style="color: red">*</span></label>
                <input type="number" name="testimonials_review" id="testimonials_review" max="5" min="1" class="form-control" placeholder="Enter Clients Rating" value="{{ old('testimonials_review') }}">
                @error('testimonials_review')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label for="testimonials_description" class="mb-2">Clients Review <span style="color: red">*</span></label>
                <textarea name="testimonials_description" id="testimonials_description" cols="100" rows="6" class="form-control" placeholder="Enter Clients Review" value="{{ old('testimonials_description') }}"></textarea>
                @error('testimonials_name')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">Add Clients</button>
        </form>
    </section>
</main>

@endsection
