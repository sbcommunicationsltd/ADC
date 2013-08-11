<?php session_start();
include '../database/databaseconnect.php';
$eid = $_GET['eid'];

if(isset($_GET['type']))
{
	if(!isset($_SESSION['premmem_is_logged_in'])){
		header('Location: login.php?type=premier&eid=' . $eid);
	}
}
else
{
	if(!isset($_SESSION['member_is_logged_in'])){
		header('Location: login.php?eid=' . $eid);
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="../css/styles.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Asian Dinner Club - for Single Asian Professionals :: events ::  Asian Dinner Club</title>
<meta name="description" content=" Asian Dinner Club, for Single Asian Professionals" />
<meta name="keywords" content="Indian, dating, party, London, Matchmaking, Asian matchmaking, Shaadi, restaurants, events, Asian Dinner Club, Asia dinner club, Indian dinner club, Supper club, Asian events, Asian dating, Asian speedating, Asian speeddating, Chillitickets, Asiana, Dating events london, Singles events asian, Singles events london, Single solution, Hindu events, Sikh events, muslim dating, Hindu dating, Sikh dating, Dinner clubs, Top table, Dinner parties, Dinner dates, Quaglinos, Asia de cuba, Asian Dinner Club, Tantric Club, Asiand8" />
<script type='text/javascript'>
function reload(gen, loc)
{
	var val = document.getElementById(gen).value;

	var val2;
	if(val == 'Female')
	{
		val2 = 'f';
	}
	else
	{
		val2 = 'm';
	}
	var pos = loc.indexOf('&gen');

	if(pos!=-1)
	{
		loc = loc.substring(0,pos);
	}
	self.location = loc + '&gen=' + val2 ;
}
</script>
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
<div id="header">
<div id="logo"><a href="http://www.asiandinnerclub.com/" target="_self"><img src="../images/logo.gif" alt="Asian Dinner Club" /></a></div>
<div id="navigation">
<ul>
<li><a href="http://www.asiandinnerclub.com/" target="_self">HOME</a></li>
<li class="topnav" ><a href="../aboutus.php" target="_self">ABOUT<br/>US</a></li>
<li><a class="active" href="../events.php" target="_self">CURRENT<br/>EVENTS</a></li>
<li><a href="../past_events.php" target="_self">PAST<br/>EVENTS</a></li>
<li><a href="../membership.php" target="_self">MEMBERSHIP</a></li>
<li><a href="../press.php" target="_self">PRESS</a></li>
<li><a href="../contact.php" target="_self">CONTACT</a></li>
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
<?php
if(!isset($_GET['type']))
{?>
	<h2>Members Booking</h2>
<?php
}
else
{?>

	<h2>Premier Members Booking</h2>
<?php
}?>
<!--<h1><img src="images/eternity_events.gif" alt="Eternity Events" width="210" height="50"/></h1>-->
<p>You can book for any number of events, but please specify if you are MALE or FEMALE as there are limited spaces available for men and women at each event. <strong>Book now to avoid disappointment!</strong></p>
<p>&nbsp;</p>
<?php
$query = "SELECT * FROM Events WHERE ID = $eid";
$result = mysql_query($query) or die(mysql_error());
$row = mysql_fetch_array($result);?>
<p><span class="righthandpic"><a name="<?php echo $row['Venue'];?>" id="<?php echo $row['Venue'];?>"></a><img src="../images/<?php echo $row['Image_Path'];?>" alt="<?php echo $row['Venue'];?>" width="188" height="168" /></span></p>
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
	  <th align='left'>City:</th>
	  <td>&nbsp;</td>
	  <td align='left'><?php echo $row['City'];?></td>
	</tr>
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
		<th align='left' valign='top' width='100'>Price:</th>
		<td style='padding-left:10px;'>&pound;<?php echo $row['Price'];?></td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	</tr>
	<tr>
	  <th align='left'>Event Type:</td>
	  <td style='padding-left:10px;'><?php echo $row['Event_Type'];?></td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	</tr>
	<tr>
	  <th align='left'>Membership:</td>
	  <td style='padding-left:10px;'><?php if($row['Member_Type'] == ''){echo "All";}else{echo $row['Member_Type'];}?></td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	</tr>
	<tr>
	  <th align='left'>Availability:</th>
	  <td style='padding-left:10px;'><?php echo $row['Availability'];?></td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	</tr>
	<tr>
	  <th valign="top" align='left'>Description:</th>
	  <td style='padding-left:10px;' valign="top"><?php echo $row['Description'];?></td>
	</tr>
	<tr>
		<td colspan='2'>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td align='left'>
		<?php
		$venue = $row['Venue'];
		if(!isset($_GET['type']))
		{
			$amount = $row['Price'];
			$item = $venue . ' - Standard';
		}
		else
		{
			$amount = $row['Price'];
			$item = $venue . ' - Premier';
		}

		$datepart = explode('-', $row['Date']);
		$date2 = $datepart[2] . $datepart[1] . $datepart[0];
		$url = $_SERVER['REQUEST_URI'];
		?>
			<form action="redirecting.php" method="post" name='redirecting'>
			<input type='hidden' name='amount' value="<?php echo $amount;?>">
			<!--<input type='hidden' name='amount' value="0.01">-->
			<input type='hidden' name='item_name' value="<?php echo $item;?>">
			<input type='hidden' name='item_number' value="<?php echo $date2;?>">
			<input type='hidden' name='id' value="<?php echo $eid;?>">
			<?php
			if(!isset($_GET['type']))
			{?>
				<input type='hidden' name='location' value='standard'>
			<?php
			}
			else
			{?>
				<input type='hidden' name='location' value='premier'>
			<?php
			}?>
			<table>
			<tr><td>Gender:</td></tr><tr><td><select name="gender" id='gender' onChange="reload('gender', '<?php echo $url;?>');")>
				<option value="Male" <?php if(isset($_GET['gen'])){if($_GET['gen'] == 'm'){echo "selected='selected'";}}?>>Male</option>
				<option value="Female" <?php if(isset($_GET['gen'])){if($_GET['gen'] == 'f'){echo "selected='selected'";}}?>>Female</option>
			</select></td>
			<td>
			<?php 
			if(!isset($_GET['type']))
			{?>
				<select name='quantity'>
				<?php
				if(isset($_GET['gen']) && strlen($_GET['gen']) > 0)
				{
					if($_GET['gen'] == 'f')
					{
						$quantity = $row['MaxFemaleQuantity'];
					}
					else
					{
						$quantity = $row['MaxMaleQuantity'];
					}
				}
				else
				{
					$quantity = $row['MaxMaleQuantity'];
				}

				for($i=1; $i<=$quantity; $i++)
				{
					echo "<option value='$i'>$i</option>";
				}?></select>
			<?php
			}
			else
			{?>
				<input type='hidden' name='quantity' value='1' />
			<?php
			}?>
			</td>
			</tr>
			</table>
			<input type="image" src="http://www.asiandinnerclub.com/images/paypalbutton.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
			<img alt="" border="0" src="https://www.paypal.com/en_GB/i/scr/pixel.gif" width="1" height="1">
			</form>
		</td>
	</tr>
</table>
<p>&nbsp;</p>
<table cellspacing='0' cellpadding='0' border='0'>
<tr>
	<td><img src="../images/sumi_buttons_04.png" width="11" height="19" alt=""></td>
	<td class='singlebutton'><a title='Back' href='../events.php'>Back to Events</a></td>
	<td><img src="../images/sumi_buttons_06.png" width="11" height="19" alt=""></td>
</tr>
</table>
<br/>
</div>


<div id="contentcol2">
<span class="lefthandpic"><img src="../images/side.jpg" alt="Asian Dinner Club" width="194" height="194" /></span>
</div>

<!-- end inner content -->

</div>
</div>
<div id="footer">
<div class="footer2col1"><a href="../terms.php">TERMS</a>&nbsp;|&nbsp;<a href="../sitemap.php">SITE MAP</a>&nbsp;|&nbsp;<a href="../admin/">ADMINISTRATOR</a></div></div>
<div id="footer2">
<span style='float:left;'>
<a href='http://www.facebook.com/home.php#/group.php?gid=39319432171'><img src='../images/Facebook_Badge.gif' border='0' alt='Find us on Facebook' /></a>
</span>
<div class="footer2col2">Copyright &copy;&nbsp;Asian Dinner Club&nbsp;2009</div>
<div class="footer2col2">designed by: <a href="http://www.streeten.co.uk" target='_blank'>streeten</a></div>
<div class="footer2col2">redeveloped by: <a href="http://www.sbcommunications.co.uk" target='_blank'>S B Communications Ltd.</a></div></div>
</div>
</body>
</html>