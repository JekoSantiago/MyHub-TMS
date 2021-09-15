$(document).ready(function ()
{
    //
    //Trainings datatable Employee
    //

    $('.select2').select2();


    var token = $('#globalToken').val();

    var tbl_trainings_emp = $('#tbl_trainings_emp').DataTable({
        autoWidth: false,
        order: [[3,"asc"]],
        processing: true,
        serverSide: true,
        scrollX: true,
        widthChange: true,
        ajax      : {
            url: WebURL + '/trainings-tables',
            method: 'POST',
            data: function (data) {
                var program  = $('#filter_parent').val();
                var training   = $('#filter_training').val();
                var location  = $('#filter_location').val();
                var traindate  = $('#filter_tdate').val();

                data.program  = program;
                data.training = training;
                data.location = location;
                data.traindate = traindate;
                token        = token;
            },
            dataType: 'JSON',
        },
        columns   :[
                {data:"Program"},
                {data:"Training",render:function(data,type,row){
                    return '<a href="javascript:void(0)" class="text-danger edittrain">'+row.Training+'<a>'
                } },
                {data:"TrainingDate"},
                {data:"Location"},
                {data:"Capacity"},
                {data:"NoOfHours"},
                {
                    render: function (data, type, row) {

                        return  ' <a href="'+WebURL+'/train-employee/'+row.Training_ID+'" class="action-icon text-danger" style = "font-size:14px"><i class="mdi mdi-account-plus"></i>Train Employee</a> ';
                    },
                    className: 'text-center',
                },

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
    });

    $('#btn_filter_trainings').on('click',function(){

        tbl_trainings_emp.draw();
        tbl_trainings_app.draw();
        $('#modal_filter_trainings').modal('hide');

    })

    $('#btn_filter_app_reset').on('click',function(){

        $('#filter_training').val('');
        $('#filter_location').val('');
        $('#filter_tdate').val('');
        $('.select2').val(null).trigger('change');
    })


    //
    //Search Box Session
    //
    if($.session.get("searchBoxE") != null)
    {
    tbl_trainings_emp.search( $.session.get("searchBoxE") ).draw();
    };

    tbl_trainings_emp.on('search.dt', function() {
        var value = $('.dataTables_filter input').val();
        $.session.set("searchBoxE",value);
    });

    //Table trainings applicants
    var tbl_trainings_app = $('#tbl_trainings_app').DataTable({
        autoWidth: false,
        order: [[2,"desc"]],
        processing: true,
        serverSide: true,
        scrollX: true,
        widthChange: true,
        ajax      : {
            url: WebURL + '/trainings-tables',
            method: 'POST',
            data: function (data) {
                var program  = $('#filter_parent').val();
                var training   = $('#filter_training').val();
                var location  = $('#filter_location').val();
                var traindate  = $('#filter_tdate').val();

                data.program  = program;
                data.training = training;
                data.location = location;
                data.traindate = traindate;
                token        = token;
            },
            dataType: 'JSON',
        },
        columns   :[
                {data:"Program",render:function(data,type,row){
                    return '<a href="'+WebURL+'/trainings-program-app/'+row.Program_ID+'" class="text-danger editt">'+row.Program+'<a>'
                }},
                {data:"Training",render:function(data,type,row){
                    return '<a href="javascript:void(0)" class="text-danger edittrain">'+row.Training+'<a>'
                } },
                {data:"TrainingDate"},
                {data:"Location"},
                {data:"Capacity"},
                {data:"NoOfHours"},
                {
                    render: function (data, type, row) {

                        return  ' <a href="'+WebURL+'/train-applicant/'+row.Training_ID+'" class="action-icon text-danger" style = "font-size:14px"><i class="mdi mdi-account-plus"></i>Train Applicant</a> ';
                    },
                    className: 'text-center',
                },

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
    });

    //
    //Search BOX Session
    //
    if ($.session.get("searchBoxA") != null)
    {
    tbl_trainings_app.search( $.session.get("searchBoxA") ).draw();
    }

    tbl_trainings_app.on('search.dt', function() {
        var value = $('.dataTables_filter input').val();
        $.session.set("searchBoxA",value);
    });

    //
    // Edit Training Modal
    //
    $('body').on('click','.edittrain',function(e){
        var data = null;
         emp = tbl_trainings_emp.row( $(this).parents('tr') ).data();
         app = tbl_trainings_app.row( $(this).parents('tr') ).data();
        if (emp == undefined)
        {
            data = app;
        }
        else if (app == undefined)
        {
            data = emp;
        }
        console.log(data);
        var programID = data['Program_ID'];
        var training = data['Training'];
        var trainingDate = data['TrainingDate'];
        var trainingID = data['Training_ID'];
        var trainingDesc = data['TrainingDesc'];
        var capacity = data['Capacity'];
        var locID = data['Location_ID'];
        var storeID = data['Store_ID'];
        var hrs = data['NoOfHours'];
        var dcID = data['DC_ID'];
        var provID = data['LocProv_ID'];
        var status = data['TrainStatus'];
        var ratings = data['Ratings'];
        var isOpen = data['isOpen'];

        $('#modal_edit_training').modal('show');


        $.ajax({
            url:WebURL+'/get-programs',
            type:'POST',
            data:{token:token},
            dataType: 'text',
            cache: false,
            success: function (data) {
                $('#edit_program_training').html(data);
                $('#edit_program_training').val(programID);
            },
            error: function (e) {
                console.log(e);
            }
        });

        $('#edit_training_id').val(trainingID);
        $('#edit_training').val(training);
        $('#edit_training_date').val(trainingDate);
        $('#edit_training_description').val(trainingDesc);
        $('#edit_hrs_training').val(hrs);

        if(status > 0)
        {
            $('#edit_training_status').prop('checked',true);
        }
        else
        {
            $('#edit_training_status').prop('checked',false);

        }

        if(ratings > 0)
        {
            $('#edit_training_ratings').prop('checked',true);

        }
        else
        {
            $('#edit_training_ratings').prop('checked',false);

        }

        if (locID > 0)
        {
            $('div.opt select').val('1');
            $('.hub').show();
            $('.storeloc').hide();

            $.ajax({
                url:WebURL+'/get-locations',
                type:'GET',
                dataType: 'text',
                cache: false,
                success: function (data) {
                    $('#edit_location_training').html(data);
                    $('#edit_location_training').val(locID);
                },
                error: function (e) {
                    console.log(e);
                }
            })

            $('#edit_capacity_training').val(capacity);

        }
        else if (storeID > 0)
        {
            $('div.opt select').val('2');
            $('.hub').hide();
            $('.storeloc').show();

            $.ajax({
                url:WebURL+'/get-dc',
                type:'GET',
                dataType: 'text',
                cache: false,
                success: function (data) {
                    $('#edit_DC').html(data);
                    $('#edit_DC').val(dcID);
                },
                error: function (e) {
                    console.log(e);
                }
            })

            $.ajax({
                url:WebURL+'/get-prov/'+dcID,
                    type:'POST',
                    dataType: 'text',
                    cache: false,
                    success: function (data) {
                        $('#edit_prov').html(data);
                        $('#edit_prov').val(provID);
                    },
                    error: function () {
                        console.log('error');
                    }
            })

            $.ajax({
                url:WebURL+'/get-store',
                    type:'POST',
                    dataType: 'text',
                    cache: false,
                    data : ({dc:dcID,prov:provID}),
                    success: function (data) {
                        $('#edit_store').html(data);
                        $('#edit_store').val(storeID);
                    },
                    error: function () {
                        console.log('error');
                    }
            })

        }





    })



    //
    //Show modal new training
    //
    $('#modal_new_training').on('show.bs.modal', function (e) {

        var remoteLink = WebURL + '/trainings-new';
        var formdata = $('#form_new_training').serialize();

        $("#modal_new_training").find('.modal-body').html('<div class="text-center"><div class="spinner spinner-border"></div></div>');
        $('#modal_new_training').find('.modal-body').load(remoteLink, formdata, function () {

            $('.filter-flatpickr').flatpickr({
                dateFormat: 'Y-m-d'
            });

            $('.select2').select2();

            $('.select2-no-search').select2({
                minimumResultsForSearch: -1
            });
        })
    });


    //
    //capacity on new training
    //
    $('body').on('change','#new_location_training',function(){
        var cap =$(this).find('option:selected').attr("name");
        $('#new_capacity_training').val(cap)
    });

    //
    //DC on new training
    //

    $('body').on('change','#new_loc_type',function(){

        if($('#new_loc_type').val()==2)
        {
            $('.storeloc').show();
            $('.hub').hide();
            $('#new_location_training').val($("#new_location_training option:first").val());
            $('#new_capacity_training').val(0);
            $.ajax({
                url:WebURL+'/get-dc',
                type:'GET',
                dataType: 'text',
                cache: false,
                success: function (data) {
                    $('#new_DC').html(data);
                    // $('#edit_prov).html('<option></option>');
                },
                error: function () {
                    console.log('error');
                }
            })

        }
        else if($('#new_loc_type').val()==1)
        {
            $('.hub').show();
            $('.storeloc').hide();
            $('#new_DC').val($("new_DC option:first").val());
            $('#new_prov').val($("new_DC option:first").val());
            $('#new_store').val($("new_DC option:first").val());

        }

        else
        {
            $('.hub').hide();
            $('.storeloc').hide();
            $('#new_location_training').val($("#new_location_training option:first").val());
            $('#new_capacity_training').val(0);
            $('#new_DC').val($("new_DC option:first").val());
            $('#new_prov').val($("new_DC option:first").val());
            $('#new_store').val($("new_DC option:first").val());

        }

    })

    //
    //Province on New Training
    //
    $('body').on('change','#new_DC',function(){
        var dc = $('#new_DC').val()
        $.ajax({
            url:WebURL+'/get-prov/'+dc,
                type:'POST',
                dataType: 'text',
                cache: false,
                success: function (data) {
                    $('#new_prov').html(data);
                    $('#new_store').html('<option></option>');
                },
                error: function () {
                    console.log('error');
                }
        })
    })

    //
    //Store on new training
    //
    $('body').on('change','#new_prov',function(){

        var prov = $('#new_prov').val();
        var dc = $('#new_DC').val();

        $.ajax({
            url:WebURL+'/get-store',
                type:'POST',
                dataType: 'text',
                cache: false,
                data : ({dc:dc,prov:prov}),
                success: function (data) {
                    $('#new_store').html(data);
                    // $('#edit_prov).html('<option></option>');
                },
                error: function () {
                    console.log('error');
                }
        })

    })




    // checkbox value

    if ($('#new_traning_status').is (':checked'))
    {
        $('new_traning_status').val('1');
    }
    if ($('#new_traning_ratings').is (':checked'))
    {
        $('new_traning_ratings').val('1');
    }


    // add new training

    $('body').on('click','#btn_add_training', function(e){

        var error = false;
        var training= $('#new_training').val();
        var training_desc = $('#new_training_description').val();
        var training_date = $('#new_training_date').val();
        var tdate = new Date(training_date);
        var today  = new Date();
        var locations = $('#new_location_training').val();
        var program = $('#new_program_training').val();
        var hrs = $('#new_hrs_training').val();
        var loctype = $('#new_loc_type').val();
        var dc = $('#new_DC').val();
        var prov = $('#new_prov').val();
        var store =$('#new_store').val();

        if(hrs<=0)
        {
            var error = true;
            $('#new_hrs_training').addClass('error-input');
            $('#new_hrs_training_error').show();

        }
        else
        {


            $('#new_hrs_training').removeClass('error-input');
            $('#new_hrs_training_error').hide();

        }


        if(program.length<=1)
        {
            var error = true;
            $('#new_program_training').addClass('error-input');
            $('#new_program_training_error').show();

        }
        else
        {


            $('#new_program_training').removeClass('error-input');
            $('#new_program_training_error').hide();

        }

        if(training.length<=1)
        {
            var error = true;
            $('#new_training').addClass('error-input');
            $('#new_training_error').show();

        }
        else
        {


            $('#new_training').removeClass('error-input');
            $('#new_training_error').hide();

        }
        if(training_desc.length==0)
        {
            var error = true;
            $('#new_training_description').addClass('error-input');
            $('#new_training_description_error').show();

        }
        else
        {


            $('#new_training_description').removeClass('error-input');
            $('#new_training_description_error').hide();

        }

        if(training_date.length==0)
        {
            var error = true;
            $('#new_training_date').addClass('error-input');
            $('#new_training_date_error').show();

        }
        else
        {

            if (tdate<today)
            {
                var error = true;
                $('#new_training_date').addClass('error-input');
                $('#new_training_date_error').show();

            }
            else
            {
                $('#new_training_date').removeClass('error-input');
                $('#new_training_date_error').hide();
            }

        }

        if(loctype==0)
        {
            var error = true;
            $('#new_loc_type').addClass('error-input');
            $('#new_loc_type_error').show();
        }
        else
        {
            $('#new_loc_type').removeClass('error-input');
            $('#new_loc_type_error').hide();
        }


        if(locations==0 && loctype ==1 )
        {
            var error = true;
            $('#new_location_training').addClass('error-input');
            $('#new_location_training_error').show();
        }
        else
        {

            $('#new_location_training').removeClass('error-input');
            $('#new_location_training_error').hide();
        }

        if(dc==0 && loctype ==2)
        {
            var error = true;
            $('#new_DC').addClass('error-input');
            $('#new_DC_error').show();
        }
        else
        {
            $('#new_DC').removeClass('error-input');
            $('#new_DC_error').hide();
        }

        if(dc==0 && loctype ==2)
        {
            var error = true;
            $('#new_DC').addClass('error-input');
            $('#new_DC_error').show();
        }
        else
        {
            $('#new_DC').removeClass('error-input');
            $('#new_DC_error').hide();
        }

        if(prov==0 && loctype ==2)
        {
            var error = true;
            $('#new_prov').addClass('error-input');
            $('#new_prov_error').show();
        }
        else
        {
            $('#new_prov').removeClass('error-input');
            $('#new_prov_error').hide();
        }


        if(store==0 && loctype ==2)
        {
            var error = true;
            $('#new_store').addClass('error-input');
            $('#new_store_error').show();
        }
        else
        {
            $('#new_store').removeClass('error-input');
            $('#new_store_error').hide();
        }


        $(document).on({
            ajaxStart: function(){
                $("body").addClass("loading");
            },
            ajaxStop: function(){
                $("body").removeClass("loading");
            }
        });

        if (error == false)
        {
            swal.fire({
                title: 'Are you sure?',
                text: "Adding the new Trainings",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
              }).then((result) => {
                if(result.value)
                {

                        var formdata = $('#form_new_training').serialize();
                        $.post(WebURL + '/trainings-store',formdata,function(data){
                        if(data.num>0)
                        {
                            //EMAIL SENDING
                            // var trainID = data.num;
                            // $.post(WebURL + '/email-create',{trainingID:trainID,action:'create'})
                            //
                            swal.fire({
                                title: 'Success',
                                text: data.msg,
                                icon: 'success',
                                confirmButtonText: 'Ok',
                                }).then(function (result) {
                                    if (true) {
                                        $('#modal_new_training').modal('hide');
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


    });





///////////////
});
