<?php

$con = mysql_connect("112.124.101.241", "zhangl", "zhangl");
if (!$con){
	die('Could not connect: ' . mysql_error());
}

mysql_select_db("everafter", $con);

mysql_query("UPDATE t_comments SET audit = '$_POST[audit]' WHERE id = $_POST[id] ");

mysql_close($con);

?>


