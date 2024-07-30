<div id="kt_aside" class="aside" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
  <div class="aside-toolbar flex-column-auto" id="kt_aside_toolbar">
    <div class="aside-user d-flex align-items-sm-center justify-content-center py-5">
      <div class="symbol symbol-50px">
        <img src="https://ui-avatars.com/api/?background=F9F9F9&color=080655&bold=true&name={{ Auth::user()->name }}" alt="{{ Auth::user()->name }}" />
      </div>
      <div class="aside-user-info flex-row-fluid flex-wrap ms-5">
        <div class="d-flex align-items-center">
          <div class="flex-grow-1 me-2">
            <a href="#" class="text-white text-hover-primary fs-6 fw-bold">{{ Auth::user()->name }}</a>
            <span class="text-gray-600 fw-semibold d-block fs-8 mb-1">{{ Auth::user()->email }}</span>
          </div>
        </div>
      </div>
    </div>
    <div class="aside-search"> </div>
  </div>

  <div class="aside-menu flex-column-fluid">
    <div class="hover-scroll-overlay-y px-2 my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="{default: '#kt_aside_toolbar, #kt_aside_footer', lg: '#kt_header, #kt_aside_toolbar, #kt_aside_footer'}" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="5px">
      <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">
        
        <div class="menu-item @if ($title == 'Dashboard') here @endif">
          <a class="menu-link" href="{{ route('dashboard') }}">
            <span class="menu-icon">
              <i class="ki-duotone ki-element-11 fs-2">
                <span class="path1"></span>
                <span class="path2"></span>
                <span class="path3"></span>
                <span class="path4"></span>
              </i>
            </span>
            <span class="menu-title">Dashboard</span>
          </a>
        </div>

        <div class="menu-item pt-5">
          <div class="menu-content">
            <span class="menu-heading fw-bold text-uppercase fs-7">Menu </span>
          </div>
        </div>

        <div data-kt-menu-trigger="click" class="menu-item menu-accordion @if ($title == 'Produk') here show @endif">
          <span class="menu-link">
            <span class="menu-icon">
              <i class="ki-duotone ki-basket fs-2">
                <span class="path1"></span>
                <span class="path2"></span>
                <span class="path3"></span>
                <span class="path4"></span>
              </i>
            </span>
            <span class="menu-title">Produk</span>
            <span class="menu-arrow"></span>
          </span>
          <div class="menu-sub menu-sub-accordion menu-active-bg">
            <div class="menu-item @if ($subTitle == 'Data Produk') here @endif">
              <a class="menu-link" href="{{ route('product.index') }}">
                <span class="menu-bullet">
                  <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">Data Produk</span>
              </a>
            </div>
            <div class="menu-item @if ($subTitle == 'Kategori') here @endif">
              <a class="menu-link" href="{{ route('product.category.index') }}">
                <span class="menu-bullet">
                  <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">Kategori</span>
              </a>
            </div>
          </div>
        </div>

        <div data-kt-menu-trigger="click" class="menu-item menu-accordion @if ($title == 'Produk') here show @endif">
          <span class="menu-link">
            <span class="menu-icon">
              <i class="ki-duotone ki-handcart fs-2"></i>
            </span>
            <span class="menu-title">Transaksi</span>
            <span class="menu-arrow"></span>
          </span>
          <div class="menu-sub menu-sub-accordion menu-active-bg">
            <div class="menu-item @if ($subTitle == 'Data Produk') here @endif">
              <a class="menu-link" href="{{ route('transaction.pending.index') }}">
                <span class="menu-bullet">
                  <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">Pending</span>
              </a>
            </div>
            <div class="menu-item @if ($subTitle == 'Kategori') here @endif">
              <a class="menu-link" href="{{ route('transaction.onprogress.index') }}">
                <span class="menu-bullet">
                  <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">On Progress</span>
              </a>
            </div>
            <div class="menu-item @if ($subTitle == 'Kategori') here @endif">
              <a class="menu-link" href="{{ route('transaction.pickup.index') }}">
                <span class="menu-bullet">
                  <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">Pickup</span>
              </a>
            </div>
            <div class="menu-item @if ($subTitle == 'Kategori') here @endif">
              <a class="menu-link" href="{{ route('transaction.complete.index') }}">
                <span class="menu-bullet">
                  <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">Complete</span>
              </a>
            </div>
          </div>
        </div>

        {{-- <div class="menu-item @if ($title == 'Pool') here @endif">
          <a class="menu-link" href="{{ route('pool') }}">
            <span class="menu-icon">
              <i class="ki-duotone ki-flag fs-2">
              <span class="path1"></span>
              <span class="path2"></span>
              </i>
            </span>
            <span class="menu-title">Pool</span>
          </a>
        </div>

        <div class="menu-item @if ($title == 'Dumping Place') here @endif">
          <a class="menu-link" href="{{ route('dumping-place') }}">
            <span class="menu-icon">
              <i class="ki-duotone ki-geolocation fs-2">
                <span class="path1"></span>
                <span class="path2"></span>
              </i>
            </span>
            <span class="menu-title">Dumping Place</span>
          </a>
        </div>

        <div class="menu-item @if ($title == 'Landfill') here @endif">
          <a class="menu-link" href="{{ route('landfill') }}">
            <span class="menu-icon">
              <i class="ki-duotone ki-trash-square fs-2">
                <span class="path1"></span>
                <span class="path2"></span>
                <span class="path3"></span>
                <span class="path4"></span>
              </i>
            </span>
            <span class="menu-title">Landfill</span>
          </a>
        </div>

        <div class="menu-item @if ($title == 'Garbage Truck') here @endif">
          <a class="menu-link" href="{{ route('garbage-truck') }}">
            <span class="menu-icon">
              <i class="ki-duotone ki-truck fs-2">
                <span class="path1"></span>
                <span class="path2"></span>
                <span class="path3"></span>
                <span class="path4"></span>
                <span class="path5"></span>
              </i>
            </span>
            <span class="menu-title">Garbage truck</span>
          </a>
        </div>

        <div class="menu-item @if ($title == 'Route') here @endif">
          <a class="menu-link" href="{{ route('route') }}">
            <span class="menu-icon">
              <i class="ki-duotone ki-map fs-2">
                <span class="path1"></span>
                <span class="path2"></span>
                <span class="path3"></span>
              </i>
            </span>
            <span class="menu-title">Route</span>
          </a>
        </div> --}}

        <div class="menu-item @if ($title == 'User Management') here @endif">
          <a class="menu-link" href="{{ route('user') }}">
            <span class="menu-icon">
              <i class="ki-duotone ki-profile-user fs-2">
                <span class="path1"></span>
                <span class="path2"></span>
                <span class="path3"></span>
                <span class="path4"></span>
              </i>
            </span>
            <span class="menu-title">User Management</span>
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="aside-footer flex-column-auto py-5" id="kt_aside_footer">
    <a href="{{ route('logout') }}" class="btn btn-flex btn-custom btn-primary w-100 d-flex align-items-center">
      <i class="ki-duotone ki-entrance-right fs-2">
        <span class="path1"></span>
        <span class="path2"></span>
      </i>
      <span class="btn-label">Logout</span>
    </a>
  </div>
</div>