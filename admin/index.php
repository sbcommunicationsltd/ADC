<?php session_start();
include '../database/databaseconnect.php';

if(!isset($_SESSION['admin_is_logged_in'])){
	header('Location: login.php');
}
$admin2 = "location.href='emailmembers.php';";
if(!isset($_SESSION['admin2_is_logged_in'])){
	$admin2 = "window.open('confirm.php', 'child', 'width=500, height=650');";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="../css/styles.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Asian Dinner Club - for Single Asian Professionals :: ADMIN AREA ::  Asian Dinner Club</title>
<meta name="description" content=" Asian Dinner Club, for Single Asian Professionals" />
<meta name="keywords" content="Indian, dating, party, London, Matchmaking, Asian matchmaking, Shaadi, restaurants, events, Asian Dinner Club, Asia dinner club, Indian dinner club, Supper club, Asian events, Asian dating, Asian speedating, Asian speeddating, Chillitickets, Asiana, Dating events london, Singles events asian, Singles events london, Single solution, Hindu events, Sikh events, muslim dating, Hindu dating, Sikh dating, Dinner clubs, Top table, Dinner parties, Dinner dates, Quaglinos, Asia de cuba, Asian Dinner Club, Tantric Club, Asiand8" />
</head>
<body>
<div id="wrapper">
<div id="header">
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
<div id="maincontent">
<div id="innercontent">

<!-- main content area -->
<style type="text/css">
<!--
.style1 {color: #FF0000}

.adminbutton
{
	font-size:16px;
	background-color:#99CCFF;
	cursor:pointer;
	height:40px;
	width:60px;
	font-weight:normal;
	font-style:italic;
}
-->
</style>


<div id="contentcol1">

<h2>Admin Area</h2>
	<h1><img src="../images/welcome.gif" alt="welcome" width="181" height="50"/></h1>
<table width='80%' align='center' cellspacing='2' cellpadding='2' border='0' style='border:2px #99CCFF double; border-width:6px;'>
<tr>
	<th width='50%'><span onclick="location.href='membershipdatabase.php';"><input type='submit' name='members' value='' class='adminbutton' /><br/><br/><span class='adminbutton'>Members Database</span></span></th>
	<th width='50%'><span onclick="location.href='eventsdatabase.php';"><input type='submit' name='events' value='' class='adminbutton' /><br/><br/><span class='adminbutton'>Event Management</span></span></th>
</tr>
<tr>
	<td colspan='2'>&nbsp;</td>
</tr>
<tr>
	<th width='50%'><span onclick="<?php echo $admin2;?>"><input type='submit' name='emailmembers' value='' class='adminbutton' /><br/><br/><span class='adminbutton'>Email Standard Members</span></span></th>
	<th width='50%'><span onclick="location.href='pressdatabase.php';"><input type='submit' name='press' value='' class='adminbutton' /><br/><br/><span class='adminbutton'>Press Releases Database</span></span></th>
</tr>
<tr>
	<td colspan='2'>&nbsp;</td>
</tr>
<tr>
	<th width='50%'><span onclick="location.href='adcloves.php';"><input type='submit' name='adcloves' value='' class='adminbutton' /><br/><br/><span class='adminbutton'>ADC Loves...</span></span></th>
	<th width='50%'>&nbsp;</th>
</tr>
</table>
<p>&nbsp;</p>

</div>

<div id="contentcol2">
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
    <p>&nbsp;</p>
  <span class="lefthandpic"><img src="../images/side.jpg" alt="Asian Dinner Club" width="194" height="194" /></span>
    <p>&nbsp;</p>
        <p>&nbsp;</p>
</div>


<!-- end inner content -->

</div>
</div>
<div id="footer">
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