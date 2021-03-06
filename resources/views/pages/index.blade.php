@extends('layout.master')

@section('title') LabWork360 @endsection

@section('content')
    <header class="masthead">
        <div class="container">
            <div class="masthead-heading"><a id="paid" href="#apptform"
                                             style="font-size: 30px;border: #484343;padding: 5px;border-radius: 10px;background: #f78f1e;color: #2d419a;">Covid-19
                    RT PCR Test For Traveling</a></div>
            <div class="masthead-heading"><a id="freeTest" href="#apptform"
                                             style="font-size: 30px;border: #484343;padding: 5px;border-radius: 10px;background: #f78f1e;color: #2d419a;">Free
                    Covid-19 PCR Test</a></div>
            <div class="masthead-heading"><a href="http://labtestezpay.com/"
                                             style="font-size: 30px;border: #484343;padding: 5px;border-radius: 10px;background: #f78f1e;color: #2d419a;">For
                    Blood & Other Test Click Here</a></div>
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
                <h3 class="section-subheading text-muted">Coronavirus disease 2019 (COVID-19) is the name of the illness
                    caused by the new strain of coronavirus called SARS-CoV-2. Diagnostic tests detect either the
                    genetic material (RNA) of the virus or viral proteins (antigens) in a sample from the respiratory
                    tract. COVID-19 serologic blood tests detect antibodies produced in response to the
                    SARS-CoV-2infection.</h3>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <!-- <span class="fa-stack fa-4x">
                         <i class="fas fa-circle fa-stack-2x text-primary"></i>
                         <i class="fas fa-shopping-cart fa-stack-1x fa-inverse"></i>
                     </span> -->
                    <h4 class="my-3">RT-PCR</h4>
                    <p class="text-muted">Reverse Transcription Polymerase Chain Reaction (RT-PCR): Most tests to check
                        for current SARS-CoV-2 infection rely on RT-PCR testing to detect the virus's RNA in a
                        respiratory tract sample from a patient. PCR is a laboratory method used for making a very large
                        number of copies of short sections of DNA from a very small sample of DNA so that it can be
                        detected. This process is called "amplifying" the DNA. (See the article on PCR for more
                        details.) The reverse transcription step allows the viral RNA to be converted into DNA so that
                        the PCR technique can be used.</p>
                </div>
                <div class="col-md-4">
                    <!--    <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-laptop fa-stack-1x fa-inverse"></i>
                        </span> -->
                    <h4 class="my-3">Rapid Antigen Tests</h4>
                    <p class="text-muted">These tests detect the viral proteins of SARS-CoV-2 in respiratory samples.
                        The main advantages of antigen tests are that they can provide results in minutes, are simpler
                        than RT-PCR tests to perform, and are sometimes used at the point of care, such as at a health
                        clinic. However, they are not as sensitive as RT-PCR tests, so negative results do not rule out
                        infection.</p>
                </div>
                <div class="col-md-4">
                    <!--  <span class="fa-stack fa-4x">
                         <i class="fas fa-circle fa-stack-2x text-primary"></i>
                         <i class="fas fa-lock fa-stack-1x fa-inverse"></i>
                     </span> -->
                    <h4 class="my-3">Blood Test for Antibodies</h4>
                    <p class="text-muted">These tests detect antibodies produced by the body's immune system in response
                        to SARS-CoV-2. COVID-19 serology tests can tell whether or not you have had the viral infection
                        in the past. However, antibody tests are not the preferred tests to diagnose current infections.
                        Antibodies don???t show up for about 1 to 2 weeks after you first become sick so antibody tests
                        could miss some early infections. (For more general information on antibodies, also called
                        immunoglobulins, see the article on Immunoglobulins.)</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Portfolio Grid-->
    <section class="page-section bg-light" id="apptform">
        <div class="container container-auto">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Create your Appointment</h2>
                <h3 class="section-subheading text-muted">Now you can create your appointment online for the COVID
                    testing.</h3>
            </div>
            <div class="row">


                <!-- Appointment Registeration form -->


                <div class="col-md-12 py-5 border">
                    <!--<h4 class="pb-4">Please fill with your details</h4> -->
                    <h5 id="pcr_paid" class="text-danger hideMe">Make sure you've entered your information same as on
                        your passport </h5>
                    <h5 id="pcr_free" class="text-danger">Free Covid-19 PCR Tests Results in 24-48 hours. (Not for
                        traveling)</h5>
                    <h5 class="pb-4 text-danger">Valid ID is required</h5>
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
                    <form id="patientForm" enctype="multipart/form-data" action="{{ route('store.patient') }}" method="post">
                        @csrf
                        <input type="hidden" id="paid_or_free" name="paid_or_free" value="0">

                        <div class="form-row">
                            <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                <select name="locationId" id="locationId" required="required" class="form-control">
                                    <option value="" selected>Select Location</option>
                                    @if(!empty($locations) && count($locations) > 0)
                                        @foreach($locations as $location)
                                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

