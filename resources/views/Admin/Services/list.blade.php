@extends('Admin.master')
@section('content')

<style>
    #service-table_wrapper{
        background-color: #fff;
        padding: 20px;
        border-radius: 10px
    }
</style>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Service</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin-dashbord')}}">Home</a></li>
                <li class="breadcrumb-item active">Service</li>
            </ol>
        </nav>
    </div>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <section>
        <form action="{{ route('service-updates') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="main_description" class="form-label">Main Description</label>
                <textarea name="main_description" id="main_description" class="form-control" rows="3">{{ old('main_description', $serviceDetail->main_description) }}</textarea>
            </div>
            <button type="submit" class="btn btn-success mb-3">Save Description</button>
        </form>
        <div class="d-flex justify-content-end mb-3">
            <a href="{{route('service-add')}}">
                <button type="button" class="btn btn-primary">Add Service</button>
            </a>
        </div>

        <div class="mt-3">
            <table id="service-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Title</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </section>
</main>

@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#service-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin-service-datable') }}',
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'description',
                    name: 'description',
                    render: function(data, type, row) {
                        // Show only the first 50 characters of description
                        return data.length > 120 ? data.substr(0, 120) + '...' : data;
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });
</script>

@endsection
