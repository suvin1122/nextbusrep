
<?php

require_once 'db.php';
require 'header.php';
?>

<?php
if(isset($_POST['nxtbsadd'])){
$sql = "INSERT INTO user(user_name,f_name,l_name,email,password,nic,type)
			VALUES('$_POST[username]','$_POST[firstname]','$_POST[lastname]',
			$_POST[email],'$_POST[password]',$_POST[nic],'$_POST[name])";

if (!mysql_query($sql, $con)) {
    die('error:*****' . mysql_error($con));
}
else{
    header("Location:");
}
mysql_close($con);
}

else
    header("Location: index.php");
?>
