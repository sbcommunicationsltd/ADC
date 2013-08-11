<?php 
include 'database/databaseconnect.php'; 
if(isset($_GET['success']))
{
	if($_GET['success'] == 'premier')
	{?>
		<script>alert('Thank your for submitting your membership form and making payment for Premier Membership. Your login details will be emailed to you within 24 hours.');
		location.href='../';
		</script>
	<?php
	}
	/*else
	{?>	
		<script>alert('You have successfully paid for your Eternity Membership. Please wait for the approval email.');
		location.href='../';
		</script>
	<?php
	}*/
}
elseif(isset($_GET['cancel']))
{
	if($_GET['cancel'] == 'premier')
	{?>
		<script>alert('You have cancelled the payment for Premier Membership. Please contact info@asiandinnerclub.com when you wish to pay.');
		location.href='../';
		</script>
	<?php
	}
	/*else
	{?>
		<script>alert('You have cancelled the payment for Eternity Membership. Please contact sales@asiandinnerclub.com when you wish to pay.');
		location.href='../';
		</script>
	<?php
	}*/
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="shortcut icon" href="images/icon.ico" />
<title>Asian Dinner Club - exclusive dinners and drinks events for Single Asian professionals :: home :: Asian Dinner Club</title>
<meta name="description" content="Asian Dinner Club, exclusive dinners and drinks events for Single Asian professionals" />
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
<div id='social'><img src="images/sociallink.png" /><a href="http://www.twitter.com/" target="_blank" title="Tweet Us"><img src="images/twitter.png" border='0' alt='Tweet Us' /></a><a href="https://www.facebook.com/group.php?gid=39319432171" target="_blank" title="Find us on Facebook"><img src="images/facebook.png" border='0' alt='Find us on Facebook' /></a></div>
<div id="logo"><a href="http://www.asiandinnerclub.com/" target="_self"><img src="images/asiandinnerclub.gif" alt="Asian Dinner Club" /></a></div>
<div id="navigation">
<ul>
<li><a class="active" href="http://www.asiandinnerclub.com/" target="_self">HOME</a></li>
<li class="topnav" ><a href="aboutus.php" target="_self">ABOUT<br/>US</a></li>
<li><a href="events.php" target="_self">CURRENT<br/>EVENTS</a></li>
<li><a href="past_events.php" target="_self">PAST<br/>EVENTS</a></li>
<li><a href="membership.php" target="_self">MEMBERSHIP</a></li>
<li><a href="press.php" target="_self">PRESS</a></li>
<li><a href="contact.php" target="_self">CONTACT</a></li>
</ul>
</div>
</div>
<div id="maincontent">
<div id="innercontent">

<!-- main content area -->


<div id="contentcol1">


	<h1><img src="images/welcome.gif" alt="welcome" width="181" height="50"/></h1>
  <p>The <b>Asian Dinner Club</b> hosts dinner parties for single Asian professionals who enjoy relaxing and socialising over outstanding food in some of London's finest restaurants.</p>
    <p>Our events attract individuals aged 25+ who lead hectic lives and work long hours, thereby finding it difficult to meet other like-minded Asians.

Each specially organised dinner party has a maximum of 20 Members, with an even mix of men and women. </p>
	    <p>We also host regular Networking Drinks at stylish bars. We provide luxurious environments for our members to relax, socialise and network over informal drinks. To join this unique Club, please go to <a style='text-decoration:none;' href="membership.php">Membership</a>. </p>
	    <p>NOTE: Each registration is vetted and you will be contacted by one of our team if your application is successful.<br/>
  </p>
  <div>
    <table class='table' width='100%' style="border:1px solid #d0d3d5; background-color:transparent;" border="0" cellspacing="1" cellpadding="4" align='center'>
    	<tr>
        	<td colspan="7" class='title3' style='background-color:#ec008c;'>&nbsp;LATEST EVENTS</td>
      	</tr>
      	<tr>
        	<td class="title3">Date</td>
        	<td class="title3">Venue</td>
        	<td class="title3">Event Type</td>
      	</tr>
      	<?php	$query = "SELECT * FROM Events WHERE Date >= CURDATE() ORDER BY Date ASC LIMIT 0,8";
      			$result = mysql_query($query) or die(mysql_error());
      			if(mysql_num_rows($result) != 0)
      			{
      				$counter = 0;
      				while($row = mysql_fetch_array($result))
					{
						$counter++;
						$background_color = ( $counter % 2 == 0 ) ? ('#e9e9e9') : ('#ffffff');
						$venue = addslashes($row['Venue']);
						$date = date('D, d M', strtotime($row['Date']));?>
						<a href='events.php#<?php echo $venue;?>'>
						<tr class='table' bgcolor="<?php echo $background_color;?>" onmouseover="this.className='table tablehover'" onmouseout="this.className='table'" onclick="location.href='events.php#<?php echo $venue;?>';">
							<td style='white-space: nowrap;'><?php echo $date;?></td>
							<td><?php echo $venue;?></td>
							<td><?php echo $row['Event_Type'];?></td>
						</tr>
						</a>
						<?php
					}
      			}
      	?>
    </table>
  </div>
  <p>For more information and additional events, please go to <a href='events.php'>Current Events</a></p>
</div>

<div id="contentcol2">
  <span class="lefthandpic"><img src="images/side.jpg" alt="Asian Dinner Club" width="194" height="194" /></span>
  <?php
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

  	 $query2 = "SELECT * FROM LoveItems LIMIT $firstid, 10";
  	 $result2 = mysql_query($query2) or die(mysql_error());
  	 ?>
  	 <span class='lefthandpic'>
  	 <br/>
  	 &nbsp;<img src="images/adclovessmall.gif" alt="Asian Dinner Club Loves" width="190" />
  	 &nbsp;<marquee behaviour='scroll' direction='up' scrollamount='1' width='180' style='border:1px solid #FF00FF;'>
  	 <?php
  	 $i = 1;
  	 while($row2 = mysql_fetch_array($result2))
  	 {
  			$id = $row2['ID'];
  			$title = $row2['Title'];
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
<!--<span style='float:left;'>
<a href='http://www.facebook.com/home.php#/group.php?gid=39319432171'><img src='images/Facebook_Badge.gif' border='0' alt='Find us on Facebook' /></a>
</span>-->
<div class="footer2col2">Copyright &copy;&nbsp;Asian Dinner Club&nbsp;2009</div>
<div class="footer2col2">designed by: <a href="http://www.streeten.co.uk" target='_blank'>streeten</a></div>
<div class="footer2col2">redeveloped by: <a href="http://www.sbcommunications.co.uk" target='_blank'>S B Communications Ltd.</a></div></div>
</div>
</div>
</body>
</html>