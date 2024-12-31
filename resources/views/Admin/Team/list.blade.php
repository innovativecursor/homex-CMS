@extends('Admin.master')
@section('content')

<style>
    #team-table_wrapper{
        background-color: #fff;
        padding: 20px;
        border-radius: 10px
    }
</style>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Team</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin-dashbord')}}">Home</a></li>
                <li class="breadcrumb-item active">Team</li>
            </ol>
        </nav>
    </div>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <section>
        <div class="d-flex justify-content-end mb-3">
            <a href="{{route('team-add')}}">
                <button type="button" class="btn btn-primary">Add Team Member</button>
            </a>
        </div>

        <div class="mt-3">
            <table id="team-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name </th>
                        <th>Designation</th>
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
        $('#team-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin-team-datable') }}',
            columns: [{
                    data: 'DT_RowIndex'
                    , name: 'DT_RowIndex'
                    , orderable: false
                    , searchable: false
                }
                , {
                    data: 'name'
                    , name: 'name'
                }
                , {
                    data: 'designation'
                    , name: 'designation'
                }
                ,
                {
                    data: 'action'
                    , name: 'action'
                    , orderable: false
                    , searchable: false
                }
            ]
        });
    });

</script>
@endsection
