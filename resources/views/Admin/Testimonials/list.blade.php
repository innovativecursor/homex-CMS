@extends('Admin.master')
@section('content')

<style>
    #testimonials-table_wrapper{
        background-color: #fff;
        padding: 20px;
        border-radius: 10px
    }
</style>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Testimonials</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin-dashbord')}}">Home</a></li>
                <li class="breadcrumb-item active">Testimonials</li>
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
            <a href="{{route('testimonials-add')}}">
                <button type="button" class="btn btn-primary">Add Testimonials</button>
            </a>
        </div>

        <div class="mt-3">
            <table id="testimonials-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Testimonials Name </th>
                        <th>Testimonials Location</th>
                        <th>Testimonials Rating</th>
                        <th>Testimonials Review </th>
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
        $('#testimonials-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin-testimonials-datable') }}',
            columns: [{
                    data: 'DT_RowIndex'
                    , name: 'DT_RowIndex'
                    , orderable: false
                    , searchable: false
                }
                , {
                    data: 'testimonials_name'
                    , name: 'testimonials_name'
                }
                , {
                    data: 'testimonials_location'
                    , name: 'testimonials_location'
                }
                ,
                {
                    data: 'testimonials_review'
                    , name: 'testimonials_review'
                }
                ,
                {
                    data: 'testimonials_description'
                    , name: 'testimonials_description'
                }
                , {
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
