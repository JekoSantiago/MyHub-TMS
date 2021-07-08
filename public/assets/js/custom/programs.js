
$(document).ready(function ()
{
    var tbl_programs = $('#tbl_programs').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        ajax      : {
            url: WebURL + '/programs-table',
            method: 'GET',
        },
        columns   :[
                {data: "ParentProgram"},
                {data:"Program",render:function(data, type, row){
                    return '<a href="javascript:void(0) "class="text-danger editprogram">'+row.Program+'</a>'}},
                {render:function(data,type,row){

                    var button =  (row.isComplete > 0) ? '<button type="button" class="btn btn-warning complete" disabled >CLOSED</button>' : '<button type="button" class="btn btn-warning complete">CLOSE</button>'
                    return button;
                }}
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


    if ($.session.get("searchBoxP") != null)
    {
        tbl_programs.search( $.session.get("searchBoxP") ).draw();
    }
    tbl_programs.on('search.dt', function() {
        var value = $('.dataTables_filter input').val();
        $.session.set("searchBoxP",value);
    });


    //
    //Show Modal New Programm
    //
    $('#modal_new_program').on('show.bs.modal', function (e) {

        var remoteLink = WebURL + '/programs-new';
        var formdata = $('#form_new_program').serialize();

        $("#modal_new_program").find('.modal-body').html('<div class="text-center"><div class="spinner spinner-border"></div></div>');
        $('#modal_new_program').find('.modal-body').load(remoteLink, formdata, function(){
            $('.select2').select2();

            $('.select2-no-search').select2({
                minimumResultsForSearch: -1
            });
        })
    });


    //
    //Add Program
    //
    $('body').on('click','#btn_add_program', function(e){

        var error = false;
        var parentProgram = $('#new_parent_program').val();
        var program = $('#new_program').val();


        if(program.length<=1)
        {
            var error = true;
            $('#new_program').addClass('error-input');
            $('#new_program_error').show();

        }
        else
        {

            $('#new_program').removeClass('error-input');
            $('#new_program_error').hide();

        }

        if (error == false)
        {
            swal.fire({
                title: 'Are you sure?',
                text: "Adding the new Program",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
              }).then((result) => {
                if(result.value)
                {
                    var formdata = $('#form_new_program').serialize();
                    $.post(WebURL + '/programs-store',formdata,function(data){
                        if(data.num>0)
                        {
                            swal.fire({
                                title: 'Success',
                                text: data.msg,
                                icon: 'success',
                                confirmButtonText: 'Ok',
                                }).then(function (result) {
                                    if (true) {
                                        $('#modal_new_program').modal('hide');
                                        tbl_programs.ajax.reload();
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
        else
        {
            $('.error-input').filter(":first").focus();
        }


    });

    $('body').on('click','.editprogram',function(e){
        var data = tbl_programs.row( $(this).parents('tr') ).data();
        console.log(data);
        var parentProgram = data['ParentProgram'];
        var parentID = data['Parent_Program_ID'];
        var program = data['Program'];
        var programID = data['Program_ID'];
        var seqID = data['Sequence_Program_ID'];
        var progID = parentID;

        (seqID>0) ? $('#seqlist').show() : $('#seqlist').hide()

        $.ajax({
            url:WebURL+'/get-programs',
            type:'GET',
            dataType: 'text',
            cache: false,
            success: function (data) {
                $('#edit_parent_program').html(data);
                $('#edit_parent_program').val(parentID);
            },
            error: function (e) {
                console.log(e);
            }
        });

        $.ajax({
            url:WebURL+'/get-sequence',
            type:'post',
            dataType: 'text',
            data:{progID},
            cache: false,
            success: function (data) {
                console.log(data);
                if(data.length > 0)
                {
                    $('#seqlist').show();
                    $('#edit_seq_program').html(data);
                    $('#edit_seq_program').val(seqID);
                }
            },
            error: function (e) {
                console.log(e);
            }
        });

        $('#edit_program_id').val(programID);
        $('#edit_program').val(program);

        $('#modal_edit_program').modal('show');

    })


    //
    //Update Program
    //
    $('body').on('click','#btn_update_program', function(e){

        var error = false;
        var parentProgram = $('#edit_parent_program').val();
        var program = $('#edit_program').val();


        if(program.length<=1)
        {
            var error = true;


            $('#edit_program').addClass('error-input');
            $('#edit_program_error').show();

        }
        else
        {


            $('#edit_program').removeClass('error-input');
            $('#edit_program_error').hide();

        }

        if (error == false)
        {
            swal.fire({
                title: 'Are you sure?',
                text: "Updating the Program",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
              }).then((result) => {
                if(result.value)
                {
                    var formdata = $('#form_edit_program').serialize();
                    $.post(WebURL + '/programs-update',formdata,function(data){
                        if(data.num>=0)
                        {
                            swal.fire({
                                title: 'Success',
                                text: data.msg,
                                icon: 'success',
                                confirmButtonText: 'Ok'
                                }).then(function (result) {
                                    if (true) {
                                        $('#modal_edit_program').modal('hide');
                                        tbl_programs.ajax.reload();
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

                });
        }
        else {
            $('.error-input').filter(":first").focus();
        }


    })

    if ($('#edit_parent_program').val()!="")
    {
        $('#prog_ast').show();
    }
    else
    {
        $('#prog_ast').hide();
    }


    $('body').on('change','#new_parent_program',function(){
        console.log($('#new_parent_program').val());
        progID = $('#new_parent_program').val();

        $.ajax({
            url:WebURL+'/get-sequence',
            type:'post',
            dataType: 'text',
            data:{progID},
            cache: false,
            success: function (data) {
                // console.log(data);
                if(data.length > 0)
                {
                    $('#seqlist').show();
                    $('#new_seq_program').html(data);
                }
                else
                {
                    $('#seqlist').hide();

                }

            },
            error: function (e) {
                console.log(e);
            }
        });
    })

    $('body').on('change','#edit_parent_program',function(){
        console.log($('#edit_parent_program').val());
        progID = $('#edit_parent_program').val();


        $.ajax({
            url:WebURL+'/get-sequence',
            type:'post',
            dataType: 'text',
            data:{progID},
            cache: false,
            success: function (data) {
                // console.log(data);
                if(data.length > 0)
                {
                    $('#seqlist').show();
                    $('#edit_seq_program').html(data);
                    $('#edit_seq_program').val()
                }
                else
                {
                    $('#seqlist').hide();

                }
            },
            error: function (e) {
                console.log(e);
            }
        });
    })

    $('body').on('change','#edit_parent_program',function(){
        console.log($('#edit_parent_program').val());
        progID = $('#edit_parent_program').val();

        $.ajax({
            url:WebURL+'/get-sequence',
            type:'post',
            dataType: 'text',
            data:{progID},
            cache: false,
            success: function (data) {
                // console.log(data);
                if(data.length > 0)
                {
                    $('#seqlist').show();
                    $('#edit_seq_program').html(data);
                }
                else
                {
                    $('#seqlist').hide();

                }

            },
            error: function (e) {
                console.log(e);
            }
        });
    })


    $('body').on('click','.complete',function(){
        var data = tbl_programs.row( $(this).parents('tr') ).data();
        var Program_ID = data['Program_ID'];

        swal.fire({
            title: 'Are you sure?',
            text: "Completing the Program",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            showLoaderOnConfirm: true,
            preConfirm:(done) =>
            {
                $.post(WebURL + '/recruitment-notif',{Program_ID:Program_ID},function(data){
                    if(data.num>=0)
                    {
                        swal.fire({
                            title: 'Success',
                            text: data.msg,
                            icon: 'success',
                            confirmButtonText: 'Ok'
                            }).then(function (result) {
                                if (true) {
                                    tbl_programs.ajax.reload();
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
                })

            }
          })
    })


///////////
});
