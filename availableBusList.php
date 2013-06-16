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


        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <link rel="stylesheet" href="/resources/demos/style.css" />

        <script>
            function pop() {
                $( "#dialog" ).dialog();
            };
        </script>

        <SCRIPT LANGUAGE="JavaScript">
            <!-- 

            // Generated at http://www.csgnetwork.com/puhtmlwincodegen.html 
            function popUp(URL) {
                day = new Date();
                id = day.getTime();
                eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=300,height=500');");
            }

            // -->
        </script>



    </head>
    <body>
        <!-- Start: HEADER -->
        <?php
        require_once 'header.php';
        require 'db.php';
        ?>
        <!-- End: HEADER -->
        <!-- Start: MAIN CONTENT -->
        <div class="content">
            <div class="container">
                <div class="page-header">
                    <h1>Seat Reservation Service</h1>
                </div>
                <div class="row-fluid">
                    <!-- Start: CONTACT US FORM -->
                    <div class="span4 offset1">
                        <div class="page-header">
                            <h2>Check Availability</h2>
                        </div>
                        <?php require 'functions/reservation.php'; ?>
                        <?php
                        $h1 = $_POST['startLocation'];
                        $h2 = $_POST['endLocation'];
                        $d = $_POST['date'];
                        if (isset($_POST['route']))
                            $r = $_POST['route'];
                        else
                            $r = 0;

                        $bustable = search_reservation($h1, $h2, $d, $r)
                        ?>
                        <table border="1" padding="5    ">
                            <tr>
                                <th> Route Number </th>
                                <th> Route </th>
                                <th> Bus </th>
                                <th> Time </th>
                                <th> Departure </th>
                                <th> Reserve </th>
                            </tr>

                            <?php for ($n = 0; $n < count($bustable); $n++) { ?>
                                <tr align="center" >
                                    <td> <?php echo $bustable[$n][4]; ?> </td>
                                    <td> <?php echo $bustable[$n][5]; ?> </td>
                                    <td> <?php echo $bustable[$n][1]; ?> </td>
                                    <td> <?php echo $bustable[$n][2]; ?> </td>
                                    <td> <?php echo $bustable[$n][3]; ?> </td>
                                    <?php $l='pop_reserve.php?id='.$bustable[$n][0] ?>
                                    <td> <button onClick="javascript:popUp('<?php echo $l?>')" >Reserve</button> </td>
                                </tr>
                            <?php } ?>
                        </table>
                        <form class="form-contact-us" action="availableBusList.php">
                            <div class="control-group">
                                <div class="controls">
                                    <input type="submit" class="btn btn-primary btn-large" value="Continue Booking">
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- End: CONTACT US FORM -->
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