$(document).ready(function ()
{
    console.log($('#globalToken').val());
    var token = $('#globalToken').val();

    $('#tbl_trainees').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        ajax      : {
            url: WebURL + '/trainees-table',
            method: 'POST',
            data: {token:token},
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



///////////////
});
