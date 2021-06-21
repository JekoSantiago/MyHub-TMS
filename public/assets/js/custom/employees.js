$(document).ready(function ()
{
    $('#tbl_employees').DataTable({
        processing: true,
        serverSide: true,
        ajax      : {
            url: WebURL + '/employees-table',
            method: 'GET',
            dataType: 'json'
        },
        columns   :[
                {data:"EmployeeNo", render:function(data,type,row)
                {
                    return '<a href="'+WebURL+'/employee-look/'+row.Employee_ID+'" class ="text-danger empdet">'+row.EmployeeNo+'</a>';
                }},
                {data:"Fullname"},
                {data:"DateHired"},
                {data:"Position"},
                {data:"Department"}

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



