<?php session_start();
include '../database/databaseconnect.php';

if(!isset($_SESSION['admin_is_logged_in'])){
	header('Location: login.php');
}

function DetermineAgeFromDOB($YYYYMMDD_In)
{
  // Parse Birthday Input Into Local Variables
  // Assumes Input In Form: YYYYMMDD
  $yIn = substr($YYYYMMDD_In, 0, 4);
  $mIn = substr($YYYYMMDD_In, 4, 2);
  $dIn = substr($YYYYMMDD_In, 6, 2);

  // Calculate Differences Between Birthday And Now
  // By Subtracting Birthday From Current Date
  $ddiff = date("d") - $dIn;
  $mdiff = date("m") - $mIn;
  $ydiff = date("Y") - $yIn;

  // Check If Birthday Month Has Been Reached
  if($mdiff < 0)
  {
	// Birthday Month Not Reached
	// Subtract 1 Year From Age
	$ydiff--;
  }
  elseif($mdiff==0)
  {
	// Birthday Month Currently
	// Check If BirthdayDay Passed
	if($ddiff < 0)
	{
	  //Birthday Not Reached
	  // Subtract 1 Year From Age
	  $ydiff--;
	}
  }
  return $ydiff;
}

if(isset($_POST['export']))
{
	$qu = "SELECT * FROM Members ORDER BY ID ASC";
	$re = mysql_query($qu) or die(mysql_error());
	$num = mysql_num_fields($re);

	$output = '';

	for($i=1; $i < $num; $i++)
	{
		$fields = mysql_field_name($re, $i);
		$output .= $fields . "\t ";
	}
	$output .= "Age\t ";
	$output .= "\n";

	while ($rowr = mysql_fetch_array($re))
	{
		for ($j=1; $j < $num ; $j++)
		{
			$output .= $rowr[$j]."\t ";
		}
		$dob = explode('/', $rowr['DOB']);
		$dobformat = $dob[2] . $dob[1] . $dob[0];
		$age = DetermineAgeFromDOB($dobformat);
		$output .= "$age\t ";
		$output .= "\n";
	}

	$filename = "members_".date("Y-m-d_H-i",time());
	header("Content-Type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=".$filename.".xls");
	print $output;
	exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="../css/styles.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Asian Dinner Club - for Single Asian Professionals :: ADMIN AREA - MEMBERSHIP ::  Asian Dinner Club</title>
<meta name="description" content=" Asian Dinner Club, for Single Asian Professionals" />
<meta name="keywords" content="Indian, dating, party, London, Matchmaking, Asian matchmaking, Shaadi, restaurants, events, Asian Dinner Club, Asia dinner club, Indian dinner club, Supper club, Asian events, Asian dating, Asian speedating, Asian speeddating, Chillitickets, Asiana, Dating events london, Singles events asian, Singles events london, Single solution, Hindu events, Sikh events, muslim dating, Hindu dating, Sikh dating, Dinner clubs, Top table, Dinner parties, Dinner dates, Quaglinos, Asia de cuba, Asian Dinner Club, Tantric Club, Asiand8" />
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-43079962-1', 'asiandinnerclub.com');
  ga('send', 'pageview');

</script>
</head>
<body>
<div id="wrapper">
<div id="header-admin">
<div id="logo"><a href="../admin/" target="_self"><img src="../images/logo.gif" alt="Asian Dinner Club" /></a></div>
<div id="navigation">
<ul>
<li><a href="http://www.asiandinnerclub.com/" target="_self">HOME</a></li>
<li class="topnav" ><a href="../aboutus.php" target="_self">ABOUT<br/>US</a></li>
<li><a href="../events.php" target="_self">CURRENT<br/>EVENTS</a></li>
<li><a href="../past_events.php" target="_self">PAST<br/>EVENTS</a></li>
<li><a href="../membership.php" target="_self">MEMBERSHIP</a></li>
<li><a href="../press.php" target="_self">PRESS</a></li>
<li><a href="../contact.php" target="_self">CONTACT</a></li>
</ul>
</div>
</div>
<div id="maincontent-admin">
<div id="innercontent">

<!-- main content area -->
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>

<div id="contentcol1-admin">
<h2>Admin Area</h2>
<img src="../images/membership.gif" alt="Membership" width="181" height="50"/>

<iframe name='members' width='100%' allowTransparency="true" align='center' height='400' frameborder='0' src='membertable.php'></iframe>

<p>&nbsp;</p>
<?php
$query = "SELECT * FROM Members WHERE Gender = 'Male'";
$result = mysql_query($query) or die(mysql_error());
$male = mysql_num_rows($result);

$query2 = "SELECT * FROM Members WHERE Gender = 'Female'";
$result2 = mysql_query($query2) or die(mysql_error());
$female = mysql_num_rows($result2);

$total = $male + $female;?>

<table width='100%' border='0' cellpadding='2' cellspacing='2' style='border:2px #99CCFF double; border-width:6px; background-color:#B0E0E6;'>
<tr>
	<th align='left'>Total Members:</th>
	<td> Male </td>
	<td><?php echo $male;?></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td style='border-bottom:1px black solid;'> Female </td>
	<td style='border-bottom:1px black solid;'><?php echo $female;?></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td> Grand Total </td>
	<td><?php echo $total;?></td>
</tr>
</table>
<p>&nbsp;</p>

<form method='post' name='Export'>
<input type='hidden' name='export' />
<table cellspacing='0' cellpadding='0' border='0'>
	<tr>
		<td><img src="../images/sumi_buttons_04.png" width="11" height="19" alt=""></td>
		<td class='singlebutton'><a title='Export' onclick="if(confirm('Are you sure you want to export this data?')){document.Export.submit();}else{window.location.reload(false);}">Export Membership Table</a></td>
		<td><img src="../images/sumi_buttons_06.png" width="11" height="19" alt=""></td>
	</tr>
</table>
</form>
<!--<p><form method='post' action='../admin/'><input type='submit' name='admin' value='Back to Main Admin Page' style='cursor:pointer;' /></form></p>-->
<br/>
<table cellspacing='0' cellpadding='0' border='0'>
	<tr>
		<td><img src="../images/sumi_buttons_04.png" width="11" height="19" alt=""></td>
		<td class='singlebutton'><a title='Back' href='../admin/'>Back to Main Admin Page</a></td>
		<td><img src="../images/sumi_buttons_06.png" width="11" height="19" alt=""></td>
	</tr>
</table>
<p><br/></p>
</div>


    <div id="contentcol2-admin">
      <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
    <p>&nbsp;</p>
  <!--<span class="lefthandpic"><img src="../images/side.jpg" alt="Asian Dinner Club" width="194" height="194" /></span>-->

</div>

<!-- end inner content -->

</div>
</div>
<div id="footer-admin">
<div class="footer2col1"><a href="../terms.php">TERMS</a>&nbsp;|&nbsp;<a href="../sitemap.php">SITE MAP</a>&nbsp;|&nbsp;<a class='active' href="../admin/">ADMINISTRATOR</a>&nbsp;|&nbsp;<a class='active' href="../admin/logout.php">LOG OUT</a></div></div>
<div id="footer2">
<div class="footer2col2">Copyright &copy;&nbsp;Asian Dinner Club&nbsp;2009</div>
<div class="footer2col2">designed by: <a href="http://www.streeten.co.uk" target='_blank'>streeten</a></div>
<div class="footer2col2">redeveloped by: <a href="http://www.sbcommunications.co.uk" target='_blank'>S B Communications Ltd.</a></div></div>
</div>
</body>
</html>