<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Flight Management</title>

        <link rel="icon" href="{{ asset('logo.svg') }}">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
      integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
      crossorigin="anonymous"
    ></script>
    <link
      rel="icon"
      type="image/x-icon"
      href="src/images/plane-departure-solid.svg"
    />
    </head>
    <body class="antialiased">
        <nav class="navbar navbar-expand-lg bg-dark text-light">
            <div class="container-fluid bg-dark">
              <a class="navbar-brand text-light" href="/"
                ><strong> Flight for us </strong></a
              >
              <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
              ></button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-light">
                  <li class="nav-item">
                    <a class="nav-link active text-light" aria-current="page" href="/home"
                      >Home</a
                    >
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active text-light" aria-current="page" href="/search"
                      >Flights</a
                    >
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active text-light" aria-current="page" href="/about"
                      >About Us</a
                    >
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active text-light" aria-current="page" href="/contact"
                      >Contact Us</a
                    >
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active text-light" aria-current="page" href="/shop"
                      >Shop</a
                    >
                  </li>
                  @if(session('admin') == true)
                  <li class="nav-item">
                    <a class="nav-link active text-light" aria-current="page" href="/add_shop"
                      >Add Medicine</a
                    >
                  </li>
                  @endif
                </ul>
                <div class="text-white">
                  <button class="btn"><a href="/cart"><i class="fa-solid fa-cart-shopping" style="color: #ffffff;"></i></a></button>
                </div>
                <div class="text-white">
                  @if(session('username'))
                  <div class="d-flex">
                    <p class="m-2">Welcome, {{ session('full_name') }}</p>
                    <a href="/logout"><button class="btn btn-primary">LOGOUT</button></a>
                  </div>
                  @else
                    <a href="/login"><button class="btn btn-primary">LOGIN</button></a>
                  @endif
                </div>
              </div>
            </div>
          </nav>
          <div>
            @yield('content')
          </div>
          <script
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
            integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
          ></script>

    </body>
</html>
