<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('meta')
    
    <title> CludNine </title>
    
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <link href="{{ url('assets/build/css/nucleo-icons.css') }}" rel="stylesheet">
    <link href="{{ url('assets/build/css/nucleo-svg.css') }}" rel="stylesheet">
    <link href="{{ url('assets/build/css/login.css') }}" rel="stylesheet">
  </head>
  
  <body class="">
    <div class="container position-sticky z-index-sticky top-0">
      <div class="row">
        <div class="col-12">
          <!-- Navbar -->
          <nav class="navbar navbar-expand-lg blur blur-rounded top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
            <div class="container-fluid">
              <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="../pages/dashboard.html">
                Cloud 9
              </a>
              <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon mt-2">
                  <span class="navbar-toggler-bar bar1"></span>
                  <span class="navbar-toggler-bar bar2"></span>
                  <span class="navbar-toggler-bar bar3"></span>
                </span>
              </button>
              <div class="collapse navbar-collapse" id="navigation">
                <ul class="navbar-nav mx-auto">
                  <li class="nav-item">
                    <a class="nav-link me-2" href="../pages/sign-in.html">
                      <i class="fas fa-key opacity-6 text-dark me-1"></i>
                      Sign In
                    </a>
                  </li>
                </ul>
                <ul class="navbar-nav d-lg-block d-none">
                  <li class="nav-item">
                    <a href="#" class="btn btn-sm btn-round mb-0 me-1 bg-gradient-dark">Reliable</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
          <!-- End Navbar -->
        </div>
      </div>
    </div>
    <main class="main-content  mt-0">
      <section>
        <div class="page-header min-vh-75">
          <div class="container">
            <div class="row">
              <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                <div class="card card-plain mt-8">
                  <div class="card-header pb-0 text-left bg-transparent">
                    <h3 class="font-weight-bolder text-info text-gradient">Login</h3>
                    <p class="mb-0">Enter your email and password to sign in</p>
                  </div>
                  <div class="card-body">
                    <form role="form" method="POST" action="{{ route('login') }}">
                      @csrf
                      <label>Email</label>
                      <div class="mb-3">
                        <input id="email" type="email" class="form-control  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" autofocus aria-describedby="email-addon">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <label>Password</label>
                      <div class="mb-3">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
                        @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </form>
                    <div class="text-center">
                      <button type="submit" class="btn btn-login bg-gradient-info w-100 mt-4 mb-0">{{ __('Sign in') }}</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                  <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('assets/images/curved-images/curved6.jpg')"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
    <footer class="footer py-5">
      <div class="container">
        <div class="row">
          <div class="col-8 mx-auto text-center mt-1">
            <p class="mb-0 text-secondary">
              Copyright © <script>
                document.write(new Date().getFullYear())
              </script> Soft by CloudNine.
            </p>
          </div>
        </div>
      </div>
    </footer>
    <script src="{{ url('assets/build/js/core/popper.min.js') }}"></script>
    <script src="{{ url('assets/build/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ url('assets/build/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ url('assets/build/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="{{ url('assets/build/js/ui-dashboard.min.js?v=1.0.3') }}"></script>
    <script src="{{ url('assets/vendors/jquery/dist/jquery.min.js') }}"></script>
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
      var win = navigator.platform.indexOf('Win') > -1;
      if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
          damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
      }

      $(document).ready(function() {
        
        $('.btn-login').click(function() {
          var email = $('#email').val();
          var password = $('#password').val();
          var token = $("meta[name='csrf-token']").attr('content');

          if(email.length == ""){
            Swal.fire({
              icon: 'warning',
              title: 'Oops...',
              text: 'Email Wajib diisi',
            })
          }else if(password.length == ""){
            Swal.fire({
              icon: 'warning',
              title: 'Oops...',
              text: 'Password Wajib Diisi !'
            });
          }else{

            $.ajax({

              url: "{{ route('prosesLogin') }}",
              type: 'POST',
              dataType: 'JSON',
              cache: false,
              data: {
                'email': email,
                'password': password,
                '_token': token
              },
              success: function(response) {
                if(response.qwerty == 0){
                  if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Login Berhasil!',
                        text: 'Anda akan di arahkan dalam 3 Detik',
                        timer: 3000,
                        showCancelButton: false,
                        showConfirmButton: false
                    })
                    
                    .then (function () {
                        window.location.href = "{{ route('admin') }}";
                    });
                  } else {
                      console.log(response.success);

                      Swal.fire({
                          icon: 'error',
                          title: 'Login Gagal!',
                          text: 'silahkan coba lagi!'
                      });
                  }
                }else if(response.qwerty == 1) {
                  if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Login Berhasil!',
                        text: 'Anda akan di arahkan dalam 3 Detik',
                        timer: 3000,
                        showCancelButton: false,
                        showConfirmButton: false
                    })
                    
                    .then (function () {
                        window.location.href = "{{ route('owner') }}";
                    });
                  } else {
                    console.log(response.success);

                    Swal.fire({
                        icon: 'error',
                        title: 'Login Gagal!',
                        text: 'silahkan coba lagi!'
                    });

                  }
                }
              },
              error: function(e) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Invalid Email or Password',
                })
              }

            });
          }
        })

      });
    </script>
  </body>
  </html>