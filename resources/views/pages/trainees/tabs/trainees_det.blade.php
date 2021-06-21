@extends('layouts.main')
@section('content')
{{-- <div id="preloader">
    <div id="status">
        <div class="spinner">Loading...</div>
    </div>
</div> --}}
<div class="row">
    <div class="col-lg-11">
        <h2 class="mb-3 text-uppercase bg-light p-2">{{ $applicant[0]->LastName .", ". $applicant[0]->FirstName . " " . $applicant[0]->Middlename}}</h2>
    </div>
    <div class="col-lg-1 pt-4">
        <a href="{{ route('page.trainees') }}"><button type="button" class="btn btn-outline-secondary">Back</button></a>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3">
            <form id="form_app_det">
             <input type="hidden" name="_token" id="globalToken" value="{{csrf_token()}}" />
            <input type="hidden" id="app_det_id" value="{{ $applicant[0]->Applicant_ID }}">
            </form>
            <div class="col-lg-11">
                <label for="applicant_position">Position</label>
                <input id="applicant_position" name="applicant_position" type="text" class="form-control" value="{{ $applicant[0]->Position}}" disabled>
            </div>
            <div class="col-lg-11">
                <label for="applicant_lastname">Last Name</label>
                <input id="applicant_lastname" name="applicant_lastname" type="text" class="form-control" value="{{ $applicant[0]->LastName}}" disabled>
            </div>

            <div class="col-lg-11">
                <label for="applicant_firstname">First Name</label>
                <input id="applicant_firstname" name="applicant_firstname" type="text" class="form-control" value="{{ $applicant[0]->FirstName}}" disabled>
            </div>

             <div class="col-lg-11">
                <label for="applicant_middlename">Middle Name</label>
                <input id="applicant_middlename" name="applicant_middlename" type="text" class="form-control" value="{{ $applicant[0]->Middlename}}" disabled>
            </div>

            <div class="col-lg-11">
                <label for="applicant_gender">Gender</label>
                <input id="applicant_gender" name="applicant_gender" type="text" class="form-control" value="{{ $applicant[0]->Gender}}" disabled>
            </div>

            <div class="col-lg-11">
                <label for="applicant_bday">Birth Date</label>
                <input id="applicant_bday" name="applicant_bday" type="text" class="form-control" value="{{ $applicant[0]->Birthdate}}" disabled>
            </div>

            <div class="col-lg-11">
                <label for="applicant_address">Home Address</label>
                <input id="applicant_address" name="applicant_address" type="text" class="form-control" value="{{ $applicant[0]->HomeAdd}}" disabled>
            </div>

            <div class="col-lg-11">
                <label for="applicant_municipal">Municipal</label>
                <input id="applicant_municipal" name="applicant_municipal" type="text" class="form-control" value="{{ $applicant[0]->Municipal}}" disabled>
            </div>

            <div class="col-lg-11">
                <label for="applicant_province">Province</label>
                <input id="applicant_province" name="applicant_province" type="text" class="form-control" value="{{ $applicant[0]->Province}}" disabled>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="tbl_app_det" class="table table-centered w-100 nowrap">
                                <thead>
                                    <tr>
                                        <th>Program</th>
                                        <th>Training</th>
                                        <th width='15px'>No of Hrs</th>
                                        <th width='70px'>Date</th>
                                        <th>Location</th>
                                        <th>Status</th>
                                        <th>Ratings</th>
                                        <th>Remarks</th>
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
    </div>
</div>


@endsection
@section('js')
<script src="{{asset('assets/js/custom/traineesdet.js')}}"></script>
@endsection
