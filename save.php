<?php

$con = mysql_connect("112.124.101.241", "zhangl", "zhangl");
if (!$con){
	die('Could not connect: ' . mysql_error());
}

mysql_select_db("everafter", $con);

$sql="insert into t_comments (name, response, phonenumber, guests, message) VALUES ('$_POST[name]', '$_POST[response]', '$_POST[phonenumber]', $_POST[guests], '$_POST[message]')";

if (!mysql_query($sql,$con)){
	die('Error: ' . mysql_error());
}

echo "1 record added";

mysql_close($con);

?>


