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
    @yield('style')

</head>
<body>

  <div class="d-flex flex-column flex-root">
    <div class="page d-flex flex-row flex-column-fluid">

      @include('layouts._partials-app.sidebar')
      
      <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">

        @include('layouts._partials-app.topbar')

        <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
          <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">

              @yield('content')

            </div>
          </div>
        </div>

        @include('layouts._partials-app.footer')

      </div>
    </div>
  </div>

  @include('layouts._partials-app.alert')
  @include('layouts._partials-app.foot')
  
  <!--begin::Vendors Javascript(used for this page only)-->
  @yield('script')

</body>
</html>
