<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/main.css') }}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Login - Vali Admin</title>
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <h1>Vali</h1>
      </div>
        <div class="tile">
          <form class="login-form" action="{{route('register_store')}}" method="POST"  enctype="multipart/form-data">
            @csrf
                <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user "></i>REGISTERATION</h3>
                <hr>
                <div class="form-group">
                  <label class="control-label">USERNAME</label>
                  <input class="form-control" type="text" placeholder="Email" name="name" autofocus>
                </div>
                <div class="form-group">
                  <label class="control-label">USEREMAIL</label>
                  <input class="form-control" type="text" placeholder="Email" name="email" autofocus>
                </div>
                <div class="form-group">
                      <label class="control-label">IMAGE</label>
                      <input class="form-control" name="file" id="file" type="file">
                </div>
                <div class="form-group">
                  <label class="control-label">PASSWORD</label>
                  <input class="form-control" type="password" placeholder="Password" name="password">
                </div>
                <div class="form-group">
                  <div class="utility">
                    {{-- <div class="animated-checkbox">
                      <label>
                        <input type="checkbox"><span class="label-text">Stay Signed in</span>
                      </label>
                    </div> --}}
                    <p class="semibold-text mb-2"><a href="{{route('login')}}"><i class="fa fa-angle-left fa-fw"></i>Back to Login</a></p>
                  </div>
                </div>
                <div class="form-group btn-container">
                  <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>REGISTER</button>
                </div>
          </form>
        </div> 
    </section>

    <!-- Essential javascripts for application to work-->
    <script src="{{ asset('backend/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('backend/js/popper.min.js') }}"></script>
    <script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/js/main.js') }}"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="{{ asset('backend/js/plugins/pace.min.js') }}"></script>
    <script type="text/javascript">
      // Login Page Flipbox control
      $('.login-content [data-toggle="flip"]').click(function() {
      	$('.login-box').toggleClass('flipped');
      	return false;
      });
    </script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  @if(Session::has('msg'))
    Swal.fire({
      icon: "{{Session::get('type')}}",
      title: "{{Session::get('title')}}",
      text: "{{Session::get('msg')}}",
      showConfirmButton: false,
      timer: 1500
    });
  @endif

</script>

  </body>
</html>