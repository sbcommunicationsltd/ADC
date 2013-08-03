<?php
/*$zipfile = 'http://control.asiandinnerclub.com/mysqldumps/comsiandinn427_backup.zip';
$zip = zip_open($zipfile);
$date = date('Y-m-d');
$newzip = '../database/comsiandinn427' . $date . '.zip';
if($zip)
{
	while($zip_entry = zip_read($zip))
	{
    	$fp = fopen($newzip, "w");
    	if(zip_entry_open($zip, $zip_entry, "r"))
    	{
      		$buf = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
      		fwrite($fp, "$buf");
      		zip_entry_close($zip_entry);
      		fclose($fp);
    	}
  	}
  	zip_close($zip);
}*/

include('../database/databaseconnect.php');
$user = 'asiand_1';
$pass = 'towers';
$dbname = 'asiand_1';
$dbhost = 'db1';
$date = date('Y-m-d');
$file = '../database/asiand' . $date . '.sql';
$output = "mysqldump --opt -h $dbhost -u$user -p$pass $dbname > $file";
system($output);

$to = 'sumita.biswas@gmail.com';
$subject = 'Cron 2 daily';
$body = 'Triggered This';
$headers = "From: Auto <auto@asiandinnerclub.com> \r\n";
mail($to, $subject, $body, $headers);

echo 'DONE';
exit;
?>