@extends('layouts.master')
@section('title', 'Ticket Panel')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <p class="text-primary"><i class="fal fa-angle-double-right">&nbsp;</i>Ticket Panel <i class="fal fa-angle-double-right">&nbsp;</i> {{ ucfirst($status_for_display) }}</p>
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
                            <p class="card-title">
                                Ticket List
                            </p>
                        </div>
                        <div class="card-body">
                            <table id="example" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>TicketID</th>
                                        <th>Agent Name</th>
                                        <th>Customer Name</th>
                                        <th>Customer Contact</th>
                                        <th>Address</th>
                                        <th>Query Type</th>
                                        <th>Complain Type</th>
                                        <th>Verbatim</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($tickets as $ticket)
                                    <tr>
                                        <td>{{ $ticket->id }}</td>
                                        <td>{{ $ticket->crm->agent_name }}</td>
                                        <td>{{ $ticket->crm->customer_name }}</td>
                                        <td>{{ $ticket->crm->customer_contact }}</td>
                                        <td>{{ $ticket->crm->address }}</td>
                                        <td>{{ $ticket->crm->query_type->name }}</td>
                                        <td>{{ $ticket->crm->complain_type->name }}</td>
                                        <td>{{ Illuminate\Support\Str::limit($ticket->crm->verbatim, 30) }}</td>
                                        <td>
                                            <form action="{{ route('ticket.show', $ticket->id) }}" method="get" class="d-flex align-items-center">
                                                <button type="submit" class="btn btn-info btn-sm text-white"><i class="fas fa-eye"></i></button>
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
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "ordering": true,
                "info": true,
                "responsive": true,
                "autoWidth": false,
            });
        } );
    </script>
@endsection
