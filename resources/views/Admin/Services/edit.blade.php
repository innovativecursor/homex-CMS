@extends('Admin.master')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Service Edit</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin-dashbord')}}">Home</a></li>
                <li class="breadcrumb-item active">Service Edit</li>
            </ol>
        </nav>
    </div>

    <section>
        <form action="{{route('service-update', ['id' => $service->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mt-3">
                <label for="service_image" class="mb-2">Service Image</label>

                <!-- Show the current image if it exists -->


                <!-- Allow the user to upload a new image -->
                <input type="file" name="service_image" id="service_image" class="form-control" placeholder="Choose Service Image" >

                @if ($service->service_image)
                <div>
                    <img src="{{ $service->service_image }}" class="mt-2" alt="Current Service Image" style="border-radius: 10px" width="100" height="100">
                </div>
                 @endif
                @error('service_image')
                    <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label for="description" class="mb-2">Description <span style="color: red">*</span></label>
                <textarea name="description" id="description" cols="100" rows="6" class="form-control" placeholder="Enter Description">{{ old('description', $service->description) }}</textarea>
                @error('description')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-3">Add Service</button>
        </form>
    </section>
</main>

@endsection
