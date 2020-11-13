@extends('layout.master')

@section('title') LabTestEZPay @endsection

@section('content')
    <header class="masthead">
        <div class="container">
            <div class="masthead-heading">RT- PCR</div>
            <div class="masthead-heading">Rapid Antigen Tests</div>
            <div class="masthead-heading">Blood Test for Antibodies</div>
            <div class="masthead-heading"><a class="btn btn-dark" style="background: red; border: white; font-size: large; font-weight: 550;" href="http://labtestezpay.com/">For Blood & Other Test Click Here</a> </div>
            <!--<div class="masthead-subheading">We Provide Private And Affordable Lab Testing Enhanced Patient Experience, Flexible & Discounted Pricing for Cash & Uninsured</div>
            <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#services">Tell Me More</a> -->
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
    <section class="page-section bg-light" id="portfolio">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Create your Appointment</h2>
                <h3 class="section-subheading text-muted">Now you can create your appointment online for the COVID testing.</h3>
            </div>
            <div class="row">
                


<!-- Appointment Registeration form -->


<div class="col-md-12 py-5 border">
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
                                <input type="email" name="confemail_address" class="form-control" required="required" id="confemail" placeholder="Confirm Email">
                            </div>

                        </div>

                        <div class="form-row">
                            
                            
                            <div class="form-group col-md-6">
                                <input type="text" name="dob" class="form-control" required="required" id="dob" placeholder="DOB">
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
                                        <input class="form-check-input" type="radio" name="bill_to" value="Uninsured">
                                        <span class="form-check-label"> Uninsured</span>
                                    </label>

                                </div>
                            </div>
                        </div>

                       <!-- <div class="form-row">
                            <div class="form-group col-md-6">
                                <input id="ins_name" name="ins_name" placeholder="Insurance Name & Policy" class="form-control" type="text">
                            </div>
                            <div class="form-group col-md-6">
                                <input id="group_no" name="group_no" placeholder="Group No" class="form-control" type="text">
                            </div>
                        </div> -->



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






                <!--<div class="col-lg-4 col-sm-6 mb-4">
                    <div class="portfolio-item">
                        <a class="portfolio-link" data-toggle="modal" href="#portfolioModal1">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets/img/portfolio/01-thumbnail.jpg" alt="" />
                        </a>
                        <div class="portfolio-caption">
                            <div class="portfolio-caption-heading">Threads</div>
                            <div class="portfolio-caption-subheading text-muted">Illustration</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mb-4">
                    <div class="portfolio-item">
                        <a class="portfolio-link" data-toggle="modal" href="#portfolioModal2">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets/img/portfolio/02-thumbnail.jpg" alt="" />
                        </a>
                        <div class="portfolio-caption">
                            <div class="portfolio-caption-heading">Explore</div>
                            <div class="portfolio-caption-subheading text-muted">Graphic Design</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mb-4">
                    <div class="portfolio-item">
                        <a class="portfolio-link" data-toggle="modal" href="#portfolioModal3">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets/img/portfolio/03-thumbnail.jpg" alt="" />
                        </a>
                        <div class="portfolio-caption">
                            <div class="portfolio-caption-heading">Finish</div>
                            <div class="portfolio-caption-subheading text-muted">Identity</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
                    <div class="portfolio-item">
                        <a class="portfolio-link" data-toggle="modal" href="#portfolioModal4">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets/img/portfolio/04-thumbnail.jpg" alt="" />
                        </a>
                        <div class="portfolio-caption">
                            <div class="portfolio-caption-heading">Lines</div>
                            <div class="portfolio-caption-subheading text-muted">Branding</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mb-4 mb-sm-0">
                    <div class="portfolio-item">
                        <a class="portfolio-link" data-toggle="modal" href="#portfolioModal5">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets/img/portfolio/05-thumbnail.jpg" alt="" />
                        </a>
                        <div class="portfolio-caption">
                            <div class="portfolio-caption-heading">Southwest</div>
                            <div class="portfolio-caption-subheading text-muted">Website Design</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="portfolio-item">
                        <a class="portfolio-link" data-toggle="modal" href="#portfolioModal6">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets/img/portfolio/06-thumbnail.jpg" alt="" />
                        </a>
                        <div class="portfolio-caption">
                            <div class="portfolio-caption-heading">Window</div>
                            <div class="portfolio-caption-subheading text-muted">Photography</div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </section>



    <!-- About-->
 
 <!--   <section class="page-section" id="about">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">About</h2>
                <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
            </div>
            <ul class="timeline">
                <li>
                    <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/about/1.jpg" alt="" /></div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4>2009-2011</h4>
                            <h4 class="subheading">Our Humble Beginnings</h4>
                        </div>
                        <div class="timeline-body"><p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p></div>
                    </div>
                </li>
                <li class="timeline-inverted">
                    <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/about/2.jpg" alt="" /></div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4>March 2011</h4>
                            <h4 class="subheading">An Agency is Born</h4>
                        </div>
                        <div class="timeline-body"><p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p></div>
                    </div>
                </li>
                <li>
                    <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/about/3.jpg" alt="" /></div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4>December 2012</h4>
                            <h4 class="subheading">Transition to Full Service</h4>
                        </div>
                        <div class="timeline-body"><p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p></div>
                    </div>
                </li>
                <li class="timeline-inverted">
                    <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/about/4.jpg" alt="" /></div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4>July 2014</h4>
                            <h4 class="subheading">Phase Two Expansion</h4>
                        </div>
                        <div class="timeline-body"><p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p></div>
                    </div>
                </li>
                <li class="timeline-inverted">
                    <div class="timeline-image">
                        <h4>
                            Be Part
                            <br />
                            Of Our
                            <br />
                            Story!
                        </h4>
                    </div>
                </li>
            </ul>
        </div>
    </section> -->

    <!-- Team-->
 <!--   <section class="page-section bg-light" id="team">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Our Amazing Team</h2>
                <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="team-member">
                        <img class="mx-auto rounded-circle" src="assets/img/team/1.jpg" alt="" />
                        <h4>Kay Garland</h4>
                        <p class="text-muted">Lead Designer</p>
                        <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="team-member">
                        <img class="mx-auto rounded-circle" src="assets/img/team/2.jpg" alt="" />
                        <h4>Larry Parker</h4>
                        <p class="text-muted">Lead Marketer</p>
                        <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="team-member">
                        <img class="mx-auto rounded-circle" src="assets/img/team/3.jpg" alt="" />
                        <h4>Diana Petersen</h4>
                        <p class="text-muted">Lead Developer</p>
                        <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 mx-auto text-center"><p class="large text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p></div>
            </div>
        </div>
    </section>  -->
    <!-- Clients-->
  
  <!--  <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6 my-3">
                    <a href="#!"><img class="img-fluid d-block mx-auto" src="assets/img/logos/envato.jpg" alt="" /></a>
                </div>
                <div class="col-md-3 col-sm-6 my-3">
                    <a href="#!"><img class="img-fluid d-block mx-auto" src="assets/img/logos/designmodo.jpg" alt="" /></a>
                </div>
                <div class="col-md-3 col-sm-6 my-3">
                    <a href="#!"><img class="img-fluid d-block mx-auto" src="assets/img/logos/themeforest.jpg" alt="" /></a>
                </div>
                <div class="col-md-3 col-sm-6 my-3">
                    <a href="#!"><img class="img-fluid d-block mx-auto" src="assets/img/logos/creative-market.jpg" alt="" /></a>
                </div>
            </div>
        </div>
    </div>

    <section class="page-section" id="contact">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Contact Us</h2>
                <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
            </div>
            <form id="contactForm" name="sentMessage" novalidate="novalidate">
                <div class="row align-items-stretch mb-5">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input class="form-control" id="name" type="text" placeholder="Your Name *" required="required" data-validation-required-message="Please enter your name." />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="form-group">
                            <input class="form-control" id="email" type="email" placeholder="Your Email *" required="required" data-validation-required-message="Please enter your email address." />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="form-group mb-md-0">
                            <input class="form-control" id="phone" type="tel" placeholder="Your Phone *" required="required" data-validation-required-message="Please enter your phone number." />
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-textarea mb-md-0">
                            <textarea class="form-control" id="message" placeholder="Your Message *" required="required" data-validation-required-message="Please enter a message."></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <div id="success"></div>
                    <button class="btn btn-primary btn-xl text-uppercase" id="sendMessageButton" type="submit">Send Message</button>
                </div>
            </form>
        </div>
    </section> -->




@endsection

@push('js')
    <script src="{!! asset('assets/js/validate.js') !!}"></script>
    <script type='text/javascript' src="{!! asset('assets/js/inputMask.js') !!}"></script>
@endpush


