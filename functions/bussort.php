<?php

//require '../db.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function validate_halt($halt) {
    $q = "SELECT h.halt_id FROM halt as h WHERE h.name='$halt'";
    $result = mysql_query($q);
    $count = mysql_num_rows($result);
    if ($count) {
        while ($row = mysql_fetch_array($result))
            $halt_id = $row['halt_id'];
        return $halt_id;
    }
    else
        return 0;
}

function get_route($halt1, $halt2) {
    $q1 = "SELECT  DISTINCT r.route_id FROM route_halt as r  where
            r.halt_id='$halt1' AND
            r.route_id in 
            (SELECT DISTINCT p.route_id FROM route_halt as p 
            where p.halt_id='$halt2')";

    $result = mysql_query($q1);
    $count = mysql_num_rows($result);

    if ($count) {
        $i = 0;
        while ($row = mysql_fetch_array($result)) {
            $arr[$i] = $row['route_id'];
            $i++;
        }
        return $arr;
    }
    else
        return false;
}

function get_order($route, $halt) {
    $query = "SELECT r.order
                FROM route_halt AS r
                WHERE r.route_id = '$route'
                AND r.halt_id = '$halt'";

    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
        $order = $row['order'];
    return $order;
}

function headed($route, $halt1, $halt2) {
    $o1 = get_order($route, $halt1);
    $o2 = get_order($route, $halt2);
    if ($o1 < $o2)
        $dir = 'p';
    else
        $dir = 'm';
    $arr = array($route, $o1, $o2, $dir);
    return $arr;
}

function halt_order_arr($halt1, $halt2) {
    //retruns an array with hallt orders of given halts
    $routeAr = get_route($halt1, $halt2);
    $mainArr = array();
    $routeDetails;
    for ($i = 0; $i < count($routeAr); $i++) {
        $a = headed($routeAr[$i], $halt1, $halt2);
        $x = $routeAr[$i];
        //$b=array($x => $a);
        $mainArr[$x] = $a;
    }
    return $mainArr;
}

function cur_bus($route) {
    $query = "SELECT * FROM current_details as c, bus as b WHERE c.bus_id=b.bus_id AND b.route_id='$route'";
    $result = mysql_query($query);
    return $result;
}

function filter_bus($h1, $h2) {

    $halt1 = validate_halt($h1);
    $halt2 = validate_halt($h2);
    $bus_order = halt_order_arr($halt1, $halt2);
    $routeAr = get_route($halt1, $halt2);
    $bustable = array();

    for ($i = 0; $i < count($routeAr); $i++) {
        $route = $routeAr[$i];
        $result = cur_bus($route);
        $dir = $bus_order[$route][3];

        if ($dir == 'p') {
            while ($row = mysql_fetch_array($result)) {
                //$dir=$row["direction"];
                $start = get_order($route, $row['start']);
                $cur = get_order($route, $row['current_halt']);
                if ($start == 0 && ($cur < $bus_order[$route][1])) {
                    $temp = array($row['route_id'], $row['bus_id'], $row['long'], $row['lati'], $row['current_halt']);
                    $bustable[count($bustable)] = $temp;
                }
            }
            unset($temp);
        } else if ($dir == 'm') {
            while ($row = mysql_fetch_array($result)) {
                $start = get_order($route, $row['start']);
                $cur = get_order($route, $row['current_halt']);
                if ($start > 0 && ($cur > $bus_order[$route][1])) {
                    $temp = array($row['route_id'], $row['bus_id'], $row['long'], $row['lati'], $row['current_halt']);
                    $bustable[count($bustable)] = $temp;
                }
            }
            unset($temp);
        }
    }
    $bustable1 = bsort($bustable, $halt1);
    return $bustable1;
}

function bsort($bustable, $halt1) {
    for ($i = 0; $i < count($bustable); $i++) {
        $inter = inter_halts($bustable[$i][0], $halt1, $bustable[$i][4]);
        $bustable[$i][5] = $inter;
        //echo $bustable[$i][4]." inter: ". $bustable[$i][5]  ."<br/>";
    }
    usort($bustable, "cmp");

//  for($i=0;$i<count($bustable);$i++){
//      echo $bustable[$i][4]." inter: ". $bustable[$i][5]  ."<br/>";
//  }
    return $bustable;
}

function inter_halts($route, $halt1, $halt2) {
    $h1 = get_order($route, $halt1);
    $h2 = get_order($route, $halt2);

    if ($h1 > $h2) {
        $inter = $h1 - $h2;
    } else if ($h2 > $h1) {
        $inter = $h2 - $h1;
    }

    return $inter;
}

function cmp($a, $b) {
    if ($a[5] == $b[5]) {
        return 0;
    }
    return ($a[5] < $b[5]) ? -1 : 1;
}

function get_route_id($route) {
    $query = "SELECT route_id FROM route WHERE route_no='$route'";
    $result = mysql_query($query);
    if ($result) {
        $row = mysql_fetch_array($result);
        return $row['route_id'];
    }
    else
        return 0;
}

