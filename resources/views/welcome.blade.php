<!DOCTYPE html>
<html>
    <head>

        <!-- /.website title -->
        <title>JungleCoder Contact List</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <!-- CSS Files -->
        <link href="css/app.css" rel="stylesheet" media="screen">
        <link href="css/animate.min.css" rel="stylesheet" media="screen">
        <link href="css/social-login.css" rel="stylesheet">

        <!-- Colors -->
        <link href="css/css-index.css" rel="stylesheet" media="screen">

        <!-- Google Fonts -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic" />

    </head>

    <body>

        <!-- /.parallax full screen background image -->
        <div class="fullscreen landing parallax"x`>

            <div class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7">

                            <!-- /.logo -->
                            <div class="logo wow fadeInDown"> <a href=""><img src="images/logo.png" alt="logo"></a></div>

                            <!-- /.main title -->
                            <h1 class="wow fadeInLeft">
                                Contact List Management System
                            </h1>

                            <!-- /.header paragraph -->
                            <div class="landing-text wow fadeInUp">
                                <p>This platform is build to manage your whole contact list at a single place. Here you can easily add, edit and search your contacts within a moment!</p>
                            </div>                

                        </div> 

                        <!-- /.signup form -->
                        <div class="col-md-5">

                            <div class="signup-header wow fadeInUp">
                                <h3 class="form-title text-center">LOGIN</h3>
                                <form class="form-header signin-form" action="/signin" role="form" method="POST" id="signin-form">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <input class="form-control input-lg" name="name" id="name" type="hidden" placeholder="Name">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control input-lg" name="email" id="email" type="email" placeholder="Email address" >
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control input-lg" name="password" id="password" type="password" placeholder="Password" >
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control input-lg" name="confirmPassword" id="confirm-password" type="hidden" placeholder="Password" hidden="true">
                                    </div>
                                    <div class="form-group remember-checkbox">
                                        <input name="remember" id="remember" type="checkbox">
                                        <label for="Remember">Remember Me</label>
                                    </div>
                                    <div class="form-group last">
                                        <input type="submit" class="btn btn-warning btn-block btn-lg" id = "login-button" value="LOGIN">
                                    </div>
                                    <div class="form-group forgot-password">
                                        <a href="#">Forgot Password?</a>
                                    </div>
                                    <p class="text-center signup-line">Don't have an account? <a class="signup-link">Sign Up</a> here.</p>

                                    <div class="social-or">
                                        <span>OR</span>
                                        <div></div>
                                    </div>

                                    <a class="loginBtn loginBtn--facebook" href="/auth/facebook">
                                      Login with Facebook
                                    </a>

                                    <a class="loginBtn loginBtn--google" href="/auth/google">
                                      Login with Google
                                    </a>
                                    
                                </form>
                            </div>              

                        </div>
                    </div>
                </div> 
            </div> 
        </div>
        <!-- /.javascript files -->

        <script src="js/jquery-3.2.0.min.js"></script> 
        <script src="js/app.js"></script>     
        <script src="js/wow.min.js"></script>
        <script>
            new WOW().init();
             function signupChanges(){
                $('.form-title').html('SIGNUP');
                $("#name").attr('type',"text");
                $("#confirm-password").attr('type',"password");
                $('.remember-checkbox').hide();
                $("#signin-form").attr('action',"signup");
                $("#signin-form").attr('method',"POST");
                $('#login-button').val('SIGN UP')
                $('.signup-line').hide();
                $('.forgot-password').hide();
            }

            if(location.pathname == '/signup'){
                signupChanges();
            }

            $(document).ready(function() {
                $(".signup-link").click(function() {
                    signupChanges();
                });
            });

            @if(isset($error))
                alert('{{$error}}');
            @endif

           
        </script>
    </body>
</html>