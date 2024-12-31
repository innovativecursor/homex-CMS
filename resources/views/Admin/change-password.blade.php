@extends('Admin.master')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Change Password</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin-dashbord') }}">Home</a></li>
                <li class="breadcrumb-item active">Change Password</li>
            </ol>
        </nav>
    </div>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <section>
        <!-- Password Change Form -->
        <form action="{{ route('change-password.update') }}" method="post">
            @csrf
            <div class="mt-3">
                <label for="current_password" class="mb-2">Current Password <span style="color: red">*</span></label>
                <input type="password" name="current_password" id="current_password" class="form-control" placeholder="Enter Current Password" required>
                @error('current_password')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-3">
                <label for="new_password" class="mb-2">New Password <span style="color: red">*</span></label>
                <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Enter New Password" required>
                @error('new_password')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-3">
                <label for="new_password_confirmation" class="mb-2">Confirm New Password <span style="color: red">*</span></label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" placeholder="Confirm New Password" required>
                @error('new_password_confirmation')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-3">Change Password</button>
        </form>
    </section>

</main>

@endsection
