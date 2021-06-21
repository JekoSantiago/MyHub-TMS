<form id="form_new_training">
    <fieldset>
        <input type="hidden" name="_token" id="globalToken" value="{{csrf_token()}}" />
        <div class="form-group">
            <div class="row">
                <div class="col-md-5">
                    <label for="new_program_training">Program <span class="text-danger">*</span></label>
                    <select id="new_program_training" name="new_program_training" class="form-control select2"
                        data-placeholder="Select Program">
                        <option></option>
                        @foreach ($programs as $program)
                        <option value={{$program->Program_ID}}>{{$program->Program}}</option>
                        @endforeach
                    </select>
                    <label class="invalid-feedback" id="new_program_training_error">Select a Program.</label>
                </div>
                <div class="col-md-3">
                    <label for="new_loc_type">Location Type <span class="text-danger">*</span></label>
                    <select name="new_loc_type" id="new_loc_type" class="form-control select2" data-placeholder="Select Location Type">
                        <option value="0"></option>
                        <option value="1">HUB</option>
                        <option value="2">STORE</option>
                    </select>
                    <label class="invalid-feedback" id="new_loc_type_error">Select Location Type.</label>
                </div>
                <div class="col-md-3 storeloc" style = "display:none">
                    <label for="new_DC">DC <span class="text-danger">*</span></label>
                    <select name="new_DC" id="new_DC" class="form-control select2" data-placeholder="Select DC">
                        <option value = '0'></option>
                    </select>
                    <label class="invalid-feedback" id="new_DC_error">Select a DC.</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label for="new_training_date">Training Date <span class="text-danger">*</span></label>
                    <input id="new_training_date" name="new_training_date" type="date" class="form-control filter-flatpickrs">
                    <label class="invalid-feedback" id="new_training_date_error">Invalid Date of Training.</label>
                </div>
                <div class="col-md-2">
                </div>
                <div class="col-md-3 storeloc" style = "display:none">
                    <label for="new_prov">Province <span class="text-danger">*</span></label>
                    <select name="new_prov" id="new_prov" class="form-control select2" data-placeholder="Select province">
                        <option value = '0'></option>
                    </select>
                    <label class="invalid-feedback" id="new_prov_error">Select a Province.</label>
                </div>
                <div class="col-md-3 storeloc" style = "display:none">
                    <label for="new_store">Store <span class="text-danger">*</span></label>
                    <select name="new_store" id="new_store" class="form-control select2" data-placeholder="Select Store">
                        <option value = '0'></option>
                    </select>
                    <label class="invalid-feedback" id="new_store_error">Select a Store.</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <label for="new_training">Training <span class="text-danger">*</span></label>
                    <input id="new_training" name="new_training" type="text" class="form-control">
                    <label class="invalid-feedback" id="new_training_error">Invalid training name, should be more than 1 character</label>
                </div>

                <div class="col-md-5 hub" style = "display:none">
                    <label for="new_location_training">Location <span class="text-danger">*</span></label>
                    <select id="new_location_training" name="new_location_training" class="form-control select2"
                        data-placeholder="Select Location for training">
                        <option value = '0'></option>
                        @foreach ($locations as $location)
                        <option value={{$location->Location_ID}} name="{{ $location->Capacity }}">{{$location->Location}}</option>
                        @endforeach
                    </select>
                    <label class="invalid-feedback" id="new_location_training_error">Location for Training is required.</label>
                </div>
                <div class="col-md-1 hub" style = "display:none">
                    <label for="new_capacity_training">Capacity <span class="text-danger">*</span></label>
                    <input id="new_capacity_training" name="new_capacity_training" type="text" class="form-control" value="" disabled>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <label for="new_training_description">Training Description <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="new_training_description" id="new_training_description" cols="30" rows="5"></textarea>
                    <label class="invalid-feedback" id="new_training_description_error">Invalid description, should be more than 1 character</label>
                </div>
                <div class="col-md-2">
                    <label for="new_hrs_training">No. of Hours <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="new_hrs_training" name="new_hrs_training" max="8" min="1">
                    <label class="invalid-feedback" id="new_hrs_training_error">Number of hours must be greater than 0.</label>
                    <div class="row">
                        <label for="new_training_status" class="form-check-label pt-1 pl-2">Status</label>
                        <label for="new_training_ratings" class="form-check-label pt-1 pl-2">Ratings</label>
                    </div>
                    <div class="row">
                        <input type="checkbox" name="new_training_status" id="new_training_status" class="form-control pt-2 col-4" value='1'>
                        <input type="checkbox" name="new_training_ratings" id="new_training_ratings" class="form-control pt-2 col-4" value='1'>
                    </div>
                </div>

            </div>




        </div>

    </fieldset>
    <div class="text-center">
        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
        <button type="button" id="btn_add_training" class="btn btn-success">Save changes</button>
    </div>
</form>
