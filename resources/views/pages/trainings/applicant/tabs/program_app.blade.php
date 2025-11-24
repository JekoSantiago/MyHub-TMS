@extends('layouts.main')
@section('content')

{{-- <div id="preloader">
    <div id="status">
        <div class="spinner">Loading...</div>
    </div>
</div> --}}
<div class="row">
    <div class="col-lg-11 pt-2 pl-4">
        <h2 class="page-title" id="program-title">{{ $datas[0]->Program }}</h2>
    </div>
    <div class="col-lg-1 pt-2">
        <a href="{{ route('page.training.app') }}"><button type="button" class="btn btn-outline-secondary">Back</button></a>
    </div>
</div>
<div class="row">
    <div class="col-lg-3 pt-2 pl-4">
        <h5>Total Applicant : {{ $count[0]->total }}</h5>
    </div>
    <div class="col-lg-3 pt-2 pl-2">
        <h5 class = "text-blue" >Have Recommendation : <span id="HaveRec"> {{ $HaveR }}</span></h5>
    </div>
    <div class="col-lg-3 pt-2 pl-2">
        <h5 class = "text-danger">For Recommendation : <span id="ForRec"> {{ $countN[0]->total }} </span></h5>
    </div>
</div>

<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Training Monitoring System</a></li>
                        <li class="breadcrumb-item active">Program Applicants</li>
                    </ol>
                </div>

            </div>
        </div>

    </div>

    <div>
        <input type="hidden" id="program_id" value="{{ $datas[0]->Program_ID }}">
    </div>

    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <div class="d-flex flex-wrap justify-content-between">
                            <div class="text-sm-left">
                            </div>
                        </div>
                    </div>
                </div>
                <table id="tbl_app_prog" class="table table-centered w-100 tbl_training nowrap" >
                    <thead>
                        <tr>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Position</th>
                            <th>Gender</th>
                            <th width='70px'>Birth Date</th>
                            <th>Home Address</th>
                            <th>Municipal</th>
                            <th>Province</th>
                            <th>Ave Ratings</th>
                            <th>Status</th>
                            <th>Recommendations</th>
                            <th>Remarks</th>
                            <th width='70px'>Insert Date</th>
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
@include('pages.trainings.applicant.modals.recom')
@endsection
@section('js')
<script src="{{asset('assets/js/custom/trainapp.js')}}"></script>
<script src="{{asset('assets/libs/datatables/datatables.buttons.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables/Jszip.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables/html5export.min.js')}}"></script>
@endsection
