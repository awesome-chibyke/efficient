@php $title = 'Login Area' @endphp
@include('fincludes.head')
    <body>

        <!-- Start Navbar Area -->
        @include('fincludes.nav')
        <!-- End Navbar Area -->

        <!-- Start Page Title Area -->
        <section class="page-title-area">
            <div class="container">
                <div class="page-title-content">
                    <h1>Login to start a session.</h1>
                </div>
            </div>

            <div class="shape2"><img src="{{asset('main/assets/img/shape/shape2.png')}}" alt="image"></div>
            <div class="shape3"><img src="{{asset('main/assets/img/shape/shape3.png')}}" alt="image"></div>
            <div class="shape5"><img src="{{asset('main/assets/img/shape/shape5.png')}}" alt="image"></div>
            <div class="shape6"><img src="{{asset('main/assets/img/shape/shape6.png')}}" alt="image"></div>
            <div class="shape7"><img src="{{asset('main/assets/img/shape/shape7.png')}}" alt="image"></div>
            <div class="shape8"><img src="{{asset('main/assets/img/shape/shape8.png')}}" alt="image"></div>
            <div class="lines">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
        </section>
        <!-- End Page Title Area -->

        <!-- Start Profile Authentication Area -->
        <section class="profile-authentication-area ptb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12 offset-2">
                        <div class="login-form">
                            <h2>Login</h2>

                            <form method="post" action="{{ route('login') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    @if (session('status'))
                                        <p class="alert alert-success" style="color:black;">
                                            {{ session('status') }}
                                        </p>
                                    @endif
                                    @if (session('hold_ref'))
                                        <p class="alert alert-success" style="color:black;">
                                            {{ session('hold_ref') }}
                                        </p>
                                    @endif
                                </div>
                                <input type="hidden" name="refId" value="{{$refId ?? ''}}">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input type="text" id="email" value="{{session('hold_ref')}}" name="email" class="form-control" placeholder="Email Address">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" id="password" name="password" class="form-control"  placeholder="Password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="row align-items-center">
                                    <div class="col-lg-6 col-md-6 col-sm-6 remember-me-wrap">
                                        <p>
                                            <input type="checkbox" name="remember" id="test2">
                                            <label for="test2">Remember me</label>
                                        </p>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6 lost-your-password-wrap">
                                        <a href="{{route('password.request')}}" class="lost-your-password">Lost your password?</a>
                                    </div>
                                </div>

                                <button type="submit">Log In</button>
                            </form>
                        </div>
                    </div>
                    

                </div>
            </div>
        </section>
        <!-- Start Profile Authentication Area -->
        @include('fincludes.footer')
        <script>
            $(document).ready(function () {
                showErrors();
            })
        </script>