<!-- Start Top Header Area -->
<div class="navbar-area <?php if(isset($active)){print 'navbar-color-white';}else{print 'navbar-style-two';};?>">

    <div class="container-fluid" style="padding-bottom: 10px; border-bottom: solid 2px #000000;">
        <div class="row align-items-center">
            <div class="col-lg-12 col-md-12">
                <ul class="top-header-contact-info">
                    <li><i class='bx bx-phone-call'></i> <a href="tel:<?php print $sitePhone;?>"  style="color:#333;"><?php print $sitePhone;?></a></li>
                    <li><i class='bx bx-envelope'></i> <a href="mailto:<?php print $siteEmail;?>" style="color:#333;"><?php print $siteEmail;?></a></li>
                </ul>
            </div>

            <!--<div class="col-lg-6 col-md-6 hidden-xs">
                <div class="top-header-btn">
                    <a href="contact.html" class="default-btn">Free Site Analysis</a>
                </div>
            </div>-->
        </div>
    </div>

    <div class="dibiz-responsive-nav">
        <div class="container-fluid">
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
        <div class="container-fluid">
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
                                <!--<li class="nav-item"><a href="teams" class="nav-link">Our Teams</a></li>-->
                                <li class="nav-item"><a href="collection-centers" class="nav-link">Collection Centers</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a href="how-it-works" class="nav-link <?php print @$active2;?>">How It Works</a></li>
                        <li class="nav-item"><a href="testimony" class="nav-link <?php print @$active3;?>">Testimony</a></li>
                        <li class="nav-item"><a href="gallery" class="nav-link <?php print @$active4;?>">Gallery</a></li>
                        <li class="nav-item"><a href="news-events" class="nav-link <?php print @$active5;?>">News/Events</a></li>
                        <li class="nav-item"><a href="contact" class="nav-link <?php print @$active6;?>">Contact</a></li>
                        <li class="nav-item"><a href="packages" class="nav-link <?php print @$active9;?>">Packages</a></li>
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
</div>

<!-- Search Overlay -->
<div class="search-overlay">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="search-overlay-layer"></div>
            <div class="search-overlay-layer"></div>
            <div class="search-overlay-layer"></div>

            <div class="search-overlay-close">
                <span class="search-overlay-close-line"></span>
                <span class="search-overlay-close-line"></span>
            </div>

            <div class="search-overlay-form">
                <form>
                    <input type="text" class="input-search" placeholder="Search here...">
                    <button type="submit"><i class="flaticon-search"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Search Overlay -->