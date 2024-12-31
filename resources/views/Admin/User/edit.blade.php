@extends('Admin.master')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>User Edit</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin-dashbord')}}">Home</a></li>
                <li class="breadcrumb-item active">User Edit</li>
            </ol>
        </nav>
    </div>

    <section>
        <form action="{{route('user-update', ['id' => $user->id])}}" method="post">
            @csrf
            <div class="mt-3">
                <label for="name" class="mb-2">User Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter User Name" value="{{$user->name}}">
                @error('name')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label for="email" class="mb-2">User Email</label>
                <input type="text" name="email" id="email" class="form-control" placeholder="Enter User Email" value="{{$user->email}}">
                @error('email')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update User</button>
        </form>
    </section>
</main>

@endsection
