$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
   var tblEmployeeDet = $('#tbl_emp_det').DataTable({
        serverSide: true,
        processing: true,
        ajax: {
            url: WebURL + '/employee-details-table',
            method: 'POST',
            datatype: 'json',
            data: function (d) {
                return $.extend({}, d, {
                    "_token": $("#tokenfield").val(),
                    "Employee_ID": $("#emp_det_id").val()
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
            {data: "Program" },
            {data: "Training"},
            {data: "NoOfHours"},
            {data: "TrainingDate" },
            {data: "Location" },
            {data: "Status" },
            {data: "Ratings" },
            {data: "Remarks" }
        ],
        drawCallback: function () {
            $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
        },

    });


