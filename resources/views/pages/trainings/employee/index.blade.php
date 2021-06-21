@extends('layouts.main')
@section('content')

{{-- <div id="preloader">
    <div id="status">
        <div class="spinner">Loading...</div>
    </div>
</div> --}}

<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Training Monitoring System</a></li>
                        <li class="breadcrumb-item active">Employee Trainings</li>
                    </ol>
                </div>
                <h4 class="page-title">Employee Trainings</h4>
            </div>
        </div>
    </div>

    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <div class="d-flex flex-wrap justify-content-between">
                            <div class="text-sm-left">
                                <button type="button" data-toggle="modal" data-target="#modal_new_training" class="btn btn-danger waves-effect waves-light mb-2 mr-1"><i class="mdi mdi-plus-circle mr-1"></i>Create a new Training</button>
                            </div>
                        </div>
                    </div>
                </div>
                <table id="tbl_trainings_emp" class="table table-centered w-100 tbl_training">
                    <thead>
                        <tr>
                            <th width='160px'>Program</th>
                            <th>Training</th>
                            <th width='70px'>Date</th>
                            <th>Location</th>
                            <th width="60px">Capacity</th>
                            <th width="60px">No. of Hours</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</div>
@include('pages.trainings.modals.new_training')
@include('pages.trainings.modals.edit_training')
@endsection
@section('js')
<script src="{{asset('assets/js/custom/trainings.js')}}"></script>
<script src="{{asset('assets/js/custom/trainingedit.js')}}"></script>

@endsection
