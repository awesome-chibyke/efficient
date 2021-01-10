<!-- Start Navbar Area -->
<div class="navbar-area">
    <div class="dibiz-responsive-nav">
        <div class="container">
            <div class="dibiz-responsive-menu">
                <div class="logo">
                    <a href="./">
                        <img src="image/logo.png" alt="logo">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="dibiz-nav">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light">
                <a class="navbar-brand" href="./">
                    <img src="image/logo.png" alt="logo">
                </a>

                <div class="collapse navbar-collapse mean-menu">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a href="./" class="nav-link <?php print @$active;?>">Home</a></li>
                        <li class="nav-item"><a href="#" class="nav-link <?php print @$active1;?>">About <i class='bx bx-chevron-down'></i></a>
                            <ul class="dropdown-menu">
                                <li class="nav-item"><a href="about" class="nav-link">About Us</a></li>
                                <li class="nav-item"><a href="anthem" class="nav-link">Our Anthem</a></li>
                                <li class="nav-item"><a href="teams" class="nav-link">Our Teams</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a href="how-it-works" class="nav-link <?php print @$active2;?>">How It Works</a></li>
                        <li class="nav-item"><a href="testimony" class="nav-link <?php print @$active3;?>">Testimony</a></li>
                        <li class="nav-item"><a href="gallery" class="nav-link<?php print @$active4;?>">Gallery</a></li>
                        <li class="nav-item"><a href="news-events" class="nav-link <?php print @$active5;?>">News/Events</a></li>
                        <li class="nav-item"><a href="contact" class="nav-link <?php print @$active6;?>">Contact</a></li>
                        <li class="nav-item"><a href="login" class="nav-link <?php print @$active7;?>">Login</a></li>
                        <li class="nav-item"><a href="register" class="nav-link <?php print @$active8;?>">Register</a></li>
                    </ul>

                    <div class="others-option d-flex align-items-center">
                        <div class="option-item">
                            <div class="search-box">
                                <i class="flaticon-search"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </nav>
        </div>
    </div>

    <div class="others-option-for-responsive">
        <div class="container">
            <div class="dot-menu">
                <div class="inner">
                    <div class="circle circle-one"></div>
                    <div class="circle circle-two"></div>
                    <div class="circle circle-three"></div>
                </div>
            </div>

            <div class="container">
                <div class="option-inner">
                    <div class="others-option justify-content-center d-flex align-items-center">
                        <div class="option-item">
                            <div class="cart-btn">
                                <a href="cart.html">
                                    <i class="flaticon-shopping-cart"></i>
                                    <span>1</span>
                                </a>
                            </div>
                        </div>

                        <div class="option-item">
                            <div class="search-box">
                                <i class="flaticon-search"></i>
                            </div>
                        </div>

                        <div class="option-item">
                            <div class="side-menu-btn">
                                <i class="flaticon-menu" data-toggle="modal" data-target="#sidebarModal"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Navbar Area -->