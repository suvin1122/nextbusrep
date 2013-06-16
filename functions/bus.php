<?php
require '../db.php';

if(isset($_POST['type']) && ($_POST['type']=='addbus') ){
    $busNo=$_POST['bus_no'];
    $route=$_POST['route'];
    $owner=$_POST['owner'];
    
   add_bus($busNo, $route, $owner);
   header("Location: ../busmgt.php");
}

function add_bus($bus,$route,$owner){
   
    $result=mysql_query("INSERT INTO bus (`plate_number` ,
`owner_id` ,
`route_id`) VALUES ('$bus','$route','$owner')") or die(mysql_error());
    
}
?>
