<div id="modal_edit_location" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-center">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Location</h4>
            </div>
            <div class="modal-body">
                <form id="form_edit_location">
                    <fieldset>
                        <input type="hidden" id="edit_location_ID" name="edit_location_ID">
                        <h5 class="mb-3 text-uppercase bg-light p-2">Location</h5>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="edit_location">Location <span class="text-danger">*</span></label>
                                    <input id="edit_location" name="edit_location" type="text" class="form-control">
                                    <label class="invalid-feedback" id="edit_location_error">Invalid location name, should be more than 1 character</label>
                                </div>
                            </div>
                            <div class="row pt-1">
                                <div class="col-md-4">
                                    <label for="edit_capacity">Capacity <span class="text-danger">*</span></label>
                                    <input id="edit_capacity" name="edit_capacity" type="number" class="form-control" min="1">
                                    <label class="invalid-feedback" id="edit_capacity_error">Capacity should be more than 0</label>
                                </div>
                            </div>
                            <div class="row pt-1">
                                <div class="col-md-4">
                                    <label for="edit_dc">DC <span class="text-danger">*</span></label>
                                    <select id="edit_dc" name="edit_dc" class="form-control select2-no-search" min="1">
                                        <option value="0"></option>
                                    </select>
                                    <label class="invalid-feedback" id="edit_dc_error">Select a DC</label>
                                </div>
                            </div>


                        </div>

                    </fieldset>
                    <div class="text-center">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="button" id="btn_update_location" class="btn btn-success">Save changes</button>
                    </div>
            </div>
        </div>
    </div>
</div>
