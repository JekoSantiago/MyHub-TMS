@php use App\Helper\MyHelper; @endphp
<div id="modal_edit_training" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Training</h4>
            </div>
            <div class="modal-body">
                <form id="form_edit_training">
                    <fieldset>
                        <input type="hidden" name="edit_training_id" id="edit_training_id">
                        <input type="hidden" name="_token" id="globalToken" value="{{csrf_token()}}" />
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="edit_program_training">Program <span class="text-danger">*</span></label>
                                    <select id="edit_program_training" name="edit_program_training" class="form-control select2"
                                        data-placeholder="Select Program">
                                        <option></option>
                                    </select>
                                    <label class="invalid-feedback" id="edit_program_training_error">Select a Program.</label>
                                </div>
                                <div class="col-md-3">
                                    <label for="edit_loc_type">Location Type <span class="text-danger">*</span></label>
                                    <select name="edit_loc_type" id="edit_loc_type" class="form-control select2" data-placeholder="Select Location Type">
                                        <option value="0"></option>
                                        <option value="1">HUB</option>
                                        <option value="2">STORE</option>
                                    </select>
                                    <label class="invalid-feedback" id="edit_loc_type_error">Select Location Type.</label>
                                </div>
                                <div class="col-md-3 storeloc" style = "display:none">
                                    <label for="edit_DC">DC <span class="text-danger">*</span></label>
                                    <select name="edit_DC" id="edit_DC" class="form-control select2" data-placeholder="Select DC">
                                        <option value = '0'></option>
                                    </select>
                                    <label class="invalid-feedback" id="edit_DC_error">Select a DC.</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="edit_training_date">Training Date <span class="text-danger">*</span></label>
                                    <input id="edit_training_date" name="edit_training_date" type="date" class="form-control filter-flatpickrs">
                                    <label class="invalid-feedback" id="edit_training_date_error">Invalid Date of Training.</label>
                                </div>
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-3 storeloc" style = "display:none">
                                    <label for="edit_prov">Province <span class="text-danger">*</span></label>
                                    <select name="edit_prov" id="edit_prov" class="form-control select2" data-placeholder="Select province">
                                        <option value = '0'></option>
                                    </select>
                                    <label class="invalid-feedback" id="edit_prov_error">Select a Province.</label>
                                </div>
                                <div class="col-md-3 storeloc" style = "display:none">
                                    <label for="edit_store">Store <span class="text-danger">*</span></label>
                                    <select name="edit_store" id="edit_store" class="form-control select2" data-placeholder="Select Store">
                                        <option value = '0'></option>
                                    </select>
                                    <label class="invalid-feedback" id="edit_store_error">Select a Store.</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="edit_training">Training <span class="text-danger">*</span></label>
                                    <input id="edit_training" name="edit_training" type="text" class="form-control">
                                    <label class="invalid-feedback" id="edit_training_error">Invalid training name, should be more than 1 character</label>
                                </div>

                                <div class="col-md-5 hub" style = "display:none">
                                    <label for="edit_location_training">Location <span class="text-danger">*</span></label>
                                    <select id="edit_location_training" name="edit_location_training" class="form-control select2"
                                        data-placeholder="Select Location for training">
                                        <option value = '0'></option>
                                    </select>
                                    <label class="invalid-feedback" id="edit_location_training_error">Location for Training is required.</label>
                                </div>
                                <div class="col-md-1 hub" style = "display:none">
                                    <label for="edit_capacity_training">Capacity <span class="text-danger">*</span></label>
                                    <input id="edit_capacity_training" name="edit_capacity_training" type="text" class="form-control" value="" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="edit_training_description">Training Description <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="edit_training_description" id="edit_training_description" cols="30" rows="5"></textarea>
                                    <label class="invalid-feedback" id="edit_training_description_error">Invalid description, should be more than 1 character</label>
                                </div>
                                <div class="col-md-2">
                                    <label for="edit_hrs_training">No. of Hours <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="edit_hrs_training" name="edit_hrs_training" max="8" min="1">
                                    <label class="invalid-feedback" id="edit_hrs_training_error">Number of hours must be greater than 0.</label>
                                    {{-- <div class="row"> --}}
                                        {{-- <label for="edit_training_status" class="form-check-label mx-auto pt-2 ">Status</label> --}}
                                        {{-- <label for="edit_training_ratings" class="form-check-label mx-auto pt-2 col-3">Ratings</label> --}}
                                        {{-- <label for="edit_isOpen" class="form-check-label mx-auto pt-2 col-3 ">Open</label> --}}
                                    {{-- </div> --}}
                                    <div class="row">
                                        <div class = "col-4">
                                            <label for="edit_training_status" class="form-check-label mx-auto pt-2 ">Status</label>
                                            <input type="checkbox" name="edit_training_status" id="edit_training_status" class="form-control mx-auto pt-2" value='1'>
                                        </div>
                                        <div class = "col-4">
                                            <label for="edit_training_ratings" class="form-check-label mx-auto pt-2">Ratings</label>
                                            <input type="checkbox" name="edit_training_ratings" id="edit_training_ratings" class="form-control mx-auto pt-2" value='1'>
                                        </div>
                                        <div class="col-4">
                                            <label for="edit_isOpen" class="form-check-label mx-auto pt-2 ">Open</label>
                                            <input type="checkbox" name="edit_isOpen" id="edit_isOpen" class="form-control mx-auto pt-2" value='1'
                                            @if(MyHelper::decrypt(Session::get('Employee_ID')) != env('HR_MANAGER_ID')) disabled  @endif>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </fieldset>
                    <div class="text-center">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="button" id="btn_update_training" class="btn btn-success">Save changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
