
<?php  
        //session_start();
        require 'functions/userdata.php';        
 ?>

<html>
    <head>
        

    
    </head>
    <body>
      <!-- Start: Navigation wrapper -->
      <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
          <div class="container">
            <a href="index.php" class="brand brand-bootbus">NextBus</a>
            <!-- Below button used for responsive navigation -->
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <!-- Start: Primary navigation -->
            <div class="nav-collapse collapse">        
              <ul class="nav pull-right">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Services<b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="checkbus.php">Check Next Bus</a></li>
                    <li><a href="reservation.php">Ticket Reservation</a></li>
                  </ul>                  
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin<b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="usermgt.php">Users</a></li>
                    <li><a href="busmgt.php">Manage Busses</a></li>
                    <li><a href="routemgt.php">Manage Routes</a></li>
                  </ul>                  
                </li>
                <li><a href="about.php">About Us</a></li>
                
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Portfolio<b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="editaccount.php">Edit Account</a></li>
                    <li><a href="mybus.php">My Busses</a></li>
                    <li><a href="myreservations.php">My Reservations</a></li>
                  </ul>                  
                </li>
                
                <li><a href="nextbusapp.php">NextBus App</a></li>
                <li><a href="faq.php">FAQ</a></li>
                <li><a href="contact_us.php">Contact us</a></li>
                <?php if(!isset($_SESSION['username'])){ ?>
                <li><a href="signup.php">Sign up</a></li>
                <li><a href="signin.php">Sign in</a></li>
                <?php } ?>
                
                <?php if(isset($_SESSION['username'])){ ?>
                <li><a href="signout.php" method="post">Sign out</a></li>
                <?php } ?>
                
              </ul>
            </div>
          </div>
        </div>
      </div>
      <!-- End: Navigation wrapper -->   
   </body>
 </html>

