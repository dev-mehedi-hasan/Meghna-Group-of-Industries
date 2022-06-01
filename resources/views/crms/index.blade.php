@extends('layouts.master')
@section('title', 'Crm Panel')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <p class="text-primary"><i class="fal fa-angle-double-right">&nbsp;</i>Crm Panel <i class="fal fa-angle-double-right">&nbsp;</i>CRM</p>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <p class="card-title">CRM List</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>CRM ID</th>
                                        <th>Customer Name</th>
                                        <th>Customer Contact</th>
                                        <th>Division</th>
                                        <th>District</th>
                                        <th>Address</th>
                                        <th>Query</th>
                                        <th>Complain</th>
                                        <th>Verbatim</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($crms as $crm)
                                
                                    <tr>
                                        <td>{{ $crm->id }}</td>
                                        <td>{{ $crm->customer_name }}</td>
                                        <td>{{ $crm->customer_contact }}</td>
                                        <td>{{ $crm->district->name }}</td>
                                        <td>{{ $crm->district->division->name }}</td>
                                        <td>{{ $crm->address }}</td>
                                        <td>{{ $crm->query_type->name }}</td>
                                        <td>{{ $crm->complain_type->name }}</td>
                                        <td>{{ $crm->verbatim }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "ordering": true,
                "info": true,
                "responsive": true,
                "autoWidth": false,
            });
        } );

        $('.delete-confirm').click(function(event) {
            var form =  $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: `Are you sure you want to delete ${name}?`,
                text: "If you delete this, it will be gone forever.",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                form.submit();
                }
            });
        });
    </script>
@endsection