<?php
$active8 = 'active';
$title = 'Register | Grandour Empowerment Programme';
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
                    <h1>Create account is free.</h1>
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
                            <h2>Create an account.</h2>

                            <form method="post" action="" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" id="username" name="username" class="form-control" placeholder="Username">
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Username or email">
                                </div>

                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="tel" id="phone" name="phone" class="form-control" placeholder="Phone Number">
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" id="pass" name="pass" class="form-control" placeholder="Password">
                                </div>

                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" id="cpass" name="cpass" class="form-control" placeholder="Password">
                                </div>

                                <p class="description">The password should be at least eight characters long. To make it stronger, use upper and lower case letters, numbers, and symbols like ! " ? $ % ^ & )</p>
                                <p>Already have an account. <a href="login">Login</a></p>
                                <p>By clicking on the button below you agree to our <a href="terms-of-service">terms & conditions</a></p>
                                <button type="submit">Register</button>
                            </form>

                        </div>
                    </div>
                    

                </div>
            </div>
        </section>
        <!-- Start Profile Authentication Area -->
        <?php require_once('footer.php');?>