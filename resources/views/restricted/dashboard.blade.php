@extends('templates.restricted')
@section('headerTitle')
    {{ Auth::guard('users')->user()->cashier_stripe_users_name ? Auth::guard('users')->user()->cashier_stripe_users_name." Dashboard" : Auth::guard('users')->user()->cashier_stripe_users_email. " Dashboard" }}
@endsection

@section("main_content")
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                      <h6 class="h2 text-white d-inline-block mb-0">Dashborad</h6>
                      <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                          <li class="breadcrumb-item"><a href="{{ route('restricted.dashboard.index') }}"><i class="fas fa-home"></i></a></li>
                          <li class="breadcrumb-item"><a href="{{ route('restricted.dashboard.index') }}">Dashboard</a></li>
                        </ol>
                      </nav>
                    </div>            
                </div>
              <!-- Card stats -->
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                      <!-- Card body -->
                        <div class="card-body">
                            <a href="{{ route('restricted.product.index') }}" >
                                <div class="row">
                                    <div class="col">
                                      <h5 class="card-title text-uppercase text-muted mb-0">Total Products</h5>
                                      <span class="h2 font-weight-bold mb-0">{{ $allProductsCount }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                          <i class="ni ni-active-40"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm">

                                </p>
                            </a>
                        </div>
                    </div>
                </div>                 
                </div>
            </div>
        </div>
    </div>
@endsection

