<form id="form_new_program">
    <fieldset>
        <h5 class="mb-3 text-uppercase bg-light p-2">Program</h5>
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <label for="new_parent_program">Parent Program</label>
                    <select id="new_parent_program" name="new_parent_program" class="form-control select2"
                        data-placeholder="Select Parent Program">
                        <option></option>
                        @foreach ($parents as $parent)
                        <option value={{$parent->Program_ID}}>{{$parent->Program}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label for="new_program">Program <span class="text-danger">*</span></label>
                    <input id="new_program" name="new_program" type="text" class="form-control">
                    <label class="invalid-feedback" id="new_program_error">Invalid program name, should be more than 1 character</label>
                </div>
            </div>


        </div>

    </fieldset>
    <div class="text-center">
        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
        <button type="button" id="btn_add_program" class="btn btn-primary">Save changes</button>
    </div>
</form>
