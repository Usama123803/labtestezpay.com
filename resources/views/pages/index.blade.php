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
                            <p>Tation argumentum et usu, dicit viderer evertitur te has. Eu dictas concludaturque usu, facete detracto patrioque an per, lucilius pertinacia eu vel.

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
                                <input id="landline" name="landline" placeholder="Landline" class="form-control" type="text">
                            </div>

{{--                            <div class="form-group col-md-6">--}}
{{--                                <select name="countryId" id="countryId" required="required" class="form-control">--}}
{{--                                    <option value="" selected>Select Country</option>--}}
{{--                                    @if(!empty($countries) && count($countries) > 0)--}}
{{--                                        @foreach($countries as $country)--}}
{{--                                            <option value="{{ $country->id }}">{{ $country->name }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    @endif--}}
{{--                                </select>--}}
{{--                            </div>--}}

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
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="terms" id="terms" value="1" required>
                                        <label class="form-check-label" for="terms">
                                            <small>By clicking Submit, you agree to our Terms & Conditions, Visitor Agreement and Privacy Policy.</small>
                                        </label>
                                    </div>
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

@push('js')
    <script src="{!! asset('assets/js/validate.js') !!}"></script>
    <script type='text/javascript' src="{!! asset('assets/js/inputMask.js') !!}"></script>
@endpush

