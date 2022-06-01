@extends('layouts.master')
@section('title', 'Ticketing Matrix')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <p class="text-primary"><i class="fal fa-angle-double-right">&nbsp;</i>Ticketing Matrix <i class="fal fa-angle-double-right">&nbsp;</i>Escalation Level</p>
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
                            <div class="col-6">
                                <p class="card-title">Escalation Level List</p>
                            </div>
                            <div class="col-6 text-right">
                                <a href="{{ route('escalation-levels.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>Add New</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="example" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Days</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php $sl = 0 @endphp
                            @foreach($escalation_levels as $escalation_level)
                                <tr>
                                    <td>{{ ++$sl }}</td>
                                    <td>{{ $escalation_level->name }}</td>
                                    <td>{{ $escalation_level->days }}</td>
                                    <td>
                                        <form action="{{ route('escalation-levels.edit', $escalation_level->id) }}" method="get" class="mr-2">
                                            <!-- @csrf -->
                                            <button type="submit" class="btn btn-warning btn-sm"><i class="fa fa-pencil-alt"></i></button>
                                        </form>
                                        <form action="{{ url('/escalation-levels', ['id' => $escalation_level->id]) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm delete-confirm" data-name="{{ $escalation_level->name }}"><i class="fa fa-trash-alt"></i></button>
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
