@extends('Admin.master')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Achievements </h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin-dashbord')}}">Home</a></li>
                <li class="breadcrumb-item active">Achievements Create</li>
            </ol>
        </nav>
    </div>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <section>
        <form action="{{route('achievements-store')}}" method="post" >
            @csrf

            <div class="mt-3">
                <label for="description" class="mb-2">Description <span style="color: red">*</span></label>
                <textarea name="description" id="description" class="form-control" placeholder="Enter Description" cols="30" rows="5">{{ old('description', $achievements->description ?? '') }}</textarea>
                @error('description')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- <div class="mt-3">
                <label for="satisfied_clients" class="mb-2">Satisfied Clients <span style="color: red">*</span></label>
                <input type="number" min="0"  name="satisfied_clients" id="satisfied_clients" class="form-control" placeholder="Enter Satisfied Clients" value="{{ old('satisfied_clients', $about->satisfied_clients ?? '') }}">
                @error('satisfied_clients')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label for="compelete_projects" class="mb-2">Compelete Projects <span style="color: red">*</span></label>
                <input type="number" min="0" name="compelete_projects" id="compelete_projects" class="form-control" placeholder="Enter Compelete Projects" value="{{ old('compelete_projects', $about->compelete_projects ?? '') }}">
                @error('compelete_projects')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label for="industury_expertise" class="mb-2">Industury Expertise <span style="color: red">*</span></label>
                <input type="number" min="0" name="industury_expertise" id="industury_expertise" class="form-control" placeholder="Enter Industury Expertise" value="{{ old('industury_expertise', $about->industury_expertise ?? '') }}">
                @error('industury_expertise')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div> --}}
            <div class="mt-3">
                <label for="label1" class="mb-2">Label 1<span style="color: red">*</span></label>
                <input type="text"  name="label1" id="label1" class="form-control" placeholder="Enter Label 1" value="{{ old('label1', $achievements->label1 ?? '') }}">
                @error('label1')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label for="counter1" class="mb-2">Counter 1<span style="color: red">*</span></label>
                <input type="number" min="0" name="counter1" id="counter1" class="form-control" placeholder="Enter Counter 1 " value="{{ old('counter1', $achievements->counter1 ?? '') }}">
                @error('counter1')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label for="label2" class="mb-2">Label 2<span style="color: red">*</span></label>
                <input type="text"  name="label2" id="label2" class="form-control" placeholder="Enter Label 2" value="{{ old('label2', $achievements->label2 ?? '') }}">
                @error('label2')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label for="counter2" class="mb-2">Counter 2<span style="color: red">*</span></label>
                <input type="number" min="0" name="counter2" id="counter2" class="form-control" placeholder="Enter Counter 2 " value="{{ old('counter2', $achievements->counter2 ?? '') }}">
                @error('counter2')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label for="label3" class="mb-2">Label 3<span style="color: red">*</span></label>
                <input type="text"  name="label3" id="label3" class="form-control" placeholder="Enter Label 3" value="{{ old('label3', $achievements->label3 ?? '') }}">
                @error('label3')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label for="counter3" class="mb-2">Counter 3<span style="color: red">*</span></label>
                <input type="number" min="0" name="counter3" id="counter3" class="form-control" placeholder="Enter Counter 3 " value="{{ old('counter3', $achievements->counter3 ?? '') }}">
                @error('counter3')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">Save</button>
        </form>
    </section>
</main>

@endsection
