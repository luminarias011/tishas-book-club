<!DOCTYPE html>

<html class="light-style layout-menu-fixed" data-theme="theme-default" data-assets-path="{{ asset('/assets') . '/' }}"
  data-base-url="{{url('/')}}" data-framework="laravel" data-template="vertical-menu-laravel-template-free" lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <meta name="description"
    content="{{ config('variables.templateDescription') ? config('variables.templateDescription') : '' }}" />
  <meta name="keywords" content="{{ config('variables.templateKeyword') ? config('variables.templateKeyword') : '' }}">
  <!-- laravel CRUD token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title') | Book Club Management </title>
  {{--
  <link rel="icon" type="image/png" href="{{ asset('assets/img/logos/Logo-32x.png') }}" /> --}}
  <!-- Canonical SEO -->
  <link rel="canonical" href="{{ config('variables.productPage') ? config('variables.productPage') : '' }}">
  <!-- Favicon -->
  {{--
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" /> --}}

  <!-- Include Styles -->
  @include('layouts/sections/masterIncludes/styles')

  <!-- Include Scripts for customizer, helper, analytics, config -->
  @include('layouts/sections/masterIncludes/scriptsIncludes')

  <script src="js/lte-ie7.js"></script>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

</head>

<body>
  <!-- Layout Content -->
  @yield('layoutContent')
  <!--/ Layout Content -->
  {{-- remove while creating package --}}
  {{-- <div class="buy-now">
    <a href="{{config('variables.productPage')}}" target="_blank" class="btn btn-danger btn-buy-now">Order now on
      Ticoy's
      Kan anan</a>
  </div> --}}
  {{-- remove while creating package end --}}

  <!-- Include Scripts -->
  @include('layouts/sections/masterIncludes/scripts')

</body>

</html>