function get_route_name($route_id) {
    $result = mysql_query("SELECT route_no FROM route WHERE route_id='$route_id'");
    $row = mysql_fetch_array($result);
    return $row['route_no'];
}

function route_desc($route_id) {
    $result = mysql_query("select h1.name as st, h2.name as en from route as r, halt as h1, halt as h2 where r.start=h1.halt_id AND r.end=h2.halt_id AND r.route_id='$route_id'");
    $row = mysql_fetch_array($result);
    $label = $row['st'] . "-" . $row['en'];
    return $label;
}

function get_halt_name($halt) {
    $result = mysql_query("SELECT name FROM halt WHERE halt_id='$halt'");
    $row = mysql_fetch_array($result);
    return $row['name'];
}

function testing($hh, $hhh) {
    $username = $hh;
    $password = $hhh;

    //Generate the sql query based on username and password

    $query = "select id from Employees where username='$username' and password='$password'";

    //Execute the query
    $result = mysql_query($query);
    return $result;
}

if (isset($_REQUEST['method'])) {
    
    $Connection = mysql_connect("localhost", "root", "") or die('Cannot connect to Database');

        //Select the database
        mysql_select_db("mydb") or die('Cannot select Database');
        
    $Request_Method = $_REQUEST['method'];
    if ($Request_Method == "verifyLogin") {
        

        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];

        //Generate the sql query based on username and password
        //Execute the query
        $result = testing($username, $password);

        //Get the rowcount
        $rowcount = mysql_num_rows($result);

        //if the count is 0 then no matching rows are found
        if ($rowcount == 0) {
            echo json_encode(array('result' => 0));
        }
        //Else there is an employee with the given credentials
        else {
            $row = mysql_fetch_array($result);
            //Get and return his employee id
            echo json_encode(array('result' => $row['id']));
        }

        
    }

    if ($Request_Method == "buslist") {        

        $hl1 = $_REQUEST['h1'];
        $hl2 = $_REQUEST['h2'];
        $bs = filter_bus($hl1, $hl2);
  
        $c = count($bs);

        $route1 = 0;    $route2 = 0;    $route3 = 0;    $route4 = 0;    $route5 = 0;
        $routeName1=0;  $routeName2=0;  $routeName3=0;  $routeName4=0;  $routeName5=0;
        $current1=0;    $current2=0;    $current3=0;    $current4=0;    $current5=0;
        $longi1=0;      $longi2=0;      $longi3=0;      $longi4=0;      $longi5=0;
        $lat1=0;        $lat2=0;        $lat3=0;        $lat4=0;        $lat5=0;
            
        if ($c >= 5)
            $lim = 5;
        else {
            $lim = $c;
        }
        for ($i = 0; $i < $lim; $i++) {
            $r = $bs[$i][0];
            $x=($i+1);
            $route = 'route' . $x;
            $routen = 'routeName' . $x;
            $cur = 'current' . $x;
            $ln = 'longi' . $x;
            $lat = 'lat' . $x;

            $$route = get_route_name($r);
            $$routen = route_desc($r);
            $$cur = get_halt_name($bs[$i][4]);
            $$ln = $bs[$i][2];
            $$lat = $bs[$i][3];
            
        }
//$j_ar = array(
//          'route1' => $route1, 'routedesc1' => $routeName1, 'current1' => $current1, 'longi1' => $longi1, 'lat1' => $lat1
//);
        

        $j_ar = array('count'=>$lim,
            'route1' => $route1, 'routedesc1' => $routeName1, 'current1' => $current1, 'longi1' => $longi1, 'lat1' => $lat1,
            'route2' => $route2, 'routedesc2' => $routeName2, 'current2' => $current2, 'longi2' => $longi2, 'lat2' => $lat2,
            'route3' => $route3, 'routedesc3' => $routeName3, 'current3' => $current3, 'longi3' => $longi3, 'lat3' => $lat3,
            'route4' => $route4, 'routedesc4' => $routeName4, 'current4' => $current4, 'longi4' => $longi4, 'lat4' => $lat4,
            'route5' => $route5, 'routedesc5' => $routeName5, 'current5' => $current5, 'longi5' => $longi5, 'lat5' => $lat5
        );
        
            echo json_encode($j_ar);
        
        

        
    }

    if ($Request_Method == "getEmployees") {
        $id = $_REQUEST['id'];
        $query = "select name,address from Employees where manager=$id";

        $result = mysql_query($query);

        while ($row = mysql_fetch_assoc($result)) {
            $resultArray[] = $row;
        }

        echo json_encode($resultArray);
    }
    
    if ($Request_Method == "checkHalt") {
        $h1 = $_REQUEST['h1'];
        $h2 = $_REQUEST['h2'];
        
        $vh1=  validate_halt($h1);
        $vh2=  validate_halt($h2);
        
        $ret=array('halt1'=>$vh1,'halt2'=>$vh2);


        echo json_encode($ret);
    }
    
    $aaa='hellloo';
    mysql_close($Connection);
}
?>
