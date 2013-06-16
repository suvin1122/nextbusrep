<?php

/**
 * Date 		:	27.11.2012
 * Description 	:	A sample php service to return json responses for android application
 * Author		: 	Guruparan Giritharan
 * 
 */

 //Get the name of the Method
 //The method name has to be passed as Method via post
 
 $Request_Method=$_REQUEST['method'] or die('Method name not found');
 
 //Connect to the database
 $Connection = mysql_connect("localhost","root","") or die('Cannot connect to Database');
 
 //Select the database
 mysql_select_db("mydb") or die('Cannot select Database');
 
 //Method to verify the users login
 if($Request_Method=="verifyLogin")
 {
 	//username and password are password are passed via querystrings
 	$username=$_REQUEST['username'];
	$password=$_REQUEST['password'];
	
	//Generate the sql query based on username and password
	$query="select id from Employees where username='$username' and password='$password'";
	
	//Execute the query
	$result = mysql_query($query);
	
	//Get the rowcount
	$rowcount= mysql_num_rows($result);
	
	//if the count is 0 then no matching rows are found
	if($rowcount==0)
	{
		echo json_encode(array('result'=>0));
	}
	//Else there is an employee with the given credentials
	else {
		$row = mysql_fetch_assoc($result);
		//Get and return his employee id
		echo json_encode(array('result'=>$row['id']));
	}
 }
 
 //Get all th employees that are managed the by the given emplyee
 if($Request_Method=="getEmployees")
 {
 	$id=$_REQUEST['id'];
	$query="select name,address from Employees where manager=$id";

	$result = mysql_query($query);

	while($row = mysql_fetch_assoc($result))
	{
		$resultArray[] = $row;
	}

	echo json_encode($resultArray);
 }
 
 //Close Connection
 mysql_close($Connection);
?>

