<?php session_start();
include '../database/databaseconnect.php';

if(!isset($_SESSION['admin_is_logged_in'])){
	header('Location: login.php');
}

if(isset($_POST['export']))
{
	$qu = "SELECT * FROM Premier_Membership ORDER BY ID ASC";
	$re = mysql_query($qu) or die(mysql_error());
	$num = mysql_num_fields($re);

	$output = '';

	for($i=1; $i < $num; $i++)
	{
		$fields = mysql_field_name($re, $i);
		$output .= $fields . "\t ";
	}
	$output .= "\n";

	while ($rowr = mysql_fetch_array($re))
	{
		for ($j=1; $j < $num ; $j++)
		{
			$output .= $rowr[$j]."\t ";
		}
		$output .= "\n";
	}

	$filename = "premiermembers_".date("Y-m-d_H-i",time());
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
<title>Asian Dinner Club - for Single Asian Professionals :: ADMIN AREA - PREMIER MEMBERSHIP ::  Asian Dinner Club</title>
<meta name="description" content=" Asian Dinner Club, for Single Asian Professionals" />
<meta name="keywords" content="Indian, dating, party, London, Matchmaking, Asian matchmaking, Shaadi, restaurants, events, Asian Dinner Club, Asia dinner club, Indian dinner club, Supper club, Asian events, Asian dating, Asian speedating, Asian speeddating, Chillitickets, Asiana, Dating events london, Singles events asian, Singles events london, Single solution, Hindu events, Sikh events, muslim dating, Hindu dating, Sikh dating, Dinner clubs, Top table, Dinner parties, Dinner dates, Quaglinos, Asia de cuba" />
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
<!--<li><a href="../premiermembership.php" target="_self">PREMIER<br/>MEMBERSHIP</a></li>-->
<!--<li><a href="../matchmaking.php" target="_self">MATCH&nbsp;<sup style='color:white; font-size:8px; border:1px solid white; padding:1px;'>NEW</sup><br/><span style='padding-right:25px;'>MAKING</span></a></li>-->
<li><a href="../press.php" target="_self">PRESS</a></li>
<!--<li><a href="../eternitymembership.php" target="_self">ETERNITY&nbsp;<sup style='color:white; font-size:8px; border:1px solid white; padding:1px;'>NEW</sup><br/><span style='padding-right:25px;'>MEMBERSHIP</span></a></li>-->
<li><a href="../team.php" target="_self">THE<br/>TEAM</a></li>
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
<img src="../images/membership_side2.gif" alt="Premier Membership" width="300" height="50"/>

<iframe name='premiermembers' width='100%' allowTransparency="true" align='center' height='400' frameborder='0' src='premiermembertable.php'></iframe>

<p>&nbsp;</p>
<?php
$query = "SELECT * FROM Premier_Membership WHERE Gender = 'Male'";
$result = mysql_query($query) or die(mysql_error());
$male = mysql_num_rows($result);

$query2 = "SELECT * FROM Premier_Membership WHERE Gender = 'Female'";
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

<!--<p><form method="post"><input type="submit" name="export" value="Export Premier Membership Table" onclick="if(confirm('Are you sure you want to export this data?')){<?php $_POST['export'];?>}else{window.location.reload(false);}" /></form></p>-->
<form method='post' name='Export'>
<input type='hidden' name='export' />
<table cellspacing='0' cellpadding='0' border='0'>
	<tr>
		<td><img src="../images/sumi_buttons_04.png" width="11" height="19" alt=""></td>
		<td class='singlebutton'><a title='Export' onclick="if(confirm('Are you sure you want to export this data?')){document.Export.submit();}else{window.location.reload(false);}" href='#'>Export Premier Membership Table</a></td>
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
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
  _uacct = "UA-4965994-1";
  urchinTracker();
</script>
</div>
</body>
</html>