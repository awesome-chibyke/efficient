<!-- Header Start -->
<header id="header" class="header-section <?php print $fixed_top;?> w-100">
    <div class="top-header-area">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="top-header-info">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item">
                                <i class="lni lni-envelope"></i>
                                <a href="mailto:<?php print $siteEmail;?>"><span ><?php print $siteEmail;?></span></a>
                            </li>
                            <li class="list-inline-item">
                                <i class="lni lni-mobile"></i>
                                <a href="tel:<?php print $sitePhone;?>"><?php print $sitePhone;?></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="top-header-social">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item">
                                <i class="lni lni-alarm-clock"></i>
                                Mon-Sun  8:30 am - 06 pm
                            </li>
                            <li class="list-inline-item">
                                <a href="<?php print $siteFacebook;?>">
                                    <i class="lni lni-facebook-filled"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="<?php print $siteTwitter;?>">
                                    <i class="lni lni-twitter-original"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="<?php print $siteWhatsApp;?>">
                                    <i class="lni lni-whatsapp"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="<?php print $siteInstagram;?>">
                                    <i class="lni lni-instagram-original"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="container">
        <div class="row header-bottom dir-ltr">
            <nav class="navbar navbar-expand-lg w-100 header-nav py-0 pl-0">
                <a class="navbar-brand" href="./"><img src="{{asset('front/img/logo.png')}}" alt="/"></a>
                <button type="button" data-toggle="collapse" data-target="#toggle-menu" aria-controls="toggle-menu" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler collapsed">
                    <span class="lni lni-menu"></span>
                </button>
                <div id="toggle-menu" class="collapse navbar-collapse">
                    <ul class="navbar-nav w-100">
                        <li class="nav-item ml-auto">
                            <a role="button"  aria-expanded="false" href="./" class="nav-link"><h2>Home</h2></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="javascript:void(0);" class="nav-link dropdown-toggle"><h2>About</h2></a>
                            <div class="dropdown-menu">
                                <div class="menu-items">
                                    <h3 class="title-feature">
                                        <a href="about">
                                            About Us
                                        </a>
                                    </h3>
                                    <h3 class="title-feature">
                                        <a href="faq">
                                            FAQs
                                        </a>
                                    </h3>
                                    <h3 class="title-feature">
                                        <a href="collection-centers">
                                            Collection Centers
                                        </a>
                                    </h3>
                                    <h3 class="title-feature">
                                        <a href="gallery">
                                            Gallery
                                        </a>
                                    </h3>
                                    <h3 class="title-feature">
                                        <a href="news-events">
                                            News/Events
                                        </a>
                                    </h3>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a role="button"  aria-expanded="false" href="how-it-works" class="nav-link"><h2>How It Works</h2></a>
                        </li>
                        <li class="nav-item">
                            <a role="button"  aria-expanded="false" href="testimony" class="nav-link"><h2>Testimony</h2></a>
                        </li>
                        <li class="nav-item">
                            <a role="button"  aria-expanded="false" href="plans" class="nav-link"><h2>Plans</h2></a>
                        </li>
                        <li class="nav-item">
                            <a role="button"  aria-expanded="false" href="contact" class="nav-link"><h2>Contact</h2></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="javascript:void(0);" class="nav-link dropdown-toggle"><h2>Accounts</h2></a>
                            <div class="dropdown-menu">
                                <div class="menu-items">
                                    <h3 class="title-feature">
                                        <a href="dashboard/">
                                            Dashboard
                                        </a>
                                    </h3>
                                    <h3 class="title-feature">
                                        <a href="login">
                                            Login
                                        </a>
                                    </h3>
                                    <h3 class="title-feature">
                                        <a href="register">
                                            Register
                                        </a>
                                    </h3>
                                    <h3 class="title-feature">
                                        <a href="logout">
                                            Logout
                                        </a>
                                    </h3>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
<!-- Header End -->

