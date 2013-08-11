<?php include 'database/databaseconnect.php';
session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Asian Dinner Club - for Single Asian Professionals :: events ::  Asian Dinner Club</title>
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
<li><a class="active" href="events.php" target="_self">CURRENT<br/>EVENTS</a></li>
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
<style type="text/css">
<!--
.style1 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>

	<div id="contentcol1">

	<h1><img src="images/current_events.gif" alt="Events" width="210" height="50"/></h1>
	<?php
	//EITHER THANKS OR CANCELLED TICKETS
	if(isset($_GET['ven']))
	{
		$eventid = $_GET['ven'];
		$findeve = "SELECT * FROM Events WHERE ID = $eventid";
		$reseve = mysql_query($findeve) or die(mysql_error());
		$roweve = mysql_fetch_array($reseve);
		$ticket = addslashes($roweve['Venue']) . ' on ' . date('jS F Y', strtotime($roweve['Date']));
		$quantity = $_GET['success'];
	
		if(isset($_GET['success']))
		{?>
			<script>alert('Thank you for purchasing <?php echo $quantity;?> ticket(s) for <?php echo $ticket;?>. Your paypal confirmation email is your e-ticket. We will be in-touch nearer the time with more details of the event. Thank you.');</script>
		<?php
			/*$gender = $_GET['gen'];
			$stat = '';
			if($gender == 'f')
			{
				$femalequantity = $roweve['MaxFemaleQuantity'] - $quantity;
				if($femalequantity <= 5 && $femalequantity > 0)
				{
					$to = 'sales@asiandinnerclub.com';
					$subject = "Female Tickets Alert - $ticket";
					$body = "This is an auto alert letter you know that the number of Female Tickets for $ticket has reached 5 or less!\r\n";
					$body .= "\r\nPlease keep checking on the events database to see the ticket status.\r\n";
					$body .= "\r\nThanks\n Auto Service\n Asian Dinner Club\r\n";
					$headers .= "From: Asian Dinner Club <sales@asiandinnerclub.com> \r\n";
					mail($to, $subject, $body, $headers);
				}

				if($femalequantity == 0)
				{
					$to = 'sales@asiandinnerclub.com';
					$subject = "Female Tickets Alert - $ticket";
					$body = "This is an auto alert letter you know that the Female Tickets for $ticket has SOLD OUT!\r\n";
					$body .= "\r\nPlease change the ticket status on the events database asap.\r\n";
					$body .= "\r\nThanks\n Auto Service\n Asian Dinner Club\r\n";
					$headers .= "From: Asian Dinner Club <sales@asiandinnerclub.com> \r\n";
					mail($to, $subject, $body, $headers);
					
					if($roweve['MaxMaleQuantity'] == 0)
					{
						$stat = 'Event Sold Out';
					}
					else
					{
						$stat = 'Female Tickets Sold Out';
					}
				}
				
				$qu = "UPDATE Events SET MaxFemaleQuantity = '$femalequantity'";
				if($stat != '')
				{
					$qu .= ", Availability = '$stat'";
				}
				$qu .= " WHERE ID = $eventid";
				mysql_query($qu) or die(mysql_error());
			}
			else
			{
				$malequantity = $roweve['MaxMaleQuantity'] - $quantity;
				if($malequantity <= 5 && $malequantity > 0)
				{
					$to = 'sales@asiandinnerclub.com';
					$subject = "Male Tickets Alert - $ticket";
					$body = "This is an auto alert letter you know that the number of Male Tickets for $ticket has reached 5 or less!\r\n";
					$body .= "\r\nPlease keep checking on the events database to see the ticket status.\r\n";
					$body .= "\r\nThanks\n Auto Service\n Asian Dinner Club\r\n";
					$headers .= "From: Asian Dinner Club <sales@asiandinnerclub.com> \r\n";
					mail($to, $subject, $body, $headers);
				}

				if($malequantity == 0)
				{
					$to = 'sales@asiandinnerclub.com';
					$subject = "Male Tickets Alert - $ticket";
					$body = "This is an auto alert letter you know that the Male Tickets for $ticket has SOLD OUT!\r\n";
					$body .= "\r\nPlease change the ticket status on the events database asap.\r\n";
					$body .= "\r\nThanks\n Auto Service\n Asian Dinner Club\r\n";
					$headers .= "From: Asian Dinner Club <sales@asiandinnerclub.com> \r\n";
					mail($to, $subject, $body, $headers);
					
					if($roweve['MaxFemaleQuantity'] == 0)
					{
						$stat = 'Event Sold Out';
					}
					else
					{
						$stat = 'Male Tickets Sold Out';
					}
				}
				
				$qu = "UPDATE Events SET MaxMaleQuantity = '$malequantity'";
				if($stat != '')
				{
					$qu .= ", Availability = '$stat'";
				}
				$qu .= " WHERE ID = $eventid";
				mysql_query($qu) or die(mysql_error());
			}*/
			?>
			<script>location.href='events.php';</script>
		<?php
		}

		if(isset($_GET['cancel']))
		{?>
			<script>
			alert('You have just cancelled <?php echo $quantity;?> ticket(s) for <?php echo $ticket;?>. Please feel free to choose any other event.');
			location.href='events.php';
			</script>
		<?php
		}
	}

    $query = "SELECT * FROM Events WHERE Date >= CURDATE() ORDER BY Date ASC";
	$result = mysql_query($query) or die(mysql_error());
	if(mysql_num_rows($result) != 0)
	{
		while($row = mysql_fetch_array($result))
		{
			$eid = $row['ID'];?>
			<div>
				<p><span class="righthandpic"><a name="<?php echo $row['Venue'];?>" id="<?php echo $row['Venue'];?>"></a><img src="images/<?php echo $row['Image_Path'];?>" alt="<?php echo $row['Venue'];?>" width="188" height="168" /></span></p>
				<table width='390' border='0' cellpadding='0' cellspacing='0'>
					<tr>
					  <th align='left' width='100'>Venue:</th>
					  <td>&nbsp;</td>
					  <th align='left'><?php echo $row['Venue'];?></th>
					</tr>
					<tr>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
					</tr>
					<tr>
					  <th align='left'>Religion:</th>
					  <td>&nbsp;</td>
					  <td align='left'><?php echo $row['Religion'];?></td>
					</tr>
					<tr>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
					</tr>
					<!--<tr>
					  <th align='left'>City:</th>
					  <td>&nbsp;</td>
					  <td align='left'><?php echo $row['City'];?></td>
					</tr>-->
					<tr>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
					</tr>
					<tr>
					  <th align='left'>Address:</th>
					  <td>&nbsp;</td>
					  <td><?php echo $row['Address_Street'];?></td>
					</tr>
					<tr>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
					  <td><?php echo $row['Address_Town'] . ' ' . $row['Address_City'];?></td>
					</tr>
					<tr>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
					  <td><?php echo $row['Address_PostCode'];?></td>
					</tr>
					<tr>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
					  <?php if(stristr($row['Address_PostCode'], ' '))
							{
								$post = str_replace(' ', '+', $row['Address_PostCode']);
							}
							else
							{
								$post = $row['Address_PostCode'];
							}?>
					  <td><a style='text-decoration:none;' href="http://maps.google.co.uk/maps?f=q&hl=en&geocode=&q=<?php echo $post;?>" target="_blank">google map</a></td>
					</tr>
					<tr>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
					</tr>
					<tr>
					  <th align='left'>Date:</th>
					  <td>&nbsp;</td>
					  <?php $date = date('jS F Y', strtotime($row['Date']));?>
					  <td><?php echo $date;?></td>
					</tr>
					<tr>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
					</tr>
					<tr>
					  <th align='left'>Time:</th>
					  <td>&nbsp;</td>
					  <td><?php echo $row['Time'];?>pm</td>
					</tr>
					<tr>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
					</tr>
				</table>
				<table width='100%' cellspacing='0' cellpadding='0' border='0' />
					<tr>
						<th align='left' width='106'>Price:</th>
						<td>&nbsp;</td>
						<td>&pound;<?php echo $row['Price']?></td>
					</tr>
					<tr>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
					</tr>
					<tr>
					  <th align='left'>Event Type:</td>
					  <td>&nbsp;</td>
					  <td><?php echo $row['Event_Type'];?></td>
					</tr>
					<tr>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
					</tr>
					<tr>
					  <th align='left'>Age:</td>
					  <td>&nbsp;</td>
					  <td><?php echo $row['Age'];?>yrs</td>
					</tr>
					<tr>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
					</tr>
					<tr>
					    <th align='left'>Membership:</td>
					    <td>&nbsp;</td>
					    <td>
							<table>
								<tr>
									<td><?php echo $row['Member_Type']?></td>
									<td>
										<table cellspacing='0' cellpadding='0' border='0'>
											<tr>
												<td><img src="images/sumi_buttons_04.png" width="11" height="19" alt=""></td>
												<td class='singlebutton'><a title='Book Now' href="member/index.php?<?php if($row['Member_Type'] == 'Premier'){echo "type=premier&";}?>eid=<?php echo $eid;?>">Book Here</a></td>
												<td><img src="images/sumi_buttons_06.png" width="11" height="19" alt=""></td>
												<td style='padding-left:1em;'><a href="<?php if($row['Member_Type'] == 'Standard'){ echo 'membership.php';} else {echo 'member/premier/register.php';}?>" class='join'>Not a <?php if($row['Member_Type'] == 'Premier'){echo "Premier ";}?>Member? Join here</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
					</tr>
					<tr>
					  <th align='left'>Availability:</th>
					  <td>&nbsp;</td>
					  <td><?php echo $row['Availability'];?></td>
					</tr>
					<tr>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
					</tr>
					<tr>
					  <th valign="top" align='left'>Description:</th>
					  <td>&nbsp;</td>
					  <td valign="top"><?php echo $row['Description'];?></td>
					</tr>
				</table>
  				<br/>
			</div>
			<p><hr/></p>
<?php	}
	} else {?>
		<p height='450'><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/></p>
	<?php
	}?>


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
<span style='float:left;'>
<a href='http://www.facebook.com/home.php#/group.php?gid=39319432171'><img src='images/Facebook_Badge.gif' border='0' alt='Find us on Facebook' /></a>
</span>
<div class="footer2col2">Copyright &copy;&nbsp;Asian Dinner Club&nbsp;2009</div>
<div class="footer2col2">designed by: <a href="http://www.streeten.co.uk" target='_blank'>streeten</a></div>
<div class="footer2col2">redeveloped by: <a href="http://www.sbcommunications.co.uk" target='_blank'>S B Communications Ltd.</a></div></div>
</div>
</body>
</html>