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
    <input type="hidden" id="program_id" value="{{ $training[0]->Parent_Program_ID }}">
</form>
<div class="row">
    <div class="col-lg-11">
        <h2 class="text-uppercase bg-light pl-2" id="program_name">{{ $training[0]->Program }}</h2>
        <hr>
        <h2 class="text-uppercase bg-light pl-2" id="training_name">{{ $training[0]->Training }}</h2>
    </div>
    <div class="col-lg-1 pt-4">
        <a href="{{ route('page.training.app') }}"><button type="button" class="btn btn-outline-secondary">Back</button></a>
    </div>
</div>
<div class="container-fluid">
        <div class="col-xs-6">
           <div class="table-responsive">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">List of Trainees</h3>
                    <table id="tbl_train_app" class="table table-centered w-100 nowrap">
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
@include('pages.trainings.applicant.modals.ratings')
@endsection
@section('js')
<script src="{{asset('assets/js/custom/trainapp.js')}}"></script>
<script src="{{asset('assets/libs/datatables/datatables.buttons.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables/Jszip.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables/html5export.min.js')}}"></script>
@endsection
