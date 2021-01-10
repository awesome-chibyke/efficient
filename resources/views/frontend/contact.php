<?php
$active6 = 'active';
$title = 'Contact | Grandour Empowerment Programme';
$description = 'Grandour runs a contributive collaboration model of Empowerment. It is a programme of Grandourians by Grandourians and for Grandourians a ground breaking symbiotic paradigm shift in philanthropy.';
$keywords = 'Grandour, Empowerment, Programme, Wealth and Capacity building, Techo Craft, Contribution, Investment, Nigeria, Enugu, Anambra, Lagos';
require_once('head.php');?>
    <body>

        <!-- Start Navbar Area -->
        <?php require_once('nav.php');?>
        <!-- End Navbar Area -->

        <!-- Start Page Title Area -->
        <section style="background-image: url(image/program-cover.png); background-repeat: no-repeat; background-size: cover; background-position: center;" class="page-title-area">
            <div class="container">
                <div class="page-title-content">
                    <h1>Contact Us</h1>
                </div>
            </div>

            <div class="shape2"><img src="assets/img/shape/shape2.png" alt="image"></div>
            <div class="shape3"><img src="assets/img/shape/shape3.png" alt="image"></div>
            <div class="shape5"><img src="assets/img/shape/shape5.png" alt="image"></div>
            <div class="shape6"><img src="assets/img/shape/shape6.png" alt="image"></div>
            <div class="shape7"><img src="assets/img/shape/shape7.png" alt="image"></div>
            <div class="shape8"><img src="assets/img/shape/shape8.png" alt="image"></div>
            <div class="lines">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
        </section style="background-image: url(image/program.png); background-repeat: no-repeat; background-size: cover; background-position: center;">
        <!-- End Page Title Area -->

        <!-- Start Contact Info Area -->
        <section class="contact-info-area pt-100 pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="contact-info-box">
                            <div class="back-icon">
                                <i class='bx bx-map'></i>
                            </div>
                            <div class="icon">
                                <i class='bx bx-map'></i>
                            </div>
                            <h3>Our Address</h3>
                            <p>Head Office: <?php print $siteAddress;?><br>
                            Branch Office: <?php print $siteAddress1;?></p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="contact-info-box">
                            <div class="back-icon">
                                <i class='bx bx-phone-call'></i>
                            </div>
                            <div class="icon">
                                <i class='bx bx-phone-call'></i>
                            </div>
                            <h3>Contact</h3>
                            <p>Mobile: <a href="tel:<?php print $sitePhone;?>"><?php print $sitePhone;?></a></p>
                            <p>E-mail: <a href="mailto:<?php print $siteEmail;?>"><?php print $siteEmail;?></a></p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 offset-lg-0 offset-md-3">
                        <div class="contact-info-box">
                            <div class="back-icon">
                                <i class='bx bx-time-five'></i>
                            </div>
                            <div class="icon">
                                <i class='bx bx-time-five'></i>
                            </div>
                            <h3>Hours of Operation</h3>
                            <p>Monday - Friday: 09:00 - 20:00</p>
                            <p>Sunday & Saturday: 10:30 - 22:00</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Contact Info Area -->

        <!-- Start Contact Area -->
        <section class="contact-area pb-100">
            <div class="container">
                <div class="section-title">
                    <span class="sub-title">Get in Touch</span>
                    <h2>Ready to Get Started?<span class="overlay"></span></h2>
                    <p>Leave us a message today and we will get back to you shortly. Required fields are marked *</p>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="contact-image" data-tilt>
                            <img src="assets/img/contact.png" alt="image">
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="contact-form">
                            <form id="contactForm">
                                <div class="row">
                                    <div class="col-lg-12 col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control" id="name" required data-error="Please enter your name" placeholder="Your name">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-6">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control" id="email" required data-error="Please enter your email" placeholder="Your email address">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <input type="text" name="phone_number" class="form-control" id="phone_number" required data-error="Please enter your phone number" placeholder="Your phone number">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <textarea name="message" id="message" class="form-control" cols="30" rows="6" required data-error="Please enter your message" placeholder="Write your message..."></textarea>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <button type="submit" class="default-btn">Send Message</button>
                                        <div id="msgSubmit" class="h3 text-center hidden"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Contact Area -->


<?php require_once('footer.php');?>