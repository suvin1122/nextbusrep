<?php

require 'bussort.php';

function search_reservation($h1, $h2, $d, $r = 0) {
    $route;
    if ($r != 0) {
        $ro = get_route_id($r);
    }
    else
        $ro = 0;

    if ($ro != 0) {
        $route[0] = $ro;
    } else {
        $halt1 = validate_halt($h1);
        $halt2 = validate_halt($h2);
        $route = get_route($halt1, $halt2);
    }


    return get_reservation($route, $d);
}

function get_reservation($route, $date) {
    $bustable = array();
    for ($i = 0; $i < count($route); $i++) {
        $bustable = get_from_date($route[$i], $date, $bustable);
    }
    return $bustable;
}

function get_from_date($route, $date, $bustable) {

    $q1 = "SELECT b.bus_id as bid FROM reserve_bus as r , bus as b WHERE r.bus_id=b.bus_id AND b.route_id='$route' ";
    $query = "SELECT * FROM  reserve_details as rd WHERE  rd.date='$date' AND rd.bus_id in ($q1)";
    $result = mysql_query($query) or die(mysql_error());

    $busrow;
    while ($row = mysql_fetch_array($result)) {
        $busrow[0] = $row['reservation_id'];
        $busrow[1] = plate_no($row['bus_id']);
        $busrow[2] = $row['time'];
        $busrow[3] = get_halt_name($row['departure']);
        $busrow[4] = get_route_name($route);
        $busrow[5] = route_desc($route);
        
        $av=  av_seats($row['bus_id'], $row['reservation_id']);
        $busrow[6] = $av[0];
        $busrow[7] = $av[1];
        $bustable[count($bustable)] = $busrow;
    }

    return $bustable;
}

if (isset($_REQUEST['method'])) {
    $Request_Method = $_REQUEST['method'];

    $Connection = mysql_connect("localhost", "root", "") or die('Cannot connect to Database');

        //Select the database
    mysql_select_db("mydb") or die('Cannot select Database');

    if ($Request_Method == 'reserve') {
//        $h1=$_REQUEST['h1'];
//        $h2=$_REQUEST['h2'];
//        $route=$_REQUEST['route'];
//        $date=$_REQUEST['date'];
        $list = search_reservation('Yakkala', 'Gampaha', '2013-06-02', $r = 0);
        $reta=array();
        for($i=0;$i<count($list);$i++){
            $tmp=array('resid'=>$list[$i][0],'plateno'=>$list[$i][1],'time'=>$list[$i][2],
                'dep'=>$list[$i][3],'rid'=>$list[$i][4],'rname'=>$list[$i][5],'wseat'=>$list[$i][6],'nseat'=>$list[$i][7]);
            $reta[$i]=$tmp;
        }
        

        echo json_encode($reta);
    }
    if ($Request_Method == 'addreserve'){
        $rid = $_REQUEST['rid'];
        $uid = $_REQUEST['uid'];
        $date = $_REQUEST['date'];
        $time = $_REQUEST['time'];
        $ws = $_REQUEST['ws'];
        $ns = $_REQUEST['ns'];
        
        $status=add_reservation($rid, $uid, $date, $time, $ws, $ns);
        
        echo json_encode(array('status'=>$status));
    }
}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function my_reservations($uid){
		    $q1 = "SELECT reservation_id FROM reservation WHERE user_id='$uid'";
			$res = mysql_query($q1);
			$row = mysql_fetch_array($res);
			$resid = $row['reservation_id'];
			
			$q2 = "SELECT * FROM reserve_details WHERE reservation_id='$resid'";
			$res2 = mysql_query($q2);
			$restable = array();
			while($row = mysql_fetch_array($res2)){
				$ret = array($row['reservation_id'],$row['bus_id'],$row['date'],$row['time'],$row['nseat'],$row['wseat'],$row['departure']);
				$restable[count($restable)] = $ret;
			}
			
			return $restable;
			
	}

function plate_no($busid){
    $queryp = "SELECT * FROM bus WHERE bus_id='$busid'";
    $resultp = mysql_query($queryp);
    $rowp = mysql_fetch_array($resultp);
    $platep = $rowp['plate_number'];
    return $platep;
}

function av_seats($b,$r){
    $all=  get_all_seats($b);
    $res = get_reserved_seats($r);
    $av[0]=$all[0]-$res[0];
    $av[1]=$all[1]-$res[1];
    return $av;
}

function get_all_seats($bus){
    $query = "SELECT * FROM reserve_bus WHERE bus_id='$bus'";
    $result = mysql_query($query);
    $row = mysql_fetch_array($result);
    $wseat = $row['window_seat_count'];
    $nseat = $row['normal_seat_count'];
    $all_seats[0]=$wseat;
    $all_seats[1]=$nseat;
    return $all_seats;
}

function get_reserved_seats($id){
    $query = "SELECT * FROM reserve_details WHERE reservation_id='$id'";
    $result = mysql_query($query);
    $row = mysql_fetch_array($result);
//    $date = $row['date'];
//    $time = $row['time'];
//    $bus = $row['bus_id'];
    $rnseat = $row['nseat'];
    $rwseat = $row['wseat'];
    $res_seats[0]= $rwseat;
    $res_seats[1]=$rnseat;
    return $res_seats;
}

function get_res_bus($id){
    $query="SELECT * FROM reserve_details WHERE reservation_id='$id'";
    $result=  mysql_query($query);
    $row=  mysql_fetch_array($result);
    $bus=$row['bus_id'];
    return $bus;
}

function add_reservation($rid,$user,$date,$time,$ws,$ns){
   
   $bus=  get_res_bus($rid);
   $ava= av_seats($bus, $rid);
   
   if($ws>$ava[0]||$ns>$ava[1]){
       return false;
   }
   else {
       $res=  get_reserved_seats($rid);
       $wnew= $res[0]+$ws;
       $nnew= $res[1]+$ns;
       $query="UPDATE `reserve_details` SET `nseat` = '$nnew',`wseat` = '$wnew' WHERE `reserve_details`.`reservation_id` ='$rid'";
       $r1=  mysql_query($query) or mysql_error();
       $query="INSERT INTO `reservation` (`reservation_id` ,`user_id` ,`date` ,`time` ,`nseat` ,`wseat`)
            VALUES ('$rid', '$user', '$date', '$time', '$ws', '$ns')";
       $r2=  mysql_query($query) or mysql_error();
       return true;
   }
}

?>
