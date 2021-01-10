<?php
require_once('lib.php');
$title = 'News/Events | '.$siteName;
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
                                <h2>News/Events</h2>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="./">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">News/Events</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--  Home End  -->

            <!--  Blog Start  -->
            <section id="blog" class="blog-wrapper blog-02 py-6">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="title-box">
                                <h2 class="main-title">Our Latest News/Events</h2>
                                <p class="sub-title">Stay updated with happening around our communities.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Item 01 -->

                        <div class=" col-md-6 col-lg-4">
                            <div class="blog-box">
                                <div class="blog-header">
                                    <a href="news-events-details"><img src="assets/img/blog-01.jpg" alt="/"></a>
                                    <div class="blog-dates">
                                        <p class="blog-date">20</p>
                                        <p class="blog-month">Apr</p>
                                    </div>
                                </div>
                                <div class="blog-post-content">
                                    <h5>Why a visual identity system is memorable?</h5>
                                    <p>Lorem ipsum dolor sit amet consectetur adipiscing elit, sed do eiusmod tempor incididunt ut.</p>
                                    <div class="btn-01">
                                        <a href="news-events-details">
                                            <span>Read More</span>
                                            <i class="lni lni-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!--  Pagination -->
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
            </section>
            <!--   Blog End   -->

            
            <?php require_once('footer.php');?>
    </body>
</html>