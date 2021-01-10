<?php
require_once('lib.php');
$title = 'Gallery | '.$siteName;
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
                                <h2>Gallery</h2>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="./">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">Gallery</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--  Home End  -->

            <!-- Portfolio Start -->
            <section id="portfolio" class="portfolio-wrapper portfolio-02 column-4 pt-6">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="title-box">
                                <h2 class="main-title">Events Gallery</h2>
                                <p class="sub-title">Don`t miss out a moment</p>
                            </div>

                        </div>
                    </div>

                    <div class="portfolio-body">
                        <div class="portfolio-items row">

                            <!--  Item 01  -->
                            <div class="col-md-6 col-lg-3 marketing">
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

                        </div>
                    </div>
                </div>
            </section>

            <section id="portfolio" class="portfolio-wrapper portfolio-02 column-4">
                <!--  Pagination -->
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mx-auto">
                                <div class="mx-auto my-4 pagination-box">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination justify-content-center">
                                            <li class="page-item disabled">
                                                <a href="javascript:void(0);" class="page-link" tabindex="-1">Previous</a>
                                            </li>
                                            <li class="page-item active"><a href="javascript:void(0);" class="page-link">1</a></li>
                                            <li class="page-item"><a href="javascript:void(0);" class="page-link">2</a></li>
                                            <li class="page-item"><a href="javascript:void(0);" class="page-link">3</a></li>
                                            <li class="page-item">
                                                <a href="javascript:void(0);" class="page-link">Next</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--  Portfolio End  -->

            
            <?php require_once('footer.php');?>
    </body>
</html>