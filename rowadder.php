<?php
$name = $_GET['name'];
$lat = $_GET['lat'];
$lng = $_GET['lng'];

require 'db.php';

$query = sprintf("INSERT INTO halt " .
         " (`halt_id`,`name`,`long`,`lati`) " .
         " VALUES (NULL, '%s', '%s','%s' );",
         mysql_real_escape_string($name),
         mysql_real_escape_string($lng),
         mysql_real_escape_string($lat));

$result = mysql_query($query);

if (!$result) {
  die('Invalid query: ' . mysql_error());
}

?>