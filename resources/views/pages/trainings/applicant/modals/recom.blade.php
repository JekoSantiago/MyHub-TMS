<div id="modal_app_recom" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-center modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{ $datas[0]->Program }}</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>
            <div class="modal-body">
                <form id="form_app_recom">
                    <fieldset>
                    <input type="hidden" id="ProgramApp_ID" name = "ProgramApp_ID">
                    <input type="hidden" id="Applicant_ID" name = "Applicant_ID">
                    <input type="hidden" id="Program_ID" name = "Program_ID">
                    <input type="hidden" id="Parent_ID" name = "Parent_ID">
                    <input type="hidden" id="insertDate" name = "insertDate">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="recom_lastName">Last Name </label>
                                <input class="form-control" type="text" id="recom_lastName" name ="recom_lastName" disabled>
                            </div>
                            <div class="col-lg-6">
                                <label for="recom_firstName">First Name </label>
                                <input class="form-control" type="text" id="recom_firstName" name ="recom_firstName" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="recom_middleName">Middle Name </label>
                                <input class="form-control" type="text" id="recom_middleName" name ="recom_middleName" disabled>
                            </div>
                            <div class="col-lg-6">
                                <label for="recom_gender">Gender </label>
                                <input class="form-control" type="text" id="recom_gender" name ="recom_gender" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="recom_bday">Birthdate</label>
                                <input class="form-control" type="text" id="recom_bday" name ="recom_bday" disabled>
                            </div>
                            <div class="col-lg-6">
                                <label for="recom_homeAdd">Home Add </label>
                                <input class="form-control" type="text" id="recom_homeAdd" name ="recom_homeAdd" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="recom_municipal">Municipal</label>
                                <input class="form-control" type="text" id="recom_municipal" name ="recom_municipal" disabled>
                            </div>
                            <div class="col-lg-6">
                                <label for="recom_province">Province </label>
                                <input class="form-control" type="text" id="recom_province" name ="recom_province" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="recom_ave">Average Ratings</label>
                                <input class="form-control" type="text" id="recom_ave" name ="recom_ave" disabled>
                            </div>
                            <div class="col-lg-6">
                                <label for="recom_status">Status </label>
                                <input class="form-control" type="text" id="recom_status" name ="recom_status" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row-lg-6">
                                    <label for="recom_recom">Recommendations</label>
                                    <select name="recom_recom" id="recom_recom" class="form-control">
                                        <option value="1">Ready to be trained at Store</option>
                                        @foreach ($recom as $r)
                                            <option  value="{{ $r->Recommendation_ID }}">{{ $r->Recommendation }}</option>
                                        @endforeach
                                    </select>
                                    <label class="invalid-feedback" id="recom_recom_error">Select a Recommendation.</label>
                                </div>
                                <div class="row-lg-6" id="auto_enroll_div" style = "display:none">
                                    <label for="auto_enroll_list">Next Level Programs</label>
                                    <select name="auto_enroll_list" id="auto_enroll_list" class="form-control">
                                        <option></option>
                                    </select>
                                    <label class="invalid-feedback" id="auto_enroll_list_error">Select a Program</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="recom_remarks">Remarks</label>
                                <textarea class="form-control" name="recom_remarks" id="recom_remarks" cols="50" rows="4"></textarea>
                                <label class="invalid-feedback" id="recom_remarks_error">Put a Remark</label>
                            </div>
                        </div>

                    </fieldset>
                    <div class="text-center">
                    <button type="button" id="btn_cancel_recom" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" id="btn_save_recom" class="btn btn-success">Save</button>
                    <button type="button" id="btn_update_recom" class="btn btn-info">Update</button>
                    </div>
                    </form>
            </div>
        </div>
    </div>
</div>
