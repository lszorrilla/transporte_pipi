<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
   <meta name="description" content="Bootstrap Admin App + jQuery">
   <meta name="keywords" content="app, responsive, jquery, bootstrap, dashboard, admin">
   <title>Transporte pipi</title>

   <link rel="stylesheet" href="{{asset('/vendor/fontawesome/css/font-awesome.min.css')}}">
   <!-- SIMPLE LINE ICONS-->
   <link rel="stylesheet" href="{{asset('/vendor/simple-line-icons/css/simple-line-icons.css')}}">
   <!-- =============== PAGE VENDOR STYLES ===============-->
   <!-- =============== BOOTSTRAP STYLES ===============-->
   <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}" id="bscss">
   <!-- =============== APP STYLES ===============-->
   <link rel="stylesheet" href="{{asset('css/app.css')}}" id="maincss">

</head>

<body>
   <div class="wrapper">
      <div class="block-center mt-xl wd-xl">
         <!-- START panel-->
         <div class="panel panel panel-flat">
            <div class="panel-heading text-center">
               <a href="#">
                  <img src="{{ asset('/images/logog.png') }}" alt="Image" class="block-center img-rounded">

               </a>
            </div>
            <div class="panel-body">
               <p class="text-center pv">LOGIN</p>
               <form role="form" data-parsley-validate="" novalidate="" class="mb-lg" action="{{ url('/login') }}" method="post">
                 {{ csrf_field() }}
                  <div class="form-group has-feedback">
                     <input id="email" type="email" placeholder="Enter email" autocomplete="off" required class="form-control" name="email">
                     <span class="fa fa-envelope form-control-feedback text-muted"></span>
                  </div>
                  <div class="form-group has-feedback">
                     <input id="password" type="password" placeholder="Password" required class="form-control" name="password">
                     <span class="fa fa-lock form-control-feedback text-muted"></span>
                  </div>
                  <div class="clearfix">
                     <div class="checkbox c-checkbox pull-left mt0">
                        <label>
                           <input type="checkbox" value="" name="remember">
                           <span class="fa fa-check"></span>Remember Me</label>
                     </div>

                  </div>
                  <button type="submit" class="btn btn-block btn-primary mt-lg">Login</button>
               </form>

            </div>
         </div>
      </div>
   </div>
   <!-- =============== VENDOR SCRIPTS ===============-->
   <!-- MODERNIZR-->
   <script src="../vendor/modernizr/modernizr.custom.js"></script>
   <!-- JQUERY-->
   <script src="../vendor/jquery/dist/jquery.js"></script>
   <!-- BOOTSTRAP-->
   <script src="../vendor/bootstrap/dist/js/bootstrap.js"></script>
   <!-- STORAGE API-->
   <script src="../vendor/jQuery-Storage-API/jquery.storageapi.js"></script>
   <!-- PARSLEY-->
   <script src="../vendor/parsleyjs/dist/parsley.min.js"></script>
   <!-- =============== APP SCRIPTS ===============-->
   <script src="js/app.js"></script>
</body>

</html>
