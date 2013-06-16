<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />

//

<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    

//
<title>jQuery UI Draggable + Sortable</title>
<link rel="stylesheet" href="css/jquery-ui.css" />
<script src="script/jquery-1.9.1.min.js"></script>
<script src="script/jquery-ui.js"></script>
<style>
ul { list-style-type: none; margin: 0; padding: 0; margin-bottom: 10px; }
li { margin: 5px; padding: 5px; width: 150px; }
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
$( "ul, li" ).disableSelection();
});
</script>
</head>
<body>
    <?php require 'header.php';?>
<?php require 'db.php';
    $route;
    if(isset($_get['route'])){
        $route = $_get['route'];
    }
?>

<?php
    $qr = "SELECT rh.order,h.halt_id, h.name
                            FROM route_halt AS rh, halt AS h
                            WHERE rh.route_id ='1'
                            AND rh.halt_id = h.halt_id
                            ORDER BY rh.order";
                    
                    //$r2=mysql_query("SELECT route_no from route where route_id='$r'");
      
                   $result = mysql_query($qr);
?>    

    <ul id="sortable">
                    <?php while ($row = mysql_fetch_array($result)){ ?>
                
                    <li class="ui-state-default"><?php echo $row['name'];?></li>
                
                    <?php } ?>
     </ul>
    
    
</body>
</html>