{{--                            <div class="form-group col-lg-6 col-md-12 col-sm-12" id="covid_symptoms_div">--}}
{{--                                <select required="required" id="covid_symptoms_id" name="covidSymptoms[]"--}}
{{--                                        class="selectpicker w-100 multiselect-dropdown" multiple data-live-search="true"--}}
{{--                                        title="Select Covid Symptoms">--}}
{{--                                    @if(!empty($covidSymptoms) && count($covidSymptoms) > 0)--}}
{{--                                        @foreach($covidSymptoms as $covidSymptom)--}}
{{--                                            <option value="{{ $covidSymptom->id }}">{{ $covidSymptom->name }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    @endif--}}
{{--                                </select>--}}
{{--                            </div>--}}

                            <div class="form-group col-lg-6 col-md-12 col-sm-12" id="covid_symptoms_div">
                                <select required="required" id="covid_symptoms_id" name="covidSymptoms"
                                        class="form-control"
                                        title="Select Covid Symptoms">
                                    @if(!empty($covidSymptoms) && count($covidSymptoms) > 0)
                                        @foreach($covidSymptoms as $covidSymptom)
                                            <option value="{{ $covidSymptom->id }}">{{ $covidSymptom->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>



                        </div>

                        <div class="form-row">
                            <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                <input id="first_name" name="first_name" placeholder="First Name" required="required"
                                       class="form-control" type="text">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <input id="last_name" name="last_name" placeholder="Last Name" required="required"
                                       class="form-control" type="text">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                <input type="text" name="dob" class="form-control" required="required" id="dob"
                                       placeholder="MM/DD/YYYY (Date of birth)">
                            </div>
                            <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                <select name="gender" id="gender" required="required" class="form-control">
                                    <option value="" selected>Choose gender</option>
                                    <option value="male"> Male</option>
                                    <option value="female"> Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                <input type="email" name="email_address" class="form-control" required="required"
                                       id="email" placeholder="Email">
                            </div>
                            <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                <input type="email" name="confemail_address" class="form-control" required="required"
                                       id="confemail" placeholder="Confirm Email">
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                <input id="cell_phone" name="cell_phone" maxlength="12" placeholder="Cell Phone"
                                       class="form-control" required="required" type="text">
                            </div>
                            <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                <input id="landline" name="landline" maxlength="12" placeholder="Alternate phone number"
                                       class="form-control" type="text">
                            </div>

                            {{--   <div class="form-group col-md-6 col-sm-12">
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

                        <div class="form-row child-relation hideMe">
                            <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                <input id="parent_name" name="parent_name" placeholder="Parent Name"
                                       class="form-control" type="text">
                            </div>
                            <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                <input id="relation_name" name="relation_name" placeholder="Relationship of parent"
                                       class="form-control" type="text">
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                <textarea id="address" name="address" required="required" placeholder="Address"
                                          cols="40" rows="2" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                <input id="city" name="city" placeholder="City" required="required" class="form-control"
                                       type="text">
                            </div>

                            <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                <select name="stateId" id="stateId" required="required" class="form-control">
                                    <option value="" selected>Select State</option>
                                    @if(!empty($states) && count($states) > 0)
                                        @foreach($states as $state)
                                            <?php $selected = ''; ?>
                                            @if($state->id == 51)
                                                <?php $selected = 'selected'; ?>
                                            @endif
                                            <option value="{{ $state->id }}" {{ $selected }}>{{ $state->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                <input id="zipcode" name="zipcode" placeholder="Zip Code" required="required"
                                       class="form-control" type="text">
                            </div>
                        </div>

                        <div class="form-row">

                            <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                <input id="appointment" name="appointment" placeholder="Appointment Date"
                                       required="required" class="form-control" type="text">
                            </div>
                            <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                <select class="form-control timeSlotSelect" id="timeSlotSelect" required
                                        name="timeslot">
                                    <option value=""> Please Select Appointment Time</option>
                                @foreach($timeSlots as $timeSlot)
                                    <!--                                        --><?php //$disabled = ''; ?>
                                        {{--                                        @foreach($patientsTimeSlotCount as $patientsTime)--}}
                                        {{--                                            @if($patientsTime->total >=3 && $patientsTime->timeslot == $timeSlot)--}}
                                        {{--                                                <?php $disabled = 'disabled'; ?>--}}
                                        {{--                                            @endif--}}
                                        {{--                                        @endforeach--}}
                                        <option value="{{ $timeSlot }}"> {{ $timeSlot }} </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="form-row hideMe pcr_paid_fields">
                            <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                <select id="resultType" class="form-control result_type" required name="result_type">
                                    <option value=""> Select your price and service time</option>
                                    <!--<option value ="Results delivered in 4 days $100.00"> Results delivered in 4 days $100.00</option> -->
                                    {{--                                <option value ="72 Hours $125"> 72 Hours $125</option>--}}
                                    {{--                                <option value ="24 hours $150"> 24 hours $150</option>--}}
                                    {{--                                <option value ="Same day $200"> Same day $200</option>--}}


                                </select>
                            </div>
                            <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                <input id="flight_datetime" name="flight_datetime" placeholder="Flight Date and Time"
                                       class="form-control" type="text">
                            </div>
                        </div>

                        <!--  <div class="form-row">
                              <div class="form-group">
                                  <div class="form-group col-lg-6 col-md-12 col-sm-12">
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
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <label>
                                        I would like to receive my result via:
                                    </label> </br>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="is_fax" id="is_fax"
                                               value="1">

                                        <div class="form-group col-md-12 col-sm-12">
                                            <input id="fax" name="fax" maxlength="12" placeholder="Fax No"
                                                   class="form-control" type="text">
                                        </div>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="is_email" id="via-email"
                                               value="1">

                                        <div class="form-group col-md-12 col-sm-12">
                                            <input id="" name="email_cb" placeholder="Email" class="form-control"
                                                   type="text">
                                        </div>
                                        <!--<div class="form-group col-md-12">
                                            <input id="" name="passcode" maxlength="12" placeholder="Pass Code" class="form-control" type="text">
                                        </div> -->
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="form-row insuranc">
                            <div class="form-group">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <label>
                                        Bill To :
                                    </label>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input insuranceRadioBtn" type="radio" name="bill_to"
                                               value="Insurance">
                                        <span class="form-check-label"> Insurance </span>
                                    </label>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input insuranceRadioBtn" type="radio" checked
                                               name="bill_to" value="Uninsured">
                                        <span class="form-check-label"> Uninsured</span>
                                    </label>

                                </div>
                            </div>
                        </div>
                        <div class="form-row insdetail">
                            <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                <input id="ins_name" name="ins_name" placeholder="Insurance Name & Policy"
                                       class="form-control" type="text">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <input id="group_no" name="group_no" placeholder="Group No" class="form-control"
                                       type="text">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group row col-lg-12 col-md-12 col-sm-12 col-sm-12">
                                <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                    <label>
                                        How did you hear about us:
                                    </label>

                                    <select name="hear_about" id="hear_about" class="form-control">
                                        <option value="" selected>Please Select</option>
                                        <option value="familyandfriend"> Family & Friend</option>
                                        <!-- <option value="doctor"> Doctor/Clinic </option> -->
                                        <option value="google"> Google</option>
                                        <option value="bing"> Bing</option>
                                        <option value="yahoo"> Yahoo</option>
                                        <option value="facebook"> Facebook</option>
                                        <option value="youtube"> YouTube</option>
                                        <option value="instagram"> Instagram</option>
                                        <option value="commerical"> Commercial</option>
                                        <!-- <option value="newspaper"> Radio Station/Newspaper Name</option> -->
                                        <option value="other"> Doctor / Clinic / Radio Station / Newspaper / Other
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group col-sm-12 col-md-6 refer_name hideMe">
                                    <label>Refer Name:</label>
                                    <input type="text" value="" class="form-control" name="refer_name" id="refer_name"/>
                                </div>

                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group row col-lg-12 col-md-12 col-sm-12 col-sm-12">
                                <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                    <label>
                                        Upload Document (Insurance Card front/ Driving license/ID Card etc)
                                    </label>
                                    <input type="file" name="front_picture" accept="image/*" class="form-control" />
                                </div>
                                <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                    <label>
                                        Upload Document (Insurance Card Back/ Driving license/ID Card etc)
                                    </label>
                                    <input type="file" name="back_picture" accept="image/*" class="form-control" />
                                </div>
                            </div>
                        </div>

                        <div class="form-row child-relation-cb hideMe">
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parent_checkbox" id="parent_checkbox" value="1">
                                    <label class="form-check-label" for="parent_checkbox">
                                        <small>As the parent, I authorize the Lab testing facility to collect and test a nasal or blood sample of my child for COVID-19 testing.</small>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row termsAndCondition hideMe">
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="terms" id="terms" value="1"
                                           required>
                                    <label class="form-check-label" for="terms">
                                        <small>Kindly read carefully as by clicking Submit, you agree to our <a
                                                href="javascript:void(0)">Terms & Conditions.</a> a copy of terms and condition will also be sent to your email.</small>
                                    </label>
                                </div>
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
        .hideMe {
            display: none;
        }

        .multiselect-dropdown button.dropdown-toggle {
            display: block;
            width: 100%;
            padding: .375rem .75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        .dropdown-menu.show {
            min-width: auto !important;
            width: 100%;
        }
    </style>
    <link href="{!! asset('assets/css/bootstrap-select.css') !!}" rel="stylesheet">
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css">--}}
@endpush


@push('js')
    <script src="{!! asset('assets/js/validate.js') !!}"></script>
    <script type='text/javascript' src="{!! asset('assets/js/inputMask.js') !!}"></script>
    <script src="{!! asset('assets/js/additional-methods.js') !!}"></script>

    <script>
        $(function () {
            $('#flight_datetime').datetimepicker({
                format: 'MM/DD/YYYY hh:mm A',
            });

            $(document).on('click', '#paid', function () {
                $('#flight_datetime, .result_type, #covid_symptoms_id').val('');
                $('#paid_or_free').val('1');
                $('.insuranc').addClass('hideMe');
                $('.insdetail').addClass('hideMe');
                $('#pcr_paid,.pcr_paid_fields').removeClass('hideMe');
                $('#pcr_free, #covid_symptoms_div').addClass('hideMe');
                $('#covid_symptoms_id').attr('required', false);
            });

            $(document).on('click', '#freeTest', function () {
                $('#covid_symptoms_id').attr('required', true);
                $('#paid_or_free').val('0');
                $('.insuranc').removeClass('hideMe');
                $('.insdetail').removeClass('hideMe');
                $('#flight_datetime, .result_type').val('');
                $('#pcr_paid,.pcr_paid_fields').addClass('hideMe');
                $('#pcr_free, #covid_symptoms_div').removeClass('hideMe');
            });

            $(document).on('change', '#locationId', function () {
                if ($(this).val() == "") {
                    $('#appointment').val('');
                    $('#timeSlotSelect').html('<option value="">Please Select Appointment Time</option>');
                    return false;
                }
                $.ajax({
                    url: "/location",
                    type: "GET",
                    data: {id: $(this).val()},
                    dataType: "json",
                    success: function (response) {
                        if (response.encryptedLocationId) {
                            $('.termsAndCondition').removeClass('hideMe');
                            $('.termsAndCondition a').attr('href', "{{ url('terms-and-condition') }}"+'/'+response.encryptedLocationId);
                        }

                        $('#resultType').html('');
                        setDateTimepickerInit(response.disabledDates);
                        $('#timeSlotSelect').html(response.timeSlotsOptions);
                        let html = '<option value="">Select your price and service time</option>';
                        if (response) {
                            if (response.result.hours_1) {
                                html += '<option value="72 Hours $' + response.result.hours_1 + '">72 Hours $' + response.result.hours_1 + '</option>';
                            }
                            if (response.result.hours_2) {
                                html += '<option value="24 Hours $' + response.result.hours_2 + '">24 Hours $' + response.result.hours_2 + '</option>';
                            }
                            if (response.result.same_day) {
                                html += '<option value="Same day $' + response.result.same_day + '">Same day $' + response.result.same_day + '</option>';
                            }
                        }
                        $('#resultType').html(html);
                    },
                    error: function () {

                    }
                });
                //

            });

            function setDateTimepickerInit(disableDates) {
                $('#appointment').datetimepicker({
                    format: 'MM/DD/YYYY', daysOfWeekDisabled: [0],
                    disabledDates: disableDates
                }).on("dp.change", function (e) {
                });
            }
        });
    </script>

    <script src="{!! asset('assets/js/bootstrap-select.min.js') !!}"></script>

@endpush
