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
        require 'header.php';
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
            <h4 class="widget-header">Add a new bus</h4>
            <div class="widget-body">
              <div class="center-align">

                <form action="functions/bus.php" method="post" class="form-horizontal form-signin-signup">
                  <input type="text" name="bus_no" placeholder="Bus Plate Number"/>
                  <input type="hidden" name="type" value="addbus">
                  
                  <select name="owner" placeholder="Owner">    
                    <?php
                    
                    $sql = mysql_query("SELECT * FROM user as u WHERE u.type = '5'");
                    while ($row = mysql_fetch_array($sql)){ ?>
                       
                        <option value=<?php echo $row['id'] ?> > <?php echo $row['f_name']." ".$row['l_name']?> </option>
                    
                    <?php } ?>  
                  </select> <br/><br/>
                  
                  <select name="route" placeholder="Route No">
                       
                    <?php
                    
                    $sql = mysql_query("select r.route_id,r.route_no, h1.name as st, h2.name as en from route as r, halt as h1, halt as h2 where r.start=h1.halt_id AND r.end=h2.halt_id");
                    while ($row = mysql_fetch_array($sql)){ ?>
                       
                        <option value=<?php echo $row['route_id'] ?> > <?php echo $row['route_no']." ".$row['st']."-".$row['en']?> </option>
                    
                    <?php } ?>
                    
                       
                  </select>
                  <br/><br/>
                  <input type="submit" value="Add Bus" class="btn btn-primary btn-large">
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