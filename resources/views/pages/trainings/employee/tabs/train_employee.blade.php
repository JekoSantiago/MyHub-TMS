@extends('layouts.main')
@section('content')
{{-- <div id="preloader">
    <div id="status">
        <div class="spinner">Loading...</div>
    </div>
</div> --}}
{{-- hidden forms --}}
<form id="form_train_emp">
    <input type="hidden" name="_token" id="globalToken" value="{{csrf_token()}}" />
    <input type="hidden" id="training_id" value="{{ $training[0]->Training_ID }}">
    <input type="hidden" id="train_emp_status" value="{{ $training[0]->TrainStatus }}">
    <input type="hidden" id="train_emp_ratings" value="{{ $training[0]->Ratings }}">
</form>
<div class="row">
    <div class="col-lg-11">
        <h2 class="text-uppercase bg-light pl-2" id="program_name">{{ $training[0]->Program }}</h2>
        <hr>
        <h2 class="text-uppercase bg-light pl-2" id="training_name">{{ $training[0]->Training }}</h2>
    </div>
    <div class="col-lg-1 pt-4">
        <a href="{{ route('page.training.emp') }}"><button type="button" class="btn btn-outline-secondary">Back</button></a>
    </div>
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="col-xs-6">
           <div class="table-responsive">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Employees</h3>
                    <table id="tbl_train_emp1" class="table table-centered w-100">
                        <thead>
                            <tr>
                                <th>Employee No</th>
                                <th>Name</th>
                                <th width='70px'>Date Hired</th>
                                <th>Position</th>
                                <th>Department</th>
                                <th>Division</th>
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
        <div class="col-xs-6">
           <div class="table-responsive">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-11">
                            <h3>List of Trainees</h3>
                        </div>

                    </div>
                    <table id="tbl_train_emp2" class="table table-centered w-100">
                        <thead>
                            <tr>
                                <th>Employee No</th>
                                <th>Name</th>
                                <th>Date Hired</th>
                                <th>Position</th>
                                <th>Department</th>
                                <th>Division</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    {{-- <div class="text-center">
                        <button type="button" data-toggle="modal" data-target="#modal_list_ratings"  class="btn btn-outline-success">Rate Trainees</button>
                    </div> --}}
                </div>
            </div>
           </div>
        </div>
     </div>

</div>
@include('pages.trainings.employee.modals.ratings')
@endsection
@section('js')
<script src="{{asset('assets/js/custom/trainemp.js')}}"></script>
<script src="{{asset('assets/libs/datatables/datatables.buttons.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables/Jszip.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables/html5export.min.js')}}"></script>
@endsection
