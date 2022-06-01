@extends('layouts.master')
@section('title', 'Static Content')
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <p class="text-primary"><i class="fal fa-angle-double-right">&nbsp;</i>Static Content <a class="text-success" href="{{ url()->previous() }}"><i class="fal fa-angle-double-right">&nbsp;</i>Divisions</a> <i class="fal fa-angle-double-right">&nbsp;</i>Edit</p>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-6 mx-auto">
            <div class="card">
                <div class="card-header">
                    <p class="card-title">Edit Division</p>
                </div>
                <div class="card-body">
                    @include('divisions._form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection