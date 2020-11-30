@extends('layout.master')

@section('title') LabWork360 @endsection

@section('content')
    <header class="masthead">
        <div class="container">
            <div class="masthead-heading"><a id="paid" href="#apptform" style="font-size: 30px;border: #484343;padding: 5px;border-radius: 10px;background: #f78f1e;color: #2d419a;">Covid-19 RT PCR Test For Traveling</a> </div>
            <div class="masthead-heading"><a id="freeTest" href="#apptform" style="font-size: 30px;border: #484343;padding: 5px;border-radius: 10px;background: #f78f1e;color: #2d419a;">Free Covid-19 PCR Test</a> </div>
            <div class="masthead-heading"><a href="http://labtestezpay.com/" style="font-size: 30px;border: #484343;padding: 5px;border-radius: 10px;background: #f78f1e;color: #2d419a;">For Blood & Other Test Click Here</a> </div>
            <!--<div class="masthead-heading">Rapid Antigen Tests</div>
            <div class="masthead-heading">Blood Test for Antibodies</div> -->
            <!--<div class="masthead-heading">
            <a class="btn btn-dark" style="background: red; border: white; font-size: large; font-weight: 550;" href="#apptform">Covid-19 RT PCR Test For Traveling</a> <br>
            <a class="btn btn-dark" style="background: red; border: white; font-size: large; font-weight: 550;" href="#apptform">Free Covid 19 RT PCR Test</a><br>
            <a class="btn btn-dark" style="background: red; border: white; font-size: large; font-weight: 550;" href="http://labtestezpay.com/">For Blood & Other Test Click Here</a>

            </div> -->

        </div>
    </header>

    <section class="page-section" id="services">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">COVID RT PCR TEST FOR TRAVELING </h2>
                <h3 class="section-subheading text-muted">Coronavirus disease 2019 (COVID-19) is the name of the illness caused by the new strain of coronavirus called SARS-CoV-2. Diagnostic tests detect either the genetic material (RNA) of the virus or viral proteins (antigens) in a sample from the respiratory tract. COVID-19 serologic blood tests detect antibodies produced in response to the SARS-CoV-2infection.</h3>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <!-- <span class="fa-stack fa-4x">
                         <i class="fas fa-circle fa-stack-2x text-primary"></i>
                         <i class="fas fa-shopping-cart fa-stack-1x fa-inverse"></i>
                     </span> -->
                    <h4 class="my-3">RT-PCR</h4>
                    <p class="text-muted">Reverse Transcription Polymerase Chain Reaction (RT-PCR): Most tests to check for current SARS-CoV-2 infection rely on RT-PCR testing to detect the virus's RNA in a respiratory tract sample from a patient. PCR is a laboratory method used for making a very large number of copies of short sections of DNA from a very small sample of DNA so that it can be detected. This process is called "amplifying" the DNA. (See the article on PCR for more details.) The reverse transcription step allows the viral RNA to be converted into DNA so that the PCR technique can be used.</p>
                </div>
                <div class="col-md-4">
                    <!--    <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-laptop fa-stack-1x fa-inverse"></i>
                        </span> -->
                    <h4 class="my-3">Rapid Antigen Tests</h4>
                    <p class="text-muted">These tests detect the viral proteins of SARS-CoV-2 in respiratory samples. The main advantages of antigen tests are that they can provide results in minutes, are simpler than RT-PCR tests to perform, and are sometimes used at the point of care, such as at a health clinic. However, they are not as sensitive as RT-PCR tests, so negative results do not rule out infection.</p>
                </div>
                <div class="col-md-4">
                    <!--  <span class="fa-stack fa-4x">
                         <i class="fas fa-circle fa-stack-2x text-primary"></i>
                         <i class="fas fa-lock fa-stack-1x fa-inverse"></i>
                     </span> -->
                    <h4 class="my-3">Blood Test for Antibodies</h4>
                    <p class="text-muted">These tests detect antibodies produced by the body's immune system in response to SARS-CoV-2. COVID-19 serology tests can tell whether or not you have had the viral infection in the past. However, antibody tests are not the preferred tests to diagnose current infections. Antibodies don’t show up for about 1 to 2 weeks after you first become sick so antibody tests could miss some early infections. (For more general information on antibodies, also called immunoglobulins, see the article on Immunoglobulins.)</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Portfolio Grid-->
    <section class="page-section bg-light" id="apptform">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Create your Appointment</h2>
                <h3 class="section-subheading text-muted">Now you can create your appointment online for the COVID testing.</h3>
            </div>
            <div class="row">



