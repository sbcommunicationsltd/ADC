<?php
session_start();
include '../../database/databaseconnect.php';
if(!isset($_SESSION['premmem_is_logged_in']))
{
	header('Location: login.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="../../css/styles.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Asian Dinner Club - for Single Asian Professionals :: PREMIER MEMBERSHIP - PROFILE AREA ::  Asian Dinner Club</title>
<meta name="description" content=" Asian Dinner Club, for Single Asian Professionals" />
<meta name="keywords" content="Indian, dating, party, London, Matchmaking, Asian matchmaking, Shaadi, restaurants, events, Asian Dinner Club, Asia dinner club, Indian dinner club, Supper club, Asian events, Asian dating, Asian speedating, Asian speeddating, Chillitickets, Asiana, Dating events london, Singles events asian, Singles events london, Salima manji, Single solution, Hindu events, Sikh events, muslim dating, Hindu dating, Sikh dating, Dinner clubs, Top table, Dinner parties, Dinner dates, Quaglinos, Asia de cuba" />
<style type='text/css'>
th {font-size:14px;}
td {font-size:14px;}
</style>
</head>
<body>
<div id="wrapper">
<div id="header2-admin">
<div id="logo"><a href="../premier/" target="_self"><img src="../../images/logo.gif" alt="Asian Dinner Club" /></a></div>
<?php
$premname = $_SESSION['premmem_name'];
$id = $_SESSION['prem_id'];
$query = "SELECT * FROM Premier_Membership WHERE ID = '$id'";
$result = mysql_query($query) or die(mysql_error());
$row = mysql_fetch_array($result);
$fore = $row['Forename'];
$sur = $row['Surname'];
$consultantproposed = explode(',', $row['Consultant_Proposed']);
$consproposed = array_reverse($consultantproposed);
$memberproposed = $row['Member_Proposed'];
$memberpro = explode(',', $memberproposed);
$rejectedproposed = $row['Rejected_Proposed'];
$rejectedpro = explode(',', $rejectedproposed);?>
<div id='login'><span style='float:right; margin-top:40px;'>Logged in as <?php echo $fore;?><br/><a href='logout.php' style='text-decoration:none;'>Not <?php echo $fore;?>? Log Out</a></span></div>
<div id="navigation">
<ul>
<li><a href="http://www.asiandinnerclub.com/" target="_self">HOME</a></li>
<li class="topnav" ><a href="../../aboutus.php" target="_self">ABOUT<br/>US</a></li>
<li><a href="../../events.php" target="_self">CURRENT<br/>EVENTS</a></li>
<li><a href="../../past_events.php" target="_self">PAST<br/>EVENTS</a></li>
<li><a href="../../membership.php" target="_self">MEMBERSHIP</a></li>
<li><a class='active' href="../../premiermembership.php" target="_self">PREMIER<br/>MEMBERSHIP</a></li>
<li><a href="../../press.php" target="_self">PRESS</a></li>
<!--<li><a href="../../eternitymembership.php" target="_self">ETERNITY&nbsp;<sup style='color:white; font-size:8px; border:1px solid white; padding:1px;'>NEW</sup><br/><span style='padding-right:25px;'>MEMBERSHIP</span></a></li>-->
<li><a href="../../team.php" target="_self">THE<br/>TEAM</a></li>
<li><a href="../../contact.php" target="_self">CONTACT</a></li>
</ul>
</div>
</div>
<div id="maincontent-admin">
<div id="innercontent">

<!-- main content area -->


<div id="contentcol1-admin">

<?php
if(isset($_POST['checkedpart']))
{
	$accepted = array();
	$rejected = array();
	$notempty = array();
	foreach($consultantproposed as $conprop)
	{
		$member = $_POST['Member' . $conprop];
		if($member != '')
		{
			$notempty[] = 'true';
			if($member == 'Accept')
			{
				$accepted[] = $conprop;
			}
			else
			{
				$rejected[] = $conprop;
			}
		}
	}

	if(!empty($notempty))
	{
		$to = 'info@asiandinnerclub.com, lovesalima@googlemail.com';
		//$to = 'sumita.biswas@gmail.com';
		$subject = "Proposed Partners for $fore <$premname>";
		$body = "Member: $fore $sur <$premname> \r\n";

		$body .= "\r\nThe member(s) I would like to meet are:\r\n";
		$i=1;
		foreach($accepted as $accept)
		{
			$query3 = "SELECT * FROM Premier_Membership WHERE ID = '$accept'";
			$result3 = mysql_query($query3) or die(mysql_error());
			$row3 = mysql_fetch_array($result3);
			$forename = $row3['Forename'];
			$emailadd = $row3['EmailAddress'];
			$body .= " - $i.	$forename <$emailadd>\n";
			$i++;
		}
		$body .= "\r\n\r\nThe member(s) I would like to reject are:\r\n";
		$j=1;
		foreach($rejected as $reject)
		{
			$query5 = "SELECT * FROM Premier_Membership WHERE ID = '$reject'";
			$result5 = mysql_query($query5) or die(mysql_error());
			$row5 = mysql_fetch_array($result5);
			$forename2 = $row5['Forename'];
			$emailadd2 = $row5['EmailAddress'];
			$body .= " - $j.	$forename2 <$emailadd2>\n";
			$j++;
		}

		$body .= "\nThanks!";
		$headers .= "From: Asian Dinner Club <sales@asiandinnerclub.com> \r\n";

		if(mail($to, $subject, $body, $headers))
		{?>
			<script>
			alert("Thank you. We will contact your selected partners and when we have mutual consent, we will then arrange a suitable date/time for you to meet.");
			location.href='../premier/';
			</script>
		<?php
			if($memberproposed != '')
			{
				$mempro = $memberproposed . ',';
			}
			else
			{
				$mempro = '';
			}

			foreach($accepted as $acc)
			{
				$mempro .= "$acc,";
			}
			if($mempro != '')
			{
				$mempro = substr($mempro, 0 , -1);
			}

			if($rejectedproposed != '')
			{
				$rejpro = $rejectedproposed . ',';
			}
			else
			{
				$rejpro = '';
			}

			foreach($rejected as $rej)
			{
				$rejpro .= "$rej,";
			}
			if($rejpro != '')
			{
				$rejpro = substr($rejpro, 0, -1);
			}

			$query4 = "UPDATE Premier_Membership SET Member_Proposed = '$mempro', Rejected_Proposed = '$rejpro' WHERE ID = '$id'";
			$result4 = mysql_query($query4) or die(mysql_error());
		}
		else
		{?>
			<p><b>System Error</b></p><p>A system error has occurred -  we apologise for any inconvenience caused. Please let <a href='mailto:info@asiandinnerclub.com'>admin</a> know and try again soon.</p>
		<?php
		}
	}
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
?>

<form method='post' name='partners'>
<input type='hidden' name='checkedpart' />
<table cellspacing='0' cellpadding='0' border='0' width='100%'>
	<tr>
		<td><img src="../../images/membership_side2.gif" alt="premier membership" width="300" height="50" /></td>
		<td align='right'>
			<table cellspacing='0' cellpadding='0' border='0'>
				<tr>
					<td><img src="images/sumi_buttons_04.png" width="11" height="19" alt=""></td>
					<td class='singlebutton'><a title='Rejected Partners' onclick="window.open('rejected.php?view=<?php echo $id;?>', 'child', 'height=500,width=600,status=yes,resizable=yes,scrollbars=yes')" href='javascript:void(0)'>Rejected Partners</a></td>
    				<td><img src="images/sumi_buttons_06.png" width="11" height="19" alt=""></td>
    				<?php if($row['Consultant_Proposed'] != '')
    				{?>
    					<td><img src="images/sumi_buttons_04.png" width="11" height="19" alt=""></td>
						<td class='singlebutton'><a title='Submit Partners' onclick="javascript:document.partners.submit();" href='#'>Submit Partners</a></td>
    					<td><img src="images/sumi_buttons_06.png" width="11" height="19" alt=""></td>
    		<?php	} ?>
    			</tr>
    		</table>
    	</td>
  	</tr>
</table>
<!--<p><img src="../../images/membership_side2.gif" alt="premier membership" width="300" height="50" /><a style='text-decoration:none;' href="javascript:void(0)"><input type='button' name='rejectedpartners' value='Rejected Partners' style='cursor:pointer; float:right; margin-top:-40px;' onclick="window.open('rejected.php?view=<?php echo $id;?>', 'child', 'height=500,width=600,status=yes,resizable=yes,scrollbars=yes')" /></a><?php if($row['Consultant_Proposed'] != ''){?><input type='submit' name='checkedpart' value='Submit Partners' style='cursor:pointer; float:right; margin-top:-40px;' /><?php } ?></p>-->
<?php
if(isset($_POST['checkedpart']))
{
	if(empty($notempty))
	{
		echo "<p style='font-weight:bold;'>Error</p><p><br/></p><p>Please select or reject a proposed partner.</p>";
	}
}?>
<table width='100%' cellspacing='2' cellpadding='2' border='0' class='fontstyle2'>
	<tr>
		<td valign='top' style='border-right:1px solid #808080;' width='40%'>
			<table width='100%' cellspacing='2' cellpadding='2' border='0'>
				<tr>
					<th colspan='2' align='left'><img src='../../images/myprofile.gif' alt='My Profile' width='136' height='38' /></th>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td colspan='2'><img src="images/<?php echo $row['Image_Path'];?>" height='100' alt="<?php echo $row['Forename'];?>" border='0' />
				</tr>
				<tr>
					<td colspan='2'>&nbsp;</td>
				</tr>
				<tr>
					<td>Forename:</td>
					<td><?php echo $row['Forename'];?></td>
				</tr>
				<tr>
					<td>Age:</td>
					<td>
						<?php 	$dob = str_replace('-', '', $row['DOB']);
								$age = DetermineAgeFromDOB($dob);
								echo $age;?>
					</td>
				</tr>
				<tr>
					<td>Religion:</td>
					<td><?php echo $row['Religion'];?></td>
				</tr>
				<tr>
					<td>Height:</td>
					<td><?php echo $row['Height'];?></td>
				</tr>
				<tr>
					<td>Profession:</td>
					<td><?php echo $row['Profession'];?></td>
				</tr>
				<tr>
					<td>Interests:</td>
					<td><?php echo $row['Interests'];?></td>
				</tr>
				<tr>
					<td colspan='2'>Comments from Dating Consultant:</td>
				</tr>
				<tr>
					<td colspan='2' style='border:1px solid #808080; background-color:rgb(227,225,227);'><?php echo $row['Comments'];?></td>
				</tr>
				<tr>
					<td colspan='2'>&nbsp;</td>
				</tr>
				<tr>
					<td colspan='2'>
					<!--<a style='text-decoration:none;' href="javascript:void(0)"><input type='button' name='amend' style='font-size:13px;' value='Amend Profile' style='cursor:pointer;' onclick="window.open('profileamend.php?edit=<?php echo $id;?>', 'child', 'height=500,width=600,status=yes,resizable=yes,scrollbars=yes')" /></a>-->
					<table cellspacing='0' cellpadding='0' border='0'>
						<tr>
							<td><img src="images/sumi_buttons_04.png" width="11" height="19" alt=""></td>
							<td class='singlebutton'><a title='Amend Profile' onclick="window.open('profileamend.php?edit=<?php echo $id;?>', 'child', 'height=500,width=600,status=yes,resizable=yes,scrollbars=yes')" href="javascript:void(0)">Amend Profile</a></td>
							<td><img src="images/sumi_buttons_06.png" width="11" height="19" alt=""></td>
							<td>&nbsp;</td>
							<td><img src="images/sumi_buttons_04.png" width="11" height="19" alt=""></td>
							<td class='singlebutton'><a title='Buy Dinner Ticket' onclick="window.open('dinnerdate.php', 'child', 'height=500,width=600,status=yes,resizable=yes,scrollbars=yes')" href="javascript:void(0)">Buy Dinner Ticket</a></td>
							<td><img src="images/sumi_buttons_06.png" width="11" height="19" alt=""></td>
						</tr>
  					</table>
					</td>
				</tr>
			</table>
		</td>
		<td valign='top'>
			<table width='100%' cellspacing='0' cellpadding='2' border='0'>
				<tr>
					<th colspan='4' align='left'><img src='../../images/proposedpartners.gif' alt='Proposed Partners' width='200' height='38' /></th>
				</tr>
				<tr>
					<td colspan='4'>&nbsp;</td>
				</tr>
				<?php
				if($row['Consultant_Proposed'] != '')
				{
					foreach($consproposed as $conpro)
					{
						$query2 = "SELECT * FROM Premier_Membership WHERE ID = '$conpro'";
						$result2 = mysql_query($query2) or die(mysql_error());
						$row2 = mysql_fetch_array($result2);?>
						<tr<?php if((in_array($conpro, $memberpro)) || (in_array($conpro, $rejectedpro)))
								{ echo " style='background-color:rgb(227,225,227);'"; }?>>
							<td>Select<br/><input type='radio' name='Member<?php echo $conpro;?>' value='Accept' <?php if((in_array($conpro, $memberpro)) || (in_array($conpro, $rejectedpro))) { echo "disabled='disabled'";}?> /></td>
							<td>Reject<br/><input type='radio' name='Member<?php echo $conpro;?>' value='Reject' <?php if((in_array($conpro, $memberpro)) || (in_array($conpro, $rejectedpro))) { echo "disabled='disabled'";}?> /></td>
							<td><img src="images/<?php echo $row2['Image_Path'];?>" alt="<?php echo $row2['Forename'];?>" height='100' border='0' /></td>
							<td>
								<table width='100%' cellspacing='2' cellpadding='2' border='0'>
									<tr>
										<td>Forename:</td>
										<td><?php echo $row2['Forename'];?></td>
									</tr>
									<tr>
										<td>Age:</td>
										<td><?php 	$dob2 = str_replace('-', '', $row2['DOB']);
													$age2 = DetermineAgeFromDOB($dob2);
													echo $age2;?>
										</td>
									</tr>
									<tr>
										<td>Religion:</td>
										<td><?php echo $row2['Religion'];?></td>
									</tr>
									<tr>
										<td colspan='2'>
										<!--<a style='text-decoration:none;' href="javascript:void(0)"><input type='button' name='details' style='font-size:13px;' value='View Profile' onclick="window.open('details.php?view=<?php echo $conpro;?>', 'child', 'height=500,width=600,status=yes,resizable=yes,scrollbars=yes')" /></a>-->
										<table cellspacing='0' cellpadding='0' border='0'>
											<tr>
												<td><img src="images/sumi_buttons_04.png" width="11" height="19" alt=""></td>
												<td class='singlebutton'><a title='View Profile' onclick="window.open('details.php?view=<?php echo $conpro;?>', 'child', 'height=500,width=600,status=yes,resizable=yes,scrollbars=yes')" href="javascript:void(0)">View Profile</a></td>
												<td><img src="images/sumi_buttons_06.png" width="11" height="19" alt=""></td>
											</tr>
  										</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan='4'>&nbsp;</td>
						</tr>
			<?php	}
				}
				else
				{?>
					<tr>
						<td colspan='4'>You have no proposed partners yet.</td>
					</tr>
		<?php	}?>
				<tr>
					<td colspan='4'>&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</form>
</div>

<div id="contentcol2-admin">
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
    <p>&nbsp;</p>
  <!--<span class="lefthandpic"><img src="../../images/side.jpg" alt="Asian Dinner Club" width="194" height="194" /></span>-->
    <p>&nbsp;</p>
        <p>&nbsp;</p>
</div>


<!-- end inner content -->

</div>
</div>
<div id="footer-admin">
<div class="footer2col1"><a href="../terms.php">TERMS</a>&nbsp;|&nbsp;<a href="../sitemap.php">SITE MAP</a>&nbsp;|&nbsp;<a href="../admin/">ADMINISTRATOR</a></div></div>
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