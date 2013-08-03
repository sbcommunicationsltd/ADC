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

<?php
session_start();
include '../database/databaseconnect.php';

if(!isset($_GET['type']))
{
	$eid = $_GET['eid'];
	$errorMessage = '';
	if (isset($_POST['txtUserId']) && isset($_POST['txtPassword'])) {

	   $userId = $_POST['txtUserId'];
	   $password = $_POST['txtPassword'];

	   // check if the user id and password combination exist in database
	   $sql = "SELECT *
	           FROM tbl_auth_user
	           WHERE member_id = '$userId'
	                 AND user_pass = '$password'";

	   $result = mysql_query($sql)
	             or die('Query failed. ' . mysql_error());

	   if (mysql_num_rows($result) == 1) {
	      // the user id and password match,
	      // set the session
	      $_SESSION['member_is_logged_in'] = true;

	      // after login we move to the main page
	      header('Location: ../member/?eid=' . $eid);
	      exit;
	   } else {
	      $errorMessage = 'Sorry, wrong user id / password';
	   }
	}
	?>

	<h1><img src="../images/welcome.gif" alt="welcome" width="181" height="50"/></h1>
	<div>

	<?php
	if ($errorMessage != '') {
	?>
	<p align="center" style='color:#990000; font-weight:bold;'><?php echo $errorMessage; ?></p>
	<?php
	}
	?>
	<form method="post" name="frmLogin" id="frmLogin">
	<table style="border:1px solid #d0d3d5; background-color:transparent;" border="0" cellspacing="0" cellpadding="4" width="300" align='center' height='175'>
		<tr>
	    	<th align='center' colspan="2" bgcolor="#ec008c" class="bghome"><div style="color: #00225d;">&nbsp;MEMBER LOGIN</div></td>
	    </tr>
	    <tr>
			<td>Username</td>
			<td><input name="txtUserId" type="text" id="txtUserId"></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input name="txtPassword" type="password" id="txtPassword"></td>
		</tr>
	</table>
	<table cellspacing='0' cellpadding='0' border='0' align='center'>
		<tr>
			<td colspan='3'>&nbsp;</td>
		</tr>
		<tr>
			<td><img src="../images/sumi_buttons_04.png" width="11" height="19" alt="" /></td>
			<td class='singlebutton'><a title='Log In' onclick="javascript:document.frmLogin.submit();" href='#'>Log In</a></td>
			<td><img src="../images/sumi_buttons_06.png" width="11" height="19" alt="" /></td>
		</tr>
	</table>
	<!--<table height="50" colspan="2" align="center">
		<tr>
			<td><a onclick="javascript:document.frmLogin.submit();" href='#'><img src="images/login.gif" alt="Login" border="0" /></a></td>
		</tr>
	</table>-->
	</form>
<?php
}
elseif($_GET['type'] == 'premier')
{	
	$eid = $_GET['eid'];
	$errorMessage2 = '';
	if (isset($_POST['txtUserId2']) && isset($_POST['txtPassword2'])) {

		$userId2 = $_POST['txtUserId2'];
		$password2 = $_POST['txtPassword2'];
		$day = substr($password2, 0, 2);
		$month = substr($password2, 2, 2);
		$year = substr($password2, -2);
		
		$password2 = $year . '-' . $month . '-' . $day;

		// check if the user id and password combination exist in database
		$sql2 = "SELECT *
			   FROM Premier_Membership
			   WHERE EmailAddress = '$userId2'
					 AND DOB LIKE '%$password2'";
		//echo $sql2;
		$result2 = mysql_query($sql2)
				 or die('Query failed. ' . mysql_error());

		if (mysql_num_rows($result2) == 1) {
			$row2 = mysql_fetch_array($result2);
			$date = date('Y-m-d H:i');
			$expires = $row2['DateExpire'];
			if($expires == '') {
				$errorMessage2 = "Login Error</p><p><br/></p><p style='font-size:14px;'>Your account has not been activated yet. Please try again later or please contact the <a href='info@asiandinnerclub.com' style='text-decoration:none;' border='0'>Administrator</a>.</p><p>Note: If you have registered for Premier Membership but not paid yet - please follow the link below to pay through PayPal. Thanks.";
				$errorMessage2 .= "<form action='https://www.paypal.com/cgi-bin/webscr' method='post'>
					<input type='hidden' name='business' value='sales@asiandinnerclub.com'>
					<input type='hidden' name='cmd' value='_xclick'>
					<input type='hidden' name='amount' value='150.00'>
					<input type='hidden' name='currency_code' value='GBP'>
					<input type='hidden' name='item_name' value='Premier Membership'>
					<input type='hidden' name='return' value='http://www.asiandinnerclub.com/?success=premier'>
					<input type='hidden' name='cancel_return' value='http://www.asiandinnerclub.com/?cancel=premier'>
					<input type='image' src='http://www.asiandinnerclub.com/images/paypalbutton2.png' border='0' name='submit' alt='PayPal - The safer, easier way to pay online.'>
					</form>";
			} else {
				if($date < $expires)
				{
					// the user id and password match,
					// set the session
					$_SESSION['premmem_is_logged_in'] = true;
					//$_SESSION['premmem_name'] = $userId2;
					//$_SESSION['prem_id'] = $row2['ID'];

					// after login we move to the main page
					header('Location: ../member/?type=premier&eid=' . $eid);
					exit;
				}
				else
				{
					$errorMessage2 = "Login Error</p><p><br/></p><p style='font-size:14px;'>Your account has expired. Please use the link in the reminder email that you received.<br/><br/>If you did not recieve this email, then please contact the <a href='info@asiandinnerclub.com' style='text-decoration:none;' border='0'>Administrator</a>.";
				}
			}
		} else {
		  $errorMessage2 = "Login Error</p><p><br/></p><p style='font-size:14px;'>The username/password you entered does not match any enabled profiles currently on our system. Please try again.<br/><br/>Your username should be your email address which you used to register with us and the password is your date of birth (YYMMDD).";
		}
	}
	?>

	<h1><img src="../images/membership_side2.gif" alt="premier membership" width="300" height="50"/></h1>
	<div>

	<?php
	if($errorMessage2 != '')
	{?>
		<p style='font-weight:bold; font-size:16px;'><?php echo $errorMessage2;?></p>
	<?php
	}?>

	<p height='50'>&nbsp;</p>
	<form method="post" name="frmLogin2" id="frmLogin2">
	<table style="border:1px solid #d0d3d5; background-color:transparent;" border="0" cellspacing="4" cellpadding="4" width="300" align='center' height='265'>
		<tr>
	    	<th colspan="2" align='left'>Event Booking Login:</th>
	    </tr>
	    <tr>
			<th align='left'>email</th>
			<td><input name="txtUserId2" type="text" id="txtUserId2" /></td>
		</tr>
		<tr>
			<th align='left'>password</th>
			<td><input name="txtPassword2" type="password" id="txtPassword2" /></td>
		</tr>
		<tr>
			<td>
				<table cellspacing='0' cellpadding='0' border='0'>
					<tr>
						<td><img src="../images/sumi_buttons_04.png" width="11" height="19" alt=""></td>
						<td class='singlebutton'><a title='Log In' onclick="javascript:document.frmLogin2.submit();" href='#'>Log In</a></td>
						<td><img src="../images/sumi_buttons_06.png" width="11" height="19" alt=""></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	</form>
	<p><br/></p>
	<p>Note: To be able to book tickets for an event, login using your premier membership details that you created when you subscribed for the service.</p>
<?php
}
/*elseif($_GET['type'] == 'eternity')
{
	$errorMessage3 = '';
	$eid = $_GET['eid'];
	if (isset($_POST['txtUserId3']) && isset($_POST['txtPassword3'])) {

	   $userId3 = $_POST['txtUserId3'];
	   $password3 = $_POST['txtPassword3'];

	   // check if the user id and password combination exist in database
	   $sql3 = "SELECT *
	           FROM tbl_auth_user
	           WHERE eternitymem_id = '$userId3'
	                 AND user_pass = '$password3'";

	   $result3 = mysql_query($sql3)
	             or die('Query failed. ' . mysql_error());

	   if (mysql_num_rows($result3) == 1) {
	      // the user id and password match,
	      // set the session
	      $_SESSION['eternitymem_is_logged_in'] = true;

	      // after login we move to the main page
	      header('Location: ../eternityevents.php?eid=' . $eid);
	      exit;
	   } else {
	      $errorMessage3 = 'Sorry, wrong user id / password';
	   }
	}
	?>

	<h1><img src="../images/welcome.gif" alt="welcome" width="181" height="50"/></h1>
	<div>

	<?php
	if ($errorMessage3 != '') {
	?>
	<p align="center" style='color:#990000; font-weight:bold;'><?php echo $errorMessage3; ?></p>
	<?php
	}
	?>
	<form method="post" name="frmLogin3" id="frmLogin3">
	<table style="border:1px solid #d0d3d5; background-color:transparent;" border="0" cellspacing="0" cellpadding="4" width="300" align='center' height='175'>
		<tr>
	    	<th align='center' colspan="2" bgcolor="#ec008c" class="bghome"><div style="color: #00225d;">&nbsp; ETERNITY MEMBER LOGIN</div></td>
	    </tr>
	    <tr>
			<td>Username</td>
			<td><input name="txtUserId3" type="text" id="txtUserId3"></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input name="txtPassword3" type="password" id="txtPassword3"></td>
		</tr>
	</table>
	<table cellspacing='0' cellpadding='0' border='0' align='center'>
		<tr>
			<td colspan='3'>&nbsp;</td>
		</tr>
		<tr>
			<td><img src="../images/sumi_buttons_04.png" width="11" height="19" alt="" /></td>
			<td class='singlebutton'><a title='Log In' onclick="javascript:document.frmLogin3.submit();" href='#'>Log In</a></td>
			<td><img src="../images/sumi_buttons_06.png" width="11" height="19" alt="" /></td>
		</tr>
	</table>
	</form>
<?php
}*/
?>
<p><br/></p>
<table cellspacing='0' cellpadding='0' border='0'>
	<tr>
		<td><img src="../images/sumi_buttons_04.png" width="11" height="19" alt="" /></td>
		<td class='singlebutton'><a title='Back' <?php if((!isset($_GET['type'])) || ($_GET['type'] == 'premier')){ echo "href='../events.php'";}/*else{ echo "href='../eternitymembership.php'";}*/?>>Back</a></td>
		<td><img src="../images/sumi_buttons_06.png" width="11" height="19" alt="" /></td>
	</tr>
</table>
<!--<input type="button" value="Back" onClick="location.href='../index.php'">-->
</div>
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