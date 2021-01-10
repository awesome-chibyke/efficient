<?php
$active7 = 'active';
$title = 'Login | Grandour Empowerment Programme';
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
                    <h1>Login to start a session.</h1>
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
                            <h2>Login</h2>

                            <form method="post" action="" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Username or email</label>
                                    <input type="text" id="email" name="email" class="form-control" placeholder="Username or email">
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" id="pass" name="pass" class="form-control"  placeholder="Password">
                                </div>

                                <div class="row align-items-center">
                                    <div class="col-lg-6 col-md-6 col-sm-6 remember-me-wrap">
                                        <p>
                                            <input type="checkbox" id="test2">
                                            <label for="test2">Remember me</label>
                                        </p>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6 lost-your-password-wrap">
                                        <a href="forgot-password" class="lost-your-password">Lost your password?</a>
                                    </div>
                                </div>

                                <button type="submit">Log In</button>
                            </form>
                        </div>
                    </div>
                    

                </div>
            </div>
        </section>
        <!-- Start Profile Authentication Area -->
        <?php require_once('footer.php');?>