<?php 
include '../database/databaseconnect.php';
//DELETE SECTION!
if(isset($_GET['delete']))
{
	$delid = $_GET['delete'];
	$query2 = "SELECT Forename, Surname, Image_Path FROM Members WHERE ID = '$delid'";
	$result2 = mysql_query($query2) or die(mysql_error());
	$row = mysql_fetch_array($result2);
	$fullname = "$row[0] $row[1]";
	$query3 = "DELETE FROM Members WHERE ID = $delid";
	$result3 = mysql_query($query3) or die(mysql_error());
	unlink('member/images/' . $imagefile);
	?>
	<script>
	alert("Thanks - Member '<?php echo $fullname;?> Deleted!");
	top.opener.top.location.reload(true);
	window.close();
	</script>
	<?php
}
//DELETE SECTION ENDED

//APPROVE MEMBER
if(isset($_GET['approve']))
{
	$approveid = $_GET['approve'];
	$query2 = "SELECT * FROM Members WHERE ID = '$approveid'";
	$result2 = mysql_query($query2) or die(mysql_error());
	$row2 = mysql_fetch_array($result2);
	$fname = $row2['ForeName'];
	$sname = $row2['Surname'];
	$fullname = "$fname $sname";
	if('No' == $row2['Approved'])
	{	
		$query3 = "UPDATE Members SET Approved = 'Yes' WHERE ID = $approveid";
		mysql_query($query3) or die(mysql_error());
		$to = $row2['EmailAddress'];
		//$to = 'sumita.biswas@gmail.com, info@asiandinnerclub.com';
		$subject = 'Membership to Asian Dinner Club';
		$mess = "Dear $fname,<br>";
		$mess .= "<br/>Thank you for contacting Asian Dinner Club. Your request to join us as a member has been successful.<br/>";
		$mess .= "<br/>To book tickets please find below your member username and password:<br/>";
		$mess .= "<br/>Username: member<br/>Password: monaco<br/>";
		$mess .= "<br/>Our events get booked up quickly, booking early is advised.<br/>";
		$mess .= "<br/>You can also book on behalf of friends, please email us their names.<br/>";
		$mess .= "<br/>We hope to see you soon.<br/>";
		$message = "<html><head></head><body><p>" . $mess . "</p>";
		$message .= "<p>&nbsp;</p><p>Thanks,<br/><br/>From the Asian Dinner Club Team</p>";
		$message .= "<p><img src='http://www.asiandinnerclub.com/images/logo.gif' alt='Asian Dinner Club' border='0' /></p>";
		$message .= "<p>&nbsp;<p><p>&nbsp;</p><p><hr/></p><p style='font-size:9px; color:grey;'>Asian Connections Ltd | Registered Office: 145-157 St John Street, London, EC1V 4PW | ";
		$message .= "Reg. in England &amp; Wales | Co No: 8595159</p></body></html>";
		$headers = "MIME-Version: 1.0 \r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1 \r\n";
		$headers .= "From: Asian Dinner Club <info@asiandinnerclub.com> \r\n";

		if(mail($to, $subject, $message, $headers))
		{?>
			<script>
			alert("Thanks - Member '<?php echo $fullname;?> has been approved!");
			top.opener.top.location.reload(true);
			window.close();
			</script>
			<?php
		} else {?>
			<p><b>System Error</b></p><p>A system error has occurred. The email did not go through:<br />
			<?php echo 'mailto:' . $addresses;?></p><p>Please manually email this address to approve the member by clicking on the individual link. Thanks</p>
<?php	}
	} else {?>
		<script>
		alert("Error - Member '<?php echo $fullname;?> has already been approved!");
		top.opener.top.location.reload(true);
		window.close();
		</script>
		<?php
	}
}
//APPROVE MEMBER ENDED

