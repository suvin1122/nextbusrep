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
    <script src="script/jquery-1.9.1.min.js"> </script>

  </head>
  <body>
    <!-- Start: HEADER -->
     <?php  
        require 'header.php';
        require 'db.php';
    ?>
    <!-- End: HEADER -->
    
    <?php
        if(isset($_GET['ar'])&&isset($_POST['routeno'])){
            $start = $_POST['start'];
            $end = $_POST['end'];
            $routeno = $_POST['routeno'];
            
            $query = "INSERT INTO route (`route_no`,`start`,`end`)
            VALUES('$routeno','$start','$end')";
		 
            $res = mysql_query($query);
            
            if($res){
     ?>
            <font size="3" color="green">
                Route added successfully!
            </font>
     <?php           
            }
            else{
     ?>
            <font size="3" color="red">
                Failed to add route!
            </font>
     <?php
            }
        }
      ?>
            
       
       
       
    <!-- Start: MAIN CONTENT -->
    <div class="content">
      <div class="container">
        <div class="page-header">
          <h1>Manage Routes & Halts</h1>
        </div>
          
        <div class="row">
          
          <div class="span6 offset3">
            <h4 class="widget-header"> Select a route </h4>
            <div class="widget-body">
              <div class="center-align">
                <form class="form-horizontal form-signin-signup" action="rhviewer.php?vr='true'" method="GET">
                   Route No:
                   <select name="route" placeholder="Route No">
                       
                    <?php
                    
                    $sql = mysql_query("select r.route_id,r.route_no, h1.name as st, h2.name as en from route as r, halt as h1, halt as h2 where r.start=h1.halt_id AND r.end=h2.halt_id");
                    while ($row = mysql_fetch_array($sql)){ ?>
                       
                        <option value=<?php echo $row['route_id'] ?> > <?php echo $row['route_no']." ".$row['st']."-".$row['en']?> </option>
                    
                    <?php } ?>
                    
                       
                    </select>
                  
                   <br/> <br/>
                  
                  <div>
                    <input type="submit" value="select" class="btn btn-primary btn-large">
                  </div>
                </form>
              </div>
            </div>
            
            
            
            <h4 class="widget-header"> Add new Route </h4>
            <div class="widget-body">
              <div class="center-align">
                <form class="form-horizontal form-signin-signup" action="routemgt.php?ar=true" method="POST">
                   <input type="text" name="routeno" placeholder="Route No">
          
                   
                   <br/>Select starting halt:
                   <select name="start" max="5">
                    <?php
                    $sql = mysql_query("select halt_id,name from halt");
                     while ($row = mysql_fetch_array($sql)){ ?>
                         <option value=<?php echo $row['halt_id'] ?> > <?php echo $row['name']?> </option>
                     <?php } ?>
                   </select>
                   <br/>
                   
                   <br/>Select ending halt:
                   <select name="end" max="5">
                    <?php
                    $sql = mysql_query("select halt_id,name from halt");
                     while ($row = mysql_fetch_array($sql)){ ?>
                         <option value=<?php echo $row['halt_id'] ?> > <?php echo $row['name']?> </option>
                     <?php } ?>
                   </select>
                   <br/><br/>
                  <div>
                    <input type="submit" value="select" class="btn btn-primary btn-large">
                  </div>
                   
                </form>
              </div>
            </div>
            
                <center>
                     <a href="routeadder.php"><img src="img/addroute.png" width ='150px' height ='150px'/></a>
                     <a href="haltadder.php"><img src="img/addhalt.png" width ='150px' height ='150px'/></a>
                </center>
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