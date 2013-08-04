<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Asian Dinner Club - for Single Asian Professionals :: membership booking login ::  Asian Dinner Club</title>
<meta name="description" content=" Asian Dinner Club, for Single Asian Professionals" />
<meta name="keywords" content="Indian, dating, party, London, Matchmaking, Asian matchmaking, Shaadi, restaurants, events, Asian Dinner Club, Asia dinner club, Indian dinner club, Supper club, Asian events, Asian dating, Asian speedating, Asian speeddating, Chillitickets, Asiana, Dating events london, Singles events asian, Singles events london, Salima manji, Single solution, Hindu events, Sikh events, muslim dating, Hindu dating, Sikh dating, Dinner clubs, Top table, Dinner parties, Dinner dates, Quaglinos, Asia de cuba" />
</head>
<body>
<div id="wrapper">
<div id="header">
<div id="logo"><a href="../member/" target="_self"><img src="images/logo.gif" alt="Asian Dinner Club" /></a></div>
<div id="navigation">
<ul>
<li><a href="http://www.asiandinnerclub.com/" target="_self">HOME</a></li>
</ul>
</div>
</div>
<div id="maincontent">
<div id="innercontent">

<!-- main content area -->

<div id="contentcol1">
<p>Please Wait...</p>
<p>Redirecting...</p>
<?php
session_start();
include '../database/databaseconnect.php';
$redirect = 0;
$amount = $_POST['amount'];
$item = $_POST['item_name'];
$itemnumber = $_POST['item_number'];
$quantity = $_POST['quantity'];
$id = $_POST['id'];
$location = $_POST['location'];
if($location == 'standard')
{
	$url2 = "../member/?eid=$id";
	$gender = $_POST['gender'];
}
elseif($location == 'premier')
{
	$gender = $_POST['gender'];
}
/*else
{
	$url2 = "../eternityevents.php?eid=$id";
}*/

if($location != 'eternity')
{
	$query = "SELECT * FROM Events WHERE ID = $id";
	$result = mysql_query($query) or die(mysql_error());
	$row = mysql_fetch_array($result);
	$venue = $row['Venue'] . ' on ' . date('jS F Y', strtotime($row['Date']));
	$maxmale = $row['MaxMaleQuantity'];
	$maxfemale = $row['MaxFemaleQuantity'];
	if($gender == 'Male')
	{
		if($maxmale == 0)
		{?>
			<script>
			alert('Sorry - Male Tickets for <?php echo $venue;?> are sold out! Please feel free to choose another event.');
			location.href='../events.php';
			</script>
		<?php
		}
		elseif($maxmale!=0 && ($maxmale < $quantity))
		{?>
			<script>
			alert('Sorry, we cannot provide that many tickets. Please change the quantity of tickets needed.');
			location.href="<?php echo $url2;?>";
			</script>
		<?php
		}
		else
		{
			$redirect = 1;
			$url = '=' . $quantity . '&ven=' . $id . '&gen=m&loc=' . $location;
		}
	}
	else
	{
		if($maxfemale == 0)
		{?>
			<script>
			alert('Sorry - Female Tickets for <?php echo $venue;?> are sold out! Please feel free to choose another event.');
			location.href='../events.php';
			</script>
		<?php
		}
		elseif($maxfemale!=0 && ($maxfemale < $quantity))
		{?>
			<script>
			alert('Sorry, we cannot provide that many tickets. Please change the quantity of tickets needed.');
			location.href="<?php echo $url2;?>";
			</script>
		<?php
		}
		else
		{
			$redirect = 1;
			$url = '=' . $quantity . '&ven=' . $id . '&gen=f&loc=' . $location;
		}
	}
}
/*else
{
	$query = "SELECT * FROM Eternity_Events WHERE ID = $id";
	$result = mysql_query($query) or die(mysql_error());
	$row = mysql_fetch_array($result);
	$venue = $row['Venue'] . ' on ' . date('jS F Y', strtotime($row['Date']));
	$max = $row['MaxQuantity'];
	if($max == 0)
	{?>
		<script>
		alert('Sorry - Tickets for <?php echo $venue;?> are sold out! Please feel free to choose another event.');
		location.href='../eternitymembership.php';
		</script>
	<?php
	}
	elseif($max!=0 && ($max < $quantity))
	{?>
		<script>
		alert('Sorry, we cannot provide that many tickets. Please change the quantity of tickets needed.');
		location.href="<?php echo $url2;?>";
		</script>
	<?php
	}
	else
	{
		$redirect = 2;
		$url = '=' . $quantity . '&ven=' . $id . '&loc=' . $location;
	}
}*/
?>
</div>

