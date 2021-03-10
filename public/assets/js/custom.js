
$(function(){

    const ageChecked = 216;

    //Contact Form Validation
    if($('#patientForm').length){

        jQuery.validator.addMethod("filesize", function(value, element, param) {
            var isOptional = this.optional(element),
                file;

            if(isOptional) {
                return isOptional;
            }

            if ($(element).attr("type") === "file") {

                if (element.files && element.files.length) {

                    file = element.files[0];
                    return ( file.size && file.size <= param );
                }
            }
            return false;
        }, "File size must be less than 2MB");



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
                },
                front_picture: {
                    required: false,
                    extension: "jpg|jpeg|png",
                    filesize: 2000000,
                },
                back_picture: {
                    required: false,
                    extension: "jpg|jpeg|png",
                    filesize: 2000000,
                }
            }
        });
    }

    $("#dob").inputmask({
        mask: '99/99/9999',
        placeholder: 'MM/DD/YYYY',
        showMaskOnHover: false,
        showMaskOnFocus: false,
    }).on('change',function(){
        const age = calculate_age($(this).val());
        if (age <= ageChecked) {
            $('.child-relation, .child-relation-cb').removeClass('hideMe');
            $('#parent_name, #relation_name, #parent_checkbox').addClass('required').attr('required', true);
        } else {
            $('.child-relation, .child-relation-cb').addClass('hideMe');
            $('#parent_name, #relation_name, #parent_checkbox').removeClass('required').attr('required', false);
        }
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

    $(document).on('change','.insuranceRadioBtn',function () {
        console.log("9898989",$(this).val());
        if($(this).val() == "Insurance"){
            $('input[name="ins_name"], input[name="group_no"]').addClass('required');
            $('input[name="ins_name"], input[name="group_no"]').attr('required',true);
        }else{
            $('input[name="ins_name"], input[name="group_no"]').removeClass('required');
            $('input[name="ins_name"], input[name="group_no"]').attr('required',false);
        }
    });


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


});

function calculate_age(dob) {
    // var diff_ms = Date.now() - dob.getTime();
    // var age_dt = new Date(diff_ms);
    // return Math.abs(age_dt.getUTCFullYear() - 1970);


    const today = new Date();
    const birthDate = new Date(dob);
    let age = today.getFullYear() - birthDate.getFullYear();
    const m = today.getMonth() - birthDate.getMonth();
    age = age * 12 + m;

    return age;

}
