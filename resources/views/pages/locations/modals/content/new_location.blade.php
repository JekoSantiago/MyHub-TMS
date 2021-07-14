<form id="form_new_location">
    <fieldset>
        <h5 class="mb-3 text-uppercase bg-light p-2">Location</h5>
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <label for="new_location">Location <span class="text-danger">*</span></label>
                    <input id="new_location" name="new_location" type="text" class="form-control">
                    <label class="invalid-feedback" id="new_location_error">Invalid location name, should be more than 1 character</label>
                </div>
            </div>
            <div class="row pt-1">
                <div class="col-md-4">
                    <label for="new_capacity">Capacity <span class="text-danger">*</span></label>
                    <input id="new_capacity" name="new_capacity" type="number" class="form-control" min="1">
                    <label class="invalid-feedback" id="new_capacity_error">Capacity should be more than 0</label>
                </div>
            </div>
            <div class="row pt-1">
                <div class="col-md-4">
                    <label for="new_dc">DC <span class="text-danger">*</span></label>
                    <select id="new_dc" name="new_dc" class="form-control select2-no-search" min="1">
                        <option value="0"></option>
                    </select>
                    <label class="invalid-feedback" id="new_dc_error">Select a DC</label>
                </div>
            </div>


        </div>

    </fieldset>
    <div class="text-center">
        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
        <button type="button" id="btn_add_location" class="btn btn-success">Save changes</button>
    </div>
</form>
