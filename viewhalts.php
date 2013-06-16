<?php

$connection=mysql_connect ("localhost","root","");
if (!$connection) {
  die('Not connected : ' . mysql_error());
}

$db_selected = mysql_select_db("mydb", $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}



$return_arr = array();

$fetch = mysql_query("SELECT * FROM halt"); 

while ($row = mysql_fetch_array($fetch, MYSQL_ASSOC)) {
    $row_array['halt_id'] = $row['halt_id'];
    $row_array['name'] = $row['name'];
    $row_array['long'] = $row['long'];
	$row_array['lati'] = $row['lati'];

    array_push($return_arr,$row_array);
}

echo json_encode($return_arr);

?>