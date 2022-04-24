<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('meta')
    
    <title> CluodNine </title>

    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
    <link href="{{ url('assets/build/css/login.css') }}" rel="stylesheet">
</head>
<body oncontextmenu='return false' class='snippet-body'>
    <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
        <div class="card card0 border-0">
            <div class="row d-flex">
                <div class="col-lg-6">
                    <div class="card1 pb-5">
                        <div class="row"> 
                            <img src="https://i.imgur.com/CXQmsmF.png" class="logo"> 
                        </div>
                        <div class="row px-3 justify-content-center mt-4 mb-5 border-line"> 
                            <img src="https://i.imgur.com/uNGdWHi.png" class="image"> 
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card2 card border-0 px-4 py-5">
                          <div class="row mb-4 px-3">
                            <h6 class="mb-0 mr-4 mt-2">Cloud9 </h6>
                            {{--  <div class="facebook text-center mr-3">
                                <div class="fa fa-facebook"></div>
                            </div>
                            <div class="twitter text-center mr-3">
                                <div class="fa fa-twitter"></div>
                            </div>
                            <div class="linkedin text-center mr-3">
                                <div class="fa fa-linkedin"></div>
                            </div>  --}}
                        </div>  
                        <div class="row px-3 mb-4">
                            <div class="line"></div> <small class="or text-center">Login</small>
                            <div class="line"></div>
                        </div>
                        <form role="form" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row px-3"> <label class="mb-1">
                                <h6 class="mb-0 text-sm">Email Address</h6>
                                </label> <input id="email" class="mb-4 @error('email') is-invalid @enderror" type="email" name="email" placeholder="Enter a valid email address" value="{{ old('email') }}" required autocomplete="email" autofocus aria-describedby="email-addon"> 
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row px-3"> <label class="mb-1">
                                <h6 class="mb-0 text-sm">Password</h6>
                                </label> <input id="password" class="@error('password') is-invalid @enderror" type="password" name="password" placeholder="Enter password" required autocomplete="current-password" aria-label="Password" aria-describedby="password-addon"> 
                            </div>
                            <div class="row px-3 mb-4">
                                <div class="custom-control custom-checkbox custom-control-inline"> <input id="chk1" type="checkbox" name="chk" class="custom-control-input"> <label for="chk1" class="custom-control-label text-sm">Remember me</label> </div> <a href="#" class="ml-auto mb-0 text-sm">Forgot Password?</a>
                            </div>
                        </form>
                        <div class="row mb-3 px-3"> <button type="submit" class="btn btn-login btn-blue text-center">Login</button> </div>
                    </div>
                </div>
            </div>
            <div class="bg-blue py-4">
                <div class="row px-3"> <small class="ml-4 ml-sm-5 mb-2">Copyright &copy; 2022. All rights reserved.</small>
                    <div class="social-contact ml-4 ml-sm-auto"> <span class="fa fa-facebook mr-4 text-sm"></span> <span class="fa fa-google-plus mr-4 text-sm"></span> <span class="fa fa-linkedin mr-4 text-sm"></span> <span class="fa fa-twitter mr-4 mr-sm-5 text-sm"></span> </div>
                </div>
            </div>
        </div>
    </div>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
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
        $.ajaxSetup({
          headers:{
              'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
          },
        });
  
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