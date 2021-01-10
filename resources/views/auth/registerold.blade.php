@php $title = 'Registration' @endphp
@include('fincludes.head')
    <body>

        <!-- Start Navbar Area -->
        @include('fincludes.nav')
        <!-- End Navbar Area -->

        <!-- Start Page Title Area -->
        <section class="page-title-area">
            <div class="container">
                <div class="page-title-content">
                    <h1>Create account is free.</h1>
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
                            <h2>Create an account.</h2>

                            <form method="post" action="{{route('register')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    @if (session('success_message'))
                                        <p class="alert alert-success" style="color:black;">
                                            {{ session('success_message') }}
                                        </p>
                                    @endif
                                    @if (session('error_message'))
                                        <p class="alert alert-danger" style="color:black;">
                                            {{ session('error_message') }}
                                        </p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <input value="{{old('email')}}" type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror form-border" placeholder="Email Address">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="username">Username <span class="text-danger">*</span></label>
                                    <input type="text" value="{{old('username')}}" id="username" name="username" class="form-control form-border @error('username') is-invalid @enderror" placeholder="Username">
                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="phone">Phone <span class="text-danger">*</span></label>
                                    <input value="{{old('phone')}}" type="tel" id="phone" name="phone" class="form-control form-border @error('phone') is-invalid @enderror" placeholder="Phone Number">
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="gender">Gender <span class="text-danger">*</span></label>
                                    <select id="gender" name="gender" class="form-control form-border @error('gender') is-invalid @enderror" style="width: 100%;" >
                                        <option selected value="">Select Gender</option>
                                            <option @if(old('gender') === 'male') {{'selected'}} @endif value="male">Male</option>
                                            <option @if(old('gender') === 'female') {{'selected'}} @endif value="female">FeMale</option>
                                    </select>
                                    @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                                <div class="form-group " style="margin-top: 10px;" hidden>
                                    <label for="referral_id">Referal ID <small>(Optional)</small></label>
                                    <input value="{{isset($_GET['ref']) ? trim($_GET['ref']) : old('referral_id')}}" type="text" id="referral_id" name="referral_id" class="form-control form-border" placeholder="Referral ID">
                                    @error('referral_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                {{--<div class="form-group">
                                    <label for="preferred_center">Preferred Collection Center <span class="text-danger">*</span></label>
                                    <select id="preferred_center" name="preferred_center" class="form-control form-border @error('preferred_center') is-invalid @enderror" style="width: 100%;" >
                                        <option selected value="">Select Center</option>
                                        @if(count($collectionCenters) > 0)
                                            @foreach($collectionCenters as $k => $eachCollectionCenters)
                                            <option @if(old('preferred_center') === $eachCollectionCenters->unique_id) {{'selected'}} @endif value="{{$eachCollectionCenters->unique_id}}">{{$eachCollectionCenters->address.', '.$eachCollectionCenters->city_town.', '. $eachCollectionCenters->state_region_province.', '.$eachCollectionCenters->country}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('preferred_center')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>--}}


                                <div class="form-group">
                                    <label for="preferred_center">Preferred Collection Center <span class="text-danger">*</span></label>
                                    <select id="preferred_center" name="preferred_center" class="form-control js-example-basic-single form-border @error('preferred_center') is-invalid @enderror" style="width: 100%;" >

                                        <option selected value="">Select Center</option>
                                        @if(count($collectionCenters) > 0)
                                            @foreach($collectionCenters as $k => $eachCollectionCenters)
                                                <optgroup label="{{ucfirst($k).' State'}}">
                                                    @foreach($eachCollectionCenters as $l => $subCollection)
                                                        <option @if(old('preferred_center') === $subCollection->unique_id) {{'selected'}} @endif value="{{$subCollection->unique_id}}">{{ucwords($subCollection->team)}} - {{$subCollection->address.', '.$subCollection->city_town.', '. $subCollection->state_region_province.', '.$subCollection->country}}</option>
                                                    @endforeach
                                                </optgroup>

                                            @endforeach
                                        @endif
                                    </select>
                                    @error('preferred_center')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password">Password <span class="text-danger">*</span></label>
                                    <input type="password" id="pass" name="password" class="form-control form-border @error('password') is-invalid @enderror" placeholder="Password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Confirm Password <span class="text-danger">*</span></label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control form-border" placeholder="Confirm Password">
                                    @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                                {{--<p class="description">The password should be at least eight characters long. To make it stronger, use upper and lower case letters, numbers, and symbols like ! " ? $ % ^ & )</p>--}}
                                <p>Already have an account. <a href="{{route('login', isset($_GET['ref']) ? ['ref'=>trim($_GET['ref'])]: '')}}">Login</a></p>
                                <p>By clicking on the button below you agree to our <a href="terms-of-service">terms & conditions</a></p>
                                <button type="submit">Register</button>
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