<div id="contentcol2">
<p>&nbsp;</p>
<p>&nbsp;</p>
<!--<span class="lefthandpic"><img src="../images/side.jpg" alt="Asian Dinner Club" width="194" height="194" /></span>-->
<p>&nbsp;</p>
<p>&nbsp;</p>
</div>


<!-- end inner content -->

</div>
</div>
<div id="footer">
</div>
<div id="footer2">
<div class="footer2col2">Copyright &copy;&nbsp;Asian Dinner Club&nbsp;2009</div>
<div class="footer2col2">designed by: <a href="http://www.streeten.com">streeten</a></div>
<div class="footer2col2">redeveloped by: <a href="http://www.sbcommunications.co.uk">S B Communications Ltd.</a></div></div>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
  _uacct = "UA-4965994-1";
  urchinTracker();
</script>
</div>
</body>
</html>
<?php
if($redirect == 1)
{?>
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" name='paypal'>
	<input type="hidden" name="business" value="info@asiandinnerclub.com">
	<input type='hidden' name='cmd' value='_xclick'>
	<input type='hidden' name='amount' value="<?php echo $amount;?>">
	<!--<input type='hidden' name='amount' value="0.01">-->
	<input type='hidden' name='currency_code' value="GBP">
	<input type='hidden' name='item_name' value="<?php echo $item;?>">
	<input type='hidden' name='item_number' value="<?php echo $itemnumber;?>">
	<input type="hidden" name="on0" value="Gender">
	<select name="os0" style='display:none;'>
		<option value="Male" <?php if($gender == 'Male'){echo "selected='selected'";}?>>Male</option>
		<option value="Female" <?php if($gender == 'Female'){echo "selected='selected'";}?>>Female</option>
	</select>
	<input type='hidden' name='quantity' value="<?php echo $quantity;?>">
	<input type="hidden" name="return" value="http://www.asiandinnerclub.com/events.php?success<?php echo $url;?>">
	<!--added in to test gender countdown -->
	<input type='hidden' name='notify_url' value="http://www.asiandinnerclub.com/scripts/ipnprocess.php?success<?php echo $url;?>">
	<input type="hidden" name="cancel_return" value="http://www.asiandinnerclub.com/events.php?cancel<?php echo $url;?>">
	</form>
	<script>document.paypal.submit();</script>
<?php
}

/*if($redirect == 2)
{?>
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" name='paypal2'>
	<input type="hidden" name="business" value="sales@asiandinnerclub.com">
	<input type='hidden' name='cmd' value='_xclick'>
	<input type='hidden' name='amount' value="<?php echo $amount;?>">
	<input type='hidden' name='currency_code' value="GBP">
	<input type='hidden' name='item_name' value="<?php echo $item;?>">
	<input type='hidden' name='item_number' value="<?php echo $itemnumber;?>">
	<input type='hidden' name='quantity' value="<?php echo $quantity;?>">
	<input type="hidden" name="return" value="http://www.asiandinnerclub.com/eternitymembership.php?success<?php echo $url;?>">
	<!-- added in to test max ticket countdown -->
	<input type='hidden' name='notify_url' value="http://www.asiandinnerclub.com/scripts/ipnprocess.php?success<?php echo $url;?>">
	<input type="hidden" name="cancel_return" value="http://www.asiandinnerclub.com/eternitymembership.php?cancel<?php echo $url;?>">
	</form>
	<script>document.paypal2.submit();</script>
<?php
}*/?>