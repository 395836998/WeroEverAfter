
<html>
<head>
<link rel="shortcut icon" href="img\favicon.ico">
<title>Ever Ever After - 留言汇总</title>
<style>
	table {margin:0; padding:0; border-collapse: collapse; }
	th { background-color: #eee; height: 40px;}
	td, th { border: 1px solid #ccc; padding: 10px;}
</style>
<head>
<body>
<?php

header("Content-Type: text/html; charset=utf-8");

$con = mysql_connect("112.124.101.241", "zhangl", "zhangl");
if (!$con) {
	die('Could not connect: ' . mysql_error());
}

mysql_select_db("everafter", $con);

$result = mysql_query("SELECT * FROM t_comments");

echo "<table style='text-align:center;'>
<tr>
<th>姓名</th>
<th>是否到场</th>
<th>联系电话</th>
<th>人数</th>
<th>留言</th>
<th>审核状态</th>
</tr>";

while($row = mysql_fetch_array($result)) {
	echo "<tr>";
	echo "<td width='100'>" . $row['name'] . "</td>";
	echo "<td width='80'>" . $row['response'] . "</td>";
	echo "<td width='100'>" . $row['phonenumber'] . "</td>";
	echo "<td width='50'>" . $row['guests'] . "</td>";
	echo "<td>" . $row['message'] . "</td>";

	$a = $row['audit'];
	if ( is_null($a) ) {
		echo "<td width='130' cid='" . $row['id'] . "'>&nbsp;&nbsp;<a href='javascript:void(0)' class='pass'>通过</a>&nbsp;&nbsp;<a class='reject' href='javascript:void(0)'>拒绝</a>&nbsp;&nbsp;</td>";
	}else if( $a == 'Y' ){
		echo "<td>已审核通过</td>";
	}else if( $a == 'N' ){
		echo "<td>未审核通过</td>";
	}

	echo "</tr>";
}
echo "</table>";

mysql_close($con);
?>



<script src="js\jquery.min.js"></script>
<script type="text/javascript">
	$(function(){
		$(".pass").click(function(){
			var p = $(this).parent();
			var id = p.attr("cid");
			$.post("audit.php", {id: id, audit: 'Y'}, function(){
				p.text("已审核通过");
			});
		});
		
		$(".reject").click(function(){
			var p = $(this).parent();
			var id = p.attr("cid");
			$.post("audit.php", {id: id, audit: 'N'}, function(){
				p.text("未审核通过");
			});
		});
	});

</script>

</body>
</html>

