<?php
require_once('lib.php');
$title = 'Collection Centers | '.$siteName;
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
                                <h2>Collection Centers</h2>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="./">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">Collection Centers</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--  Home End  -->

            <!--  Services Start  -->
            <section class="services-wrapper py-6">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="title-box">
                                <h2 class="main-title"><?php print $siteName;?></h2>
                                <p class="sub-title">Collection Centers</p>
                            </div>
                        </div>
                    </div>
                    <div class="row row-sticky">
                        <div class="col-lg-12">
                            <div class="services-content-wrapper">

                                <div class="offering">
                                    <div class="row">
                                        <!--  Item-01  -->
                                        <div class="col-lg-12">
                                            <div class="offer-box">
                                                <div class="item-icon">
                                                    <i class="lni lni-map-marker"></i>
                                                </div>
                                                <div class="item-text">
                                                    <h5>UMUAHIA CENTRAL LEADER'S</h5>
                                                    <p class="mb-0">35 ABA ROAD UMUAHIA, OPPOSITE PATORIA HOTEL. DIKE IRENE, ABA, ABIA STATE, NIGERIA.<br>
                                                        08136992140, 09042977874</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  Item-02  -->

                                        <!--  Item-01  -->
                                        <div class="col-lg-12">
                                            <div class="offer-box">
                                                <div class="item-icon">
                                                    <i class="lni lni-map-marker"></i>
                                                </div>
                                                <div class="item-text">
                                                    <h5>UMUAHIA CENTRAL LEADER'S</h5>
                                                    <p class="mb-0">35 ABA ROAD UMUAHIA, OPPOSITE PATORIA HOTEL. DIKE IRENE, ABA, ABIA STATE, NIGERIA.<br>
                                                        08136992140, 09042977874</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  Item-02  -->


                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="sidebar-toggler d-lg-none">
                            <span><i class="lni lni-pencil-alt"></i></span>
                        </div>
                    </div>
                </div>
            </section>
            <!--   Services End   -->

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
            
            <?php require_once('footer.php');?>
    </body>
</html>