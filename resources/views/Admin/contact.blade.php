@extends('Admin.master')
@section('content')

<style>
    #contact-table_wrapper{
        background-color: #fff;
        padding: 20px;
        border-radius: 10px
    }
</style>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Contact</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin-dashbord')}}">Home</a></li>
                <li class="breadcrumb-item active">Contact</li>
            </ol>
        </nav>
    </div>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <section>


        <div class="mt-3">
            <table id="contact-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th> Name </th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Subject </th>
                        <th>Message</th>
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
        $('#contact-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin-contact-datable') }}',
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
                    data: 'phone'
                    , name: 'phone'
                }
                ,
                {
                    data: 'email'
                    , name: 'email'
                }
                ,
                {
                    data: 'message'
                    , name: 'message'
                },
                {
                    data: 'subject'
                    , name: 'subject'
                },
                {
                    data: 'action', name: 'action', orderable: false, searchable: false
                }

            ]
        });
    });

</script>
@endsection
