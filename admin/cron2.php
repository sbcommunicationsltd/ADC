<?php
include('../database/databaseconnect.php');
$user = 'ytmp6701_1';
$pass = 'A07D13C';
$dbname = 'ytmp6701_1';
$dbhost = 'db2';
$date = date('Y-m-d');
$file = '../database/adc' . $date . '.sql';
$output = "mysqldump --opt -h $dbhost -u$user -p$pass $dbname > $file";
system($output);

$to = 'sumita.biswas@gmail.com';
$subject = 'Cron backup daily';
$body = 'Triggered This';
$headers = "From: Auto <auto@asiandinnerclub.com> \r\n";
mail($to, $subject, $body, $headers);

echo 'DONE';
exit;
?>