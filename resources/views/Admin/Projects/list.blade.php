@extends('Admin.master')
@section('content')

<style>
    #project-table_wrapper{
        background-color: #fff;
        padding: 20px;
        border-radius: 10px
    }
</style>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Project</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin-dashbord')}}">Home</a></li>
                <li class="breadcrumb-item active">Project</li>
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
            <a href="{{route('project-add')}}">
                <button type="button" class="btn btn-primary">Add Project</button>
            </a>
        </div>

        <div class="mt-3">
            <table id="project-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Loction</th>
                        <th>Key Features</th>
                        <th>Exuction Time</th>
                        <th>Turn Over </th>
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
        $('#project-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin-project-datable') }}',
            columns: [{
                    data: 'DT_RowIndex'
                    , name: 'DT_RowIndex'
                    , orderable: false
                    , searchable: false
                }
                , {
                    data: 'title'
                    , name: 'title'
                }
                , {
                    data: 'description'
                    , name: 'description'
                }
                ,
                {
                    data: 'loction'
                    , name: 'loction'
                }
                ,
                {
                    data: 'features'
                    , name: 'features'
                }
                ,   {
                    data: 'exuctiontime'
                    , name: 'exuctiontime'
                }
                ,  {
                    data: 'turnover'
                    , name: 'turnover'
                }
                ,{
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
