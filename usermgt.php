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
        require 'header.php'
    ?>
    <!-- End: HEADER -->
    
   <!-- Start: MAIN CONTENT -->
    <div class="content">
      <div class="container">
        <div class="page-header">
          <h1>Create New User Account</h1>
        </div>
		<fieldset>
			
		
        <div class="row">
          <div class="span6 offset3">
            <!-- <h4 class="widget-header"><i class="icon-lock"></i> Signin to Bootbusiness</h4> -->
            <div class="widget-body">
              <div class="center-align">
                <form action="addnewuser.php" method="POST">
                                   <input type="hidden" name="link" value=<?php echo $_SERVER['REQUEST_URI'] ?>/>
                                   <input type="hidden" name="nxtbsadd" value="nxtbsadd"/>
                                  User name : <input type="text" name="username" ><br/><br/>
				  First Name: <input type="text" name="firstname" ><br/><br/>
				  Last Name : <input type="text" name="lastname" ><br/><br/>
				  E-mail    : <input type="text" name="email"><br/><br/>
				  Password  : <input type="password" name="password" ><br/><br/>
				  Re-enter the password : <input type="password" name="password"><br/><br/>
				  NIC:        <input type="text" name="nic"><br/><br/>
                                  Select the User type:
				<select name="type">
					<option value="6">General User</option>
					<option value="5">Bus Owner</option>
					<option value="4">Route Admin</option>
					<option value="3">Stand officer</option>
				</select><br/><br/>
				  
				  <input type="submit" value="Submit"><!--,class="btn btn-primary btn-large"-->
                </form>
               <!-- <h4><i class="icon-question-sign"></i> Don't have an account?</h4>
                <a href="signup.html" class="btn btn-large bottom-space">Signup</a>-->
              </div>
            </div>
          </div>
        </div>
		</fieldset>
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
