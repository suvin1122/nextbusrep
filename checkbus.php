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
        require_once 'header.php';
    ?>
    <!-- End: HEADER -->

    <!-- Start: MAIN CONTENT -->
    <div class="content">
      <div class="container">
        <div class="page-header">
          <h1>Search For a Bus</h1>
        </div>
        <div class="row">
          <div class="span6 offset3">
            <div class="widget-body">
              <div class="center-align">
                <form action="viewresults.php" method="post" class="form-horizontal form-signin-signup">
                  <input type="text" name="halt1" placeholder="Enter Current Halt">
                  <input type="text" name="halt2" placeholder="Enter Your Destination">
                  <input type="submit" value="Check Out" class="btn btn-primary btn-large">
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End: MAIN CONTENT -->
    
    <!-- Start: FOOTER -->
     <?php 
    require 'footer.php'
    ?>
    <!-- End: FOOTER -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/boot-business.js"></script>
  </body>
</html>
