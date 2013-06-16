<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bootbusiness | Short description about company">
    <meta name="author" content="Your name">
    <title>nextBus</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap responsive -->
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
    <!-- Font awesome - iconic font with IE7 support --> 
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/font-awesome-ie7.css" rel="stylesheet">
    <!-- Bootbusiness theme -->
    <link href="css/boot-business.css" rel="stylesheet">
  </head>
  <body>
    <!-- Start: HEADER -->
     <?php  
        require_once 'db.php';
        require 'header.php';
    ?>
    <!-- End: HEADER -->
    
    <?php
        if(isset($_GET['login'])){
            $user_name = $_POST['username'];
            $pass_word = $_POST['password'];
                
            user_login($user_name,$pass_word);
            
            echo $_SESSION['username'];
            echo $_SESSION['userlevel'];
        }
    ?>
    <!-- Start: MAIN CONTENT -->
    <div class="content">
      <div class="container">
        <div class="page-header">
          <h1>Signin to Bootbusiness</h1>
        </div>
        <div class="row">
          <div class="span6 offset3">
            <h4 class="widget-header"><i class="icon-lock"></i> Signin to Bootbusiness</h4>
            <div class="widget-body">
              <div class="center-align">
                <form action="signin.php?login=true" method="post" class="form-horizontal form-signin-signup">
                  <input type="text" name="username" placeholder="User Name">
                  <input type="password" name="password" placeholder="Password">
                  <div class="remember-me">
                    <div class="pull-left">
                      <label class="checkbox">
                        <input type="checkbox"> Remember me
                      </label>
                    </div>
                    <div class="pull-right">
                      <a href="#">Forgot password?</a>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <input type="submit" value="Signin" class="btn btn-primary btn-large">
                </form>
                <h4><i class="icon-question-sign"></i> Don't have an account?</h4>
                <a href="signup.html" class="btn btn-large bottom-space">Signup</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End: MAIN CONTENT -->
    
    
    <!-- Start: FOOTER -->
    <?php 
    require_once 'footer.php';
    ?>
    <!-- End: FOOTER -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/boot-business.js"></script>
  </body>
</html>