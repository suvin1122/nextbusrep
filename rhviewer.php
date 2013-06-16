<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="description" content="Bootbusiness | Short description about company">
        <meta name="author" content="Your name">
        <title>nextBus</title>
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet"/>
        <!-- Bootstrap responsive -->
        <link href="css/bootstrap-responsive.min.css" rel="stylesheet"/>
        <!-- Font awesome - iconic font with IE7 support --> 
        <link href="css/font-awesome.css" rel="stylesheet"/>
        <link href="css/font-awesome-ie7.css" rel="stylesheet"/>
        <!-- Bootbusiness theme -->
        <link href="css/boot-business.css" rel="stylesheet">

        <link rel="stylesheet" href="css/jquery-ui.css" />
        <script src="script/jquery-1.9.1.min.js"></script>
        <script src="script/jquery-ui.js"></script>

        <style>
            .listyle{ 
                margin: 5px; padding: 5px; width: 150px;
            }

            .ulstyle{
                list-style-type: none; margin: 0; padding: 0; margin-bottom: 10px; 
            }
        </style>

        <script>
            $(function() {
                $( "#sortable" ).sortable({
                    revert: true
                });
                $( "#draggable" ).draggable({
                    connectToSortable: "#sortable",
                    helper: "clone",
                    revert: "invalid"
                });
                $( "#lichnage" ).disableSelection();
            });
        </script>

        <script type="text/javascript">
            function listadd(){
                
                //                var list = document.getElementById('sortable').childNodes.TextNode;
                var a="";
                //document.write(list);
                //               for(var i=0;i < list.length; i++) {
                //                    var arrValue = list[i];
                //                    alert(arrValue);
                //                    a=string.concat(a,list[i]);
                //                }
                
                var list = document.getElementById('sortable'); 
                var items = list.getElementsByTagName("li");
                //a=items.length;
                for(var i=0;i < items.length; i++) {
                    //                    var arrValue = list[i];
                    //                    alert(arrValue);
                    a=items[i].value;
                }
                //            var ListItems = unorderedList.getElementsByTagName('li');  
                //            var listID
                //
                //             for (var input, i = 0; i < ListItems.length; i++) {
                //                input = ListItems[i].getElementsByTagName('input')[0];
                //                console.log(input.id, input.value);
                //            }
            
                //s = JSON.stringify( arrValue );
                document.getElementById("demo").innerHTML="text";
                document.cookie= "haltlist" + "=" + a;
                
            }
            
            function ScrollList () {
                var list = document.getElementById ("sortable");
                var listItems = list.getElementsByTagName ("li");
                var a=""
                for(var i=0;i<listItems.length-1;i++)
                    a+=listItems[i].innerHTML+",";
                a+=listItems[listItems.length-1].innerHTML;
                //document.write(listItems[i].innerHTML + "<br/>");
                                
                document.cookie= "haltlist" + "=" + a;
                                
            }
            
            
        </script>
    </head>
    <body>
        <?php require 'header.php';
              require 'db.php';
              require './functions/bussort.php';
        ?>
        <?php
        if (isset($_COOKIE["haltlist"])) {
            $haltck = $_COOKIE['haltlist'];
            $haltck = explode(",", $haltck);

            $l = $_SERVER['REQUEST_URI'];
            $url_query = parse_url($l, PHP_URL_QUERY);
            if ($url_query) {
                parse_str($url_query, $params);
            }
            if (isset($params['route'])) {
                $r_id = $params['route'];
            }
            
            for($i=0;$i<count($haltck);$i++){
                $hlt=  validate_halt($haltck[$i]);
                $odr=$i+1;
                $query="UPDATE `route_halt` SET `order`='$odr' WHERE `halt_id`= $hlt AND `route_id`=$r_id";
                mysql_query($query);
            }
            
            ?>

            <script>  document.cookie = "haltlist" + '=; Max-Age=0' </script> 
            <script>  document.cookie = "retlink" + '=; Max-Age=0' </script> 
            <?php
        }
//else{
//     header("Location: ../index.php");
//    } 
        ?>   



        <?php
        //add route halt
        if (isset($_GET['ahr']) && isset($_POST['order'])) {
            $route = $_GET['routeno'];
            $halt = $_POST['halt'];
            $order = $_POST['order'];
            $wp = $_POST['waypoint'];

            $query = "INSERT INTO route_halt (`route_id`,`halt_id`,`orderno`,`waypoint`) 
                VALUES('$route','$halt','$order','$wp')";

            $res = mysql_query($query);

            if ($res) {
                ?>
                <font size="3" color="green">
                Route updated successfully!
                </font>
                <?php
            } else {
                ?>
                <font size="3" color="red">
                Failed to update route!
                </font>
                <?php
            }
        }
        ?>

        <?php
        if (isset($_GET['route'])) {
            $r = $_GET['route'];
            $qr = "SELECT rh.order,h.halt_id, h.name
                            FROM route_halt AS rh, halt AS h
                            WHERE rh.route_id ='$r'
                            AND rh.halt_id = h.halt_id
                            ORDER BY rh.order";
            $link = $_SERVER['REQUEST_URI'];

            $r2 = mysql_query("SELECT route_no from route where route_id='$r'");
            while ($r3 = mysql_fetch_array($r2))
                $rname = $r3['route_no'];
            $result = mysql_query($qr);
            ?>
            <h4 class="widget-header"> Route <?php echo $rname ?> </h4>
            <div class="widget-body">
                <div class="center-align">
                    <center>
                        <ul id="sortable" class="ulstyle" align="center">

                            <?php while ($row = mysql_fetch_array($result)) { ?>
                                <div class="listyle">
                                    <li class="ui-state-default" id="lichange"><?php echo $row['name']; ?></li>
                                </div>
                            <?php } ?>

                        </ul>
                    </center>
                    <a href= <?php echo $link; ?> > <button class="btn btn-primary btn-large" onclick="ScrollList()"> save </button> </a>
                    
                </div>
            </div>

            <h4 class="widget-header"> Add halts to <?php echo $rname ?> </h4>
            <div class="widget-body">
                <div class="center-align">
                    <form class="form-horizontal form-signin-signup" action="rhviewer.php?routeid='$r'&ahr='true'" method="POST">

                        <select name="halt" max="5">
                            <?php
                            $sql = mysql_query("select halt_id,name from halt");
                            while ($row = mysql_fetch_array($sql)) {
                                ?>
                                <option value=<?php echo $row['halt_id'] ?> > <?php echo $row['name'] ?> </option>
                            <?php } ?>
                        </select>

                        <br/><br/>

                        <input type="text" name="order" placeholder="Order"/>
                        <br/><br/>
                        Waypoint : 
                        <input type='checkbox' name='waypoint' value='1'/>
                        <br/> <br/>

                        <div>
                            <input type="submit" value="select" class="btn btn-primary btn-large">
                        </div>
                    </form>
                </div>
            </div>

        <?php } ?>
    </body>
</html>