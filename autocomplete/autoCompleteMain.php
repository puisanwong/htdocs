<?php
$host='instance35319.db.xeround.com:3874'; // Host name
$username='comp320';// Mysql username
$password='comp320'; // Mysql password
$db_name='phpwebco_shop'; // Database name



	$con = mysql_connect($host,$username,$password)   or die(mysql_error());
	mysql_select_db($db_name, $con)  or die(mysql_error());


$sql = "SELECT pd_name,cat_id,pd_id FROM  tbl_product where pd_name LIKE '%$q%'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$cname = $rs['pd_name'];
	$cid= $rs['cat_id'];
	$pid= $rs['pd_id'];	
	echo "$cname\n";
}
?>
