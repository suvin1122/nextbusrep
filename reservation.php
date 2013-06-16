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
                    <h1>Seat Resevation Service</h1>
                </div>
                <div class="row-fluid">
                    <!-- Start: CONTACT US FORM -->
                    <div class="span4 offset1">
                        <div class="page-header">
                            <h2>Check Availability</h2>
                        </div>

                        <form class="form-contact-us" action="availableBusList.php" method="post">
                            <div class="control-group">
                                <div class="controls">
                                    Start Location :<br/>
                                    <input type="text" name= "startLocation"  required>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    End Location :<br/>
                                    <input type="text" name= "endLocation"  required>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    Route :<br/>
                                    <input type="text" name= "route" name="endLocation" >
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    Date : <br/>
                                    <input type="date" name="date" id="Date" required>
              <!--<input type="text" id="Date" placeholder="Date">-->
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <input type="submit" name="formSubmit" class="btn btn-primary btn-large" value="Submit">
                                </div>
                            </div>
                            <?
                            if (empty($endLocation))
                                echo "Name is not filled out";
                            if (empty($phone))
                                echo "Phone is not filled out";
                            ?>
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