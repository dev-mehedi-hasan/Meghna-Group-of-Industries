@extends('layouts.master')
@section('title', 'Ticketing Matrix')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <p class="text-primary"><i class="fal fa-angle-double-right">&nbsp;</i>Ticketing Matrix <a class="text-success" href="{{ url()->previous() }}"><i class="fal fa-angle-double-right">&nbsp;</i>Common Mail CCs</a> <i class="fal fa-angle-double-right">&nbsp;</i>Edit</p>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-6 mx-auto">
            <div class="card">
                <div class="card-header">
                    <p class="card-title">Edit Common Mail CC</p>
                </div>
                <div class="card-body">
                    @include('common_mail_cc._form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