<!-- Appointment Registeration form -->


<div class="col-md-12 py-5 border">
                    <!--<h4 class="pb-4">Please fill with your details</h4> -->
                    <h5 id="pcr_paid" class="pb-4 hideMe" style="color: red">Result for Covid-19 RT PCR tests for travelers in 48 hours is $125, 24 hours $150 and same day result $200</h5>
                    <h5 id="pcr_free" class="pb-4" style="color: red">Free Covid-19 PCR Tests Results in 96 hours. (Not for traveling)</h5>
                    @if (Session::has('success'))
                        <div class="alert alert-success mt-2">
                            {!! Session::get('success') !!}
                        </div>
                    @endif
                    @if (Session::has('error'))
                        <div class="alert alert-danger mt-2">
                            {!! Session::get('error') !!}
                        </div>
                    @endif
                    <form id="patientForm" action="{{ route('store.patient') }}" method="post">
                        @csrf
                        <input type="hidden" id="paid_or_free" name="paid_or_free" value="0">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input id="first_name" name="first_name" placeholder="First Name" required="required" class="form-control" type="text">
                            </div>
                            <div class="form-group col-md-6">
                                <input id="last_name" name="last_name" placeholder="Last Name" required="required" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="email" name="email_address" class="form-control" required="required" id="email" placeholder="Email">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="email" name="confemail_address" class="form-control" required="required" id="confemail" placeholder="Confirm Email">
                            </div>

                        </div>

                        <div class="form-row">


                            <div class="form-group col-md-6">
                                <input type="text" name="dob" class="form-control" required="required" id="dob" placeholder="Date of Birth">
                            </div>



                            <div class="form-group col-md-6">
                                <select name="gender" id="gender" required="required" class="form-control">
                                    <option value="" selected>Choose gender</option>
                                    <option value="male"> Male</option>
                                    <option value="female"> Female</option>
                                </select>
                            </div>

                        </div>

                        <div class="form-row">


                           <div class="form-group col-md-6">
                                <input id="cell_phone" name="cell_phone" maxlength="12" placeholder="Cell Phone" class="form-control" required="required" type="text">
                            </div>


                            <div class="form-group col-md-6">
                                <input id="landline" name="landline" maxlength="12" placeholder="Alternate phone number" class="form-control" type="text">
                            </div>

                            {{--   <div class="form-group col-md-6">
                                   <select name="countryId" id="countryId" required="required" class="form-control">
                                       <option value="" selected>Select Country</option>
                                       @if(!empty($countries) && count($countries) > 0)
                                           @foreach($countries as $country)
                                               <option value="{{ $country->id }}">{{ $country->name }}</option>
                                           @endforeach
                                       @endif
                                   </select>
                               </div> --}}

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input id="city" name="city" placeholder="City" required="required" class="form-control" type="text">
                            </div>

                            <div class="form-group col-md-6">
                                <select name="stateId" id="stateId" required="required" class="form-control">
                                    <option value="" selected>Select State</option>
                                    @if(!empty($states) && count($states) > 0)
                                        @foreach($states as $state)
                                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input id="zipcode" name="zipcode" placeholder="Zip Code" required="required" class="form-control" type="text">
                            </div>

                            <div class="form-group col-md-6">
                                <select name="locationId" id="locationId" required="required" class="form-control">
                                    <option value="" selected>Select Location</option>
                                    @if(!empty($locations) && count($locations) > 0)
                                        @foreach($locations as $location)
                                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <textarea id="address" name="address" required="required" placeholder="Address" cols="40" rows="2" class="form-control"></textarea>
                            </div>

                            <div class="form-group col-md-6">
                                <input id="appointment" name="appointment" placeholder="Appointment Date" required="required" class="form-control" type="text">
                            </div>
                            <div class="form-group col-md-6">
                                <select class="form-control timeSlotSelect" required name ="timeslot">
                                    <option value =""> Please Select Appointment Time</option>
                                    @foreach($timeSlots as $timeSlot)
<!--                                        --><?php //$disabled = ''; ?>
{{--                                        @foreach($patientsTimeSlotCount as $patientsTime)--}}
{{--                                            @if($patientsTime->total >=3 && $patientsTime->timeslot == $timeSlot)--}}
{{--                                                <?php $disabled = 'disabled'; ?>--}}
{{--                                            @endif--}}
{{--                                        @endforeach--}}
                                        <option value = "{{ $timeSlot }}" > {{ $timeSlot }} </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="form-row hideMe pcr_paid_fields">
                            <div class="form-group col-md-6">
                                <select class="form-control result_type" required name ="result_type">
                                <option value =""> Select Result Delivered Type</option>
                                <!--<option value ="Results delivered in 4 days $100.00"> Results delivered in 4 days $100.00</option> -->
                                <option value ="In 3 days $125"> In 3 days $125</option>
                                <option value ="In 24 hours (next day evening) $150"> In 24 hours (next day evening) $150</option>
                                <option value ="Same day results $200"> Same day results $200</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <input id="flight_datetime" name="flight_datetime" placeholder="Flight Date and Time" class="form-control" type="text">
                            </div>
                        </div>

                      <!--  <div class="form-row">
                            <div class="form-group">
                                <div class="form-group col-md-12">
                                    <label>
                                        Test Price :
                                    </label> </br>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="testprice" value="1">
                                        <span class="form-check-label"> Results delivered in 4 days $100.00 </span>
                                    </label>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="testprice" value="2">
                                        <span class="form-check-label"> In 3 days $125</span>
                                    </label>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="testprice" value="3">
                                        <span class="form-check-label"> In 24 hours (next day evening) $150</span>
                                    </label>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="testprice" value="4">
                                        <span class="form-check-label"> Same day results $200</span>
                                    </label>
                                </div>
                            </div>
                        </div> -->


                        <div class="form-row">
                            <div class="form-group">
                                <div class="form-group col-md-12">
                                    <label>
                                        I would like to receive my result via:
                                    </label> </br>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="is_fax" id="is_fax" value="1">

                                        <div class="form-group col-md-12">
                                            <input id="fax" name="fax" maxlength="12" placeholder="Fax No" class="form-control" type="text">
                                        </div>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="is_email" id="via-email" value="1">

                                        <div class="form-group col-md-12">
                                            <input id="" name="email_cb" placeholder="Email" class="form-control" type="text">
                                        </div>
                                        <!--<div class="form-group col-md-12">
                                            <input id="" name="passcode" maxlength="12" placeholder="Pass Code" class="form-control" type="text">
                                        </div> -->
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="form-group">
                                <div class="form-group col-md-12">
                                    <label>
                                        Bill To :
                                    </label>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="bill_to" value="Insurance">
                                        <span class="form-check-label"> Insurance </span>
                                    </label>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="bill_to" value="Uninsured">
                                        <span class="form-check-label"> Uninsured</span>
                                    </label>

                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input id="ins_name" name="ins_name" placeholder="Insurance Name & Policy" class="form-control" type="text">
                            </div>
                            <div class="form-group col-md-6">
                                <input id="group_no" name="group_no" placeholder="Group No" class="form-control" type="text">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group row col-sm-12">
                                <div class="form-group col-md-6">
                                    <label>
                                        How did you hear about us:
                                    </label>

                                    <select name="hear_about" id="hear_about" class="form-control">
                                        <option value="" selected>Please Select</option>
                                        <option value="familyandfriend"> Family & Friend </option>
                                       <!-- <option value="doctor"> Doctor/Clinic </option> -->
                                        <option value="google"> Google </option>
                                        <option value="bing"> Bing</option>
                                        <option value="yahoo"> Yahoo</option>
                                        <option value="facebook"> Facebook</option>
                                        <option value="youtube"> YouTube</option>
                                        <option value="instagram"> Instagram</option>
                                        <option value="commerical"> Commercial</option>
                                        <!-- <option value="newspaper"> Radio Station/Newspaper Name</option> -->
                                        <option value="other"> Doctor / Clinic / Radio Station / Newspaper / Other</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6 refer_name hideMe">
                                    <label>Refer Name:</label>
                                    <input type="text" value="" class="form-control" name="refer_name" id="refer_name" />
                                </div>

                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                {{-- <div class="form-group"> --}}
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="terms" id="terms" value="1" required>
                                    <label class="form-check-label" for="terms">
                                        <small>By clicking Submit, you agree to our <a href="{{ url('/terms-and-condition') }}">Terms & Conditions.</a></small>
                                    </label>
                                </div>
                                {{--  </div> --}}

                            </div>
                        </div>

                        <div class="form-row">
                            <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>

