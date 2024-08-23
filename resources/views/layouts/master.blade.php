<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{env('APP_NAME')}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .btn-primary
        {
            color: #fff;
            background-color: #7367f0;
            border-color: #7367f0;
        }

        .btn-primary:hover 
        {
            color: #fff !important;
            background-color: #685dd8 !important;
            border-color: #685dd8 !important;
        }

        .accordion-button
        {
            border: 1px solid #685dd8;
        }
        .accordion-button:not(.collapsed) 
        {
            color: white;
            background-color: #685dd8;
        }

        .sidebar .active
        {
            background:#fff !important;
            color: #685dd8 !important;
        }
    </style>
  </head>
  <body>

<main class="d-flex flex-nowrap">
  <div class="d-flex flex-column flex-shrink-0 p-3 vh-100" style="width: 280px; background-color: #685dd8;">
    <a href="{{route('home')}}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      <span class="fs-4">{{env('APP_NAME')}}</span>
    </a>
    <hr>
    <ul class="sidebar nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="{{route('home')}}" class="nav-link active" aria-current="page">
          Customer Search
        </a>
      </li>
    </ul>
  </div>

  <div class="row d-flex flex-grow-1 p-3">
      @yield('content')
  </div>

</main>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment-with-locales.min.js" integrity="sha512-4F1cxYdMiAW98oomSLaygEwmCnIP38pb4Kx70yQYqRwLVCs3DbRumfBq82T08g/4LJ/smbFGFpmeFlQgoDccgg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js" integrity="sha512-eYSzo+20ajZMRsjxB6L7eyqo5kuXuS2+wEbbOkpaur+sA2shQameiJiWEzCIDwJqaB0a4a6tCuEvCOBHUg3Skg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@3.2.47/dist/vue.global.min.js"></script>


<script>
    @if(session()->has("success"))
    $( document ).ready(function() {
        Swal.fire({
            title: 'Success',
            text: '{{session("success")}}',
            icon: 'success',
            customClass: {
            confirmButton: 'btn btn-primary'
            },
            buttonsStyling: false
        });
    });
    @endif

    @if(session()->has("fail"))
    $( document ).ready(function() {
        Swal.fire({
            title: 'Error',
            text: '{{session("fail")}}',
            icon: 'error',
            customClass: {
            confirmButton: 'btn btn-primary'
            },
            buttonsStyling: false
        });
    });
    @endif
</script>

<script>
  const { createApp } = Vue
</script>

@yield('vue')

</body>
</html>
