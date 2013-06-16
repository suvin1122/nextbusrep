<?php

require 'db.php';

if (isset($_POST['formtype']) && $_POST['formtype'] == 'daily') {
    $bus = $_POST['bus'];
    $departure = $_POST['departure'];
    $dates = $_POST['dates'];
    $times = $_POST['times'];
    for ($i = 0; $i < count($times); $i++) {
        $time = $times[$i] . ":00";
        $query = "INSERT INTO `mydb`.`reserve_details` (`reservation_id` ,`bus_id` ,`date` ,`time` ,`departure`)
                    VALUES (NULL , '$bus', '$dates[$i]', '$time', '$departure');";
        $result = mysql_query($query) or mysql_error();
        echo 'd';
    }
}

if (isset($_POST['formtype']) && $_POST['formtype'] == 'weekly') {

    $bus = $_POST['bus'];
    $departure = $_POST['departure'];
//    $sun = $_POST['suna'];
//    $mon = $_POST['mona'];
//    $tue = $_POST['tuea'];
//    $wed = $_POST['weda'];
//    $thu = $_POST['thua'];
//    $fri = $_POST['fria'];
//    $sat = $_POST['sata'];
    $type = $_POST['duration'];
    $sun = array('1:00', '2:00');
    $mon = array('3:00', '4:00');
    $tue = array('5:00', '6:00');
    $wed = array('7:00', '8:00', '15:00');
    $thu = array('8:00', '10:00');
    $fri = array('9:00', '12:00');
    $sat = array('10:00', '14:00');
//$type = 1; //one week

    $date = getdate();
//$d = $date['weekday'];
//$val = getval($d);
//echo date("Y/m/d", $curd).'<br/>';
    switch ($type) {
        case 1:
            $lim = 7;
            break;
        case 2:
            $lim = 14;
            break;
        case 3:
            $lim = 30;
            break;
    }

    $d = $_POST['sdate'];
    ;
    if ($d != '')
        $tm = strtotime($d);
    else{
        $tm = $date;
        //$tm = strtotime($d);
        }
    for ($a = 0; $a < $lim; $a++) {
        
        if ($d != '')
            $curd = mktime(0, 0, 0, date('m', $tm), date('d', $tm) + $a, date('Y', $tm));
        else
            $curd = mktime(0, 0, 0, date("m"), date("d") + $a, date("Y"));
        $sdate = date("Y-m-d", $curd);
        //echo $sdate . '<br/>';
        $timestamp = strtotime($sdate);
        $day = date('D', $timestamp);
        //var_dump($day);
        //echo $day . '<br/>';

        switch ($day) {
            case 'Sun':
                update_d($sun, $bus, $sdate, $departure);
                break;
            case 'Mon':
                update_d($mon, $bus, $sdate, $departure);
                break;
            case 'Tue':
                update_d($tue, $bus, $sdate, $departure);
                break;
            case 'Wed':
                update_d($wed, $bus, $sdate, $departure);
                break;
            case 'Thu':
                update_d($thu, $bus, $sdate, $departure);
                break;
            case 'Fri':
                update_d($fri, $bus, $sdate, $departure);
                break;
            case 'Sat':
                update_d($sat, $bus, $sdate, $departure);
                break;
        }
    }
}

function update_d($arr, $bus, $sdate, $departure) {
    for ($b = 0; $b < count($arr); $b++) {
//        echo $bus . '  ';
//        echo $sdate . '  ';
//        echo $arr[$b] . '  ';
//        echo $departure . '<br/>';
        $query = "INSERT INTO `mydb`.`reserve_details` (`reservation_id` ,`bus_id` ,`date` ,`time` ,`departure`,`nseat`,`wseat`)
                    VALUES (NULL , '$bus', '$sdate', '$arr[$b]', '$departure','0','0');";
        echo mysql_query($query);
    }
}

?>
