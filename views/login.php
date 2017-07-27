<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo SITE_NAME; ?> Admin Login </title>
        <!-- Bootstrap core CSS -->
        <link href="<?php echo CSS_PATH; ?>bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo ASSETS_PATH; ?>fonts/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo CSS_PATH; ?>animate.min.css" rel="stylesheet">
        <!-- Custom styling plus plugins -->
        <link href="<?php echo CSS_PATH; ?>custom.css" rel="stylesheet">
        <link href="<?php echo CSS_PATH; ?>icheck/flat/green.css" rel="stylesheet">
        <script src="<?php echo JS_PATH; ?>jquery.min.js"></script>
        <script src="<?php echo JS_PATH; ?>custom.js"></script>
        <!--[if lt IE 9]>
              <script src="<?php echo JS_PATH; ?>ie8-responsive-file-warning.js"></script>
              <![endif]-->

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
              <![endif]-->
    </head>
    <body style="background:#F7F7F7;">
        <div class="">
            <?php if (isset($data['msg']) && $data['msg']!=""){ ?>
            <div class="alert alert-danger">
                <strong><?php echo $data['msg'];?></strong>
            </div>
            <?php } ?>
            <a class="hiddenanchor" id="toregister"></a>
            <a class="hiddenanchor" id="tologin"></a>
            <div id="wrapper">
                <div id="login" class="animate form">
                    <section class="login_content">
                        <form name="loginform" id="loginform" method="POST" action="<?php echo BASE_URL; ?>/home/">
                            <h1>Login Form</h1>
                            <div>
                                <input type="text" class="form-control" placeholder="Username" name="adminusername" id="adminusername" required="" />
                            </div>
                            <div>
                                <input type="password" class="form-control" placeholder="Password" required="" name="adminpassword" id="adminpassword" />
                            </div>
                            <div>
                                <a class="btn btn-default submit" href="javascript:" onclick="return validate_admin_login()">Log in</a>
                                <!--<a class="reset_pass" href="#">Lost your password?</a>-->
                            </div>
                            <div class="clearfix"></div>
                            <div class="separator">
                                <div class="clearfix"></div>
                                <br />
                                <div>
                                    <h1><i class="fa fa-bank" style="font-size: 26px;"></i> <?php echo SITE_NAME; ?></h1>
                                    <p>&copy; <?php echo strtolower(SITE_NAME); ?>.in All Rights Reserved</p>
                                </div>
                            </div>
                        </form>
                        <!-- form -->
                    </section>
                    <!-- content -->
                </div>
            </div>
        </div>
    </body>
</html>
