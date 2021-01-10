<?php
require_once('lib.php');
$title = 'About | '.$siteName;
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
                                <h2>About Us</h2>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="./">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">About</li>
                                </ul>
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

                                                We are society of network marketers that support each other to grow income and eliminate poverty.<br/><br/>

                                                As an indigenous Nigerian company, we promote the use and consumption of locally manufactured goods usually needed in the day to day family life.<br/><br/>

                                                We have wonderful incentive packages that reward every effort put in by our members.<br/><br/>

                                                Efficient Home Resources And Foods is managed by the team work of the management, other support staff and leaders of various groups in various states.<br/><br/>

                                                Efficient Home Resources And Foods is currently fully operational in Lagos, Anambra, Enugu, Rivers, Kano, Abia and many more coming up.<br/><br/>

                                                We take pride in the integrity of management team who work indefatigable to deliver on the day to day running of our activities.<br/><br/>

                                                Efficient Home Resources And Foods has more than 5000 members nationwide and still counting...

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
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--  About End  -->

            <?php require_once('footer.php');?>
    </body>
</html>