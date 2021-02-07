@extends('templates.frontend')
@section('headerTitle')
    Sumanas Coding Login
@endsection

@section('mainContent')
    <div class="main-content">
    <!-- Header -->
        <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
            <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <h1 class="text-white">Welcome!</h1>
              <p class="text-lead text-white">Login To Sumanas Coding Test.</p>
            </div>
          </div>
        </div>
      </div>
            <div class="separator separator-bottom separator-skew zindex-100">
              <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
              </svg>
            </div>
        </div>
    <!-- Page content -->
        <div class="container mt--8 pb-5">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card bg-secondary border-0 mb-0">
                        <div class="card-header bg-transparent pb-5">
                            <div class="text-muted text-center mt-2 mb-3"><small>Sign in with</small></div>
                            <div class="btn-wrapper text-center">
                              <a href="#" class="btn btn-neutral btn-icon">
                                <span class="btn-inner--icon"><img src="{{asset("assets/img/icons/common/github.svg")}}"></span>
                                <span class="btn-inner--text">Github</span>
                              </a>
                              <a href="#" class="btn btn-neutral btn-icon">
                                <span class="btn-inner--icon"><img src="{{asset("assets/img/icons/common/google.svg")}}"></span>
                                <span class="btn-inner--text">Google</span>
                              </a>
                            </div>
                        </div>
                        <div class="card-body px-lg-5 py-lg-5">
                            @if(Session::has('vmessage'))
                                <div class="alert alert-danger alert-dismissible fade show" id="alert">
                                    <span class="alert-text">{{ Session::get('vmessage') }}</span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if(Session::has('logoutmessage'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert">
                                    <span class="alert-text">{{ Session::get('logoutmessage') }}</span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            
                            <div class="text-center text-muted mb-4">
                              <small>Or sign in with credentials</small>
                            </div>
                            <form role="form" class="needs-validation" novalidate id="loginFrm" action="{{ route('login.doLogin') }}" method="post">
                                @csrf
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative {{ $errors->any() && $errors->has('cashier_stripe_users_userid') ? ' is-invalid' : '' }}">
                                        <div class="input-group-prepend">{{ $errors->any() && $errors->has('cashier_stripe_users_userid') ? ' is-invalid' : '' }}
                                          <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                        </div>
                                        <input class="form-control cashier_stripe_users_userid" placeholder="Email" type="email" name="cashier_stripe_users_userid" value="{{ old('cashier_stripe_users_userid') ? old('cashier_stripe_users_userid') : '' }}">                         
                                        
                                    </div>
                                    @if ($errors->any() && $errors->has('cashier_stripe_users_userid'))
                                            <span class="pdt_error_class_validate">
                                               {{ $errors->first('cashier_stripe_users_userid') }}
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative {{ $errors->any() && $errors->has('cashier_stripe_users_password') ? ' is-invalid' : '' }}">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                        </div>
                                        <input class="form-control cashier_stripe_users_password" placeholder="Password" type="password" name="cashier_stripe_users_password" value="{{ old('cashier_stripe_users_password') ? old('cashier_stripe_users_password') : '' }}">
                                        
                                    </div>
                                    @if ($errors->any() && $errors->has('cashier_stripe_users_password'))
                                            <span class="pdt_error_class_validate">
                                                {{ $errors->first('cashier_stripe_users_password') }}
                                            </span>
                                        @endif
                                </div>

                                <div class="text-center">
                                  <button type="submit" class="btn btn-primary my-4 loginBtn">Sign in</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                          <a href="#" class="text-light"><small>Forgot password?</small></a>
                        </div>
                        <div class="col-6 text-right">
                          <a href="#" class="text-light"><small>Create new account</small></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_scripts')
    <script type="text/javascript" src="{{asset('assets/js/validate.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/additionalmethod.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/loginValidation.js')}}"></script>
@endsection
