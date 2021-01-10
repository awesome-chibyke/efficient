@php $title = 'Email Verification' @endphp
@include('fincludes.head')
    <body>

        <!-- Start Navbar Area -->
        @include('fincludes.nav')
        <!-- End Navbar Area -->

        <!-- Start Page Title Area -->
        <section class="page-title-area">
            <div class="container">
                <div class="page-title-content">
                    <h1>Email Verification Notice</h1>
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
                            {{--<h2>Login</h2>--}}

                            <form method="post" action="{{ route('verification.send') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    @if (session('status'))
                                        <p class="alert alert-success" style="color:black;">
                                            {{ session('status') }}
                                        </p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <p class="alert alert-info">A message containing your account verification link have been sent to your mail box. Please visit your mail box and follow the link to continue. Please click the Resend button below to resend email if you can`t find the already sent one.</p>
                                </div>



                                <button type="submit">Resend Verification Email</button>
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