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
        <form action="{{route('project-update', ['id' => $project->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mt-3">
                <label for="project_video" class="mb-2">Project Video</label>
                <input type="file" name="project_video" id="project_video" class="form-control" accept="video/*">

                @if ($project->project_video)
                    <div class="mt-2">
                        <video width="250" height="250" controls >
                            <source src="{{ $project->project_video }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                @endif

                @error('project_video')
                    <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label for="project_image" class="mb-2">Project Image</label>

                <!-- Show the current image if it exists -->


                <!-- Allow the user to upload a new image -->
                <input type="file" name="project_image" id="project_image" class="form-control" placeholder="Choose Project Image" >

                @if ($project->project_image)
                <div>
                    <img src="{{ $project->project_image }}" class="mt-2" alt="Current Project Image" style="border-radius: 10px" width="100" height="100">
                </div>
                 @endif
                @error('project_image')
                    <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-3">
                <label for="title" class="mb-2">Title<span style="color: red">*</span></label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title" value="{{ old('project', $project->title) }}">
                @error('title')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label for="description" class="mb-2">Description <span style="color: red">*</span></label>
                <textarea name="description" id="description" cols="100" rows="6" class="form-control" placeholder="Enter Description">{{ old('description', $project->description) }}</textarea>
                @error('description')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label for="loction" class="mb-2">Loction<span style="color: red">*</span></label>
                <input type="text" name="loction" id="loction"  class="form-control" loction="Enter Loction" value="{{ old('project', $project->loction) }}">
                @error('Loction')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label for="features" class="mb-2">Key Features<span style="color: red">*</span></label>
                <input type="text" name="features" id="features" class="form-control" placeholder="Enter Key Features" value="{{ old('project', $project->features) }}">
                @error('features')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label for="exuctiontime" class="mb-2">Exuction Time <span style="color: red">*</span></label>
                <input type="text" name="exuctiontime" id="exuctiontime" class="form-control" placeholder="Enter Exuction Time" value="{{ old('project', $project->exuctiontime) }}">
                @error('exuctiontime')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label for="turnover" class="mb-2">Turn Over<span style="color: red">*</span></label>
                <input type="text" name="turnover" id="turnover" class="form-control" placeholder="Enter Turn Over" value="{{ old('project', $project->turnover) }}">
                @error('turnover')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update</button>
        </form>
    </section>
</main>

@endsection