//AMEND MEMBER
if(isset($_POST['Submit']))
{
	$errors = array();
	if($_POST['Date_Day']=="" || $_POST['Date_Month']=="" || $_POST['Date_Year']=="")
	{
		$_POST['DOB'] == "";
	}
	elseif(!checkdate($_POST['Date_Month'], $_POST['Date_Day'], $_POST['Date_Year']))
	{
		$errors[] = "The Date is not valid";
	}
	else
	{
		while(strlen($_POST['Date_Day'])==1)
		{
			$_POST['Date_Day'] = "0" . $_POST['Date_Day'];
		}
		while(strlen($_POST['Date_Month'])==1)
		{
			$_POST['Date_Month'] = "0" . $_POST['Date_Month'];
		}
		$_POST['DOB'] = $_POST['Date_Day'] . '/' . $_POST['Date_Month'] . '/' . $_POST['Date_Year'];
	}


	$_POST['DietaryReq'] = str_replace("\r\n", ', ', $_POST['DietaryReq']);

	$_POST['Interests'] = str_replace("\r\n", ', ', $_POST['Interests']);

	$sPattern = '/\s*/m';
	$sReplace = '';

	$_POST['Mobile'] = preg_replace( $sPattern, $sReplace, $_POST['Mobile'] );
	$_POST['Mobile'] = trim($_POST['Mobile']);
	if(!is_numeric($_POST['Mobile']))
	{
		$errors[] = "The mobile number must be numeric!";
	}

	$fields = array('Forename', 'Surname', 'Gender', 'Status', 'EmailAddress', 'DOB', 'Profession', 'Mobile', 'DietaryReq', 'Religion', 'Height', 'Drink', 'HeardFrom', 'Interests', 'Achieve',
					'Address_Line1', 'Address_Line2', 'Address_Town', 'Address_City', 'Address_County', 'Address_PostCode', 'Address_Country', 'Notes');

	foreach($fields as $field)
	{
		$formvar = $_POST[$field];
		if($formvar == '' && $field != 'Address_City' && $field != 'Notes')
		{
			$errors[] = "You forgot to enter the '$field'";
		}
	}

	if(empty($errors))
	{
		$id = $_POST['ID'];
		$first = $_POST['Forename'];
		$second = $_POST['Surname'];
		$name = "$first $second";
		$query5 = "UPDATE Members SET ";
		foreach($fields as $field)
		{
			$formvar = $_POST[$field];
			$formvar = addslashes($formvar);
			$query5 .= "$field = '$formvar', ";
		}
		$query5 = substr($query5, 0, -2) . " WHERE ID = '$id'";
		$result5 = mysql_query($query5) or die(mysql_error());
		?>
		<script>
		alert("Thanks - Member '<?php echo $name;?>' Details Amended!");
		top.opener.top.location.reload(true);
		window.close();
		</script>
		<?php
	}
}
//AMEND SECTION ENDED PART 1
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="../css/styles.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Asian Dinner Club - for Single Asian Professionals :: membership ::  Asian Dinner Club</title>
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
<!-- overriding the original style setting-->
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
<!-- AMEND SECTION PART 2 -->
<?php
if(isset($_POST['Submit']))
{
	if(!empty($errors))
	{ // Report the errors.
		foreach($fields as $field)
		{
			if(strpos($_POST[$field], "\'")!==false)
			{
				$_POST[$field] = str_replace("\'", "'", $_POST[$field]);
			}
			if(strpos($_POST[$field], '\"')!==false)
			{
				$_POST[$field] = str_replace('\"', '"', $_POST[$field]);
			}
		}
		echo '<p><b>Error!</b></p>
			<p>The following error(s) occurred:<br />';
			foreach ($errors as $msg) { // Print each error.
				echo " - $msg<br />\n";
			}
			echo '</p><p>Please try again.</p><p><br /></p>';
	} // End of if (empty($errors)) IF.
}
//AMEND MEMBER END PART 2

