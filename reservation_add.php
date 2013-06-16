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

        <!-- Bootstrap responsive -->
        <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
        <!-- Font awesome - iconic font with IE7 support --> 
        <link href="css/font-awesome.css" rel="stylesheet">
        <link href="css/font-awesome-ie7.css" rel="stylesheet">
        <!-- Bootbusiness theme -->
        <link href="css/boot-business.css" rel="stylesheet">


        <link rel="stylesheet" href="css/collapse.css">

        <script>document.documentElement.className = "js";</script>
        <script src="js/jquery-1.9.1.js"></script>
        <script src="js/vendor/json2.js"></script>
        <script src="js/jquery.collapse.js"></script>
        <script src="js/jquery.collapse_storage.js"></script>
        <script src="js/jquery.collapse_cookie_storage.js"></script>

        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript">
            var count = 1;
            function addfield(div){
                count += 1;
                $(div).append(
                'Date : '+'<input id="date_' + count + '" name="dates[]' + '" type="text" />' +
                    'Time : '+'<input id="time_' + count + '" name="times[]' + '" type="text" /><br />');
		
            };
        </script>

        <script type="text/javascript">
            var countsun = 1;
            function addsun(div){
                countsun += 1;
                $(div).append(
                'Time : '+'<input id="sun_' + countsun + '" name="suna[]' + '" type="text" /><br />');
		
            };
		
            var countmon = 1;
            function addmon(div){
                countmon += 1;
                $(div).append(
                'Time : '+'<input id="mon_' + countmon + '" name="mona[]' + '" type="text" /><br />');
		
            };
		
            var counttue = 1;
            function addtue(div){
                counttue += 1;
                $(div).append(
                'Time : '+'<input id="tue_' + counttue + '" name="tuea[]' + '" type="text" /><br />');
		
            };
		
            var countwed = 1;
            function addwed(div){
                countwed += 1;
                $(div).append(
                'Time : '+'<input id="wed_' + countwed + '" name="weda[]' + '" type="text" /><br />');
		
            };
		
            var countthu = 1;
            function addthu(div){
                countthu += 1;
                $(div).append(
                'Time : '+'<input id="thu_' + countthu + '" name="thua[]' + '" type="text" /><br />');
		
            };
		
            var countfri = 1;
            function addfri(div){
                countfri += 1;
                $(div).append(
                'Time : '+'<input id="fri_' + countfri + '" name="fria[]' + '" type="text" /><br />');
		
            };
		
            var countsat = 1;
            function addsat(div){
                countsat += 1;
                $(div).append(
                'Time : '+'<input id="sat_' + countsat + '" name="sata[]' + '" type="text" /><br />');
		
            };
		
        </script>

        <script type="text/javascript">
            function displayForm(c){
                if(c.value == "1"){
                    document.getElementById("d1").style.visibility='visible';
                    document.getElementById("d2").style.visibility='hidden';
                }
                else if(c.value =="2"){
                    document.getElementById("d1").style.visibility='hidden';
                    document.getElementById("d2").style.visibility='visible';
                }
                else{
                }
            
            }        
        </script>

    </head>
    <body>
        <!-- Start: HEADER -->

        <!-- End: HEADER -->

        <div class="col11 cl1">

            <h2>Reservation</h2>
            <div id="accordion-example" data-collapse="accordion">
                <h3>Daily Update</h3>
                <?php
                    $bus=$_POST['bus'];
                    $query = "SELECT h1.halt_id as h1id,h1.name as h1nm ,h2.halt_id as h2id ,h2.name as h2nm FROM halt as h1,halt as h2, bus as b,route as r WHERE r.route_id=b.route_id AND h1.halt_id=r.start AND h2.halt_id=r.end";
                    $result = mysql_query($query);
                    $row=  mysql_fetch_array($result);
                ?> 
                <div>
                    <form name="test" method="post" action="reservation_insert.php">
         
                        <input type="hidden" name="formtype" value="daily"/>
                        <input type="hidden" name="bus" value=<?php echo $bus?>/>
                        <label> Depart From : </label> <select name="departure">                    
                                <option value=<?php echo $row['h1id'] ?>> <?php echo $row['h1nm'] ?> </option>
                                <option value=<?php echo $row['h2id'] ?>> <?php echo $row['h2nm'] ?> </option>
                        </select>
                        <div id="d1" > 
                            <div id="sn">
                                <br/><br/>
                                Date : <input id="date_1" name="dates[]" type="date" />
                                Time : <input id="time_1" name="times[]" type="time" /><br />
                            </div>
                            <p id="add_field" onclick="addfield('#sn')"><a href="#"><span>Add Date</span></a></p>
                        </div>
                        <div class="spacer"></div>
                        <input id="go" name="btnSubmit" type="submit" value="Save" class="btn" />
                    </form>
                </div>
                <h3>Weekly Update</h3>
                <?php
                    $bus=$_POST['bus'];
                    $query1 = "SELECT h1.halt_id as h1id,h1.name as h1nm ,h2.halt_id as h2id ,h2.name as h2nm FROM halt as h1,halt as h2, bus as b,route as r WHERE r.route_id=b.route_id AND h1.halt_id=r.start AND h2.halt_id=r.end";
                    $result1 = mysql_query($query1);
                    $row1=  mysql_fetch_array($result1);
                ?> 
                <div>
                    <form name="test" method="post" action="reservation_insert.php">
                        <input type="hidden" name="formtype" value="weekly"/>
                        <input type="hidden" name="bus" value=<?php echo $bus?> />
                        
                        <label> Depart From : </label> <select name="departure">                    
                                <option value=<?php echo $row1['h1id'] ?>> <?php echo $row1['h1nm'] ?> </option>
                                <option value=<?php echo $row1['h2id'] ?>> <?php echo $row1['h2nm'] ?> </option>
                        </select>
                        
                        <div id="d2" > 
                            <div id="sun">
                                <label> Sunday </label><br/>
                                Time : <input id="sun_1" name="suna[]" type="text" /><br />
                            </div>
                            <p id="sunbtn" onclick="addsun('#sun')"><a href="#"><span>Add Time</span></a></p>

                            <div id="mon">
                                <label> Monday </label><br/>
                                Time : <input id="mon_1" name="mona[]" type="text" /><br />
                            </div>
                            <p id="monbtn" onclick="addmon('#mon')"><a href="#"><span>Add Time</span></a></p>

                            <div id="tue">
                                <label> Tuesday </label><br/>
                                Time : <input id="tue_1" name="tuea[]" type="text" /><br />
                            </div>
                            <p id="tuebtn" onclick="addtue('#tue')"><a href="#"><span>Add Time</span></a></p>

                            <div id="wed">
                                <label> Wednesday </label><br/>
                                Time : <input id="wed_1" name="weda[]" type="text" /><br />
                            </div>
                            <p id="wedbtn" onclick="addwed('#wed')"><a href="#"><span>Add Time</span></a></p>

                            <div id="thu">
                                <label> Thursday </label><br/>
                                Time : <input id="thu_1" name="thua[]" type="text" /><br />
                            </div>
                            <p id="thubtn" onclick="addthu('#thu')"><a href="#"><span>Add Time</span></a></p>

                            <div id="fri">
                                <label> Friday </label><br/>
                                Time : <input id="fri_1" name="fria[]" type="text" /><br />
                            </div>
                            <p id="fribtn" onclick="addfri('#fri')"><a href="#"><span>Add Time</span></a></p>

                            <div id="sat">
                                <label> Saturday </label><br/>
                                Time : <input id="sat_1" name="sata[]" type="text" /><br />
                            </div>
                            <p id="satbtn" onclick="addsat('#sat')"><a href="#"><span>Add Time</span></a></p>
                        </div>
                        <div class="spacer"></div>
                        
                        <label> Add duration </label>
                        <select name="duration">
                            <option value='1'> 1 week</option>
                            <option value='2'> 2 weeks</option>
                            <option value='3'> 1 month</option>
                        </select>
                        <br/>
                        <br/>
                        <input name="sdate" placeholder="Enter Specific Date" />
                        <input id="go" name="btnSubmit" type="submit" value="Add" class="btn" />
                    </form>
                </div>
            </div>

        </div>

        <!-- Start: FOOTER -->

        <?php
        require_once 'footer.php';
        ?>
        <!-- End: FOOTER -->
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/timepicker.js"></script>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/boot-business.js"></script>
        <script type="text/javascript" src="js/timepicker.js"></script>
    </body>
</html>
