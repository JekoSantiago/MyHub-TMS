<div id="modal_filter_applicants" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Filter Form</h4>
            </div>
            <div class="modal-body">
                <form id="form_filter_applicants">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="filter_lname">Last Name</label>
                                <input id="filter_lname" name="filter_lname" type="text" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="filter_fname">First Name</label>
                                <input id="filter_fname" name="filter_fname" type="text" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="filter_mname">Middle Name</label>
                                <input id="filter_mname" name="filter_mname" type="text" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="filter_pos">Position</label>
                                <input id="filter_pos" name="filter_pos" type="text" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <button type="button" id="btn_filter_app_reset" class="btn btn-light waves-effect waves-light">Reset Filter</button>
                        </div>
                        <div>
                            <button type="button" class="btn btn-light waves-effect waves-light" data-dismiss="modal">Close</button>
                            <button type="button" id="btn_filter_applicants" class="btn btn-danger waves-effect waves-light">Apply</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
