@extends('Admin.master')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>User Create</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin-dashbord')}}">Home</a></li>
                <li class="breadcrumb-item active">User Create</li>
            </ol>
        </nav>
    </div>

    <section>
        <form action="{{route('user-store')}}" method="post">
            @csrf
            <div class="mt-3">
                <label for="name" class="mb-2">User Name <span style="color: red">*</span></label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter User Name" value="{{ old('name') }}">
                @error('name')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label for="email" class="mb-2">User Email <span style="color: red">*</span></label>
                <input type="text" name="email" id="email" class="form-control" placeholder="Enter User Email" value="{{ old('email') }}">
                @error('email')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label for="password" class="mb-2">User Password <span style="color: red">*</span></label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter User Password" value="{{Str::random(10)}}">
                @error('password')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">Add User</button>
        </form>
    </section>
</main>

@endsection
