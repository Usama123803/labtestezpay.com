
$(function(){
    //Contact Form Validation
    if($('#patientForm').length){
        $('#patientForm').validate({
            rules: {
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                email_address: {
                    required: true,
                    email: true
                },
                confemail_address : {
                    required: true,
                    email: true,
                    equalTo: "#email"

                },
                dob: {
                    required: true
                },
                gender: {
                    required: true
                },
                cell_phone: {
                    required: true
                },
                // countryId: {
                //     required: true
                // },
                city: {
                    required: true
                },
                stateId: {
                    required: true
                },
                zipcode: {
                    required: true
                },
                locationId: {
                    required: true
                },
                address: {
                    required: true
                },
                appointment: {
                    required: true
                },
                term: {
                    required: true
                }
            }
        });
    }


    $('#dob').datetimepicker({
        format: 'MM/DD/YYYY'
    });

    $("#cell_phone").inputmask({
        mask: '999-999-9999',
        placeholder: ' ',
        showMaskOnHover: false,
        showMaskOnFocus: false,
    });

    $("#landline").inputmask({
        mask: '999-999-9999',
        placeholder: ' ',
        showMaskOnHover: false,
        showMaskOnFocus: false,
    });

    $(document).on('change','#hear_about',function(){
       const referName =  $(this).val();
        $('#refer_name').val('');
        if(referName == 'other'){
            $('.refer_name').removeClass('hideMe');
        }else{
            $('.refer_name').addClass('hideMe');
        }
    });

    //$(document).on('change','#paid',function(){
      // const pcrPaid =  $(this).val();
        //$('#pcr_paid').val('');
        //if(pcrPaid == '1'){
          //  $('.refer_name').removeClass('hideMe');
       // }else{
        //    $('.refer_name').addClass('hideMe');
        //}
   // });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


});
