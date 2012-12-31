<?php

define('DB_SERVER', 'instance35319.db.xeround.com:3874');
define('DB_USERNAME', 'comp320');
define('DB_PASSWORD', 'comp320');
define('DB_DATABASE', 'phpwebco_shop');
$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die(mysql_error());
$database = mysql_select_db(DB_DATABASE) or die(mysql_error());
?>
