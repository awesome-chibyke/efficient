<?php
require_once('lib.php');
$title = 'News/Events Details | '.$siteName;
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
                                <h2>News/Events Details</h2>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="./">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">News/Events Details</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--  Home End  -->

            <!--  blog Single Start  -->
            <section class="blog-single py-6">
                <div class="container">
                    <div class="row row-sticky">
                        <div class="col-lg-8 post-content">
                            <div class="single-post">
                                <div class="entry-image">
                                    <img src="assets/img/blog-02.jpg" alt="">
                                </div>
                                <div class="entry-content">
                                    <h3>Team we want to work without mistakes runner</h3>
                                    <p class="mb-0">These words are here to provide the reader with a basic impression of how actual text will appear in its final presentation. This is dummy copy. It is not meant to be read. It has been placed here solely to demonstrate the look and feel of finished, typeset text. These words are here to provide the reader with a basic impression of how actual text will appear in its final presentation. Only for show.</p>

                                </div>
                            </div>
                        </div>
                        <aside class="col-lg-4 sidebar col-sticky property-sidebar-sticky">
                            <div class="sidebar-wrapper">
                                <!--Search-->
                                <div class="search-boxes">
                                    <div class="search">
                                        <form>
                                            <div class="position-relative  form-group">
                                                <input type="text" placeholder="Enter your keywords..." name="search">
                                                <button type="submit" class="btn">
                                                    <i class="lni lni-search-alt"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="aside-contents">
                                    <!-- Recent Post -->
                                    <div class="aside-box">
                                        <div class="aside-title">
                                            <h6>Recent Post</h6>
                                        </div>
                                        <div class="post-box">
                                            <!-- Item 01 -->
                                            <div class="post-list">
                                                <div class="post-image">
                                                    <a href="javascript:void(0);">
                                                        <img src="assets/img/instagram-01.jpg" alt="/">
                                                    </a>
                                                </div>
                                                <div class="post-content">
                                                    <h5 class="post-title">
                                                        <a href="javascript:void(0);">Why a visual identity system is more memorable?</a>
                                                    </h5>
                                                    <p class="blog-date">Oct,28,2020</p>
                                                </div>
                                            </div>
                                            <!-- Item 02 -->
                                            <div class="post-list">
                                                <div class="post-image">
                                                    <a href="javascript:void(0);">
                                                        <img src="assets/img/instagram-02.jpg" alt="/">
                                                    </a>
                                                </div>
                                                <div class="post-content">
                                                    <h5 class="post-title">
                                                        <a href="javascript:void(0);">8 Steps to making better business decisions</a>
                                                    </h5>
                                                    <p class="blog-date">Oct,28,2020</p>
                                                </div>
                                            </div>
                                            <!-- Item 03 -->
                                            <div class="post-list">
                                                <div class="post-image">
                                                    <a href="javascript:void(0);">
                                                        <img src="assets/img/instagram-03.jpg" alt="/">
                                                    </a>
                                                </div>
                                                <div class="post-content">
                                                    <h5 class="post-title">
                                                        <a href="javascript:void(0);">Team we want to work without mistakes runner</a>
                                                    </h5>
                                                    <p class="blog-date">Oct,28,2020</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </aside>
                        <div class="sidebar-toggler d-lg-none">
                            <span><i class="lni lni-pencil-alt"></i></span>
                        </div>
                    </div>
                </div>
            </section>
            <!--  blog Single End  -->


            
            <?php require_once('footer.php');?>
    </body>
</html>