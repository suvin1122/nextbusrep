<?php
session_start();
require 'db.php';
if (!isset($_SESSION['userid'])) {
    ?>
    <script>
        window.close();
    </script>
    <?php
}


$userid=$_SESSION['userid'];
$pagetype='general';
?>
<?php

    if(isset($_POST['nxtpopreserve'])){
        require './functions/reservation.php';
        $rid=$_POST['rid'];
        $user=$userid;
        $date=date('Y-m-d ');
        $time= date('H:i');
        $ws=$_POST['wseat'];
        $ns=$_POST['nseat'];
        $rr=add_reservation($rid, $user, $date, $time, $ws, $ns);
        if($rr){
            $pagetype='success';
        }
        else{
            $pagetype='fail';
        }
    }
    
    else{
    $id = $_GET['id'];
    $query ="SELECT f_name,l_name FROM user WHERE id='$userid'";
    $result = mysql_query($query);
    $row=  mysql_fetch_array($result);
    $name=$row['f_name'].' '.$row['l_name'];
    
    $query ="SELECT * FROM reserve_details WHERE reservation_id='$id'";
    $result = mysql_query($query);
    $row=  mysql_fetch_array($result);
    $date=$row['date'];
    $time=$row['time'];
    $bus=$row['bus_id'];
    $rnseat=$row['nseat'];
    $rwseat=$row['wseat'];
    
    $query ="SELECT * FROM bus WHERE bus_id='$bus'";
    $result = mysql_query($query);
    $row=  mysql_fetch_array($result);
    $plate = $row['plate_number'];
    
    $query ="SELECT * FROM reserve_bus WHERE bus_id='$bus'";
    $result = mysql_query($query);
    $row=  mysql_fetch_array($result);
    $wseat = $row['window_seat_count'];
    $nseat = $row['normal_seat_count'];
    
    }
?>
<html>
    <head>
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
        <div class="content">
            <div class="container">
                <div class="page-header">
                    <h1>Reservation</h1>
                </div>
                <div class="row">
                    <div class="span6 offset3">
                        <h4 class="widget-header">Reservation Details</h4>
                        <div class="widget-body">
                            <div class="center-align">
                                <?php if($pagetype=='general'){ ?>
                                <form action="pop_reserve.php" method="post" class="form-horizontal form-signin-signup">

                                    <input type="hidden" name="rid" value=<?php echo $id;?> />

                                    <label name='usnm'> User name: <?php echo $name ?> </label>
                                    <label> Date: <?php echo $date ?> </label>
                                    <label> Time: <?php echo $time ?> </label>
                                    <label> Bus: <?php echo $plate ?> </label>
                                    <label> Seats </label>
                                    <label> Normal (Remaining:<?php echo ($nseat-$rnseat); ?>)</label><input type="text" name="nseat"/><br/>
                                    <label> Window (Remaining:<?php echo ($wseat-$rwseat); ?>)</label><input type="text" name="wseat"/><br/>
                                    <input type='hidden' name="nxtpopreserve"/>    
                                    <input type="submit" value="Reserve" class="btn btn-primary btn-large">
                                </form>
                                <?php }else if($pagetype=='success'){
                                    echo '<h2> Reservation Added </h2>';
                                }else if($pagetype=='fail'){
                                    echo '<h2> Reservation Adding Failed </h2>';
                                }
                                
?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
