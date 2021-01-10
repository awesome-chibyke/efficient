<?php
require_once('lib.php');
$title = 'Welcome To '.$siteName;
$fixed_top = 'fixed-top';
$description = 'Efficient Home Resources And Foods is an initiative developed to support the middle and low income earners in our society.';
$keyword = '';
require_once('head.php');?>
    <body data-spy="scroll" data-target="#scrollspy" data-offset="1">

        <div class="homepage-02">

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
            <section id="home" class="home home-01 home-02 full-screen">
                <div class="home-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="home-bg-content">
                                    <h2 class="pt-5">We Are Society Of Network Marketers That Support Each Other To Grow Income And Eliminate Poverty.</h2>
                                    <p class="my-4">We have wonderful incentive packages that reward every effort put in by our members.</p>
                                    <div class="btn-01 mt-2">
                                        <a href="register">
                                            <span>Get Started</span>
                                            <i class="lni lni-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--  Home End  -->

            <!--  About Start  -->
            <section id="about" class="about-02 py-6">
                <div class="container">
                    <div class="about-item">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="title-box">
                                    <h2 class="main-title">About</h2>
                                    <p class="sub-title">Welcome to <?php print $siteName;?></p>
                                </div>
                                <div class="tab-box">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="mission-tab" data-toggle="tab" href="#mission" role="tab" aria-controls="mission" aria-selected="true">About Us</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="advantages-tab" data-toggle="tab" href="#advantages" role="tab" aria-controls="advantages" aria-selected="false">Our Vision</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content mt-4" id="myTabContent">
                                        <div class="tab-pane fade show active" id="mission" role="tabpanel" aria-labelledby="mission-tab">
                                            <p class="about-content">
                                                Efficient Home Resources And Foods is an initiative developed to support the middle and low income earners in our society.<br/><br/>

                                                We are society of network marketers that support each other to grow income and eliminate poverty <em>...<a href="about">read more</a></em>
                                            </p>
                                            <ul class="about-description-box">
                                                <li>
                                                    <p>Our program is designed to help the general public in securing a financial and stable life style.</p>
                                                </li>
                                                <li>
                                                    <p>We are also committed to ensuring that the gap between the rich<br> and poor is reduced to the barest minimum.</p>
                                                </li>
                                                <li>
                                                    <p>We keep focus on increasing revenue. Thereby helping our <br>members to stay financially stable.</p>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane fade mt-4" id="advantages" role="tabpanel" aria-labelledby="advantages-tab">
                                            <p class="about-content">To grow income and businesses through efficient network marketing and allocation of resources to eliminate poverty.</p>
                                            <ul class="about-description-box">
                                                <li>
                                                    <p>Our program is designed to help the general public in securing a financial and stable life style.</p>
                                                </li>
                                                <li>
                                                    <p>We are also committed to ensuring that the gap between the rich<br> and poor is reduced to the barest minimum.</p>
                                                </li>
                                                <li>
                                                    <p>We keep focus on increasing revenue. Thereby helping our <br>members to stay financially stable.</p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            
                            </div>
                            <div class="col-lg-6">
                                <div class="about-img">
                                    <img src="assets/img/about-03.jpg" alt="/">
                                </div>
                                <div class="year-box">
                                    <h2>Empowerment and Wealth Creation.</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--  About End  -->

            <!--  Counted Start  -->
            <section class="counted-01 py-6">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="title-box">
                                        <h2 class="main-title">A better future</h2>
                                        <h5 class="sub-title">Join <?php print $siteName;?> for a brighter future. </h5>
                                    </div>
                                </div>
                            </div>
                            <p>We grow by uplifting other. Get connected to the winning team and secure your future financially. Your well been is our concern.</p>
                        </div>
                        <div class="col-lg-7">
                            <div class="counted">
                                <div class="row">
                                    <!-- Item-01 -->
                                    <div class="col-6 col-sm-3 count-item">
                                        <div class="count-content">
                                            <span class="timer count-number" data-from="0" data-to="73" data-speed="5000">0</span>
                                        <p class="mb-0">Team Member</p>
                                        </div>
                                    </div>
                                    <!-- Item-02 -->
                                    <div class="col-6 col-sm-3 count-item">
                                        <div class="count-content">
                                            <span class="timer count-number" data-from="0" data-to="6549" data-speed="5000">0</span>
                                            <p class="mb-0">Project Done</p>
                                        </div>
                                    </div>
                                    <!-- Item-03 -->
                                    <div class="col-6 col-sm-3 count-item">
                                        <div class="count-content">
                                            <span class="timer count-number" data-from="0" data-to="793" data-speed="5000">0</span>
                                        <p class="mb-0">Get Award</p>
                                        </div>
                                    </div>
                                    <!-- Item-04 -->
                                    <div class="col-6 col-sm-3 count-item">
                                        <div class="count-content">
                                            <span class="timer count-number" data-from="0" data-to="286" data-speed="5000">0</span>
                                            <p class="mb-0">Happy Client</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--   Counted End   -->

            <!--  Why Choose Start  -->
            <section id="whyChoose" class="why-choose-02 pt-6 pb-50">
                <div class="container">
                    <div class="about-item">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="title-box">
                                    <h2 class="main-title">How to get started</h2>
                                    <p class="sub-title">Our system is easy and efficient.</p>
                                </div>
                                <p><?php print $siteName;?> is here to help you gradually build homes and  business financially.</p>
                                <!-- Skill -->
                                <div class="skill-box">
                                    <div class="skillbar clearfix" data-percent="95%">
                                        <div class="skillbar-title"><span>Wealth</span></div>
                                        <div class="skillbar-bar fill-skillbar"></div>
                                        <div class="skill-bar-percent">95%</div>
                                    </div>
                                    <div class="skillbar clearfix " data-percent="85%">
                                        <div class="skillbar-title"><span>Financial Freedom</span></div>
                                        <div class="skillbar-bar fill-skillbar"></div>
                                        <div class="skill-bar-percent">85%</div>
                                    </div>
                                    <div class="skillbar clearfix" data-percent="80%">
                                        <div class="skillbar-title"><span>Empowerment</span></div>
                                        <div class="skillbar-bar fill-skillbar"></div>
                                        <div class="skill-bar-percent">80%</div>
                                    </div>
                                </div>
                            
                            </div>
                            <div class="col-lg-6 why-choose-boxes">
                                <div class="row">
                                    <div class="col-md-6 boxes">
                                        <div class="why-choose-box">
                                            <i class="lni lni-thunder"></i>
                                            <h5 class="title">Create Account</h5>
                                            <p class="mb-0">To get started create account with <?php print $siteName;?>.</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 boxes">
                                        <div class="why-choose-box">
                                            <i class="lni lni-protection"></i>
                                            <h5 class="title">Make Deposit</h5>
                                            <p class="mb-0">Proceed to your dashboard to create investment from the available packages on the site.</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 boxes">
                                        <div class="why-choose-box">
                                            <i class="lni lni-grow"></i>
                                            <h5 class="title">Refer A Friend</h5>
                                            <p class="mb-0">Refer a friend to going the business and increase your earnings. </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 boxes">
                                        <div class="why-choose-box">
                                            <i class="lni lni-bulb"></i>
                                            <h5 class="title">Get Paid</h5>
                                            <p class="mb-0">Your profit and capital will be available for withdrawal after the end of the investment period.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--   Why Choose End   -->

            <!--  Portfolio Start  -->
            <section id="portfolio" class="portfolio-02 pt-6">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="title-box">
                                <h2 class="main-title">Coverages/Gallery</h2>
                                <p class="sub-title">Don`t miss out a moment</p>
                            </div>
                            
                        </div>
                    </div>
                    <div class="portfolio-body">
                        <div class="row">
                            <!--  Item 01  -->
                            <div class="col-md-6 col-lg-3">
                                <div class="portfolio-box">
                                    <div class="portfolio-img">
                                        <img src="assets/img/portfolio-01.jpg" alt="/">
                                    </div>
                                    <div class="portfolio-overlay">
                                        <div class="portfolio-content">
                                            <div class="portfolio-hover-icon">
                                                <a href="assets/img/portfolio-01.jpg">
                                                    <i class="lni lni-plus"></i>
                                                </a>
                                            </div>
                                            <p class="portfolio-category">Training For Website Management</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--  Item 02  -->
                            <div class="col-md-6 col-lg-3">
                                <div class="portfolio-box">
                                    <div class="portfolio-img">
                                        <img src="assets/img/portfolio-02.jpg" alt="/">
                                    </div>
                                    <div class="portfolio-overlay">
                                        <div class="portfolio-content">
                                            <div class="portfolio-hover-icon">
                                                <a href="assets/img/portfolio-02.jpg">
                                                    <i class="lni lni-plus"></i>
                                                </a>
                                            </div>
                                            <p class="portfolio-category">Training For Website Management</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--  Item 03  -->
                            <div class="col-md-6 col-lg-3">
                                <div class="portfolio-box">
                                    <div class="portfolio-img">
                                        <img src="assets/img/portfolio-03.jpg" alt="/">
                                    </div>
                                    <div class="portfolio-overlay">
                                        <div class="portfolio-content">
                                            <div class="portfolio-hover-icon">
                                                <a href="assets/img/portfolio-03.jpg">
                                                    <i class="lni lni-plus"></i>
                                                </a>
                                            </div>
                                            <p class="portfolio-category">Training For Website Management</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--  Item 04  -->
                            <div class="col-md-6 col-lg-3">
                                <div class="portfolio-box">
                                    <div class="portfolio-img">
                                        <img src="assets/img/portfolio-04.jpg" alt="/">
                                    </div>
                                    <div class="portfolio-overlay">
                                        <div class="portfolio-content">
                                            <div class="portfolio-hover-icon">
                                                <a href="assets/img/portfolio-04.jpg">
                                                    <i class="lni lni-plus"></i>
                                                </a>
                                            </div>
                                            <p class="portfolio-category">Training For Website Management</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="btn-01">
                        <a href="gallery">
                            <span>View More</span>
                            <i class="lni lni-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </section>
            <!--   Portfolio End   -->

            <!--  Client Start  -->
            <section id="testimonial2" class="testimonial-02 py-50">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="title-box">
                                        <h2 class="main-title">Testimonial</h2>
                                        <p class="sub-title"> We are happy to share client’s review.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="testimonial-items testimonial-items-02">
                                <div class="swiper-container">
                                    <div class="swiper-wrapper">
                                        <!--  Item 01 -->
                                        <div class="swiper-slide">
                                            <div class="testimonial-box">
                                                <div class="testimonial-header">
                                                    <div class="testimonial-img">
                                                        <img src="img/avatar.png" alt="/">
                                                    </div>
                                                    <div class="testimonial-detail">
                                                        <span class="testimonial-name">John Doe, </span>
                                                        <span class="testimonial-job">Seo Manager</span>
                                                    </div>
                                                </div>
                                                <div class="testimonial-comment">
                                                    <p>"In a professional context it often happens that private or corporate clients corder a publication to be made.In a professional context it often happens that private or corporate clients corder a publication to be made."</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  Item 02 -->
                                        <div class="swiper-slide">
                                            <div class="testimonial-box">
                                                <div class="testimonial-header">
                                                    <div class="testimonial-img">
                                                        <img src="img/avatar.png" alt="/">
                                                    </div>
                                                    <div class="testimonial-detail">
                                                        <span class="testimonial-name">John Doe, </span>
                                                        <span class="testimonial-job">Seo Manager</span>
                                                    </div>
                                                </div>
                                                <div class="testimonial-comment">
                                                    <p>"In a professional context it often happens that private or corporate clients corder a publication to be made.In a professional context it often happens that private or corporate clients corder a publication to be made."</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  Item 03 -->
                                        <div class="swiper-slide">
                                            <div class="testimonial-box">
                                                <div class="testimonial-header">
                                                    <div class="testimonial-img">
                                                        <img src="img/avatar.png" alt="/">
                                                    </div>
                                                    <div class="testimonial-detail">
                                                        <span class="testimonial-name">John Doe, </span>
                                                        <span class="testimonial-job">Seo Manager</span>
                                                    </div>
                                                </div>
                                                <div class="testimonial-comment">
                                                    <p>"In a professional context it often happens that private or corporate clients corder a publication to be made.In a professional context it often happens that private or corporate clients corder a publication to be made."</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Add Arrows -->
                                    <div class="swiper-button-next swiper-button"></div>
                                    <div class="swiper-button-prev swiper-button"></div>
                                </div>
                                <div class="col-lg-12"><center>
                                        <div class="btn-01">
                                            <a href="testimony">
                                                <span>View More</span>
                                                <i class="lni lni-arrow-right"></i>
                                            </a>
                                        </div></center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--  Client End  -->

            <!--  Price Start  -->
            <section id="price" class="price-02 py-50">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="title-box">
                                <h2 class="main-title">Pricing Plan</h2>
                                <p class="sub-title">We offer the best price for you!</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!--  Item 01  -->
                        <div class="col-md-6 col-lg-4">
                            <div class="price-box">
                                <div class="price-header">
                                    <h3 class="price-title">Basic Plan</h3>
                                    <div class="price-cost"><span>$</span> 568.99</div>
                                    <div class="pricing-period">per month</div>
                                </div>
                                <div class="price-text">
                                    <ul class="list-unstyled">
                                        <li>Standard Feature</li>
                                        <li>Business And Finance Analyzing</li>
                                        <li>tricket Management</li>
                                        <li>1 Free Optimization</li>
                                        <li>24/7 Hours Support</li>
                                    </ul>
                                </div>
                                <div class="btn-01">
                                    <a href="#">
                                        <span>Get Started</span>
                                        <i class="lni lni-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!--  Item 02  -->
                        <div class="col-md-6 col-lg-4">
                            <div class="price-box offer-box">
                                <div class="price-highlighter">
                                    <i class="lni lni-checkmark"></i>
                                    <span>best</span>
                                </div>
                                <div class="price-header">
                                    <h3 class="price-title">Basic Plan</h3>
                                    <div class="price-cost"><span>$</span> 568.99</div>
                                    <div class="pricing-period">per month</div>
                                </div>
                                <div class="price-text">
                                    <ul class="list-unstyled">
                                        <li>Standard Feature</li>
                                        <li>Business And Finance Analyzing</li>
                                        <li>tricket Management</li>
                                        <li>1 Free Optimization</li>
                                        <li>24/7 Hours Support</li>
                                    </ul>
                                </div>
                                <div class="btn-01">
                                    <a href="#">
                                        <span>Get Started</span>
                                        <i class="lni lni-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!--  Item 03  -->
                        <div class="col-md-6 col-lg-4">
                            <div class="price-box">
                                <div class="price-header">
                                    <h3 class="price-title">Basic Plan</h3>
                                    <div class="price-cost"><span>$</span> 568.99</div>
                                    <div class="pricing-period">per month</div>
                                </div>
                                <div class="price-text">
                                    <ul class="list-unstyled">
                                        <li>Standard Feature</li>
                                        <li>Business And Finance Analyzing</li>
                                        <li>tricket Management</li>
                                        <li>1 Free Optimization</li>
                                        <li>24/7 Hours Support</li>
                                    </ul>
                                </div>
                                <div class="btn-01">
                                    <a href="#">
                                        <span>Get Started</span>
                                        <i class="lni lni-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--  Price End  -->

            <!--  Blog Start  -->
            <section id="blog" class="blog-02 pt-50 pb-6">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="title-box">
                                <h2 class="main-title">Our Latest News</h2>
                                <p class="sub-title">We're ready to share our experience.</p>
                            </div>
                        </div>
                        <!-- Item 01 -->
                        <div class=" col-md-6 col-lg-4">
                            <div class="blog-box">
                                <div class="blog-header">
                                    <a href="#"><img src="assets/img/blog-01.jpg" alt="/"></a>
                                    <div class="blog-dates">
                                        <p class="blog-date">20</p>
                                        <p class="blog-month">Apr</p>
                                    </div>
                                </div>
                                <div class="blog-post-content">
                                    <h5>Why a visual identity system is memorable?</h5>
                                    <p>Lorem ipsum dolor sit amet consectetur adipiscing elit, sed do eiusmod tempor incididunt ut.</p>
                                    <div class="btn-01">
                                        <a href="#">
                                            <span>Read More</span>
                                            <i class="lni lni-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Item 02 -->
                        <div class=" col-md-6 col-lg-4">
                            <div class="blog-box">
                                <div class="blog-header">
                                    <a href="#"><img src="assets/img/blog-02.jpg" alt="/"></a>
                                    <div class="blog-dates">
                                        <p class="blog-date">18</p>
                                        <p class="blog-month">may</p>
                                    </div>
                                </div>
                                <div class="blog-post-content">
                                    <h5>8 Steps to making better decisions</h5>
                                    <p>Lorem ipsum dolor sit amet consectetur adipiscing elit, sed do eiusmod tempor incididunt ut.</p>
                                    <div class="btn-01">
                                        <a href="#">
                                            <span>Read More</span>
                                            <i class="lni lni-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Item 03 -->
                        <div class=" col-md-6 col-lg-4">
                            <div class="blog-box">
                                <div class="blog-header">
                                    <a href="#"><img src="assets/img/blog-01.jpg" alt="/"></a>
                                    <div class="blog-dates">
                                        <p class="blog-date">11</p>
                                        <p class="blog-month">Jun</p>
                                    </div>
                                </div>
                                <div class="blog-post-content">
                                    <h5>Team we want to work with less mistakes</h5>
                                    <p>Lorem ipsum dolor sit amet consectetur adipiscing elit, sed do eiusmod tempor incididunt ut.</p>
                                    <div class="btn-01">
                                        <a href="#">
                                            <span>Read More</span>
                                            <i class="lni lni-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-5"><center>
                                <div class="btn-01">
                                    <a href="news-events">
                                        <span>View More</span>
                                        <i class="lni lni-arrow-right"></i>
                                    </a>
                                </div></center>
                        </div>
                    </div>
                </div>
            </section>
            <!--   Blog End   -->
            <?php require_once('footer.php');?>
    </body>
</html>