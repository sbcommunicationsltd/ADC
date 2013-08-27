<?php session_start();
include '../database/databaseconnect.php';

if(!isset($_SESSION['admin_is_logged_in'])){
	header('Location: login.php');
}
if(!isset($_SESSION['admin2_is_logged_in'])){
	header('Location: ../admin/');
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
<script>
function check()
{
	var subject = document.getElementById('Subject');
	if(subject.value == '')
	{
		alert('Please enter a subject.');
		return false;
	}

	var message = document.getElementById('Message');
	if(message.value == '')
	{
		alert('Please enter a message.');
		return false;
	}
	document.send.submit();
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
<div id="maincontent">
<div id="innercontent">

<!-- main content area -->

<div id="contentcol1">

<h2>Admin Area</h2>
<img src="../images/membership.gif" alt="Membership" width="181" height="50"/>
<?php
if(!isset($_POST['Send']) || (isset($_POST['Send']) && !empty($failed)))
{?>
	<table width='100%' align='center' cellspacing='2' cellpadding='2' border='0'>
	<tr>
		<td colspan='3'>&nbsp;</td>
	</tr>
	<tr>
		<th colspan='3' align='left'>Email:</th>
	</tr>
	<tr>
		<th width='33%'><input type='radio' name='email' value='All' <?php if(isset($_GET['email'])){if($_GET['email'] == 'all'){ echo "checked='checked'"; }}else{ echo "checked='checked'"; }  ?> onclick="location.href='?email=all';" />All Standard Members</th>
		<th width='33%'><input type='radio' name='email' value='Male' <?php if($_GET['email'] == 'male'){echo "checked='checked'";} ?> onclick="location.href='?email=male';" />Male</th>
		<th width='33%'><input type='radio' name='email' value='Female' <?php if($_GET['email'] == 'female'){echo "checked='checked'";} ?> onclick="location.href='?email=female';" />Female</th>
	</tr>
	<tr height='40'>
		<td colspan='3'>&nbsp;</td>
	</tr>
	<tr>
		<th align='left' colspan='3'>Compose Message:</th>
	</tr>
	<tr>
		<td colspan='3'>
			<?php
			$query = "SELECT ForeName, EmailAddress FROM Members";
			if(isset($_GET['email']))
			{
				$gen = $_GET['email'];
				if($gen == 'male')
				{
					$query .= " WHERE Gender = 'Male'";
				}
				elseif($gen == 'female')
				{
					$query .= " WHERE Gender = 'Female'";
				}
			}
			$result = mysql_query($query) or die(mysql_error());
			
			$emails = array();
			while($row = mysql_fetch_array($result))
			{
				$emails[] = $row[0] . '#' . $row[1];
			}
			//$emails = array('Sumita#sumita.biswas@gmail.com', 'Sumi#sumi@blueyonder.co.uk', 'SumiHotMail#sumita_biswas@hotmail.com', 'TestMail#info@asiandinnerclub.com');
			$emailsadd = serialize($emails);?>
			<form method='post' name='send'>
				<table width='100%' cellspacing='2' cellpadding='2' border='0'>
					<tr>
						<th width='15%' align='left'>To:</th>
						<td><?php
							if(isset($_GET['email']))
							{
								$gen = $_GET['email'];
								if($gen == 'all')
								{
									echo 'All Standard Members';
								}
								elseif($gen == 'male')
								{
									echo 'All Male Standard Members';
								}
								else
								{
									echo 'All Female Standard Members';
								}
							}
							else
							{
								echo 'All Standard Members';
							}?>
							<input type='hidden' name='EmailAdd' value='<?php echo $emailsadd;?>' />
						</td>
					</tr>
					<tr>
						<td colspan='2'>&nbsp;</td>
					</tr>
					<tr>
						<th align='left'>Subject:</th>
						<td><input type='text' name='Subject' id='Subject' size='65' /></td>
					</tr>
					<tr>
						<td colspan='2'>&nbsp;</td>
					</tr>
					<tr>
						<th align='left'valign='top'>Message:</th>
						<td><textarea name='Message' cols='80' rows='15' id='Message' class='fontstyle3'></textarea></td>
					</tr>
					<tr>
						<td colspan='2'>&nbsp;</td>
					</tr>
					<tr>
						<td colspan='2' align='center'>
						<input type='hidden' name='Send' />
						<table cellspacing='0' cellpadding='0' border='0'>
							<tr>
								<td><img src="../images/sumi_buttons_04.png" width="11" height="19" alt=""></td>
								<td class='singlebutton'><a title='Send Message' href="#" onclick='return check();'>Send Message</a></td>
								<td><img src="../images/sumi_buttons_06.png" width="11" height="19" alt=""></td>
							</tr>
						</table>
					</tr>
				</table>
			</form>
		</td>
	</tr>
	</table>
<?php
}
else
{
	$failed = array();
	$toemails = unserialize($_POST['EmailAdd']);
	foreach($toemails as $toe)
	{
		$toemail = explode('#', $toe);
		$to = $toemail[1];
		$subject = $_POST['Subject'];
		if(strpos($subject, '\"') !== false)
		{
			$subject = str_replace('\"', '"', $subject);
		}

		if(strpos($subject, "\'") !== false)
		{
			$subject = str_replace("\'", "'", $subject);
		} 

		$mess = $_POST['Message'];
		
		if (strpos($mess, '[firstname]') !== false) {
			$mess = str_replace("[firstname]", $toemail[0], $mess);
		}
		
		if(strpos($mess, "\r\n") !== false)
		{
			$mess = str_replace("\r\n", '<br/>', $mess);
		}

		if(strpos($mess, '\"') !== false)
		{
			$mess = str_replace('\"', '"', $mess);
		}

		if(strpos($mess, "\'") !== false)
		{
			$mess = str_replace("\'", "'", $mess);
		}

		$message = "<html><head></head><body><p>" . $mess . "</p>";
		$message .= "<p>&nbsp;</p><p>Best Wishes,<br/><br/>From the Asian Dinner Club Team</p>";
		$message .= "<p><img src='http://www.asiandinnerclub.com/images/logo.gif' alt='Asian Dinner Club' border='0' /></p>";
		$message .= "<p style='font-size:10px;'>We want to keep you up to date with everything that is happening at Asian Dinner Club.";
		$message .= "Click <a href='mailto:info@asiandinnerclub.com'>info@asiandinnerclub.com</a> to let us know if you wish to unsubscribe or cancel your membership with Asian Dinner Club. Thank you.</p>";
		$message .= "<p>&nbsp;<p><p>&nbsp;</p><p><hr/></p><p style='font-size:9px; color:grey;'>Asian Connections Ltd | Registered Office: 145-157 St John Street, London, EC1V 4PW | ";
		$message .= "Reg. in England &amp; Wales | Co No: 8595159</p></body></html>";
		$headers = "MIME-Version: 1.0 \r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1 \r\n";
		$headers .= "From: Asian Dinner Club <info@asiandinnerclub.com> \r\n";

		if(!mail($to, $subject, $message, $headers))
		{
			$failed[] = $toe;
		}
	}

	if(empty($failed))
	{?>
		<p>All Email(s) have been sent successfully!</p>
		<p>Total Sent: <?php echo count($toemails);?></p>
		<p>&nbsp;</p>
		<p>
		<table cellspacing='0' cellpadding='0' border='0'>
			<tr>
				<td><img src="../images/sumi_buttons_04.png" width="11" height="19" alt=""></td>
				<td class='singlebutton'><a title='Send More Emails' href="emailmembers.php">Send More Emails</a></td>
				<td><img src="../images/sumi_buttons_06.png" width="11" height="19" alt=""></td>
			</tr>
		</table>
		</p>
<?php
	}
	else
	{
		$totalsent = count($toemails) - count($failed);?>
		<p>Sorry, a few emails couldn't be sent.</p>
		<p>Total Number Successfully Sent: <?php echo $totalsent;?></p>
		<p>There is a temporary error in the system. We apologise for any inconvenience caused.</p>
		<p>Please try again later or email manually by clicking the recipient(s) below:</p>
		<p>
		<?php
		foreach($failed as $fail)
		{
			echo "- <a href='mailto:$fail'>$fail</a><br/>";
		}?>
		</p>
<?php
	}
}?>

<table cellspacing='0' cellpadding='0' border='0'>
	<tr>
		<td><img src="../images/sumi_buttons_04.png" width="11" height="19" alt=""></td>
		<td class='singlebutton'><a title='Return' href="../admin/">Return</a></td>
		<td><img src="../images/sumi_buttons_06.png" width="11" height="19" alt=""></td>
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
</div>
</body>
</html>