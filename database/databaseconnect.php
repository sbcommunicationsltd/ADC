<?php

$connection = @mysql_connect("db2", "ytmp6701_1", "A07D13C");
if (!$connection) {
echo "Could not connect to MySql server!";
exit;
}

$db = mysql_select_db("ytmp6701_1", $connection);
if (!$db) {
echo "Could not select database";
exit;
}

?>