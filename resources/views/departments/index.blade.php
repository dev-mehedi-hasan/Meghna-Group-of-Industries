@extends('layouts.master')
@section('title', 'Static Content')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <p class="text-primary"><i class="fal fa-angle-double-right">&nbsp;</i>Static Content <i class="fal fa-angle-double-right">&nbsp;</i>Department</p>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <p class="card-title">Department List</p>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="{{route('department.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i>Add New</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $sl = 0 @endphp
                                @foreach($departments as $department)
                                    <tr>
                                        <td>{{ ++$sl }}</td>
                                        <td>{{ $department->name }}</td>
                                        <td>{{ $department->created_at }}</td>
                                        <td>
                                            <form action="{{ route('department.edit',$department->id) }}" method="get" class="mr-3">
                                                <!-- @csrf -->
                                                <button type="submit" class="btn btn-warning btn-sm"><i class="fa fa-pencil-alt"></i></button> 
                                            </form>
                                            <form action="{{ url('/department', ['id' => $department->id]) }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm delete-confirm" data-name="{{ $department->name }}"><i class="fa fa-trash-alt"></i></button> 
                                            </form>
                                        </td>
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
    <script src="{{ asset('/js/sweetalert.min.js') }}"></script>

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