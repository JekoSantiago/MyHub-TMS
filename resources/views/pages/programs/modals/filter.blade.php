<div id="modal_filter_programs" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Filter Form</h4>
            </div>
            <div class="modal-body">
                <form id="form_filter_applicants">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="filter_parent">Parent Program</label>
                                <select name="filter_parent" id="filter_parent" class="form-control select2">
                                    <option value="0"></option>
                                    @foreach ($parents as $parent)
                                    <option value={{$parent->Program_ID}}>{{$parent->Program}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="filter_program">Program</label>
                                <input id="filter_program" name="filter_program" type="text" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <button type="button" id="btn_filter_app_reset" class="btn btn-light waves-effect waves-light">Reset Filter</button>
                        </div>
                        <div>
                            <button type="button" class="btn btn-light waves-effect waves-light" data-dismiss="modal">Close</button>
                            <button type="button" id="btn_filter_programs" class="btn btn-danger waves-effect waves-light">Apply</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
