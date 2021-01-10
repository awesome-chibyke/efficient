@php $pageTitle = 'Edit Profile' @endphp

@extends('layouts.design')

@section('content')

    <!-- Basic Form area Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-18">Edit Profile</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Edit Profile</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form row -->
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-sm-12 box-margin height-card">
                <div class="card">
                    <div class="card-body">
                        <form id="contactForm" method="POST" action="{{ route('updateProfile') }}" class="log-form">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="name">{{ __('Name') }}</label>
                                        <input type="text" id="name" name="name" value="{{$userDetails->name}}" class="form-control @error('name') is-invalid @enderror" placeholder="Full Name" required data-error="Full Name" autofocus>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="gender">{{ __('Gender') }}</label>
                                        @php $gender = strtolower($userDetails->gender) @endphp
                                        <select id="gender" name="gender" class="form-control @error('gender') is-invalid @enderror" >
                                            <option @if($gender === null) {{'selected'}} @endif value="">Select Gender</option>
                                            <option @if($gender === 'male') {{'selected'}} @endif value="male">Male</option>
                                            <option @if($gender === 'female') {{'selected'}} @endif value="female">Female</option>
                                        </select>
                                        @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="date_of_birth">{{ __('Date Of Birth') }}</label>
                                        <input type="date" id="date_of_birth" name="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror" placeholder="Your State" value="{{$userDetails->date_of_birth}}"  />
                                        @error('date_of_birth')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="phone">{{ __('Phone Number') }}</label>
                                        <input type="number" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Your Phone Number" value="{{$userDetails->phone}}"  />
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="address">{{ __('Address') }}</label>
                                        <input type="text" id="address" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Your Address" value="{{$userDetails->address}}"  />
                                        @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="city">{{ __('City') }}</label>
                                        <input type="text" id="city" name="city" class="form-control @error('city') is-invalid @enderror" placeholder="Your City" value="{{$userDetails->city}}"  />
                                        @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="state">{{ __('State / Region') }}</label>
                                        <input type="text" id="state" name="state" class="form-control @error('state') is-invalid @enderror" placeholder="Your State" value="{{$userDetails->state}}"  />
                                        @error('state')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="country">{{ __('Country') }}</label>
                                        <select id="country" name="country" class="form-control @error('country') is-invalid @enderror" ></select>
                                        @error('country')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="preferred_center">{{ __('Preferred Collection Center') }}</label>
                                        <select name="preferred_center" class="form-control js-example-basic-single @error('preferred_center') is-invalid @enderror" >
                                            @php $selectedCenter = $userDetails->preferred_center; @endphp
                                            <option value="">Select Center</option>
                                            @if(count($centers) > 0 )
                                                @foreach($centers as $k => $center)
                                                    <optgroup label="{{ucfirst($k)}}">
                                                        @foreach($center as $l => $eachCenter)
                                                            <option @if($selectedCenter  === $eachCenter->unique_id) {{'selected'}} @endif value="{{$eachCenter->unique_id}}">
    {{ucwords($eachCenter->team)}} - {{$eachCenter->address.', '.$eachCenter->city_town.', '. $eachCenter->state_region_province.', '.$eachCenter->country}}
                                                            </option>
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
                                </div><!-- Col -->

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn guoBtn">Update Profile</button>
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
