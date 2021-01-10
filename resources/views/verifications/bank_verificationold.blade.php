@include('fincludes.head')
    <body>

        <!-- Start Navbar Area -->
        @include('fincludes.nav')
        <!-- End Navbar Area -->

        <!-- Start Page Title Area -->
        <section class="page-title-area">
            <div class="container">
                <div class="page-title-content">
                    <h1>Bank Account Verification</h1>
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
        <section class="profile-authentication-area ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12 offset-2">
                        <div class="login-form">

                          <div class="form-group">
                            <div id="bank_info"></div>
                          </div>

                            <form method="post" action="{{route('add-bank', ['userId'=>$userDetails->unique_id])}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Select Bank</label>
                                    <select id="banks_user" onclick="dropBankName(this)" data-bank-code="{{$userDetails->bank_code}}" name="bank_code" class="form-control bank_code" style="width: 100%">
                                      <option value="" disabled selected>Select your bank</option>
                                    </select>
                                    <input type="hidden" name="bank" value="{{$userDetails->bank}}" class="bank_name" id="bank_name"/>

                                </div>

                                <div class="form-group">
                                    <label>Account Name</label>
                                    <input type="text" required name="account_name" value="{{$userDetails->account_name}}" id="account_name" class="form-control"  placeholder="Account Name">
                                </div>

                                <div class="form-group">
                                    <label>Account Number</label>
                                    <input name="account_number" type="text" required value="{{$userDetails->account_number}}" id="account_number" class="form-control"  placeholder="Account number">
                                </div>


                                <button class="btn btn-success" type="submit">Submit</button>

                            </form>
                        </div>
                    </div>
                    

                </div>
            </div>
        </section>
        <!-- Start Profile Authentication Area -->

        @include('fincludes.footer')
        @include('js_files.user_account_manager')
