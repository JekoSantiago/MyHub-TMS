@extends('layouts.main')
@section('content')
{{-- <div id="preloader">
    <div id="status">
        <div class="spinner">Loading...</div>
    </div>
</div> --}}
<div class="row">
    <div class="col-lg-11">
        <h2 class="mb-3 text-uppercase bg-light p-2">{{ $employee[0]->Fullname }}</h2>
    </div>
    <div class="col-lg-1 pt-4">
        <a href="{{ route('page.employees') }}"><button type="button" class="btn btn-outline-secondary">Back</button></a>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3">
            <form id="form_emp_det">
             <input type="hidden" name="_token" id="globalToken" value="{{csrf_token()}}" />
            <input type="hidden" id="emp_det_id" value="{{ $employee[0]->Employee_ID }}">
            </form>
            <div class="col-lg-11">
                <label for="employee_no">Employee No.</label>
                <input id="employee_no" name="employee_no" type="text" class="form-control" value="{{ $employee[0]->EmployeeNo}}" disabled>
            </div>
            <div class="col-lg-11">
                <label for="employee_name">Name</label>
                <input id="employee_name" name="employee_name" type="text" class="form-control" value="{{ $employee[0]->Fullname}}" disabled>
            </div>

            <div class="col-lg-11">
                <label for="employee_gender">Gender</label>
                <input id="employee_gender" name="employee_gender" type="text" class="form-control" value="{{ $employee[0]->Gender}}" disabled>
            </div>

            <div class="col-lg-11">
                <label for="employee_datehired">Date Hired</label>
                <input id="employee_datehired" name="employee_datehired" type="text" class="form-control" value="{{ $employee[0]->DateHired}}" disabled>
            </div>

            <div class="col-lg-11">
                <label for="employee_position">Position</label>
                <input id="employee_position" name="employee_position" type="text" class="form-control" value="{{ $employee[0]->Position}}" disabled>
            </div>

            <div class="col-lg-11">
                <label for="employee_dept">Department</label>
                <input id="employee_dept" name="employee_dept" type="text" class="form-control" value="{{ $employee[0]->Department}}" disabled>
            </div>

            <div class="col-lg-11">
                <label for="employee_div">Division</label>
                <input id="employee_div" name="employee_div" type="text" class="form-control" value="{{ $employee[0]->Division}}" disabled>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="tbl_emp_det" class="table table-centered w-100">
                                <thead>
                                    <tr>
                                        <th>Program</th>
                                        <th>Training</th>
                                        <th>No of Hrs</th>
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
<script src="{{asset('assets/js/custom/empdet.js')}}"></script>
@endsection
