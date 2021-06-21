<div id="modal_app_rating" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-center">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{  $training[0]->Program  }}<br>{{  $training[0]->Training  }}</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>
            <div class="modal-body">
                <form id="form_app_ratings">
                    <fieldset>
                    <input type="hidden" id="TrainApp_ID" name = "TrainApp_ID">
                    <input type="hidden" id="Applicant_ID" name = "Applicant_ID">
                    <div class="form-group">
                        <div class="row pl-3">
                            <h3 id="app_name_ratings"></h3>
                        </div>
                        <div class="row" id='isStatus'>
                            <div class="col pl-5">
                                <h5>Status:</h5>
                            </div>
                            <div class="col-md-8 pt-1" >
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status_passed" id="status_passed" value="1">
                                    <label class="form-check-label" for="inlineRadio1">Passed</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status_fail" id="status_fail" value="0">
                                    <label class="form-check-label" for="inlineRadio2">Failed</label>
                                  </div>
                            </div>
                        </div>
                        <div class="row" id="isRatings">
                            <div class="col pl-5">
                                <h5>Ratings:</h5>
                            </div>
                            <div class="col-md-8 pt-1">
                                <input type="number" name="ratings_app" id="ratings_app" max="100" min="0">
                                <label class="invalid-feedback" id="ratings_app_error">Rating should not be less than 0 nor morethan 100</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col pl-5">
                                <h5>Remarks:</h5>
                            </div>
                            <div class="col-md-8 pt-1">
                                <textarea name="remarks" id="remarks" cols="20" rows="5"></textarea>
                            </div>
                        </div>

                    </div>
                    </fieldset>
                    <div class="text-center">
                    <button type="button" id="btn_cancel_ratings" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" id="btn_update_ratings" class="btn btn-info">Update</button>
                    </div>
                    </form>
            </div>
        </div>
    </div>
</div>
