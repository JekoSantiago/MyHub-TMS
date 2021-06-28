$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function ()
{

    //
    // Employees table
    //
        var tbl_train_emp1= $('#tbl_train_emp1').DataTable({
        serverSide: true,
        processing: true,
        pageLength : 5,
        lengthMenu: [[5, 10, 20], [5, 10, 20]],
        ajax      : {
            url: WebURL + '/train-employee-tbl1',
            method: 'GET',
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
            {data:"EmployeeNo"},
            {data: "FullName"},
            {data: "DateHired" },
            {data: "Position" },
            {data: "Department" },
            {data: "Division" },
            {data: "Employee_ID",

               render: function (data, type, row)
                {
                    return  ' <a class="action-icon text-info"><i class="mdi mdi-clipboard-plus-outline"></i></a> ';
                },
                className: 'text-center',
             }
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
    // Enlisting and Employee to the Training
    //
    $('#tbl_train_emp1').on( 'click', '.action-icon', function () {
        var data = tbl_train_emp1.row( $(this).parents('tr') ).data();
        var Employee_ID = data['Employee_ID'];
        var Training_ID = $('#training_id').val()
        swal.fire({
            title: 'Are you sure?',
            text: "Enlist the Employee to this Training",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
          }).then((result) => {
              if(result.value)
              {
                        $.post(WebURL + '/train-emp',{Training_ID:Training_ID,Employee_ID:Employee_ID},function(data)
                        {
                            if(data.num>0)
                            {
                                swal.fire({
                                    title: 'Success',
                                    text: data.msg,
                                    icon: 'success',
                                    confirmButtonText: 'Ok'
                                    }).then(function (result) {
                                        if (true) {
                                            tbl_train_emp2.draw() ;
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




    } );

    //
    //List of trainees Employee
    //
    var program=$('#program_name').text();
    var training=$('#training_name').text();
    var tbl_train_emp2 = $('#tbl_train_emp2').DataTable({
        serverSide: false,
        processing: true,
        dom: 'Bfrtip',
        buttons: [
            'copy',
            {extend: 'excelHtml5',
            title: program+" - "+training,
            exportOptions: {
                columns: [ 0,1,2,3,4,5]
            },
            modifier: {
                page: 'all',
                search: 'none'
              }},

        ],
        pageLength : 5,
        lengthMenu: [[5, 10, 20], [5, 10, 20]],
        ajax: {
            url: WebURL + '/train-employee-tbl2',
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
        language: {
            emptyTable: 'No data available.',
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'>",
                next: "<i class='mdi mdi-chevron-right'>"
            },
            processing:'<div class="text-center"><div class="spinner spinner-border"></div></div>'
        },
        columns: [
            {data:"EmployeeNo", render: function(data,type,row)
                {
                    return '<a href="#" class="text-danger ratings">'+row.EmployeeNo+'</a>'
                }},
            {data: "Fullname"},
            {data: "DateHired" },
            {data: "Position" },
            {data: "Department" },
            {data: "Division" },
            {
                render: function (data, type, row)
                 {
                     return  ' <a href="#" class="action-icon text-danger"><i class="mdi mdi-trash-can-outline"></i></a> ';
                 },
                 className: 'text-center',
              }
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
    //Remove from enlisting
    //
    $('#tbl_train_emp2').on( 'click', '.action-icon', function () {

        var data = tbl_train_emp2.row( $(this).parents('tr') ).data();
        var TrainingEmp_ID = data['TrainingEmp_ID'];
        swal.fire({
            title: 'Are you sure?',
            text: "Remove this Employee from the list",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
          }).then((result) => {
              if(result.value)
              {
                        $.post(WebURL + '/train-del',{TrainingEmp_ID:TrainingEmp_ID},function(data)
                        {
                            if(data.num>0)
                            {
                                swal.fire({
                                    title: 'Deleted',
                                    text: "Successfully Removed",
                                    icon: 'success',
                                    confirmButtonText: 'Ok'
                                    }).then(function (result) {
                                        if (true) {
                                            tbl_train_emp2.draw() ;
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

    } );


    //
    //Ratings Modal
    //

    $('#tbl_train_emp2').on( 'click', '.ratings', function () {
        var data = tbl_train_emp2.row( $(this).parents('tr') ).data();
        var emp_name = data['Fullname'];
        var isStatus = $("#train_emp_status").val();
        var isRatings=$("#train_emp_ratings").val();
        var status =data['TrainStatus'];
        var ratings =data['Ratings'];
        var remarks =data['Remarks'];
        var TrainEmp_ID = data['TrainingEmp_ID'];
        $('#modal_emp_rating').modal('show');
        $('#emp_name_ratings').text(emp_name);
        $('#TrainEmp_ID').val(TrainEmp_ID)

        if (isStatus != 1)
        {
            $('#isStatus').hide();
        }
        else
        {
            $('#isStatus').show();
        }
        if (isRatings != 1)
        {
            $('#isRatings').hide();
        }
        else
        {
            $('#isRatings').show();
            $('#ratings_emp').val(ratings);
        }

        if (status==1)
        {
            $('#status_passed').prop('checked',true);
            $('#status_fail').prop('checked',false);
        }

        $('#remarks').text(remarks);

    });

    $('input:radio[name="status_fail"]').change(
        function(){
            if ($(this).is(':checked')) {
                $('#status_passed').prop('checked',false);
            }
        });

    $('input:radio[name="status_passed"]').change(
            function(){
                if ($(this).is(':checked')) {
                    $('#status_fail').prop('checked',false);
                }
            });


    //
    //Update Ratings EMP
    //
    $('body').on('click','#btn_update_ratings', function(e){
        e.preventDefault();
        var error = false;
        var ratings = $('#ratings_emp').val();

        if(ratings < 0 || ratings > 100)
        {
            error = true;
            $('#ratings_emp').addClass('error-input');
            $('#ratings_emp_error').show();
        }
        else
        {
            $('#ratings_emp').removeClass('error-input');
            $('#ratings_emp_error').hide();
        }

        if(error == false)
        {
            var formdata = $('#form_emp_ratings').serialize();
            $.post(WebURL + '/update-ratings-emp',formdata,function(data){
                if(data.num>=0)
                {
                    swal.fire({
                        title: 'Success',
                        text: data.msg,
                        icon: 'success',
                        confirmButtonText: 'Ok',
                        }).then(function (result) {
                            if (true) {
                                $('#modal_emp_rating').modal('hide');
                                tbl_train_emp2.draw();
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
         else
         {
             $('.error-input').filter(":first").focus();
         }
    })

      //Auto Pass/Fail based on AVE
      $('body').on('change','#ratings_emp',function(){

        if($('#ratings_emp').val()>=76)
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
