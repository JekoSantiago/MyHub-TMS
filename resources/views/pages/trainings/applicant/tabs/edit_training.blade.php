@extends('layouts.main')
@section('content')
@php use App\Helper\MyHelper; @endphp
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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Training</a></li>
                        <li class="breadcrumb-item active">Edit Training</li>
                    </ol>
                </div>
                <h4 class="page-title">Edit Training</h4>
    <form id="form_edit_training">
        <input type="hidden" id="edit_training_id" name="edit_training_id" value={{ $training[0]->Training_ID }}>
        <input type="hidden" id="dc" name="dc" value="{{ $training[0]->DC_ID }}">
        <input type="hidden" id="prov" name="prov" value="{{ $training[0]->LocProv_ID }}">
        <input type="hidden" id="store" name="store" value="{{ $training[0]->Store_ID }}">
        <fieldset>
            <input type="hidden" name="_token" id="globalToken" value="{{csrf_token()}}" />
            <div class="form-group">
                <div class="row">
                    <div class="col-md-5">
                        <label for="edit_program_training">Program <span class="text-danger">*</span></label>
                        <select id="edit_program_training" name="edit_program_training" class="form-control select2"
                            data-placeholder="Select Program">
                            <option></option>
                            @foreach ($programs as $program)
                            <option value={{$program->Program_ID}}
                                @if ($training[0]->Program_ID==$program->Program_ID)
                                selected = "selected"
                                @endif>
                                {{$program->Program}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="edit_loc_type">Location Type <span class="text-danger">*</span></label>
                        <select name="edit_loc_type" id="edit_loc_type" class="form-control select2" data-placeholder="Select Location Type">
                            <option value="0"></option>
                            <option value="1" @if ($training[0]->Location_ID > 0) selected = "selected" @endif> HUB</option>
                            <option value="2" @if ($training[0]->Store_ID > 0) selected = "selected" @endif)>STORE</option>
                        </select>
                        <label class="invalid-feedback" id="edit_loc_type_error">Select Location Type.</label>
                    </div>
                    <div class="col-md-3 storeloc" @if ($training[0]->Store_ID <= 0)style = "display:none" @endif>
                        <label for="edit_DC">DC <span class="text-danger">*</span></label>
                        <select name="edit_DC" id="edit_DC" class="form-control select2" data-placeholder="Select DC">
                            <option value = 0> </option>
                        </select>
                        <label class="invalid-feedback" id="edit_DC_error">Select a DC.</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="edit_training_date">Training Date <span class="text-danger">*</span></label>
                        <input id="edit_training_date" name="edit_training_date" type="date" class="form-control filter-flatpickrs" value="{{ $training[0]->TrainingDate }}" class="form-control filter-flatpickrs">
                        <label class="invalid-feedback" id="edit_training_date_error">Invalid Date of Training.</label>
                    </div>
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-3 storeloc"  @if ($training[0]->Store_ID <= 0)style = "display:none" @endif>
                        <label for="edit_prov">Province <span class="text-danger">*</span></label>
                        <select name="edit_prov" id="edit_prov" class="form-control select2" data-placeholder="Select province">
                            <option value = '0'></option>
                        </select>
                        <label class="invalid-feedback" id="edit_prov_error">Select a Province.</label>
                    </div>
                    <div class="col-md-3 storeloc"@if ($training[0]->Store_ID <= 0)style = "display:none" @endif>
                        <label for="edit_store">Store <span class="text-danger">*</span></label>
                        <select name="edit_store" id="edit_store" class="form-control select2" data-placeholder="Select province">
                            <option value = '0'></option>
                        </select>
                        <label class="invalid-feedback" id="edit_store_error">Select a Store.</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <label for="edit_training">Training <span class="text-danger">*</span></label>
                        <input id="edit_training" name="edit_training" type="text" class="form-control" value="{{ $training[0]->Training }}">
                        <label class="invalid-feedback" id="edit_training_error">Invalid training name, should be more than 1 character</label>
                    </div>

                    <div class="col-md-5 hub" @if ($training[0]->Location_ID <= 0) style = "display:none" @endif>
                        <label for="edit_location_training">Location <span class="text-danger">*</span></label>
                        <select id="edit_location_training" name="edit_location_training" class="form-control select2"
                            data-placeholder="Select Location for training">
                            <option value = '0'></option>
                            @foreach ($locations as $location)
                            <option value={{$location->Location_ID}} name="{{ $location->Capacity }}"
                                @if ($training[0]->Location_ID==$location->Location_ID)
                                selected = "selected"
                                @endif>{{$location->Location}}</option>
                            @endforeach
                        </select>
                        <label class="invalid-feedback" id="edit_location_training_error">Location for Training is required.</label>
                    </div>
                    <div class="col-md-1 hub" @if ($training[0]->Location_ID <= 0) style = "display:none" @endif>
                        <label for="edit_capacity_training">Capacity <span class="text-danger">*</span></label>
                        <input id="edit_capacity_training" name="edit_capacity_training" type="text" class="form-control" value="{{ $training[0]->Capacity }}" disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <label for="edit_training_description">Training Description <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="edit_training_description" id="edit_training_description" cols="30" rows="5">{{ $training[0]->TrainingDesc }}</textarea>
                        <label class="invalid-feedback" id="edit_training_description_error">Invalid description, should be more than 1 character</label>
                    </div>
                    <div class="col-md-2">
                        <label for="edit_hrs_training">No. of Hours <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="edit_hrs_training" name="edit_hrs_training"  value="{{ $training[0]->NoOfHours }}">
                        <label class="invalid-feedback" id="edit_hrs_training_error">Number of hours must be greater than 0.</label>
                        <div class="row">
                            <label for="edit_training_status" class="form-check-label pt-1 pl-2">Status</label>
                            <label for="edit_training_ratings" class="form-check-label pt-1 pl-2">Ratings</label>
                            <label for="edit_isOpen" class="form-check-label pt-1 pl-2">Open</label>
                        </div>
                        <div class="row">
                            <input type="checkbox" name="edit_training_status" id="edit_training_status" class="form-control pt-2 col-4" value='1' @if ($training[0]->TrainStatus==1) checked @endif>
                            <input type="checkbox" name="edit_training_ratings" id="edit_training_ratings" class="form-control pt-2 col-4" value='1' @if ($training[0]->Ratings==1) checked @endif>
                            <input type="checkbox" name="edit_isOpen" id="edit_isOpen" class="form-control pt-2 col-4" value='1' @if ($training[0]->isOpen==1) checked @endif
                            @if(MyHelper::decrypt(Session::get('Employee_ID')) != env('HR_MANAGER_ID')) disabled  @endif>

                        </div>
                    </div>

                </div>




            </div>

        </fieldset>
        <div class="text-center">
            <a href="{{ route('page.training.app') }}"><button type="button" class="btn btn-outline-info">Cancel</button></a>
            <button type="button" id="btn_update_training" class="btn btn-success">Save changes</button>
        </div>
    </form>
</div>
@endsection
@section('js')
<script src="{{asset('assets/js/custom/trainings.js')}}"></script>
<script src="{{asset('assets/js/custom/trainingedit.js')}}"></script>
@endsection
