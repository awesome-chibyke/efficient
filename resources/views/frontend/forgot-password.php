<?php
$active7 = 'active';
$title = 'Forgot Password | Grandour Empowerment Programme';
$description = 'Grandour runs a contributive collaboration model of Empowerment. It is a programme of Grandourians by Grandourians and for Grandourians a ground breaking symbiotic paradigm shift in philanthropy.';
$keywords = 'Grandour, Empowerment, Programme, Wealth and Capacity building, Techo Craft, Contribution, Investment, Nigeria, Enugu, Anambra, Lagos';
require_once('head.php');?>
    <body>

        <!-- Start Navbar Area -->
        <?php require_once('nav.php');?>
        <!-- End Navbar Area -->

        <!-- Start Page Title Area -->
        <section class="page-title-area">
            <div class="container">
                <div class="page-title-content">
                    <h1>Recover your password.</h1>
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
        </section>
        <!-- End Page Title Area -->

        <!-- Start Profile Authentication Area -->
        <section class="profile-authentication-area ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12 offset-2">
                        <div class="login-form">
                            <h2>Forgot Password</h2>

                            <form method="post" action="" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                                </div>

                                <div class="row align-items-right">
                                    <div class="col-lg-12 col-md-6 col-sm-6 lost-your-password-wrap">
                                        <a href="login" class="lost-your-password">Have an account?</a>
                                    </div>
                                </div>

                                <button type="submit">Recover Password!</button>
                            </form>
                        </div>
                    </div>
                    

                </div>
            </div>
        </section>
        <!-- Start Profile Authentication Area -->
        <?php require_once('footer.php');?>