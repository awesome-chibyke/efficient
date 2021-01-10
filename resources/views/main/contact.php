<?php
require_once('lib.php');
$title = 'Contact Us | '.$siteName;
$fixed_top = '';
$description = 'Efficient Home Resources And Foods is an initiative developed to support the middle and low income earners in our society.';
$keyword = '';
require_once('head.php');?>
    <body data-spy="scroll" data-target="#scrollspy" data-offset="1">

        <div class="secondary-pages homepage-02">

            <!--- Preloader Start -->
            <div id="onyx-preloader">
                <div  class="preloader">
                    <div class="spinner"></div>
                    <div class="loader">
                        <span data-text="E." class="letter-animation">E.</span>
                        <span data-text="H." class="letter-animation">H.</span>
                        <span data-text="R." class="letter-animation">R.</span>
                        <span data-text="A." class="letter-animation">A.</span>
                        <span data-text="F." class="letter-animation">F</span>
                    </div>
                </div>
            </div>
            <!-- Preloader End -->

            <?php require_once('header.php');?>

            <!--  Home Start  -->
            <section id="home" class="page-header  py-6 breadcrumbs">
                <div class="home-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <h2>Contact Us</h2>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="./">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">Contact Us</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--  Home End  -->

            <!--  Contact Start  -->
            <section class="contact contact-02 py-50">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <!--  Item 01 -->
                                <div class="col-lg-4">
                                    <div class="info-box">
                                        <div class="item-icon">
                                            <i class="lni lni-map-marker"></i>
                                        </div>
                                        <div class="item-text">
                                            <h5>Visit office</h5>
                                            <p class="mb-0">3556 Hartford Way Vlg, Mount of Pleasant, SC, 29466, Australia.</p>
                                        </div>
                                    </div>
                                </div>
                                <!--  Item 02 -->
                                <div class="col-lg-4">
                                    <div class="info-box">
                                        <div class="item-icon">
                                            <i class="lni lni-phone"></i>
                                        </div>
                                        <div class="item-text">
                                            <h5>Phone number</h5>
                                            <p class="mb-0">+(123)4567899</p>
                                            <p class="mb-0">+(123)4567899</p>
                                        </div>
                                    </div>
                                </div>
                                <!--  Item 03 -->
                                <div class="col-lg-4">
                                    <div class="info-box">
                                        <div class="item-icon">
                                            <i class="lni lni-envelope"></i>
                                        </div>
                                        <div class="item-text">
                                            <h5>Email us</h5>
                                            <p class="mb-0"><a href="https://retrina.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="81d2f4f1f1eef3f5c1e4f9e0ecf1ede4afe2eeec">[email&#160;protected]</a></p>
                                            <p class="mb-0"><a href="https://retrina.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="de97b0b8b19ebba6bfb3aeb2bbf0bdb1b3">[email&#160;protected]</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="title-box">
                                <h2 class="main-title">Contact Us</h2>
                                <p class="sub-title">Get in touch for any kind of help.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-6 pr-md-0">
                            <div class="contact-form">
                                <form id="contactForm">
                                    <div class="row">
                                        <div class="col-lg-6 form-item">
                                            <div class="form-group">
                                                <input name="name" id="name" type="text" class="form-control" placeholder="First name*" required >
                                            </div>
                                        </div>
                                        <div class="col-lg-6 form-item">
                                            <div class="form-group">
                                                <input name="family" id="family" type="text" class="form-control" placeholder="Last name*" required >
                                            </div>
                                        </div>
                                        <div class="col-lg-6 form-item">
                                            <div class="form-group">
                                                <input name="email" id="email" type="email" class="form-control" placeholder="Your email*" required >
                                            </div>
                                        </div>
                                        <div class="col-lg-6 form-item">
                                            <div class="form-group">
                                                <input name="subject" id="subject" type="tel" class="form-control" placeholder="Phone number*" required >
                                            </div>
                                        </div>
                                        <div class="col-12 form-item">
                                            <div class="form-group">
                                                <textarea name="comments" id="comments" rows="4" class="form-control textarea" placeholder="Your message..."></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 text-left pb-4">
                                            <div class="btn-01">
                                                <a href="#" id="submit-btn" onclick="sendEmail()">
                                                    <span>Send Message</span>
                                                    <i class="lni lni-arrow-right"></i>
                                                </a>
                                            </div>
                                            <div id="message" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000" >
                                                <div class="toast-body d-inline-block"></div>
                                                <button type="button" class="pr-3 close" data-dismiss="toast" aria-label="Close">
                                                    <span aria-hidden="true" class="lni lni-close size-xs "></span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6 pl-md-0">
                            <div class="contact-img">
                                <img src="assets/img/bg-contact-02.jpg" alt="/">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--   Contact End   -->
            
            <?php require_once('footer.php');?>
    </body>
</html>