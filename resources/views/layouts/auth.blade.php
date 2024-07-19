<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <base href=""/>
    <meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="" />
		<meta property="og:url" content="" />
		<meta property="og:site_name" content="" />
		<link rel="canonical" href="" />

    @include('layouts._partials-app.head')

</head>
<body>

  <div class="d-flex flex-column flex-root" id="kt_app_root">    
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">    
        <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
            <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                <div class="w-lg-500px p-10">

                  @yield('content')

                </div>
            </div>
        </div>
        
        <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-image: url({{ asset('assets/media/misc/auth-bg.png') }})">
            <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">          
              <h1 class="text-white fs-2qx fw-bolder text-center mb-lg-7 "> 
                  SIMPASKOT
              </h1>           
                <img class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20" src="{{ asset('assets/media/misc/auth-screens.png') }}" alt="">                 

                <div class="d-none d-lg-block text-white fs-base text-center">
                  Sistem Informasi Pengelolaan Transportasi Pengangkutan Sampah Kota Lhokseumawe <br> <a href="#" class="opacity-75-hover text-warning fw-bold me-1">"SIMPASKOT"</a> Terintegrasi Berbasis Web
                </div>
            </div>
        </div>
    </div>
    
    
  </div>

  @include('layouts._partials-app.alert')
  @include('layouts._partials-app.foot')

  @yield('script')

</body>
</html>
