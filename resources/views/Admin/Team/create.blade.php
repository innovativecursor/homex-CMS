@extends('Admin.master')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Team Create</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin-dashbord')}}">Home</a></li>
                <li class="breadcrumb-item active">Team Create</li>
            </ol>
        </nav>
    </div>

    <section>
        <form action="{{route('team-store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mt-3">
                <label for="team_image" class="mb-2">Team Member Image <span style="color: red">*</span></label>
                <input type="file" name="team_image" id="team_image" class="form-control" placeholder="Enter Team Image" value="{{ old('team_image') }}">
                @error('team_image')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label for="name" class="mb-2">Team Member Name <span style="color: red">*</span></label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Team Member Name" value="{{ old('name') }}">
                @error('name')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-3">
                <label for="designation" class="mb-2">Team Member Designation <span style="color: red">*</span></label>
                <input type="text" name="designation" id="designation" class="form-control" placeholder="Team Member Designation" value="{{ old('designation') }}">
                @error('designation')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">Add Team</button>
        </form>
    </section>
</main>

@endsection
