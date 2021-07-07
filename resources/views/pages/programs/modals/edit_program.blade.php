<div id="modal_edit_program" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-center">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Program</h4>
            </div>
            <div class="modal-body">
                <form id="form_edit_program">
    <fieldset>
        <input type="hidden" id="edit_program_id" name="edit_program_id">
        <h5 class="mb-3 text-uppercase bg-light p-2">Program</h5>
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <label for="edit_parent_program">Parent Program</label>
                    <select id="edit_parent_program" name="edit_parent_program" class="form-control select2"
                        data-placeholder="Select Parent Program">
                        <option></option>
                    </select>
                </div>
            </div>
            <div class="row" style = "display:none" id="seqlist">
                <div class="col-md-12 pt-1">
                    <label for="edit_seq_program">Prior Program</label>
                    <select id="edit_seq_program" name="edit_seq_program" class="form-control select2"
                        data-placeholder="Select Prior Program">
                        <option></option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 pt-1">
                    <label for="edit_program">Program <span class="text-danger">*</span></label>
                    <input id="edit_program" name="edit_program" type="text" class="form-control">
                    <label class="invalid-feedback" id="edit_program_error">Invalid program name, should be more than 1 character</label>
                </div>
            </div>


        </div>

    </fieldset>
    <div class="text-center">
        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
        <button type="button" id="btn_update_program" class="btn btn-success">Save changes</button>
    </div>
</form>

            </div>
        </div>
    </div>
</div>