@endsection


@push('css')
    <style>
        .hideMe{
            display: none;
        }
    </style>
@endpush


@push('js')
    <script src="{!! asset('assets/js/validate.js') !!}"></script>
    <script type='text/javascript' src="{!! asset('assets/js/inputMask.js') !!}"></script>

    <script>
        $(function () {
            // let disabledDates = [];
{{--            @foreach($disabledDates as $disabledDate)--}}
{{--                console.log('====', {{ $disabledDate }} );--}}
{{--            @endforeach--}}

                let disableDates = @json($disabledDates);

            $('#flight_datetime').datetimepicker({
                format: 'MM/DD/YYYY HH:mm:ss',
            });

            $('#appointment').datetimepicker({
                format: 'MM/DD/YYYY', daysOfWeekDisabled:[0],
                disabledDates: disableDates
            }).on("dp.change", function (e) {
                let formatedValue = e.date.format(e.date._f);
                if(formatedValue != ""){
                    $.ajax({
                        url: "/appointment/date",
                        type: "GET",
                        data: {date: formatedValue},
                        dataType:"json",
                        success: function(response) {
                            if(response.timeSlots != ""){

                                $('.timeSlotSelect').html('');
                                let html = '<option value="">Please Select Appointment Time</option>';
                                $(response.timeSlots).each(function (i,element) {
                                    let disabled = '';
                                    $(response.data).each(function(index,ele){

                                        if(ele.total >= {{ config('site.block_limit') }} && ele.timeslot == element){
                                            disabled = 'disabled';
                                        }
                                    });
                                    html += '<option value="'+element+'" '+disabled+'>'+element+'</option>';
                                });
                                $('.timeSlotSelect').html(html);
                            }
                        },
                        error:function(){

                        }
                    });
                }
            });

            $(document).on('click','#paid',function(){
               $('#flight_datetime, .result_type').val('');
               $('#paid_or_free').val('1');
               $('#pcr_paid,.pcr_paid_fields').removeClass('hideMe');
               $('#pcr_free').addClass('hideMe');
            });

            $(document).on('click','#freeTest',function(){
                $('#paid_or_free').val('0');
               $('#flight_datetime, .result_type').val('');
               $('#pcr_paid,.pcr_paid_fields').addClass('hideMe');
               $('#pcr_free').removeClass('hideMe');
            });


        });
    </script>

@endpush


