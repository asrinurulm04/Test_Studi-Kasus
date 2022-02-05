<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title')</title>
	  <link href="{{ asset('images/logo2.png') }}" rel="icon">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.min.css') }}"/>
  </head>

  <body>
    <div id="" class="gray-bg" style="min-height:740px;">
      <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
          <ul class="nav navbar-top-links navbar-right">
            <li>
              <span class="m-r-sm text-muted welcome-message">Welcome, {{ Auth::user()->name }}</span>
            </li>
            <li>
              <a href="{{ route('signout') }}">
                <i class="fa fa-sign-out"></i> Log out
              </a>
            </li>
          </ul>
        </nav>
      </div>
      <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
          @yield('info')
        </div>
      </div>
      <div class="wrapper wrapper-content animated fadeInRight ecommerce" >
        @yield('content')
      </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/datatables.min.js') }}"></script>
    @yield('s')
  </body>
</html>

