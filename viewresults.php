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

    <?php if(!isset($_POST['halt1'])){
     header("Location: index.php");
    }
    ?>
    
    <!-- Start: MAIN CONTENT -->
    <div class="content">
      <div class="container">
        <div class="page-header">
          <h1>Nearest Busses</h1>
        </div>
        <div class="row">
          <div class="span6 offset3">
            <div class="widget-body">
              <div class="center-align">
                
                  <?php 
                    require '/db.php';
                    require '/functions/bussort.php';
                    $halt1=$_POST['halt1'];
                    $halt2=$_POST['halt2'];
                    $bustable=  filter_bus($halt1, $halt2);
                    
                  ?>  
                    <table>
                        <tr>
                            <th>Route No</th>
                            <th>Route</th>
                            <th>Current Halt</th>
                        </tr>
                  <?php  
                    for($i=0;$i<count($bustable);$i++){
                  ?>
                       <tr>
                           <td><?php echo get_route_name($bustable[$i][0]); ?></td>
                           <td><?php echo route_desc($bustable[$i][0]); ?></td>
                           <td><?php echo get_halt_name($bustable[$i][4]); ?></td>
                       </tr>
                       
                  <?php }?>
                  </table>
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
