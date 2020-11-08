@extends('layout.app')
@extends('layout.master')

@section('title') LabTestEZPay @endsection

@section('content')

    <section class="testimonial py-5" id="testimonial">
        <div class="container">
            <div class="row ">
                <div class="col-md-4 py-5 bg-primary text-white text-center ">
                    <div class=" ">
                        <div class="card-body">
                            <img src="http://www.ansonika.com/mavia/img/registration_bg.svg" style="width:30%">
                            <h2 class="py-3">Registration</h2>
                            <p>We Provide Private And Affordable Lab Testing Enhanced Patient Experience, Flexible & Discounted Pricing for Cash & Uninsured.

                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 py-5 border">
                    <h4 class="pb-4">Please fill with your details</h4>
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
                                <input type="text" name="dob" class="form-control" required="required" id="dob" placeholder="DOB">
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <select name="gender" id="gender" required="required" class="form-control">
                                    <option value="" selected>Choose gender</option>
                                    <option value="male"> Male</option>
                                    <option value="female"> Female</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <input id="cell_phone" name="cell_phone" maxlength="12" placeholder="Cell Phone" class="form-control" required="required" type="text">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input id="landline" name="landline" placeholder="Alternate phone number" class="form-control" type="text">
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

                            <div class="form-group col-md-12">
                                <input id="appointment" name="appointment" placeholder="Appointment" required="required" class="form-control" type="text">
                            </div>

                        </div>


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
                                        <div class="form-group col-md-12">
                                            <input id="" name="passcode" maxlength="12" placeholder="Pass Code" class="form-control" type="text">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="form-group">
                                <div class="form-group col-md-12">
                                    <label>
                                        Bill To :
                                    </label> </br>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="bill_to" value="Insurance">
                                        <span class="form-check-label"> Insurance </span>
                                    </label>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="bill_to" value="Uninsured Program">
                                        <span class="form-check-label"> Uninsured Program</span>
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
                            <div class="form-group">
                                {{-- <div class="form-group"> --}}
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="terms" id="terms" value="1" required>
                                    <label class="form-check-label" for="terms">
                                        <small>By clicking Submit, you agree to our Terms & Conditions, Visitor Agreement and Privacy Policy.</small>
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

@push('js')
    <script src="{!! asset('assets/js/validate.js') !!}"></script>
    <script type='text/javascript' src="{!! asset('assets/js/inputMask.js') !!}"></script>
@endpush

