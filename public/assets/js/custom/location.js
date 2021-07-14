$(document).ready(function ()
{
    //Data table Locations
    var tbl_location = $('#tbl_locations').DataTable({
        processing: true,
        serverSide: true,
        ajax      : {
            url: WebURL + '/locations-table',
            method: 'GET',
        },
        columns   :[
            {data:"Location",render:function(data, type, row){
                return '<a href="javascript:void(0)" class="text-danger editlocation">'+row.Location+'</a>'}},
            {data: "DC"},
            {data:"Capacity"}
        ],
        language: {
            emptyTable: 'No data available.',
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'>",
                next: "<i class='mdi mdi-chevron-right'>"
            },
            processing:'<div class="text-center"><div class="spinner spinner-border"></div></div>'
        },
        drawCallback: function () {
            $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
        },
    });


    //Show Add Location Modal
    $('#modal_new_location').on('show.bs.modal', function (e) {

        var remoteLink = WebURL + '/locations-new';
        var formdata = $('#form_new_location').serialize();

        $("#modal_new_location").find('.modal-body').html('<div class="text-center"><div class="spinner spinner-border"></div></div>');
        $('#modal_new_location').find('.modal-body').load(remoteLink, formdata)

        $('.select2-no-search').select2({
            minimumResultsForSearch: -1
        });

        $.ajax({
            url:WebURL+'/get-dc',
            type:'GET',
            dataType: 'text',
            cache: false,
            success: function (data) {
                $('#new_dc').html(data);
            },
            error: function () {
                console.log('error');
            }
        })

    });

    //Add new Location
    $('body').on('click','#btn_add_location', function(e){

        var error = false;
        var location = $('#new_location').val();
        var capacity = $('#new_capacity').val();
        var DC_ID = $('#new_dc').val();
        console.log(DC_ID);

        if(location.length<=1)
        {
            var error = true;
            $('#new_location').addClass('error-input');
            $('#new_location_error').show();
        }
        else
        {

            $('#new_location').removeClass('error-input');
            $('#new_location_error').hide();
        }

        if(DC_ID.length<=0)
        {
            var error = true;
            $('#new_dc').addClass('error-input');
            $('#new_dc_error').show();
        }
        else
        {

            $('#new_dc').removeClass('error-input');
            $('#new_dc_error').hide();
        }

        if(capacity<=0)
        {
            var error = true;
            $('#new_capacity').addClass('error-input');
            $('#new_capacity_error').show();
        }
        else
        {

            $('#new_capacity').removeClass('error-input');
            $('#new_capacity_error').hide();
        }

        if (error == false)
        {
            swal.fire({
                title: 'Are you sure?',
                text: "Adding the new Location",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
              }).then((result) => {
                if(result.value)
                {
                    var formdata = $('#form_new_location').serialize();
                    $.post(WebURL + '/locations-store',formdata,function(data){
                        if(data.num>0)
                        {
                            swal.fire({
                                title: 'Success',
                                text: data.msg,
                                icon: 'success',
                                confirmButtonText: 'Ok'
                                }).then(function (result) {
                                    if (true) {
                                        $('#modal_new_location').modal('hide');
                                        tbl_location.draw() ;
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


    });

    $('body').on('click','.editlocation', function(e){
        var data = tbl_location.row( $(this).parents('tr') ).data();
        console.log(data);
        var loc = data['Location'];
        var locID = data['Location_ID'];
        var capacity = data['Capacity'];
        var DC_ID = data['DC_ID']

        $('#modal_edit_location').modal('show');

        $('#edit_location_ID').val(locID);
        $('#edit_location').val(loc);
        $('#edit_capacity').val(capacity);

        $.ajax({
            url:WebURL+'/get-dc',
            type:'GET',
            dataType: 'text',
            cache: false,
            success: function (data) {
                $('#edit_dc').html(data);
                $('#edit_dc').val(DC_ID);

            },
            error: function () {
                console.log('error');
            }
        })





    });

    //
    //Update Location
    //
    $('body').on('click','#btn_update_location', function(e){

        var error = false;
        var location = $('#edit_location').val();
        var capacity = $('#edit_capacity').val();

        console.log(location.length);

        if(location.length<=1)
        {
            var error = true;
            $('#edit_location').addClass('error-input');
            $('#edit_location_error').show();
        }
        else
        {

            $('#edit_location').removeClass('error-input');
            $('#edit_location_error').hide();
        }

        if(capacity<=0)
        {
            var error = true;
            $('#edit_capacity').addClass('error-input');
            $('#edit_capacity_error').show();
        }
        else
        {

            $('#edit_capacity').removeClass('error-input');
            $('#edit_capacity_error').hide();
        }

        if (error == false)
        {
            swal.fire({
                title: 'Are you sure?',
                text: "Updating the Location",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
              }).then((result) => {
                if(result.value)
                {
                    var formdata = $('#form_edit_location').serialize();
                    $.post(WebURL + '/locations-update',formdata,function(data){
                        if(data.num>0)
                        {
                            swal.fire({
                                title: 'Success',
                                text: data.msg,
                                icon: 'success',
                                confirmButtonText: 'Ok'
                                }).then(function (result) {
                                    if (true) {
                                        $('#modal_edit_location').modal('hide');
                                        tbl_location.draw() ;
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










/////////
});
