<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if(!isset($_REQUEST['method']))
    session_start();
function user_login($username,$userpass){				
                require './db.php';
		//$myusername = stripslashes($username);
		//$mypassword = stripslashes($userpass);
	
		$myusername = $username;
		$mypassword = md5(mysql_real_escape_string($userpass));
	
		$user = "SELECT * FROM user WHERE user_name='$myusername' AND password='$mypassword'";	
			
		$result = mysql_query($user);	
		$count=mysql_num_rows($result);	
                $level=mysql_fetch_array($result);
		if($count){
			$_SESSION['username'] = $myusername;
                        $_SESSION['userlevel'] = $level['type'];
                        $_SESSION['userid'] = $level['id'];
			header("Location: index.php");
			//exit;
		} else {
                        header("Location: signin.php?status=error");
			//exit;
		}		
}

function signout(){
    unset($_SESSION['username']);
    unset($_SESSION['userlevel']);
    unset($_SESSION['userid']);
    header("Location: index.php");
}

if(isset($_REQUEST['method'])){
    $Connection = mysql_connect("localhost", "root", "") or die('Cannot connect to Database');

        //Select the database
    mysql_select_db("mydb") or die('Cannot select Database');
        
    $Request_Method=$_REQUEST['method'];
    
    if($Request_Method=="login"){
        $user=$_REQUEST['username'];
        $pass=$_REQUEST['password'];
        
        $myusername = $user;
		$mypassword= md5(mysql_real_escape_string($pass));
	
		$user = "SELECT * FROM user WHERE user_name='$myusername' AND password='$mypassword'";	
			
		$result = mysql_query($user);	
		$count=mysql_num_rows($result);	
                $level=mysql_fetch_array($result);
		if($count){
			$uname = $myusername;
                        //$level = $level['type'];
                        $fullname=$level['f_name'].' '.$level['l_name'];
                        $id = $level['id'];
			//exit;
		} else {
                       $uname = 0;
                        //$level = $level['type'];
                        $fullname=0;
                        $id = 0;
		}
                
                $j_ar=array('userid'=>$id,'username'=>$uname,'fullname'=>$fullname);
                //$j_ar=array('userid'=>'$id','username'=>'$uname','fullname'=>'$fullname');
                echo json_encode($j_ar);
    }
    
    mysql_close($Connection);
}

?>
