<div class="scrollbar-inner">
      <!-- Brand -->
    <div class="sidenav-header  d-flex  align-items-center">
        <a class="navbar-brand" href="{{ route('restricted.dashboard.index') }}">
          <img src="{{asset("assets/img/brand/blue.png")}}" class="navbar-brand-img" alt="...">
        </a>
        <div class=" ml-auto ">
          <!-- Sidenav toggler -->
            <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
            <ul class="navbar-nav">            
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('restricted.dashboard.index') }}">
                    <i class="ni ni-shop text-primary"></i>
                    <span class="nav-link-text">Dashboard</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('restricted.product.index') }}">
                    <i class="ni ni-chart-pie-35 text-info"></i>
                    <span class="nav-link-text">Products</span>
                  </a>
                </li>                
            </ul>
          <!-- Divider -->        
        </div>
    </div>
</div>

