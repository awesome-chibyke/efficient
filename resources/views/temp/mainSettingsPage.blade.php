@php $pageTitle = 'Main Settings' @endphp

@extends('layouts.design')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-18">Main Settings for Website</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="/home">Home</a></li>
                            <li class="breadcrumb-item active">Main Settings for Website</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 box-margin">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            {{--<div class="col-sm-4">
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Reset Password</a>
                                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Update Profile Image</a>
                                </div>
                            </div>--}}
                            <div class="col-lg-2"></div>
                            <div class="col-sm-8">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade active show" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                        <div class="row">
                                            <div class="col-lg-6  col-lg-offset-3">
                                                @if (session('success_status'))
                                                    <p class="alert alert-success" style="color:black;">
                                                        {{ session('success_status') }}
                                                    </p>
                                                @endif
                                                @if (session('error_status'))
                                                    <p class="alert alert-danger" style="color:black;">
                                                        {{ session('error_status') }}
                                                    </p>
                                                @endif
                                            </div>
                                            <div class="col-lg-12">
                                                <form id="contactForm" method="post" action="{{ route('app_settings_sub', [$appSettings->unique_id]) }}" class="log-form">
                                                    @csrf

                                                    <div class="form-group">

                                                        <label for="site_name" class="control-label">{{ __('Name of Site') }}</label>
                                                        <input type="text" id="site_name" name="site_name" value="{{ $appSettings->site_name }}" class="form-control @error('site_name') is-invalid @enderror" placeholder="Site Name" required data-error="Site Name is required" />

                                                        @error('site_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="address1" class="control-label">{{ __('Address 1') }}</label>
                                                        <input type="text" id="address1" name="address1" value="{{ $appSettings->address1 }}" class="form-control @error('address1') is-invalid @enderror" placeholder="Address 1" required data-error="Address 1 is required" />

                                                        @error('address1')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="address2" class="control-label">{{ __('Address 2') }}</label>
                                                        <input type="text" id="address2" name="address2" value="{{ $appSettings->address2 }}" class="form-control @error('address2') is-invalid @enderror" placeholder="Address 2" required data-error="Address 2" />

                                                        @error('address2')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="address_3" class="control-label">{{ __('Address 3') }}</label>
                                                        <input type="text" id="address_3" name="address_3" value="{{ $appSettings->address_3 }}" class="form-control @error('address_3') is-invalid @enderror" placeholder="Address 2" required data-error="Address 3" />

                                                        @error('address_3')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="address4" class="control-label">{{ __('Address 4') }}</label>
                                                        <input type="text" id="address4" name="address4" value="{{ $appSettings->address4 }}" class="form-control @error('address4') is-invalid @enderror" placeholder="Address 4" required data-error="Address 4" />

                                                        @error('address4')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="slot_setup" class="control-label">{{ __('Slot Setup (Slots)') }}</label>
                                                        <input type="text" id="slot_setup" name="slot_setup" value="{{ $appSettings->slot_setup }}" class="form-control @error('slot_setup') is-invalid @enderror" placeholder="Slot Setup" required data-error="Slot Setup" />

                                                        @error('slot_setup')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="email1" class="control-label">{{ __('Email 1') }}</label>
                                                        <input type="email" id="email1" name="email1" value="{{ $appSettings->email1 }}" class="form-control @error('email1') is-invalid @enderror" placeholder="Email 1" required data-error="Email 1" />
                                                        @error('email1')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="email2" class="control-label">{{ __('Email 2') }}</label>
                                                        <input type="email" id="email2" name="email2" value="{{ $appSettings->email2 }}" class="form-control @error('email2') is-invalid @enderror" placeholder="Email 2" required data-error="Email 2" />

                                                        @error('email2')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="site_url" class="control-label">{{ __('Website Url') }}</label>
                                                        <input type="url" id="site_url" name="site_url" value="{{ $appSettings->site_url }}" class="form-control @error('site_url') is-invalid @enderror" placeholder="Website Url" data-error="Website Url" />

                                                        @error('site_url')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group" >
                                                        <label for="logo_url" class="control-label">{{ __('Logo Link') }}</label>
                                                        <input type="url" id="logo_url" name="logo_url" value="{{ $appSettings->logo_url }}" class="form-control @error('logo_url') is-invalid @enderror" placeholder="Website Url" required data-error="Logo Link" />

                                                        @error('logo_url')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="facebook" class="control-label">{{ __('FaceBook Page/Profile/Group URL') }} </label>
                                                        <input type="text" id="facebook" name="facebook" value="{{ $appSettings->facebook }}" class="form-control @error('facebook') is-invalid @enderror" placeholder="FaceBook Page/Profile/Group URL" data-error="FaceBook Page/Profile/Group URL is required" />
                                                        @error('facebook')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="email2" class="control-label">{{ __('Instagram Page/Profile') }} </label>
                                                        <input type="text" id="instagram" name="instagram" value="{{ $appSettings->instagram }}" class="form-control @error('instagram') is-invalid @enderror" placeholder="Instagram" required data-error="Instagram is Required" />

                                                        @error('instagram')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="email2" class="control-label">{{ __('Twitter Profile Url') }}</label>
                                                        <input type="text" id="twitter" name="twitter" value="{{ $appSettings->twitter }}" class="form-control @error('twitter') is-invalid @enderror" placeholder="Twitter" required data-error="Twitter is Required" />

                                                        @error('twitter')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="email2" class="control-label">{{ __('Linkedin Profile Url') }}</label>
                                                        <input type="text" id="linkedin" name="linkedin" value="{{ $appSettings->linkedin }}" class="form-control @error('linkedin') is-invalid @enderror" placeholder="Linkedin Profile Url" required data-error="Linkedin is Required" />

                                                        @error('linkedin')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="phone1" class="control-label">{{ __('Phone 1') }} </label>
                                                        <input type="text" id="phone1" name="phone1" value="{{ $appSettings->phone1 }}" class="form-control @error('least_withdrawable_amount') is-invalid @enderror" placeholder="phone 1" required data-error="Phone 1 is Required" />

                                                        @error('phone1')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="phone2" class="control-label">{{ __('Whats App: Format => 2348123435645') }} </label>
                                                        <input type="text" id="phone2" name="phone2" value="{{ $appSettings->phone2 }}" class="form-control @error('phone2') is-invalid @enderror" placeholder="Whats App" required data-error="Whats App is Required" />

                                                        @error('phone2')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="least_withdrawable_amount" class="control-label">{{ __('Set the minimum amount a user must possess before he/she can make withdrawals') }} ({{auth()->user()->currency_details->second_currency}})</label>
                                                        <input type="text" id="least_withdrawable_amount" name="least_withdrawable_amount" value="{{ round($appSettings->least_withdrawable_amount*auth()->user()->currency_details->rate_of_conversion) }}" class="form-control @error('least_withdrawable_amount') is-invalid @enderror" placeholder="Amount" required data-error="Amount is Required" />

                                                        @error('least_withdrawable_amount')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="no_of_days_to_review" class="control-label">{{ __('Number Of Days Before A User Will have to Add A Review/Testimony') }} </label>
                                                        <input type="text" id="no_of_days_to_review" name="no_of_days_to_review" value="{{ $appSettings->no_of_days_to_review }}" class="form-control @error('no_of_days_to_review') is-invalid @enderror" placeholder="Number of Days Before a Testimony" />

                                                        @error('no_of_days_to_review')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="total_projects" class="control-label">{{ __('Total Number of Projects Carried Out So Far') }} </label>
                                                        <input type="text" id="total_projects" name="total_projects" value="{{ $appSettings->total_projects }}" class="form-control @error('total_projects') is-invalid @enderror" placeholder="Total Number of Projects" />

                                                        @error('total_projects')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>



                                                    <div class="form-group">
                                                        <label for="public_key" class="control-label">{{ __('Flutter Wave Public Key') }} </label>
                                                        <input type="text" id="public_key" name="public_key" value="{{ $appSettings->public_key }}" class="form-control @error('public_key') is-invalid @enderror" placeholder="Amount" required data-error="Public Key is Required" />

                                                        @error('public_key')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="secret_key" class="control-label">{{ __('Flutter Wave Secret Key') }} </label>
                                                        <input type="text" id="secret_key" name="secret_key" value="{{ $appSettings->secret_key }}" class="form-control @error('secret_key') is-invalid @enderror" placeholder="Secret Key" required data-error="Private Key is Required" />

                                                        @error('secret_key')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="encrypt_key" class="control-label">{{ __('Flutter Wave Encryption Key') }} </label>
                                                        <input type="text" id="encrypt_key" name="encrypt_key" value="{{ $appSettings->encrypt_key }}" class="form-control @error('encrypt_key') is-invalid @enderror" placeholder="Encryption Key" required data-error="Encryption Key is Required" />

                                                        @error('encrypt_key')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>

                                                    <hr>
                                                    <div>
                                                        <h3>Bank Section</h3>
                                                    </div>

                                                    @if(count($allBanks) > 0)

                                                        @foreach($allBanks as $kk => $eachBankeDetails)
                                                            <hr><div><h4>{{$kk + 1}}</h4></div>
                                                            <div class="form-group">
                                                                <label for="bank_code" class="control-label">{{ __('Bank Name') }} </label>
                                                                <select onchange="dropBankName(this)" id="bank_code" name="bank_code[]" class="bank_code form-control @error('bank_code') is-invalid @enderror" data-bank-code="{{$eachBankeDetails->bank_code}}"  >

                                                                </select>
                                                                <input type="hidden" id="bank_name" name="bank_name[]" value="{{ $eachBankeDetails->bank_name }}" class="bank_name form-control @error('bank_name') is-invalid @enderror" placeholder="Bank Account Name" required data-error="Encryption Key is Required" />

                                                                @error('bank_code')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="bank_account_no" class="control-label">{{ __('Bank Account Number') }} </label>
                                                                <input type="text" id="bank_account_no" name="bank_account_no[]" value="{{ $eachBankeDetails->bank_account_no }}" class="form-control @error('bank_account_no') is-invalid @enderror" placeholder="Bank Account Number" required data-error="Bank Account Number is Required" />
                                                                <input value="{{$eachBankeDetails->unique_id}}" type="hidden" name="bankUniqueId[]">

                                                                @error('bank_account_no')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="account_name" class="control-label">{{ __('Bank Account Name') }} </label>
                                                                <input type="text" id="account_name" name="account_name[]" value="{{ $eachBankeDetails->account_name }}" class="form-control @error('account_name') is-invalid @enderror" placeholder="Account Name" required data-error="Account Name is Required" />

                                                                @error('account_name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <hr><div><h4>1</h4></div>
                                                        <div class="form-group">
                                                            <label for="bank_code" class="control-label">{{ __('Bank Name') }} </label>
                                                            <select required onchange="dropBankName(this)" id="bank_code" name="bank_code[]" class="bank_code form-control @error('bank_code') is-invalid @enderror" data-bank-code=""  >

                                                            </select>
                                                            <input type="hidden" id="bank_name" name="bank_name[]" value="{{old('bank_name')}}" class="bank_name form-control @error('bank_name') is-invalid @enderror" placeholder="Bank Account Name" required data-error="Encryption Key is Required" />

                                                            @error('bank_code')
                                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="bank_account_no" class="control-label">{{ __('Bank Account Number') }} </label>
                                                            <input type="text" id="bank_account_no" name="bank_account_no[]" value="{{old('bank_account_no')}}" class="form-control @error('bank_account_no') is-invalid @enderror" placeholder="Bank Account Number" required data-error="Bank Account Number is Required" />
                                                            <input type="hidden" name="bankUniqueId[]">

                                                            @error('bank_account_no')
                                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="account_name" class="control-label">{{ __('Bank Account Name') }} </label>
                                                            <input type="text" id="account_name" name="account_name[]" value="{{old('account_name')}}" class="form-control @error('account_name') is-invalid @enderror" placeholder="Account Name" required data-error="Account Name is Required" />

                                                            @error('account_name')
                                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    @endif

                                                    <div class="form-group theSubmitButton">
                                                        <button onclick="addNewFields()" type="button" class="btn btn-primary">Add New Banks Details Field</button>
                                                    </div>

                                                    <div class="form-group">
                                                        <button type="submit" class="btn guoBtn">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection