@extends('layouts.master')
@section('title', 'Ticket Panel')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <p class="text-primary"><a class="text-success" href="{{ url()->previous() }}"><i class="fal fa-angle-double-right">&nbsp;</i>Ticket Panel </a><i class="fal fa-angle-double-right">&nbsp;</i> Show Ticket</p>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    <p class="card-title">
                                        Ticket Details
                                    </p>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <p class="card-title text-success">Customer Information</p>
                                                </div>
                                                <div class="card-body h-200px overflow-auto">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <p>
                                                                <i class="fal fa-hashtag text-success"></i>
                                                                <b>
                                                                    CRM Id:
                                                                </b>
                                                                {{ $ticket->crm_id }}
                                                            </p>
                                                        </div>
                                                        <div class="col-12">
                                                            <p>
                                                                <i class="fal fa-hashtag text-success"></i>
                                                                <b>
                                                                    Name:
                                                                </b>
                                                                {{ $ticket->crm->customer_name }}
                                                            </p>
                                                        </div>
                                                        <div class="col-12">
                                                            <p>
                                                                <i class="fal fa-hashtag text-success"></i>
                                                                <b>
                                                                    Phone No:
                                                                </b>
                                                                {{ $ticket->crm->customer_contact }}
                                                            </p>
                                                        </div>
                                                        <div class="col-12">
                                                            <p>
                                                                <i class="fal fa-hashtag text-success"></i>
                                                                <b>
                                                                    Division:
                                                                </b>
                                                                {{ $ticket->crm->district->division->name }}
                                                            </p>
                                                        </div>
                                                        <div class="col-12">
                                                            <p>
                                                                <i class="fal fa-hashtag text-success"></i>
                                                                <b>
                                                                    District:
                                                                </b>
                                                                {{ $ticket->crm->district->name }}
                                                            </p>
                                                        </div>
                                                        <div class="col-12">
                                                            <p>
                                                                <i class="fal fa-hashtag text-success"></i>
                                                                <b>
                                                                    Address:
                                                                </b>
                                                                {{ $ticket->crm->address }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <p class="card-title text-info">Ticket Details</p>
                                                </div>
                                                <div class="card-body h-200px overflow-auto">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <p>
                                                                <i class="fal fa-hashtag text-info"></i>
                                                                <b>
                                                                    Ticket Id:
                                                                </b>
                                                                {{ $ticket->id }}
                                                            </p>
                                                        </div>
                                                        <div class="col-12">
                                                            <p>
                                                                <i class="fal fa-hashtag text-info"></i>
                                                                <b>
                                                                    Ticket Status:
                                                                </b>
                                                                {{ $ticket->status }}
                                                            </p>
                                                        </div>
                                                        <div class="col-12">
                                                            <p>
                                                                <i class="fal fa-hashtag text-info"></i>
                                                                <b>
                                                                    Query Type:
                                                                </b>
                                                                {{ $ticket->crm->query_type->name }}
                                                            </p>
                                                        </div>
                                                        <div class="col-12">
                                                            <p>
                                                                <i class="fal fa-hashtag text-info"></i>
                                                                <b>
                                                                    Department:
                                                                </b>
                                                                {{ $ticket->crm->department->name  ?? '' }}
                                                            </p>
                                                        </div>
                                                        <div class="col-12">
                                                            <p>
                                                                <i class="fal fa-hashtag text-info"></i>
                                                                <b>
                                                                    Customer Query:
                                                                </b>
                                                                {{ $ticket->crm->verbatim }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if(!empty($ticket->ticket_response)){?>
                                        <label>Comments&nbsp; <i class="fas fa-comments text-success"></i></label>
                                        <div class="container-fluid">
                                            @foreach ($ticket->ticket_response as $response)
                                                <div class="row">
                                                    <div class="col-2 col-lg-1">
                                                        <div class="user_avatar">
                                                            <img src="{{ asset('/img/profile.png') }}" class="" alt="User Image">
                                                        </div>
                                                    </div>
                                                    <div class="col-10 col-lg-11">
                                                        <div class="comment_body d-flex align-items-center">
                                                            <p class="m-0">{{ $response->response }}</p>
                                                        </div>

                                                        <!-- comments toolbar -->
                                                        <div class="comment_toolbar">
                                                            <!-- inc. date and time -->
                                                            <div class="comment_details">
                                                                <ul>
                                                                    <li><i class="fa fa-clock text-success mr-1"></i>{{ \Carbon\Carbon::parse($response->created_at)->toTimeString() }}</li>
                                                                    <li><i class="fa fa-calendar text-info mr-1"></i>{{ \Carbon\Carbon::parse($response->created_at)->format('d/m/Y') }}</li>
                                                                    <li><i class="fa fa-pencil text-warning"></i> <span class="user">{{ $response->user->name }}</span></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    <?php } ?>
                                    <?php if( $ticket->status != 'CLOSED'){ ?>

                                        {!! Form::open(['url' => "ticket/$ticket->id", 'method' => 'post', 'class' => 'form-horizontal', 'id'=>'comment-form']) !!}
                                            <div class="form-group {{ $errors->has('comment') ? 'has-error' : ''}}">
                                                {!! Form::label('comment', 'Add Comment')!!}
                                                <textarea class="w-100" name="comment"></textarea>
                                                <!-- <div class="text-area"></div> -->
                                                <span class="text-danger">
                                                    {{ $errors->first('comment') }}
                                                </span>
                                            </div>
                                            {{ Form::button('Update &nbsp; <i class="fas fa-caret-right"></i>', ['type' => 'submit', 'class' => 'btn btn-success float-left','name' => 'action', 'value' => 'Send to next step'] )  }}
                                            {{ Form::button('Close &nbsp; <i class="fas fa-times"></i>', ['type' => 'submit', 'class' => 'btn btn-danger float-right', 'name' => 'action' , 'value' => 'Send to close'] )  }}

                                        {!! Form::close() !!}

                                    <?php } ?>
                                </div>

                            </div>
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
            $('.text-area').summernote();
        } );

        $('#comment-form').on('submit', function(e) {
            if($('.text-area').summernote('isEmpty')) {
                
            }
            else {
                // do action
            }
        });
    </script>
@endsection
