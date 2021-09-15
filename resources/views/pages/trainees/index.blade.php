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
                        <li class="breadcrumb-item active">Trainees</li>
                    </ol>
                </div>
                <h4 class="page-title">Trainees</h4>
            </div>
        </div>
    </div>
    <input type="hidden" name="_token" id="globalToken" value="{{csrf_token()}}" />
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <div class="d-flex flex-wrap justify-content-between">
                                <div class="text-sm-left">
                                </div>
                                <div class="text-sm-right">
                                    <button type="button" class="btn btn-danger waves-effect waves-light mb-2 mr-1" data-toggle="modal" data-target="#modal_filter_applicants"><i class="mdi mdi-filter-menu"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table id="tbl_trainees" class="table table-centered w-100 nowrap">
                        <thead>
                            <tr>
                                <th>Position</th>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Gender</th>
                                <th width='70px'>Birth Date</th>
                                <th>Home Address</th>
                                <th>Municipal</th>
                                <th>Province</th>
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
@include('pages.trainees.modals.filter')
@endsection
@section('js')
<script src="{{asset('assets/js/custom/trainees.js')}}"></script>
@endsection
