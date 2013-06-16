<!DOCTYPE html>
<?php
session_start();

if (isset($_SESSION['userid']) && isset($_SESSION['userlevel'])) {
    if ($_SESSION['userlevel'] != 5) {
        header("Location: index.php");
    } else {
        $user = $_SESSION['userid'];
    }
} else {
    header("Location: index.php");
}
require_once 'db.php';
?>
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
          <h1>Bus Management</h1>
        </div>
        <div class="row">
          <div class="span6 offset3">
            <h4 class="widget-header">Add Reservation Details</h4>
            <div class="widget-body">
              <div class="center-align">

                <form action="reservation_add.php" method="post" class="form-horizontal form-signin-signup">
                  
                  <input type="hidden" name="type" value="addbus">
                  
                  <label> Select Bus : </label><select name="bus" placeholder="Owner">    
                    <?php
                    
                    $sql = mysql_query("SELECT b.plate_number as pid, b.bus_id as bid FROM bus as b, reserve_bus as r WHERE b.bus_id=r.bus_id AND b.owner_id='$user'");
                    while ($row = mysql_fetch_array($sql)){ ?>
                       
                        <option value=<?php echo $row['bid'] ?> > <?php echo $row['pid']?> </option>
                    
                    <?php } ?>  
                  </select> <br/><br/>
                  
 
                  <input type="submit" value="Proceed" class="btn btn-primary btn-large">
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
    require_once 'footer.php';
    ?>
    <!-- End: FOOTER -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/boot-business.js"></script>
  </body>
</html>