if(isset($_GET['edit']))
{
	$editid = $_GET['edit'];
	$query4 = "SELECT * FROM Members WHERE ID = '$editid'";
	$result4 = mysql_query($query4) or die(mysql_error());
	$row3 = mysql_fetch_array($result4);
	$DOB = $row3['DOB'];
	$arrdate = split("/", $DOB);
	$dateday = $arrdate[0];
	$datemonth = $arrdate[1];
	$dateyear = $arrdate[2];
	$fore = $row3['Forename'];
	$sur = $row3['Surname'];
	$names = "$fore $sur";
	
	if('No' == $row3['Approved'])
	{?>
		<table cellspacing='0' cellpadding='0' border='0'>
			<tr>
				<td><img src="../images/sumi_buttons_04.png" width="11" height="19" alt=""></td>
				<td class='singlebutton'><a title='Approved' onclick="if(confirm('Are you sure you want to approve this contact: <?php echo $names;?>?')){location.href='?approve=<?php echo $editid;?>';}else{window.location.reload(false);}">Approve Member</a></td>
				<td><img src="../images/sumi_buttons_06.png" width="11" height="19" alt=""></td>
			</tr>
		</table>
		<br/>
	<?php  
	}?>
	<table cellspacing='0' cellpadding='0' border='0'>
		<tr>
			<td><img src="../images/sumi_buttons_04.png" width="11" height="19" alt="" /></td>
			<td class='singlebutton'><a title='Delete' onclick="if(confirm('Are you sure you want to delete this contact: <?php echo $names;?>?')){location.href='?delete=<?php echo $editid;?>';}else{window.location.reload(false);}">Delete Member</a></td>
			<td><img src="../images/sumi_buttons_06.png" width="11" height="19" alt="" /></td>
		</tr>
	</table>
	<form method="post" id="profileform" name="ContactForm">
		<div id="regformwrap">
			<div class='rowwrap'>
			   <div class="cell-1">(<span class="style1">*</span>All Fields are compulsory)</div>
			</div>
		    <div class="rowwrap">
				<div class="cell-2"  style="display:none;"  id="div_nicname">
					<input type='hidden' name='ID' value='<?php echo $editid;?>' />
				</div>
	        </div>
			<div class="rowwrap">
			  	<div class="cell-1">First Name<span class="style1">*</span> <span class="redasterisk" id="usrForename_mark" style="display:none;"> *</span></div>
			  	<div class="cell-2">
			  	    <input class="text long" name="Forename" id="usrForename" value="<?php if(isset($_POST['Forename'])){echo $_POST['Forename'];}else{echo $row3['Forename'];}?>" type="text">
			  	</div>
	        </div>
	        <div class="rowwrap">
			  	<div class="cell-1">Surname <span class="style1">*</span><span class="redasterisk" id="usrSurname_mark" style="display:none;"> *</span></div>
			  	<div class="cell-2">
			  	    <input class="text long" name="Surname" id="usrSurname" value="<?php if(isset($_POST['Surname'])){echo $_POST['Surname'];}else{echo $row3['Surname'];}?>" type="text">
			  	</div>
	        </div>
	        <div class="rowwrap">
			  	<div class="cell-1">Gender<span class="style1">*</span> <span class="redasterisk" id="usrGender_mark" style="display:none;"> *</span></div>
			  	<div class="cell-2">
					<?php $genderarr = array('Female', 'Male');?>
			  	    <select class="drop short" name="Gender" id="usrGender">
			  	        <option value="">Select</option>
			  	        <?php 
						foreach($genderarr as $gen)
			  	        {
			  	            echo "<option value='$gen'"; if(isset($_POST['Gender'])){if($gen == $_POST['Gender']){echo "selected='selected'";}}else{if($gen == $row3['Gender']){ echo "selected='selected'"; }} echo ">$gen</option>";
			  	        }?>
			  	    </select>
			  	</div>
	        </div>
			<div class="rowwrap">
				<div class="cell-1">Status<span class="style1">*</span> <span class="redasterisk" id="usrStatus_mark" style="display:none;"> *</span></div>
				<div class="cell-2">
					<select class="drop short" name="Status" id="usrStatus">
						<option value="">Select</option>
						<option value="Single" <?php if(isset($_POST['Status'])){if($_POST['Status'] == 'Single'){echo "selected='selected'";}}else{if($row3['Status'] == 'Single'){echo "selected='selected'";}}?>>Single</option>
						<option value="Separated" <?php if(isset($_POST['Status'])){if($_POST['Status'] == 'Separated'){echo "selected='selected'";}}else{if($row3['Status'] == 'Separated'){echo "selected='selected'";}}?>>Separated</option>
						<option value="Divorced" <?php if(isset($_POST['Status'])){if($_POST['Status'] == 'Divorced'){echo "selected='selected'";}}else{if($row3['Status'] == 'Divorced'){echo "selected='selected'";}}?>>Divorced</option>
					</select>
				</div>
			</div>
	        <div class="rowwrap">
			  	<div class="cell-1">Email Address<span class="style1">*</span> <span class="redasterisk" id="usrEmailAddress_mark" style="display:none;"> *</span></div>
			  	<div class="cell-2">
			  	    <input class="text long" name="EmailAddress" id="usrEmailAddress" value="<?php if(isset($_POST['EmailAddress'])){echo $_POST['EmailAddress'];}else{echo $row3['EmailAddress'];}?>" type="text" >
			  	</div>
	        </div>
	        <div class="rowwrap">
			  	<div class="cell-1">Date of Birth<span class="style1">*</span> <span class="redasterisk" id="usrDOB_day_mark" style="display:none;"> *</span></div>
			  	<div class="cell-2">
			  	    <select name="Date_Day" id="usrDOB_day" class="drop date">
			  	        <option value=''>--</option>
						<?php 	for($days=1 ; $days<=31 ; $days++)
								{
									echo "<option value=\"$days\""; if(isset($_POST['Date_Day'])){if($_POST['Date_Day'] == $days){echo "selected='selected'";}}else{if ($dateday==$days){ echo "selected=\"selected\"";}} echo ">"; if(strlen($days)==1){echo "0";} echo "$days</option>";
								}
						?>
					</select>
					<select name="Date_Month" id="usrDOB_month" class="drop date">
						<option value=''>--</option>
						<?php 	$months = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
								for($month=1 ; $month<=12 ; $month++)
								{
									$word = $month-1;
									echo "<option value=\"$month\""; if(isset($_POST['Date_Month'])){if($_POST['Date_Month'] == $month){echo "selected='selected'";}}else{if ($datemonth==$month){ echo "selected=\"selected\"";}} echo ">$months[$word]</option>";
								}
						?>
			  	    </select>
			  	    <select name="Date_Year" id="usrDOB_year" class="drop date">
						<option value=''>--</option>
						<?php	for($year=1966 ; $year<=1990 ; $year++)
								{
									echo "<option value=\"$year\""; if(isset($_POST['Date_Year'])){if($_POST['Date_Year'] == $year){echo "selected='selected'";}}else{if ($dateyear==$year){ echo "selected=\"selected\"";}} echo ">$year</option>";
								}
						?>
			  	    </select>
			  	</div>
	        </div>
	        <div class="rowwrap">
			  	<div class="cell-1">Profession <span class="style1">*</span><span class="redasterisk" id="usrProfession_mark" style="display:none;"> *</span></div>
			  	<div class="cell-2">
					<?php $proarr = array('Not Specified', 'Academic', 'Accounting', 'Admin / Secretarial', 'Arts / Media', 'Company Director', 'Construction / Property Services', 'Consultant', 'Designer', 'Doctor / Medical', 'Financial Services / Insurance', 'Hospitality / Catering', 'Human Resources', 'IT / Computing', 'Legal', 'Leisure / Tourism', 'Military', 'Own Business', 'Political / Government', 'Sales and Marketing', 'Science / Technical', 'Teaching / Education', 'Writer / Journalist', 'Other');?>
			  	    <select class="drop long" name="Profession" id="usrProfession" value="profession">
						<?php foreach($proarr as $pro)
						{
							echo "<option value='$pro'"; if(isset($_POST['Profession'])){if($_POST['Profession'] == $pro){echo "selected='selected'";}}else{if($pro == $row3['Profession']){ echo "selected='selected'"; }} echo ">$pro</option>";
						}?>
			  	    </select>
			  	</div>
	        </div>
	        <div class="rowwrap">
			  	<div class="cell-1">Mobile Number<span class="style1">*</span><span class="redasterisk" id="usrPhone_mark" style="display:none;"> *</span></div>
			  	<div class="cell-2">
					<input type="text" size="20" class="text phone" name="Mobile" id="usrPhone" value="<?php if(isset($_POST['Mobile'])){echo $_POST['Mobile'];}else{ echo $row3['Mobile'];}?>">
			  	</div>
			</div>
			<div class="rowwrap">
			  	<div class="cell-1">Dietary Requirements<span class="style1">*</span><span class="redasterisk" id="usrDietary_mark" style="display:none;"></span><span class="redasterisk" id="usrPassword_mark" style="display:none;"> *</span></div>
			  	<div class="cell-2">
			  	    <textarea name="DietaryReq" cols="20" class="text long" id="usrDietary"><?php if(isset($_POST['DietaryReq'])){echo $_POST['DietaryReq'];}else{echo $row3['DietaryReq'];}?></textarea>
			  	</div>
			</div>
			<div class="rowwrap">
				<div class="cell-1">Religion <span class="style1">*</span><span class="redasterisk" id="usrReligion_mark" style="display:none;"> *</span></div>
				<div class="cell-2">
					<?php $relarr = array('Hindu', 'Sikh', 'Muslim', 'Christian', 'Spiritual - Not Religious', 'No Religion', 'Other');?>
					<select class="drop long" name="Religion" id="usrReligion">
						<option value="">Select</option>
						<?php foreach($relarr as $rel)
						{
							echo "<option value='$rel'"; if(isset($_POST['Religion'])){if($_POST['Religion'] == $rel){echo "selected='selected'";}}else{if($rel == $row3['Religion']){ echo "selected='selected'"; }} echo ">$rel</option>";
						}?>
					</select>
				</div>
			</div>
			<div class="rowwrap">
				<div class="cell-1">Height<span class="style1">*</span><span class="redasterisk" id="usrHeight_mark" style="display:none;"> *</span></div>
				<div class="cell-2">
					<?php $heigarr = array("4' 11in", "4' 12in", "5' 0in", "5' 1in", "5 '2in", "5' 3in", "5' 4in", "5' 5in", "5' 6in", "5' 7in", "5' 8in", "5' 9in", "5' 10in", "5' 11in", "6' 0in", "6' 1in", "6' 2in", "6' 3in", "6' 4in", "6' 5in", "6'6in", "6'7in");?>
					<select class="drop long" name="Height" id="usrHeight">
						<option value="">Select</option>
						<?php foreach($heigarr as $heig)
						{
							echo "<option value=\"$heig\""; if(isset($_POST['Height'])){if($_POST['Height'] == $heig){echo "selected='selected'";}}else{if($heig == $row3['Height']){ echo "selected='selected'"; }} echo ">$heig</option>";
						}?>
					</select>
				</div>
			</div>
			<div class="rowwrap">
				<div class="cell-1">Do You Drink? <span class="style1">*</span><span class="redasterisk" id="usrDrink_mark" style="display:none;"> *</span></div>
				<div class="cell-2">
					<select class="drop short" name="Drink" id="usrDrink">
						<option value="">Select</option>
						<?php $drarr = array('Yes', 'No');
						foreach($drarr as $dr)
						{
							echo "<option value='$dr'"; if(isset($_POST['Drink'])){if($_POST['Drink'] == $dr){echo "selected='selected'";}}else{if($dr == $row3['Drink']){ echo "selected='selected'"; }} echo ">$dr</option>";
						}?>
					</select>
				</div>
			</div>
			<div class="rowwrap">
				<div class="cell-1">How did you hear about us?  <span class="style1">*</span><span class="redasterisk" id="usrHear_mark" style="display:none;"> *</span></div>
				<div class="cell-2">
					<select class="drop long" name="HeardFrom" id="usrHear">
						<option value="">Select</option>
						<?php $heararr = array('Google', 'Friend', 'Asians in Media', 'Chillitickets', 'A Small World', 'Magazine', 'Newspaper', 'Decayenne', 'Asiana Magazine');
						foreach($heararr as $hear)
						{
							echo "<option value='$hear'"; if(isset($_POST['HeardFrom'])){if($_POST['HeardFrom'] == $hear){echo "selected='selected'";}}else{if($hear == $row3['HeardFrom']){ echo "selected='selected'"; }} echo ">$hear</option>";
						}?>
					</select>
				</div>
			</div>
			<div class="rowwrap">
				<div class="cell-1">Interests <span class="style1">*</span><span class="redasterisk" id="usrInterests_mark" style="display:none;"> *</span></div>
				<div class="cell-2">
					<textarea name="Interests" cols="20" class="text long" id="usrInterests"><?php if(isset($_POST['Interests'])){echo $_POST['Interests'];}else{ echo $row3['Interests'];}?></textarea>
				</div>
			</div>
			<div class='rowwrap'>
				<div class='cell-1'>&nbsp;</div>
				<div class='cell-2'></div>
			</div>
			<div class="rowwrap" style='padding-left:110px;'>
				Address  <span class="style1">*</span><span class="redasterisk" id="usrAddress_mark" style="display:none;"> *</span>
			</div>
			<div class="rowwrap">
				<div class="cell-1">Line 1</div>
				<div class="cell-2">
					<input type="text" size="20" class="text long" name="Address_Line1" value="<?php if(isset($_POST['Address_Line1'])){echo $_POST['Address_Line1'];}else {echo $row3['Address_Line1'];}?>" />
				</div>
			</div>
			<div class="rowwrap">
				<div class="cell-1">Line 2</div>
				<div class="cell-2">
					<input type="text" size="20" class="text long" name="Address_Line2" value="<?php if(isset($_POST['Address_Line2'])){echo $_POST['Address_Line2'];}else {echo $row3['Address_Line2'];}?>" />
				</div>
			</div>
			<div class="rowwrap">
				<div class="cell-1">Town</div>
				<div class="cell-2">
					<input type="text" size="20" class="text long" name="Address_Town" value="<?php if(isset($_POST['Address_Town'])){echo $_POST['Address_Town'];}else {echo $row3['Address_Town'];}?>" />
				</div>
			</div>
			<div class="rowwrap">
				<div class="cell-1">City (not mandatory)</div>
				<div class="cell-2">
					<input type="text" size="20" class="text long" name="Address_City" value="<?php if(isset($_POST['Address_City'])){echo $_POST['Address_City'];}else {echo $row3['Address_City'];}?>" />
				</div>
			</div>
			<div class="rowwrap">
				<div class="cell-1">County</div>
				<div class="cell-2">
					<input type="text" size="20" class="text long" name="Address_County" value="<?php if(isset($_POST['Address_County'])){echo $_POST['Address_County'];}else {echo $row3['Address_County'];}?>" />
				</div>
			</div>
			<div class="rowwrap">
				<div class="cell-1">Post Code</div>
				<div class="cell-2">
					<input type="text" size="20" class="text long" name="Address_PostCode" value="<?php if(isset($_POST['Address_PostCode'])){echo $_POST['Address_PostCode'];}else {echo $row3['Address_PostCode'];}?>" />
				</div>
			</div>
			<div class="rowwrap">
				<div class="cell-1">Country</div>
				<div class="cell-2">
					<input type="text" size="20" class="text long" name="Address_Country" value="<?php if(isset($_POST['Address_Country'])){echo $_POST['Address_Country'];}else {echo $row3['Address_Country'];}?>" />
				</div>
			</div>
			<div class='rowwrap'>
				<div class='cell-1'>&nbsp;</div>
				<div class='cell-2'></div>
			</div>
			<div class="rowwrap">
				<div class="cell-1">What do you hope to achieve from Asian Dinner Club? <span class="style1">*</span><span class="redasterisk" id="usrAchieve_mark" style="display:none;"> *</span></div>
				<div class="cell-2">
					<select class="drop long" name="Achieve" id="usrAchieve">
						<option value="">Select</option>
						<?php $acharr = array('Friendship', 'Socialising', 'Serious Relationship', 'Networking');
						foreach($acharr as $ach)
						{
							echo "<option value='$ach'"; if(isset($_POST['Achieve'])){if($_POST['Achieve'] == $ach){echo "selected='selected'";}}else{if($ach == $row3['Achieve']){ echo "selected='selected'"; }} echo ">$ach</option>";
						}?>
					</select>
				</div>
			</div>
			<div class="rowwrap">
				<div class="cell-1">Notes</div>
				<div class="cell-2">
					<textarea name="Notes" cols="20" class="text long" id="usrNotes"><?php if(isset($_POST['Notes'])){echo $_POST['Notes'];}else{ echo $row3['Notes'];}?></textarea>
				</div>
			</div>
			<div class="rowwrap">
				<div class="cell-1">&nbsp;</div>
				<div class="cell-2"></div>
			</div>
			<div class="rowwrap submitbutton">
				<div class="cell-1">&nbsp;</div>
				<div class="cell-2">
					<input type='hidden' name='Submit' />
					<table cellspacing='0' cellpadding='0' border='0'>
						<tr>
							<td><img src="../images/sumi_buttons_04.png" width="11" height="19" alt=""></td>
							<td class='singlebutton'><a title='Amend' onclick="javascript:document.ContactForm.submit();" href='#'>Amend Member</a></td>
							<td><img src="../images/sumi_buttons_06.png" width="11" height="19" alt=""></td>
						</tr>
					</table>
				</div>
			</div>
			<div class="rowwrap submitbutton">          </div>
		</div>
		<div align='right'><?php if($row3['Image_Path']!=''){?><img src="../member/images/<?php echo $row3['Image_Path'];?>" alt="<?php echo $names;?>" border='0' width='126' /><?php }else{ echo "NO PHOTO AVAILABLE";}?></div>
		<p></p>
	</form>
<?php
}?>
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
<div class="footer2col1"><a href="../terms.php">TERMS</a>&nbsp;|&nbsp;<a href="../sitemap.php">SITE MAP</a>&nbsp;|&nbsp;<a class='active' href="../admin/">ADMINISTRATOR</a></div></div>
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