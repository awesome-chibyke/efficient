<?php
require_once('lib.php');
$title = 'FAQs | '.$siteName;
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
                                <h2>Frequently Asked Questions</h2>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="./">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">FAQ</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--  Home End  -->

            <!--  Faq Start  -->
            <section class="faq pt-6  pb-50">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="title-box">
                                <h2 class="main-title">Frequently Asked Questions</h2>
                                <p class="sub-title">You can learn more by asked questions </p>
                            </div>
                        </div>
                    </div>
                    <div  class="row">
                        <div class="col-lg-12">
                            <!--Accordion wrapper-->
                            <div class="accordion about-content" id="accordionColumn1" role="tablist" aria-multiselectable="true">
                                <!-- Item 01 -->
                                <div class="card">
                                    <div class="card-header" role="tab" id="headingOne">
                                        <a data-toggle="collapse" data-parent="#accordionColumn1" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <h3 class="mb-0">What I can provide?</h3>
                                        </a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne"
                                         data-parent="#accordionColumn1">
                                        <div class="card-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit. esse cillum dolore eu fugiat nulla pariatur.
                                        </div>
                                    </div>
                                </div>
                                <!-- Item 02 -->
                                <div class="card">
                                    <div class="card-header" role="tab" id="headingTwo">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionColumn1" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            <h3 class="mb-0">How much time I will to invest?</h3>
                                        </a>
                                    </div>
                                    <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo"
                                         data-parent="#accordionColumn1">
                                        <div class="card-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                        </div>
                                    </div>
                                </div>
                                <!-- Item 03 -->
                                <div class="card">
                                    <div class="card-header" role="tab" id="headingThree">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionColumn1" href="#collapseThree"
                                           aria-expanded="false" aria-controls="collapseThree">
                                            <h3 class="mb-0">Other services you offer?</h3>
                                        </a>
                                    </div>
                                    <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree"
                                         data-parent="#accordionColumn1">
                                        <div class="card-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Accordion wrapper End -->
                        </div>

                    </div>
                </div>
            </section>
            <!--   Faq End   -->

            <?php require_once('footer.php');?>
    </body>
</html>