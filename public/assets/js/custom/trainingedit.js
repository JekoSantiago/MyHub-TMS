$( document ).ready(function() {


    //
    //capacity on edit training
    //
    $('body').on('change','#edit_location_training',function(){
        var cap =$(this).find('option:selected').attr("name");
        $('#edit_capacity_training').val(cap)
    });

    $('body').on('change','#edit_DC',function(){
        $('#edit_store').html('<option></option>');
    });




    $('body').on('change','#edit_loc_type',function(){

        if($('#edit_loc_type').val()==2)
        {
            $('.storeloc').show();
            $('.hub').hide();
            $('#edit_location_training').val($("#edit_location_training option:first").val());
            $('#edit_capacity_training').val(0);
            $.ajax({
                url:WebURL+'/get-dc',
                type:'GET',
                dataType: 'text',
                cache: false,
                success: function (data) {
                    $('#edit_DC').html(data);
                    // $('#edit_prov).html('<option></option>');
                },
                error: function () {
                    console.log('error');
                }
            })

        }
        else if($('#edit_loc_type').val()==1)
        {
            $('.hub').show();
            $('.storeloc').hide();
            $('#edit_DC').val($("edit_DC option:first").val());
            $('#edit_prov').val($("edit_DC option:first").val());
            $('#edit_store').val($("edit_DC option:first").val());

        }

        else
        {
            $('.hub').hide();
            $('.storeloc').hide();
            $('#edit_location_training').val($("#edit_location_training option:first").val());
            $('#edit_capacity_training').val(0);
            $('#edit_DC').val($("edit_DC option:first").val());
            $('#edit_prov').val($("edit_DC option:first").val());
            $('#edit_store').val($("edit_DC option:first").val());

        }

    })

    //
    //Province on edit Training
    //
    $('body').on('change','#edit_DC',function(){
        var dc = $('#edit_DC').val()

        $.ajax({
            url:WebURL+'/get-prov/'+dc,
                type:'POST',
                dataType: 'text',
                cache: false,
                success: function (data) {
                    $('#edit_prov').html(data);
                    // $('#edit_prov).html('<option></option>');
                },
                error: function () {
                    console.log('error');
                }
        })
    })

    //
    //Store on edit training
    //
    $('body').on('change','#edit_prov',function(){

        var prov = $('#edit_prov').val();
        var dc = $('#edit_DC').val();

        $.ajax({
            url:WebURL+'/get-store',
                type:'POST',
                dataType: 'text',
                cache: false,
                data : ({dc:dc,prov:prov}),
                success: function (data) {
                    $('#edit_store').html(data);
                    // $('#edit_prov).html('<option></option>');
                },
                error: function () {
                    console.log('error');
                }
        })

    })


         //
    //Update Training
    //
    $('body').on('click','#btn_update_training', function(e){

        var error = false;
        var training= $('#edit_training').val();
        var training_desc = $('#edit_training_description').val();
        var training_date = $('#edit_training_date').val();
        var tdate = new Date(training_date);
        var today  = new Date();
        var locations = $('#edit_location_training').val();
        var program = $('#edit_program_training').val();
        var hrs = $('#edit_hrs_training').val();
        var loctype = $('#edit_loc_type').val();
        var dc = $('#edit_DC').val();
        var prov = $('#edit_prov').val();
        var store =$('#edit_store').val();
        var open = $('#edit_isOpen').val();


        if(hrs<=0)
        {
            var error = true;
            $('#edit_hrs_training').addClass('error-input');
            $('#edit_hrs_training_error').show();

        }
        else
        {


            $('#edit_hrs_training').removeClass('error-input');
            $('#edit_hrs_training_error').hide();

        }


        if(program.length==0)
        {
            var error = true;
            $('#edit_program_traning').addClass('error-input');
            $('#edit_program_traning_error').show();

        }
        else
        {


            $('#edit_program_traning').removeClass('error-input');
            $('#edit_program_traning_error').hide();

        }

        if(training.length<=1)
        {
            var error = true;
            $('#edit_training').addClass('error-input');
            $('#edit_training_error').show();

        }
        else
        {


            $('#edit_training').removeClass('error-input');
            $('#edit_training_error').hide();

        }
        if(training_desc.length==0)
        {
            var error = true;
            $('#edit_training_description').addClass('error-input');
            $('#edit_training_description_error').show();

        }
        else
        {


            $('#edit_training_description').removeClass('error-input');
            $('#edit_training_description_error').hide();

        }
        if(training_date.length==0)
        {
            var error = true;
            $('#edit_training_date').addClass('error-input');
            $('#edit_training_date_error').show();

        }
        else
        {

            if (tdate<today)
            {
                var error = true;
                $('#edit_training_date').addClass('error-input');
                $('#edit_training_date_error').show();

            }
            else
            {
                $('#edit_training_date').removeClass('error-input');
                $('#edit_training_date_error').hide();
            }

        }
        if(loctype==0)
        {
            var error = true;
            $('#edit_loc_type').addClass('error-input');
            $('#edit_loc_type_error').show();
        }
        else
        {
            $('#edit_loc_type').removeClass('error-input');
            $('#edit_loc_type_error').hide();
        }


        if(locations==0 && loctype ==1 )
        {
            var error = true;
            $('#edit_location_training').addClass('error-input');
            $('#edit_location_training_error').show();
        }
        else
        {

            $('#edit_location_training').removeClass('error-input');
            $('#edit_location_training_error').hide();
        }

        if(dc==0 && loctype ==2)
        {
            var error = true;
            $('#edit_DC').addClass('error-input');
            $('#edit_DC_error').show();
        }
        else
        {
            $('#edit_DC').removeClass('error-input');
            $('#edit_DC_error').hide();
        }

        if(dc==0 && loctype ==2)
        {
            var error = true;
            $('#edit_DC').addClass('error-input');
            $('#edit_DC_error').show();
        }
        else
        {
            $('#edit_DC').removeClass('error-input');
            $('#edit_DC_error').hide();
        }

        if(prov==0 && loctype ==2)
        {
            var error = true;
            $('#edit_prov').addClass('error-input');
            $('#edit_prov_error').show();
        }
        else
        {
            $('#edit_prov').removeClass('error-input');
            $('#edit_prov_error').hide();
        }


        if(store==0 && loctype ==2)
        {
            var error = true;
            $('#edit_store').addClass('error-input');
            $('#edit_store_error').show();
        }
        else
        {
            $('#edit_store').removeClass('error-input');
            $('#edit_store_error').hide();
        }


        if (error == false)
        {

            swal.fire({
                title: 'Are you sure?',
                text: "Updating the training",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
              }).then((result) => {
                if(result.value)
                {
                        var formdata = $('#form_edit_training').serialize();
                        $.post(WebURL + '/trainings-update',formdata,function(data){
                        if(data.num>=0)
                        {
                            //EMAIL SENDING
                            if(open == 1)
                            {
                            var trainID = data.num;
                            console.log(trainID);
                            $.post(WebURL + '/email-create',{trainingID:trainID,action:'open'});
                            console.log('emailsent');
                            }
                            //
                            swal.fire({
                                title: 'Success',
                                text: data.msg,
                                icon: 'success',
                                confirmButtonText: 'Ok',
                                }).then(function (result) {
                                    if (true) {
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






///
});
