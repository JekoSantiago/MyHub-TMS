$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function ()
{
    console.log(SCT);

    //
    // Applicants Table
    //
        var program=$('#program_name').text();
        var training=$('#training_name').text();
        var tbl_train_app= $('#tbl_train_app').DataTable({
        serverSide: false,
        processing: true,
        scrollX: true,
        pageLength : 5,
        dom: 'Bfrtip',
        buttons: [
            'copy',
            {extend: 'excelHtml5',
            title: program+" - "+training,
            modifier: {
            page: 'all',
            search: 'none'
          }


        },

        ],
        lengthMenu: [[5, 10, 20], [5, 10, 20]],
        ajax: {
            url: WebURL + '/train-applicant-tbl',
            method: 'POST',
            datatype: 'json',
            data: function (d) {
                return $.extend({}, d, {
                    "_token": $("#tokenfield").val(),
                    "Training_ID": $("#training_id").val()
               });
            },
            beforeSend: function () {
                $('#tbl_applicants > tbody').html(
                    '<tr class="odd">' +
                    '<td valign="top" colspan="7" class="dataTables_empty"><div class="text-center"><div class="spinner spinner-border"></div></div></td>' +
                    '</tr>'
                );
            },

        },
        columns: [
            {data:"LastName", render: function(data,type,row)
            {
                return '<a href="#" class="text-danger ratings">'+row.LastName+'</a>'
            }},
            {data: "FirstName"},
            {data: "MiddleName" },
            {data: "Gender" },
            {data: "Birthdate" },
            {data: "HomeAdd" },
            {data: "Municipal"},
            {data: "Province"},
            {data: "Status"},
            {data: "Ratings"},
            {data: "Remarks"},

        ],
        drawCallback: function () {
            $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
        },
        language: {
            emptyTable: 'No data available.',
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'>",
                next: "<i class='mdi mdi-chevron-right'>"
            },
            processing:'<div class="text-center"><div class="spinner spinner-border"></div></div>'
        },
        createdRow: function (row, data, index){
            if(data.Ratings >= 76) {
                $(row).addClass('table-success');
            }
            else if(data.Ratings < 76 && data.Status == 'FAILED') {
                $(row).addClass('table-warning');
            }
        },

    });


    //
    //Program App Table
    //
    var program_title = $('#program-title').text()
    var program=$('#program_id').val();
    var tbl_app_prog= $('#tbl_app_prog').DataTable({
    serverSide: false,
    autoWidth: true,
    lengthChange: false,
    processing: true,
    retrieve: true,
    searching: true,
    scrollX: true,
    pageLength : 5,
    lengthMenu: [[5, 10, 20], [5, 10, 20]],
    dom: 'Bfrtip',
    buttons: [
        'copy',
        {extend: 'excelHtml5',
        title: program_title,
        exportOptions: {
            columns: [ 0,1,2,3,4,5,6,7,8,9,10,11,12]
        },
        modifier: {
            page: 'all',
            search: 'none'
          }

        }
    ],
    ajax: {
        url: WebURL + '/program-app-tbl',
        method: 'POST',
        datatype: 'json',
        data: function (d) {
            return $.extend({}, d, {
                "_token": $("#tokenfield").val(),
                "Program_ID": program
           });
        },
        beforeSend: function () {
            $('#tbl_applicants > tbody').html(
                '<tr class="odd">' +
                '<td valign="top" colspan="7" class="dataTables_empty"><div class="text-center"><div class="spinner spinner-border"></div></div></td>' +
                '</tr>'
            );
        },

    },
    language: {
        emptyTable: 'No data available.',
        paginate: {
            previous: "<i class='mdi mdi-chevron-left'>",
            next: "<i class='mdi mdi-chevron-right'>"
        },
        processing:'<div class="text-center"><div class="spinner spinner-border"></div></div>'
    },
    columns: [
        {data: "LastName", render: function(data,type,row)
        {
            return '<a href="#" class="text-danger recom">'+row.LastName+'</a>'
        }},
        {data: "FirstName" },
        {data: "MiddleName" },
        {data: "Gender" },
        {data: "Birthdate" },
        {data: "HomeAdd" },
        {data: "Municipal"},
        {data: "Province"},
        {data: "AveRatings"},
        {data: "Status"},
        {data: "Recommendation"},
        {data: "Remarks"},
        {data: "InsertDate"}

    ],
    drawCallback: function () {
        $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
    },
    language: {
        emptyTable: 'No data available.',
        paginate: {
            previous: "<i class='mdi mdi-chevron-left'>",
            next: "<i class='mdi mdi-chevron-right'>"
        },
        processing:'<div class="text-center"><div class="spinner spinner-border"></div></div>'
    },
    createdRow: function (row, data, index){
        if(data.AveRatings >= 76 && data.InsertDate != null) {
            $(row).addClass('table-success');
        }

        if(data.Recommendation_ID == 3 || data.Recommendation_ID == 4)
        {
            $(row).addClass('table-danger');
        }

        if(data.Recommendation_ID == 6 && data.AveRatings < 76)
        {
            console.log('deleted')
            var delID
            if(data.Parent_Program_ID == SCT) {delID = SLT;}
            else if(data.Parent_Program_ID == SLT) {delID = ACT;}
            else if(data.Parent_Program_ID == ACT) {delID = AMT;}
            $.post(WebURL + '/app-del',{Applicant_ID:data.Applicant_ID,Parent_Program_ID:delID,ProgramApp_ID:data.ProgramApp_ID})

            tbl_app_prog.ajax.reload();
        }

        if(data.Recommendation_ID == 1 && data.AveRatings < 76)
        {
            $.post(WebURL + '/app-fail',{ProgramApp_ID:data.ProgramApp_ID})
            tbl_app_prog.ajax.reload();
        }
    },

});


    //
    //Recom Modal
    //

    $('#tbl_app_prog').on( 'click', '.recom', function () {
        var data = tbl_app_prog.row( $(this).parents('tr') ).data();
        var lastName = data['LastName'];
        var firstName = data['FirstName'];
        var middleName = data['MiddleName'];
        var gender = data['Gender'];
        var bday = data['Birthdate'];
        var homeAdd = data['HomeAdd'];
        var municipal = data['Municipal'];
        var province = data['Province'];
        var ave = data['AveRatings'];
        var status = data['Status'];
        var recom = data['Recommendation'];
        var recomID = data['Recommendation_ID'];
        var remarks = data['Remarks'];
        var insertDate = data['InsertDate'];
        var programID = data['Program_ID'];
        var applicantID = data['Applicant_ID'];
        var programAppID = data['ProgramApp_ID'];
        var parentID = data['Parent_Program_ID'];
        var deptID = data['DeptPosition_ID'];

        console.log(data);


        $('#modal_app_recom').modal('show');


        if (insertDate == "" || insertDate == null)
        {
            $('#btn_update_recom').hide();
            $('#btn_save_recom').show();
        }
        else
        {
            $('#btn_update_recom').show();
            $('#btn_save_recom').hide();
        }

        if(recomID == 6)
        {
            $('#auto_enroll_div').show();
        }
        else
        {
            $('#auto_enroll_div').hide();
        }

        if(recomID == 6 && insertDate != "" && ave >= 76)
        {
            $('#btn_update_recom').show();
            $('#btn_save_recom').hide();

            if(parentID == SCT) {delID = SLT;}
            else if(parentID == SLT) {delID = ACT;}
            else if(parentID == ACT) {delID = AMT;}
            $.post(WebURL + '/app-det',{Applicant_ID:applicantID,Parent_Program_ID:delID},function(det){

                $('#auto_enroll_list').html(det);
                $('#auto_enroll_list option:eq(1)').attr('selected', 'selected');
            })

            $('#recom_recom').prop('disabled',true);
            $('#auto_enroll_list').prop('disabled',true);
        }
        else
        {
            $('#recom_recom').prop('disabled',false);
            $('#auto_enroll_list').prop('disabled',false);
        }

        $('#Parent_ID').val(parentID);
        $('#ProgramApp_ID').val(programAppID); console.log(programAppID)
        $('#Applicant_ID').val(applicantID); console.log(applicantID)
        $('#Program_ID').val(programID);
        $('#recom_lastName').val(lastName);
        $('#recom_firstName').val(firstName);
        $('#recom_middleName').val(middleName);
        $('#recom_gender').val(gender);
        $('#recom_bday').val(bday);
        $('#recom_homeAdd').val(homeAdd);
        $('#recom_municipal').val(municipal);
        $('#recom_province').val(province);
        $('#recom_ave').val(ave);
        $('#recom_status').val(status);
        $('#recom_remarks').val(remarks);
        $('#insertDate').val(insertDate);
        $('#recom_recom').val(recomID);
        if (ave>=76)
        {

            $("#recom_recom option[value='1']").show();
            $("#recom_recom option[value='2']").hide();
            $("#recom_recom option[value='3']").hide();
            $("#recom_recom option[value='4']").hide();
            $("#recom_recom option[value='5']").hide();
            $("#recom_recom option[value='6']").hide();
            // if(deptID != SC_ID && parentID == SCT)
            // {
            //     $("#recom_recom option[value='1']").show();
            //     $("#recom_recom option[value='6']").show();
            // }
            // else if((deptID != SL_ID && parentID == SLT)&&(deptID != SC_ID && parentID == SLT))
            // {
            //     $("#recom_recom option[value='1']").hide();
            //     $("#recom_recom option[value='6']").show();
            // }
            // else if((deptID != AC_ID  && parentID == ACT)&&(deptID != SC_ID && parentID == ACT)&&(deptID != SL_ID && parentID == ACT))
            // {
            //     $("#recom_recom option[value='1']").hide();
            //     $("#recom_recom option[value='6']").show();
            // }
            // else if((deptID == AM_ID && parentID == AMT)&&(deptID != SC_ID && parentID == AMT)&&(deptID != SL_ID && parentID == AMT)&&(deptID != AC_ID && parentID == AMT))
            // {
            //     $("#recom_recom option[value='1']").show();
            //     $("#recom_recom option[value='6']").hide();
            // }
            // else
            // {
            //     $("#recom_recom option[value='6']").hide();
            // }

            $("#recom_recom").val(recomID);
        }
        else
        {
            $("#recom_recom option[value='1']").hide();
            $("#recom_recom option[value='2']").show();
            $("#recom_recom option[value='3']").show();
            $("#recom_recom option[value='4']").show();
            $("#recom_recom option[value='5']").show();
            $("#recom_recom option[value='6']").hide();
            $('#recom_recom').val(recomID);
        }
  });

    //
    //Saving recom
    //
    $('#modal_app_recom').on('click','#btn_save_recom',function(){
        var error = false;
        var recom = $('#recom_recom').val();
        var remarks = $('#recom_remarks').val();
        var insertDate = $('#insertDate').val();

        if (recom == null)
        {
            error = true;
            $('#recom_recom').addClass('error-input');
            $('#recom_recom_error').show();
        }
        else
        {
            $('#recom_recom').removeClass('error-input');
            $('#recom_recom_error').hide();
        }

        if (remarks.length == 0)
        {
            error = true;
            $('#recom_remarks').addClass('error-input');
            $('#recom_remarks_error').show();
        }
        else
        {
            $('#recom_remarks').removeClass('error-input');
            $('#recom_remarks_error').hide();
        }
        // if (recom == 6)
        // {
        //     if ($('#auto_enroll_list').val() == null || $('#auto_enroll_list').val() == 0 )
        //     {
        //         error = true;
        //         $('#auto_enroll_list').addClass('error-input');
        //         $('#auto_enroll_list_error').show();
        //     }
        //     else
        //     {
        //         $('#auto_enroll_list').removeClass('error-input');
        //         $('#auto_enroll_list_error').hide();
        //     }
        // }

        if (error == false)
        {
            swal.fire({
                title: 'Are you sure?',
                text: "Recommendation of the applicant",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
              }).then((result) => {
                if(result.value)
                {
                        var formdata = $('#form_app_recom').serialize();

                        $.post(WebURL + '/insert-program-app',formdata,function(data){
                        if(data.num>0)
                        {
                            // //EMAIL SENDING
                            // var trainID = data.num;
                            // $.post(WebURL + '/email-create',{trainingID:trainID,action:'create'})
                            // //
                            swal.fire({
                                title: 'Success',
                                text: data.msg,
                                icon: 'success',
                                confirmButtonText: 'Ok',
                                }).then(function (result) {
                                    if (true) {

                                        if(recom == 6 && insertDate == "")
                                        {
                                            $.post(WebURL + '/train-app',formdata,function(data){
                                                if(data.num>0)
                                                {

                                                    swal.fire({
                                                        title: 'Success',
                                                        text: data.msg,
                                                        icon: 'success',
                                                        confirmButtonText: 'Ok',
                                                        }).then(function (result) {
                                                            if (true) {
                                                                $('#modal_app_recom').modal('hide');
                                                                tbl_app_prog.ajax.reload();
                                                            }
                                                        });
                                                }
                                                else
                                                {
                                                    swal.fire({
                                                        title: "Warning!",
                                                        text: data.msg,
                                                        icon: "warning",
                                                        confirmButtonText: "Ok",
                                                        confirmButtonColor: '#6658dd',
                                                        allowOutsideClick: false,
                                                    });
                                                }
                                            },'JSON');
                                        }

                                        $('#modal_app_recom').modal('hide');
                                        // tbl_app_prog.ajax.reload();
                                        location.reload();
                                    }
                                });
                        }
                        else
                        {
                            swal.fire({
                                title: "Warning!",
                                text: data.msg,
                                icon: "warning",
                                confirmButtonText: "Ok",
                                confirmButtonColor: '#6658dd',
                                allowOutsideClick: false,
                            });
                        }
                    },'JSON');
                }

              });


        }
        else {
            $('.error-input').filter(":first").focus();
        }

    })


    //
    //Update recom
    //
    $('#modal_app_recom').on('click','#btn_update_recom',function(){
        var error = false;
        var ProgramApp_ID = $('#ProgramApp_ID').val();
        var recom = $('#recom_recom').val();
        var remarks = $('#recom_remarks').val();

        if (recom == null)
        {
            error = true;
            $('#recom_recom').addClass('error-input');
            $('#recom_recom_error').show();
        }
        else
        {
            $('#recom_recom').removeClass('error-input');
            $('#recom_recom_error').hide();
        }


        if (remarks.length == 0)
        {
            error = true;
            $('#recom_remarks').addClass('error-input');
            $('#recom_remarks_error').show();

        }
        else
        {
            $('#recom_remarks').removeClass('error-input');
            $('#recom_remarks_error').hide();
        }

        if (recom == 6)
        {
            if ($('#auto_enroll_list').val() == null || $('#auto_enroll_list').val() == 0 )
            {
                error = true;
                $('#auto_enroll_list').addClass('error-input');
                $('#auto_enroll_list_error').show();
            }
            else
            {
                $('#auto_enroll_list').removeClass('error-input');
                $('#auto_enroll_list_error').hide();
            }
        }

        if (error == false)
        {
            swal.fire({
                title: 'Are you sure?',
                text: "Updating the Recommendation",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
              }).then((result) => {
                if(result.value)
                {
                    $.post(WebURL + '/update-program-app',{ProgramApp_ID:ProgramApp_ID,Recom:recom,Remarks:remarks},function(data){
                    if(data.num>0)
                        {


                            swal.fire({
                                title: 'Success',
                                text: data.msg,
                                icon: 'success',
                                confirmButtonText: 'Ok',
                                }).then(function (result) {
                                    if (true)
                                    {
                                        // var isDisabled = $('#auto_enroll_list').prop('disabled');
                                        // if(recom == 6 && isDisabled==false)
                                        // {
                                        //     var formdata = $('#form_app_recom').serialize();
                                        //     $.post(WebURL + '/train-app',formdata,function(data){
                                        //         if(data.num>0)
                                        //         {

                                        //             swal.fire({
                                        //                 title: 'Success',
                                        //                 text: data.msg,
                                        //                 icon: 'success',
                                        //                 confirmButtonText: 'Ok',
                                        //                 }).then(function (result) {
                                        //                     if (true) {
                                        //                         $('#modal_app_recom').modal('hide');
                                        //                         location.reload();
                                        //                     }
                                        //                 });
                                        //         }
                                        //         else
                                        //         {
                                        //             swal.fire({
                                        //                 title: "Warning!",
                                        //                 text: data.msg,
                                        //                 icon: "warning",
                                        //                 confirmButtonText: "Ok",
                                        //                 confirmButtonColor: '#6658dd',
                                        //                 allowOutsideClick: false,
                                        //             });
                                        //         }
                                        //     },'JSON');
                                        // }

                                        $('#modal_app_recom').modal('hide');
                                        tbl_app_prog.draw();

                                    }
                                });
                        }
                        else
                        {
                            swal.fire({
                                title: "Warning!",
                                text: data.msg,
                                icon: "warning",
                                confirmButtonText: "Ok",
                                confirmButtonColor: '#6658dd',
                                allowOutsideClick: false,
                            });
                        }
                    },'JSON');
                }

              });


        }
        else {
            $('.error-input').filter(":first").focus();
        }

    })

    //
    //Advanced list
    //
    // $('body').on('change','#recom_recom',function(){

    //     if($('#recom_recom').val()==6)
    //     {
    //         $('#auto_enroll_div').show();
    //         var Applicant_ID = $('#Applicant_ID').val();
    //         var ParentProgram_ID =$('#Parent_ID').val();
    //         $.ajax({
    //             url:WebURL+'/auto-enroll',
    //             type:'POST',
    //             dataType: 'text',
    //             cache: false,
    //             data : ({Applicant_ID:Applicant_ID,ParentProgram_ID:ParentProgram_ID}),
    //             success: function (data) {
    //                 $('#auto_enroll_list').html(data);
    //             },
    //             error: function () {
    //                 console.log('error');
    //             }
    //         })

    //     }
    //     else
    //     {
    //         $('#auto_enroll_div').hide();
    //     }

    // })




    //
    //Ratings Modal
    //

    $('#tbl_train_app').on( 'click', '.ratings', function () {
        var data = tbl_train_app.row( $(this).parents('tr') ).data();
        var emp_name = data['LastName'] + ", " + data['FirstName'];
        var isStatus = $("#train_emp_status").val();
        var isRatings=$("#train_emp_ratings").val();
        var status =data['TrainStatus'];
        var ratings =data['Ratings'];
        var remarks =data['Remarks'];
        var TrainApp_ID = data['TrainingApp_ID'];
        var Applicant_ID = data['Applicant_ID'];
        var ParentID = data['Parent_Program_ID'];
        var DeptPosition_ID = data['DeptPosition_ID'];
        var Parent_Program_ID = data['Parent_Program_ID'];
        var Program_ID = data['Program_ID'];
        var Sequence_Program_ID = data['Sequence_Program_ID'];
        $('#modal_app_rating').modal('show');
        $('#app_name_ratings').text(emp_name);
        $('#TrainApp_ID').val(TrainApp_ID);
        $('#Applicant_ID').val(Applicant_ID);
        $('#DeptPosition_ID').val(DeptPosition_ID);
        $('#Parent_Program_ID').val(Parent_Program_ID);
        $('#Program_ID').val(Program_ID);
        $('#Sequence_Program_ID').val(Sequence_Program_ID);

        console.log(data);

        var RateID;
        var RateCount;
        if(ParentID == SCT){RateID = SLT}
        else if(ParentID == SLT){RateID = ACT}
        else if(ParentID == ACT){RateID = AMT}

        $.post(WebURL + '/check-rate',{Applicant_ID:Applicant_ID,Parent_ID:RateID},function(data){
            RateCount = data[0]['RateCount'];
            console.log(RateID,RateCount);

            if(RateCount > 0)
            {
                if(ratings>=76)
                {
                    $('#status_fail').prop('disabled',true);
                }
                else
                {
                    $('#status_passed').prop('disabled',true);
                }
                $('#ratings_app').prop('readonly', true);
            }
            else
            {
                $('#status_passed').prop('disabled',false);
                $('#status_fail').prop('disabled',false);
                $('#ratings_app').prop('readonly', false);
            }
        });



        if (isStatus != 1)
        {
            $('#isStatus').hide();
        }
        else
        {
            if (status==1)
            {
                $('#status_passed').prop('checked',true);
                $('#status_fail').prop('checked',false);
            }
            else if (status==0)
            {
                $('#status_passed').prop('checked',false);
                $('#status_fail').prop('checked',true);
            }
            $('#isStatus').show();
        }
        if (isRatings != 1)
        {
            $('#isRatings').hide();
        }
        else
        {
            $('#isRatings').show();
            $('#ratings_app').val(ratings);
        }



        $('#remarks').val(remarks);

    });


    $('input:radio[name="status_fail"]').change(
        function(){
            if ($(this).is(':checked')) {
                $('#status_passed').prop('checked',false);

                if($('#ratings_app').val() >= PG)
                {
                    $('#ratings_app').val(PG-1);
                }
            }
        });

    $('input:radio[name="status_passed"]').change(
            function(){
                if ($(this).is(':checked')) {
                    $('#status_fail').prop('checked',false);
                    if($('#ratings_app').val() < PG)
                    {
                        $('#ratings_app').val(PG);
                    }
                }
            });


    //
    //Update Ratings APP
    //
    $('body').on('click','#btn_update_ratings', function(e){
        e.preventDefault();
        var error = false;
        var ratings = $('#ratings_app').val();
        var Applicant_ID = $('#Applicant_ID').val();
        var DeptPosition_ID = $('#DeptPosition_ID').val();
        var Parent_Program_ID = $('#Parent_Program_ID').val();
        var Program_ID = $('#Program_ID').val();
        var Sequence_Program_ID = $('#Sequence_Program_ID').val();

        if(ratings < 0 || ratings > 100)
        {
            error = true;
            $('#ratings_app').addClass('error-input');
            $('#ratings_app_error').show();
        }
        else
        {
            $('#ratings_app').removeClass('error-input');
            $('#ratings_app_error').hide();
        }

        if(error == false)
        {
            var formdata = $('#form_app_ratings').serialize();
            $.post(WebURL + '/update-ratings-app',formdata,function(data){
                if(data.num>=0)
                {
                    swal.fire({
                        title: 'Success',
                        text: data.msg,
                        icon: 'success',
                        confirmButtonText: 'Ok',
                        showLoaderOnConfirm: true,
                        allowOutsideClick: false,
                        preConfirm:() => {
                            return new Promise(function(resolve, reject) {
                                if(Sequence_Program_ID.length > 0)
                                {
                                    $.post(WebURL + '/check-eligable', {DeptPosition_ID:DeptPosition_ID,Parent_Program_ID:Parent_Program_ID},function(data)
                                    {
                                        if(data > 0)
                                        {
                                            $.post(WebURL + '/check-train',{Applicant_ID:Applicant_ID},function(data){
                                                if(data[0]['TrainCount'] == 0)
                                                {
                                                    $.post(WebURL + '/check-ratings',{Applicant_ID:Applicant_ID,Program_ID:Program_ID},function(data){
                                                        if(data >= PG)
                                                        {
                                                            $.post(WebURL + '/insert-program-app', {Program_ID:Program_ID,Applicant_ID:Applicant_ID,recom_recom:6,recom_remarks:'Enrolled to the next program'},function(data)
                                                            {
                                                                if(data.num>0)
                                                                {
                                                                    $.post(WebURL + '/train-app',{Program_ID:Sequence_Program_ID,Applicant_ID:Applicant_ID},function(data){
                                                                        if(data.num>0)
                                                                        {

                                                                            swal.fire({
                                                                                title: 'Success',
                                                                                text: data.msg,
                                                                                icon: 'success',
                                                                                confirmButtonText: 'Ok',
                                                                                }).then(function (result) {
                                                                                    if (true) {
                                                                                        $('#modal_app_rating').modal('hide');
                                                                                        tbl_train_app.ajax.reload();
                                                                                    }
                                                                                });
                                                                        }
                                                                        else
                                                                        {
                                                                            swal.fire({
                                                                                title: "Warning!",
                                                                                text: data.msg,
                                                                                icon: "warning",
                                                                                confirmButtonText: "Ok",
                                                                                confirmButtonColor: '#6658dd',
                                                                                allowOutsideClick: false,
                                                                            });
                                                                        }
                                                                    },'JSON');
                                                                }
                                                            })
                                                        }
                                                        else
                                                        {
                                                            $('#modal_app_rating').modal('hide');
                                                            tbl_train_app.ajax.reload();
                                                        }

                                                    })
                                                }
                                                else
                                                {
                                                    $('#modal_app_rating').modal('hide');
                                                    tbl_train_app.ajax.reload();
                                                }
                                            })
                                        }
                                        else
                                        {
                                            $('#modal_app_rating').modal('hide');
                                            tbl_train_app.ajax.reload();
                                        }
                                    })
                                }
                                else
                                {
                                    $('#modal_app_rating').modal('hide');
                                    tbl_train_app.ajax.reload();
                                }

                            });

                        }
                        })


                }
                else
                {
                    swal.fire({
                        title: "Warning!",
                        text: data.msg,
                        icon: "warning",
                        confirmButtonText: "Ok",
                        confirmButtonColor: '#6658dd',
                        allowOutsideClick: false,
                    });
                }
            },'JSON');
        }
    })

    //Auto Pass&Fail based on AVE
    $('body').on('change','#ratings_app',function(){

        if($('#ratings_app').val()>=76)
        {
            $('#status_passed').prop('checked',true);
            $('#status_fail').prop('checked',false);
        }

        else
        {
            $('#status_passed').prop('checked',false);
            $('#status_fail').prop('checked',true);
        }
    })







////
});
