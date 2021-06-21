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
                        <li class="breadcrumb-item active">Employees</li>
                    </ol>
                </div>
                <h4 class="page-title">Employees</h4>
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
                            </div>
                        </div>
                    </div>
                    <table id="tbl_employees" class="table table-centered w-100 nowrap">
                        <thead>
                            <tr>
                                <th>Employee No</th>
                                <th>Name</th>
                                <th width='70px'>Date Hired</th>
                                <th>Position</th>
                                <th>Department</th>
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
@endsection
@section('js')
<script src="{{asset('assets/js/custom/employees.js')}}"></script>
@endsection
