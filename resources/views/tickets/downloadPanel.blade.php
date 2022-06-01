@extends('layouts.master')
@section('title', 'Ticket Panel')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <p class="text-primary"><i class="fal fa-angle-double-right">&nbsp;</i>Ticket Panel <i class="fal fa-angle-double-right">&nbsp;</i>Report Donwload</p>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-6 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <p class="card-title">Download Tickets </p>
                        </div>
                        <div class="card-body">
                            {!! Form::open(['url' => '/ticket/download', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                                @csrf
                                <div class="form-group {{ $errors->has('start_date') ? 'has-error' : ''}}">
                                        {!! Form::label('start_date', 'Start Date', array('class' => 'font-weight-normal'))!!}
                                    <div class="datepicker date input-group">
                                        {!! Form::text('start_date', null, ['class' => 'form-control','placeholder' => 'Enter Start Date', 'id' =>"datepicker", 'autocomplete' => 'off', 'required' => 'required']) !!}
                                        <div class="input-group-append"><span class="input-group-text px-4"><i class="fas fa-clock text-primary"></i></span></div>
                                        &nbsp;<input type="text" id="alternate" class="form-control">
                                        <span class="text-danger">
                                            {{ $errors->first('start_date') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('end_date') ? 'has-error' : ''}}">
                                    {!! Form::label('end_date', 'End Date', array('class' => 'font-weight-normal'))!!}
                                    <div class="datepicker date input-group">
                                        {!! Form::text('end_date', null, ['class' => 'form-control','placeholder' => 'Enter End Date', 'id' =>"datepicker1", 'autocomplete' => 'off', 'required' => 'required']) !!}
                                        <div class="input-group-append"><span class="input-group-text px-4"><i class="fas fa-clock text-primary"></i></span></div>
                                        &nbsp;<input type="text" id="alternate1" class="form-control">
                                        <span class="text-danger">
                                            {{ $errors->first('end_date') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    {{ Form::label('ticket_type','Ticket Type', array('class' => 'font-weight-normal')) }}
                                    {{ Form::select('type',['NEW'=>'New','WIP'=> 'Wip','ANSWERED'=>'Answered','CLOSED'=>'Closed', 'ALL' => 'All'],null, array('class'=>'form-control', 'placeholder'=>'Please select ...', 'required'=>'required')) }}
                                </div>
                                {{ Form::button('Download &nbsp; <i class="fas fa-download"></i>', ['type' => 'submit', 'class' => 'btn btn-primary', 'value' => 'Download'] )  }}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
     <script type="text/javascript">
       $( function() {
			$( "#datepicker" ).datepicker({ 
                changeMonth: true, 
                changeYear: true, 
                dateFormat: "yy-mm-dd", 
                altField: "#alternate",
                altFormat: "DD, d MM, yy" 
            });
        	$( "#datepicker" ).datepicker( "option", "showAnim", "show","setDate", "0" );
        	$( "#datepicker1" ).datepicker({ 
                changeMonth: true, 
                changeYear: true, 
                dateFormat: "yy-mm-dd",
                altField: "#alternate1",
                altFormat: "DD, d MM, yy"
            });
        	$( "#datepicker1" ).datepicker( "option", "showAnim", "show", "setDate", "0" );
		} );
    </script>
@endsection