<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Asian Dinner Club - for Single Asian Professionals :: premier membership ::  Asian Dinner Club</title>
<meta name="description" content=" Asian Dinner Club, for Single Asian Professionals" />
<meta name="keywords" content="Indian, dating, party, London, Matchmaking, Asian matchmaking, Shaadi, restaurants, events, Asian Dinner Club, Asia dinner club, Indian dinner club, Supper club, Asian events, Asian dating, Asian speedating, Asian speeddating, Chillitickets, Asiana, Dating events london, Singles events asian, Singles events london, Single solution, Hindu events, Sikh events, muslim dating, Hindu dating, Sikh dating, Dinner clubs, Top table, Dinner parties, Dinner dates, Quaglinos, Asia de cuba" />
</head>
<body>
<div id="wrapper">
<!--<div id="header2">
<div id="logo"><a href="http://www.asiandinnerclub.com/" target="_self"><img src="images/logo.gif" alt="Asian Dinner Club" /></a></div>
<div id="login">
	<form name='frmLogin2' id="frmLogin2" method="post" action="member/premier/login.php">
	<table cellspacing="1" cellpadding="1" border="0" style='background-color:transparent;'>
	  <tr>
		<td colspan='2'>Premier Member Login:</td>
	  </tr>
	  <tr>
		<td>email</td>
		<td><input type="text" name="txtUserId" size="10" /></td>
	  </tr>
	  <tr>
		<td>password</td>
		<td><input name="txtPassword" type="password" size="10" /></td>
	  </tr>
	  <tr>
		<td>
			<table cellspacing='0' cellpadding='0' border='0'>
				<tr>
					<td><img src="images/sumi_buttons_04.png" width="11" height="19" alt=""></td>
					<td class='singlebutton'><a title='Sign In' onclick="javascript:document.frmLogin2.submit();" href='#'>Sign In</a></td>
    				<td><img src="images/sumi_buttons_06.png" width="11" height="19" alt=""></td>
  				</tr>
  			</table>
  		</td>
		<td><a href="member/premier/forgotpass.php" style='text-decoration:none;'>Forgotten Password?</a></td>
	  </tr>
	</table>
	</form>
</div>-->
<div id="header">
<div id="logo"><a href="http://www.asiandinnerclub.com/" target="_self"><img src="images/logo.gif" alt="Asian Dinner Club" /></a></div>
<div id="navigation">
<ul>
<li><a href="http://www.asiandinnerclub.com/" target="_self">HOME</a></li>
<li class="topnav" ><a href="aboutus.php" target="_self">ABOUT<br/>US</a></li>
<li><a href="events.php" target="_self">CURRENT<br/>EVENTS</a></li>
<li><a href="past_events.php" target="_self">PAST<br/>EVENTS</a></li>
<li><a href="membership.php" target="_self">MEMBERSHIP</a></li>
<li><a class='active' href="premiermembership.php" target="_self">PREMIER<br/>MEMBERSHIP</a></li>
<!--<li><a href="matchmaking.php" target="_self">MATCH&nbsp;<sup style='color:white; font-size:8px; border:1px solid white; padding:1px;'>NEW</sup><br/><span style='padding-right:25px;'>MAKING</span></a></li>-->
<li><a href="press.php" target="_self">PRESS</a></li>
<!--<li><a href="eternitymembership.php" target="_self">ETERNITY&nbsp;<sup style='color:white; font-size:8px; border:1px solid white; padding:1px;'>NEW</sup><br/><span style='padding-right:25px;'>MEMBERSHIP</span></a></li>-->
<li><a href="team.php" target="_self">THE<br/>TEAM</a></li>
<li><a href="contact.php" target="_self">CONTACT</a></li>
</ul>
</div>
</div>
<div id="maincontent">
<div id="innercontent">

<!-- main content area -->
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>

<div id="contentcol1">




		<h1><img src="images/membership_side2.gif" alt="Premier Membership" width="300" height="50"/></h1>

        <p>Our Premier membership are for those members who enjoy exclusive restaurants and bars in Mayfair, Chelsea and Kensington.</p> 

		<p>The membership fee is &pound;150 per annum.</p>

		<p>Please complete the membership form below and we will be in touch with your username and password to allow you to book our dinner evenings and networking drinks.</p>


	<p><br/></p>
	<table cellspacing='0' cellpadding='0' border='0'>
		<tr>
			<td><img src="images/sumi_buttons_04.png" width="11" height="19" alt=""></td>
			<td class='singlebutton'><a title='Join Now' href='member/premier/register.php'>Join Now</a></td>
			<td><img src="images/sumi_buttons_06.png" width="11" height="19" alt=""></td>
		</tr>
  	</table>
  	<p><br/></p>




</div>







<div id="contentcol2">
<span class="lefthandpic"><img src="images/side.jpg" alt="Asian Dinner Club" width="194" height="194" /></span>
  <?php
     include('database/databaseconnect.php');
  	 $find = "SELECT MAX(ID) FROM LoveItems";
  	 $res = mysql_query($find) or die(mysql_error());
  	 $ro = mysql_fetch_array($res);
  	 $maxid = $ro[0];
  	 if($maxid<10)
  	 {
  		$firstid = 0;
  	 }
  	 else
  	 {
  		$firstid = $maxid - 10;
  	 }

  	 $query = "SELECT * FROM LoveItems LIMIT $firstid, 10";
  	 $result = mysql_query($query) or die(mysql_error());
  	 ?>
  	 <span class='lefthandpic'>
  	 <br/>
  	 &nbsp;<img src="images/adclovessmall.gif" alt="Asian Dinner Club Loves" width="190" />
  	 &nbsp;<marquee behaviour='scroll' direction='up' scrollamount='1' width='180' style='border:1px solid #FF00FF;'>
  	 <?php
  	 $i = 1;
  	 while($row = mysql_fetch_array($result))
  	 {
  			$id = $row['ID'];
  			$title = $row['Title'];
  			if(strpos($title, "\'")!==false)
			{
				$title = str_replace("\'", "'", $title);
			}

			if(strpos($title, '\"')!==false)
			{
				$title = str_replace('\"', '"', $title);
			}?>
  			&nbsp;<a href='member/loveposts.php?id=<?php echo $id;?>' style='color:white; text-decoration:none; font-size:11px;' onmouseover="this.style.color='#FF00FF';" onmouseout="this.style.color='#FFFFFF';"><?php echo $i . '. ' . $title;?></a><br/><br/>
  	 <?php
  			$i++;
  	 }?>
  	 </marquee>
	 <br/>
  	 &nbsp;<a href='member/loveposts.php' style='color:white; text-decoration:none; font-size:11px;' onmouseover="this.style.color='#FF00FF';" onmouseout="this.style.color='#FFFFFF';">See all posts</a>
	</span>
</div>
<!-- end inner content -->

</div>
</div>
<div id="footer">
<div class="footer2col1"><a href="terms.php">TERMS</a>&nbsp;|&nbsp;<a href="sitemap.php">SITE MAP</a>&nbsp;|&nbsp;<a href="admin/">ADMINISTRATOR</a></div></div>
<div id="footer2">
<span style='float:left;'>
<a href='http://www.facebook.com/home.php#/group.php?gid=39319432171'><img src='images/Facebook_Badge.gif' border='0' alt='Find us on Facebook' /></a>
</span>
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