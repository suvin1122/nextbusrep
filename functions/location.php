<?php

function checkIn( $latitude1, $longitude1, $latitude2, $longitude2 )
{  
    $earth_radius = 6371;
    $lim=50;
    $dLat = deg2rad( $latitude2 - $latitude1 );  
    $dLon = deg2rad( $longitude2 - $longitude1 );  

    $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * sin($dLon/2) * sin($dLon/2);  
    $c = 2 * asin(sqrt($a));  
    $d = $earth_radius * $c;  
    $m=$d*1000;
    echo $m."<br/>";
    if($m<$lim)
        return "in";
    else 
        return "out";
}

function feed($bus,$lat,$long){
    require 'bussort.php';
    $query = "SELECT * FROM current_details WHERE bus_id='$bus'";
    $result=  mysql_query($query);
    $row=  mysql_fetch_array($result);
    $cur=$row['current_halt'];
    $dir=$row['direction'];
    
    $query = "SELECT route_id FROM bus WHERE bus_id='$bus'";
    $result=  mysql_query($query);
    $row2=  mysql_fetch_array($result);
    $route=$row2['route_id'];
    $order=get_order($route,$cur);
    
    if($dir=='p'){
        $next=$order+1;
    }
    else if($dir=='m'){
        $next=$order-1;
    }
    echo $next;
    $query="SELECT * FROM route_halt as r WHERE r.order='$next' AND r.route_id='$route'";
    $result=  mysql_query($query) or
		die (mysql_error());
    $row2=  mysql_fetch_array($result);
    $halt=$row2['halt_id'];
    echo $halt."<br/>";

    $query="SELECT * FROM halt WHERE halt_id='$halt'";
    $result=  mysql_query($query);
    $row2=  mysql_fetch_array($result);
    $latn=$row2['lati'];
    $longn=$row2['long'];
    echo $latn."<br/>";
    echo $longn."<br/>";
    $status =  checkIn($lat, $long, $latn, $longn);
    echo $status;
    
}

?>
