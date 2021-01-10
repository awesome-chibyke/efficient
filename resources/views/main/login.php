<?php
require_once('lib.php');
$title = 'Login | '.$siteName;
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
                                <h2>Login</h2>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="./">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">Login</li>
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

                    <div class="row align-items-center">

                        <div class="col-md-6 pr-md-0 offset-3">
                            <h2 class="main-title text-center">Login Now!</h2>
                            <p class="mb-0"></p>
                            <div class="contact-form">
                                <form id="contactForm">
                                    <div style="padding-top: 50px; padding-bottom: 50px;" class="row">
                                        <div class="col-lg-6 form-item">
                                            <div class="form-group">
                                                <label>Email*</label>
                                                <input name="email" id="email" type="email" class="form-control" placeholder="Your email*" required >
                                            </div>
                                        </div>
                                        <div class="col-lg-6 form-item">
                                            <div class="form-group">
                                                <label>Password*</label>
                                                <input name="pass" id="pass" type="password" class="form-control" placeholder="Enter Password*" required >
                                            </div>
                                        </div>



                                        <div class="col-sm-12 text-left pb-4">
                                            <div class="btn-01">
                                                <a href="#" id="submit-btn" onclick="sendEmail()">
                                                    <span>Login</span>
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

                    </div>
                </div>
            </section>
            <!--   Contact End   -->
            
            <?php require_once('footer.php');?>
    </body>
</html>