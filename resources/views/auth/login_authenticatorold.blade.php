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
            <h1>Login Authentication</h1>
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
                    <h2>Login Authentication</h2>

                    <form method="post" action="{{route('update_login_auth')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            @if (session('success_message'))
                                <p class="alert alert-success" style="color:black;">
                                    {{ session('success_message') }}
                                </p>
                            @endif
                            @if (session('error_message'))
                                <p class="alert alert-success" style="color:black;">
                                    {{ session('error_message') }}
                                </p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="code">Login Authentication Code</label>
                            <input type="text" id="code" value="{{session('code')}}" name="code" class="form-control" placeholder="Authentication Code">
                            @error('code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                        <button type="submit">Authenticate Login</button><br>
                        <a style="margin-top: 20px; font-weight: bold;" href="{{route('resend_login_authenticator')}}">Resend Code</a>
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
    });

    function getRequestCaller(url){

        return new Promise(function (resolve, reject) {
            /*fetch(url)
                .then(res => res.json())
                .then(data => resolve(data))
                .then(err => reject(err));*/

            fetch(url, {
                headers: {
                    'Access-Control-Allow-Origin': 'https://www.bulksmsnigeria.com'
                }
            })
                .then(res => res.json())
                .then(data => resolve(data))
                .then(err => reject(err));

        });
    }//headers: {  'Access-Control-Allow-Origin': 'http://The web site allowed to access' }

    async function callAuthenticator() {

        let getMessage = await getRequestCaller("{{URL::to('/')}}/send_text");

        if(getMessage.status === true){
            //let result = await getRequestCaller(getMessage.data);
            $.ajax({
                type: 'POST',
                crossDomain: true,
                dataType: 'jsonp',
                url: getMessage.data,
                success: function(jsondata){
                    console.log(jsondata)
                }
            })
        }


    }
    callAuthenticator();

</script>