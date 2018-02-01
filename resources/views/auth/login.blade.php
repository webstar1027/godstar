<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="Author"    content="author">
    <meta name="Keywords" content="keywords">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Site</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="libs/font-awesome/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/media.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="wrapper">

    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>
    <!--==== MODAL ====-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <div class="modal-body">
                    <h1 class="caption-modal text-center">Log in to your account</h1>
                    <div class="modal-inside clearfix">
                        <div class="modal-item pull-left">
                            <form class="form" method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}
                                <input type="text" placeholder="Email" name="email">
                                <input type="password" placeholder="Password" name="password">
                                <button class="submit">Log In</button>
                            </form>
                        </div>
                        <div class="modal-item pull-right">
                            <div class="social-box">
                                <a href="/login/facebook">
                                    <i class="fa fa-facebook" aria-hidden="true"></i>
                                    <span>Log via Facebook</span>
                                </a>
                                <a href="/login/google">
                                    <i class="fa fa-google-plus" aria-hidden="true"></i>
                                    <span>Log via Google</span>
                                </a>
                                <a href="/login/linkedin">
                                    <i class="fa fa-linkedin" aria-hidden="true"></i>
                                    <span>Log via Linkedln</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="modal-inside clearfix">
                        <div class="modal-item pull-left">
                            <a href="#" class="forgot">Forgot password</a>
                        </div>
                        <div class="modal-item pull-right text-right">
                            <span class="acc">Don't have an account?</span> &ensp; <a href="#" class="Signup">Sign up</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--==== END MODAL ====-->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="libs/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>

