$(document).ready(function ()
{
    console.log($('#globalToken').val());
    var token = $('#globalToken').val();

    var tbl_trainees = $('#tbl_trainees').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        searching: false,
        ajax      : {
            url: WebURL + '/trainees-table',
            method: 'POST',
            data: function (data) {
                var firstName  = $('#filter_fname').val();
                var middleName = $('#filter_mname').val();
                var lastName   = $('#filter_lname').val();
                var position   = $('#filter_pos').val();

                data.firstName  = firstName;
                data.middleName = middleName;
                data.lastName   = lastName;
                data.position   = position;
                token           = token;
            },
            dataType: 'JSON',
        },
        columns   :[
                {data:"Position"},
                {data:"LastName", render:function(data,type,row)
                {
                    return '<a href="'+WebURL+'/applicant-look/'+row.Applicant_ID+'" class ="text-danger empdet">'+row.LastName+'</a>';
                }},
                {data:"FirstName"},
                {data:"Middlename"},
                {data:"Gender"},
                {data:"Birthdate"},
                {data:"HomeAdd"},
                {data:"Municipal"},
                {data:"Province"}

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


    $('#btn_filter_applicants').on('click',function(){

        tbl_trainees.draw();
        $('#modal_filter_applicants').modal('hide');

    })

    $('#btn_filter_app_reset').on('click',function(){

        $('#filter_fname').val('');
        $('#filter_mname').val('');
        $('#filter_lname').val('');
        $('#filter_pos').val('');
    })


///////////////
});
