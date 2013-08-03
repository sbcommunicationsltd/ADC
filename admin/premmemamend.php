<?php include '../database/databaseconnect.php';?>
<!-- DELETE SECTION! -->
<?php if(isset($_GET['delete']))
{
	$delid = $_GET['delete'];
	$query2 = "SELECT Forename, Surname FROM Premier_Membership WHERE ID = '$delid'";
	$result2 = mysql_query($query2) or die(mysql_error());
	$row = mysql_fetch_array($result2);
	$fullname = "$row[0] $row[1]";
	$query3 = "DELETE FROM Premier_Membership WHERE ID = $delid";
	$result3 = mysql_query($query3) or die(mysql_error());

	/*$qu = "SELECT * FROM tbl_auth_user WHERE ID = '$delid'";
	$re = mysql_query($qu) or die(mysql_error());
	if(mysql_num_rows($re) == 1)
	{
		$qu2 = "DELETE FROM tbl_auth_user WHERE ID = $delid";
		$re2 = mysql_query($qu2) or die(mysql_error());
	}*/
	?>
	<script>
	alert("Thanks - Member '<?php echo $fullname;?> Deleted!");
	top.opener.top.location.reload(true);
	window.close();
	</script>
	<?php
}?>
<!-- DELETE SECTION ENDED-->

<!-- AMEND MEMBER -->
<?php
if(isset($_POST['Submit']))
{
	$id = $_POST['ID'];
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
		$_POST['DOB'] = $_POST['Date_Year'] . '-' . $_POST['Date_Month'] . '-' . $_POST['Date_Day'];
	}

	/*$_POST['Interests'] = str_replace("\r\n", ', ', $_POST['Interests']);
	$_POST['Comments'] = str_replace("\r\n", ', ', $_POST['Comments']);*/

	$sPattern = '/\s*/m';
	$sReplace = '';

	$_POST['Mobile'] = preg_replace( $sPattern, $sReplace, $_POST['Mobile'] );
	$_POST['Mobile'] = trim($_POST['Mobile']);
	if(!is_numeric($_POST['Mobile']))
	{
		$errors[] = "The mobile number must be numeric!";
	}

	$target_path = "../member/premier/images/";

	$filename = basename($_FILES['uploadedfile']['name']);

	if($filename != '')
	{
		$oldimage = $_POST['image'];
		if($oldimage!=''){
			unlink($target_path . $oldimage);
		}
		
		function getExtension($str)
		{
			$i = strrpos($str,".");
			if (!$i) { return ""; }
			$l = strlen($str) - $i;
			$ext = substr($str,$i+1,$l);
			return $ext;
		}

		$extension = getExtension($filename);
		$extension = strtolower($extension);

		$imagefile = $id . '.' . $extension;
		$target_path = $target_path . $imagefile;

		if($_POST['MAX_FILE_SIZE'] < $_FILES['uploadedfile']['size'])
		{
			$errors[] = "The file size is too big for the server. Please reduce the size!";
		}

		if($extension!='jpg' && $extension!='jpeg' && $extension!='gif')
		{
			$errors[] = "Your uploaded file must be of JPG or GIF. Other file types are not allowed";
		}

		if(!move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path))
		{
			$errors[] = "There was an error uploading the file!";
		}

		$_POST['Image_Path'] = $imagefile;
	}

	/*if($_POST['Partner_Age_Max'] < $_POST['Partner_Age_Min'])
	{
		$errors[] = 'The Maximum Age is younger than the Minumum Age!';
	}
	elseif($_POST['Partner_Age_Min']=="" || $_POST['Partner_Age_Max']=="")
	{
		$_POST['Partner_Age_Range'] == "";
	}
	else
	{
		$_POST['Partner_Age_Range'] = $_POST['Partner_Age_Min'] . ' - ' . $_POST['Partner_Age_Max'];
	}

	if($_POST['Partner_Height_Max'] < $_POST['Partner_Height_Min'])
	{
		$errors[] = 'The Maximum Height is shorter than the Minumum Height!';
	}
	elseif($_POST['Partner_Height_Min']=="" || $_POST['Partner_Height_Max']=="")
	{
		$_POST['Partner_Height_Range'] == "";
	}
	else
	{
		$_POST['Partner_Height_Range'] = $_POST['Partner_Height_Min'] . ' - ' . $_POST['Partner_Height_Max'];
	}*/

	$fields = array('Forename', 'Surname', 'Gender', 'EmailAddress', 'DOB', 'Profession', 'Mobile', 'Religion'/*, 'Height', 'Interests'*/);

	foreach($fields as $field)
	{
		$formvar = $_POST[$field];
		if($formvar == '')
		{
			$errors[] = "You forgot to enter the '$field'";
		}
	}

	if(empty($errors))
	{
		$first = $_POST['Forename'];
		$second = $_POST['Surname'];
		$name = "$first $second";
		$query5 = "UPDATE Premier_Membership SET ";
		foreach($fields as $field)
		{
			$formvar = $_POST[$field];
			$formvar = addslashes($formvar);
			$query5 .= "$field = '$formvar', ";
		}
		$other = array('Image_Path');
		foreach($other as $oth)
		{
			$formv = $_POST[$oth];
			$formv = addslashes($formv);
			if($formv!='')
			{
				$query5 .= "$oth = '$formv', ";
			}
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
}?>
<!-- AMEND SECTION ENDED PART 1 -->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="../css/styles.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Asian Dinner Club - for Single Asian Professionals :: premier membership ::  Asian Dinner Club</title>
<meta name="description" content=" Asian Dinner Club, for Single Asian Professionals" />
<meta name="keywords" content="Indian, dating, party, London, Matchmaking, Asian matchmaking, Shaadi, restaurants, events, Asian Dinner Club, Asia dinner club, Indian dinner club, Supper club, Asian events, Asian dating, Asian speedating, Asian speeddating, Chillitickets, Asiana, Dating events london, Singles events asian, Singles events london, Single solution, Hindu events, Sikh events, muslim dating, Hindu dating, Sikh dating, Dinner clubs, Top table, Dinner parties, Dinner dates, Quaglinos, Asia de cuba" />
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

		foreach($other as $oth)
		{
			if(strpos($_POST[$oth], "\'")!==false)
			{
				$_POST[$oth] = str_replace("\'", "'", $_POST[$oth]);
			}
			if(strpos($_POST[$oth], '\"')!==false)
			{
				$_POST[$oth] = str_replace('\"', '"', $_POST[$oth]);
			}
		}

		echo '<p><b>Error!</b></p>
			<p>The following error(s) occurred:<br />';
			foreach ($errors as $msg) { // Print each error.
				echo " - $msg<br />\n";
			}
			echo '</p><p>Please try again.</p><p><br /></p>';
	} // End of if (empty($errors)) IF.
}?>
<!-- AMEND MEMBER END PART 2 -->

<?php
if(isset($_GET['edit']))
{
	$editid = $_GET['edit'];
	$query4 = "SELECT * FROM Premier_Membership WHERE ID = '$editid'";
	$result4 = mysql_query($query4) or die(mysql_error());
	$row3 = mysql_fetch_array($result4);
	$DOB = $row3['DOB'];
	$arrdate = split("-", $DOB);
	$dateday = $arrdate[2];
	$datemonth = $arrdate[1];
	$dateyear = $arrdate[0];
	$arrage = split(" - ", $age);
	$agemin = $arrage[0];
	$agemax = $arrage[1];
	$arrheight = split(" - ", $height);
	$fore = $row3['Forename'];
	$sur = $row3['Surname'];
	$names = "$fore $sur";?>
	<!--<p><input type='button' name='delete' value='Delete Member' onclick="if(confirm('Are you sure you want to delete this contact: <?php echo $names;?>?')){location.href='?delete=<?php echo $editid;?>';}else{window.location.reload(false);}" /></p>-->
	<table cellspacing='0' cellpadding='0' border='0'>
		<tr>
			<td><img src="../images/sumi_buttons_04.png" width="11" height="19" alt="" /></td>
			<td class='singlebutton'><a title='Delete' href="#" onclick="if(confirm('Are you sure you want to delete this contact: <?php echo $names;?>?')){location.href='?delete=<?php echo $editid;?>';}else{window.location.reload(false);}">Delete Member</a></td>
			<td><img src="../images/sumi_buttons_06.png" width="11" height="19" alt="" /></td>
		</tr>
	</table>
	<p>(<span class="style1">*</span>All Fields marked with an asterisk are compulsory)</p>
	<form method="post" id="profileform" name="ContactForm" enctype="multipart/form-data">
	<input type='hidden' name='ID' value='<?php echo $editid;?>' />
	<table width='100%' cellspacing='2' cellpadding='2' border='0' class='fontstyle'>
    	<tr>
       		<th style='font-size:16px;' align='left' colspan='2'><i>About Member</i><th>
	      </tr>
       	<tr>
       		<td colspan='2'>&nbsp;</td>
       	</tr>
        <tr>
        	<td class='headings'>First Name: <span class="style1">*</span></td>
            <td><input name="Forename" id="usrForename" value="<?php if(isset($_POST['Forename'])){echo $_POST['Forename'];}else{echo $row3['Forename'];}?>" type="text" /></td>
        </tr>
        <tr>
        	<td class='headings'>Surname: <span class="style1">*</span></td>
            <td><input name="Surname" id="usrSurname" value="<?php if(isset($_POST['Surname'])){echo $_POST['Surname'];}else{echo $row3['Surname'];}?>" type="text" /></td>
        </tr>
        <tr>
          	<td class='headings'>Gender: <span class="style1">*</span></td>
			<td><?php $genderarr = array('Female', 'Male');?>
			  <select name="Gender" id="usrGender">
				<option value="">Select</option>
				<?php foreach($genderarr as $gen)
				{
					echo "<option value='$gen'"; if(isset($_POST['Gender'])){if($gen == $_POST['Gender']){echo "selected='selected'";}}else{if($gen == $row3['Gender']){ echo "selected='selected'"; }} echo ">$gen</option>";
				}?>
			  </select>
			</td>
		<tr>
			<td class='headings'>Email Address: <span class="style1">*</span></td>
            <td><input size='30' name="EmailAddress" id="usrEmailAddress" value="<?php if(isset($_POST['EmailAddress'])){echo $_POST['EmailAddress'];}else{echo $row3['EmailAddress'];}?>" type="text" /></td>
        </tr>
        <tr>
        	<td class='headings'>Date of Birth: <span class="style1">*</span></td>
         	<td><select name="Date_Day" id="usrDOB_day" class="drop date">
				<option value=''>--</option>
				<?php 	for($days=1 ; $days<=31 ; $days++)
						{
							echo "<option value=\"$days\""; if(isset($_POST['Date_Day'])){if($_POST['Date_Day'] == $days){echo "selected='selected'";}}else{if ($dateday==$days){ echo "selected=\"selected\"";}} echo ">"; if(strlen($days)==1){echo "0";} echo "$days</option>";
						}
				?>
			  </select>
			  <select name="Date_Month" id="usrDOB_month">
				<option value=''>--</option>
				<?php 	$months = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
						for($month=1 ; $month<=12 ; $month++)
						{
							$word = $month-1;
							echo "<option value=\"$month\""; if(isset($_POST['Date_Month'])){if($_POST['Date_Month'] == $month){echo "selected='selected'";}}else{if ($datemonth==$month){ echo "selected=\"selected\"";}} echo ">$months[$word]</option>";
						}
				?>
			  </select>
			  <select name="Date_Year" id="usrDOB_year">
				<option value=''>--</option>
				<?php	for($year=1966 ; $year<=1990 ; $year++)
						{
							echo "<option value=\"$year\""; if(isset($_POST['Date_Year'])){if($_POST['Date_Year'] == $year){echo "selected='selected'";}}else{if ($dateyear==$year){ echo "selected=\"selected\"";}} echo ">$year</option>";
						}
				?>
			  </select>
			</td>
        </tr>
        <tr>
        	<td class='headings'>Profession: <span class="style1">*</span></td>
            <td><?php $proarr = array('Not Specified', 'Academic', 'Accounting', 'Admin / Secretarial', 'Arts / Media', 'Company Director', 'Construction / Property Services', 'Consultant', 'Designer', 'Doctor / Medical', 'Financial Services / Insurance', 'Hospitality / Catering', 'Human Resources', 'IT / Computing', 'Legal', 'Leisure / Tourism', 'Military', 'Own Business', 'Political / Government', 'Sales and Marketing', 'Science / Technical', 'Teaching / Education', 'Writer / Journalist', 'Other');?>
			  	              <select name="Profession" id="usrProfession" value="profession">
			  	                <?php foreach($proarr as $pro)
			  	                {
			  	                	echo "<option value='$pro'"; if(isset($_POST['Profession'])){if($_POST['Profession'] == $pro){echo "selected='selected'";}}else{if($pro == $row3['Profession']){ echo "selected='selected'"; }} echo ">$pro</option>";
			  	                }?>
			  	              </select>
			</td>
       	</tr>
        <tr>
        	<td class='headings'>Mobile Number: <span class="style1">*</span></td>
            <td><input type="text" name="Mobile" id="usrPhone" value="<?php if(isset($_POST['Mobile'])){echo $_POST['Mobile'];}else{ echo $row3['Mobile'];}?>" /></td>
        </tr>
        <tr>
			<td class='headings'>Religion: <span class="style1">*</span></td>
            <td><?php $relarr = array('Hindu', 'Sikh', 'Muslim', 'Christian', 'Spiritual - Not Religious', 'No Religion', 'Other');?>
			  	              <select name="Religion" id="usrReligion">
			  	                <option value="">Select</option>
			  	                <?php foreach($relarr as $rel)
			  	                {
			  	                	echo "<option value='$rel'"; if(isset($_POST['Religion'])){if($_POST['Religion'] == $rel){echo "selected='selected'";}}else{if($rel == $row3['Religion']){ echo "selected='selected'"; }} echo ">$rel</option>";
			  	                }?>
			  	              </select>
			</td>
       	</tr>
       	<!--<tr>
		  	<td class='headings'>Height: <span class="style1">*</span></td>
            <td><?php $heigarr = array("4' 11in", "4' 12in", "5' 0in", "5' 1in", "5 '2in", "5' 3in", "5' 4in", "5' 5in", "5' 6in", "5' 7in", "5' 8in", "5' 9in", "5' 10in", "5' 11in", "6' 0in", "6' 1in", "6' 2in", "6' 3in", "6' 4in", "6' 5in", "6'6in", "6'7in");?>
			  	              <select name="Height" id="usrHeight">
			  	                <option value="">Select</option>
			  	                <?php foreach($heigarr as $heig)
			  	                {
			  	                	echo "<option value=\"$heig\""; if(isset($_POST['Height'])){if($_POST['Height'] == $heig){echo "selected='selected'";}}else{if($heig == $row3['Height']){ echo "selected='selected'"; }} echo ">$heig</option>";
			  	                }?>
			  	              </select>
			</td>
     	</tr>
     	<tr>
        	<td class='headings'>Interests: <span class="style1">*</span></td>
            <td><textarea name="Interests" cols="35" rows='4' id="usrInterests"><?php if(isset($_POST['Interests'])){echo $_POST['Interests'];}else{ echo $row3['Interests'];}?></textarea></td>
        </tr>-->
		<input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
		<tr>
			<td class='headings'>Photo: </td>
			<td><img src="../member/premier/images/<?php echo $row3['Image_Path'];?>" height='150' alt="<?php echo $row3['Forename'];?>" />
				<input type='hidden' name='image' value="<?php echo $row3['Image_Path'];?>" /></td>
       	</tr>
       	<tr>
		  	<td class='headings'>To change the above photo<br/>- please click Browse</td>
            <td><input name="uploadedfile" type="file" /></td>
       	</tr>
		<tr>
			<td colspan='2' height='20'>&nbsp;</td>
       	</tr>
		<tr>
			<td colspan='2'>
			<!--<input type="submit" name="Submit" value="Amend" style='font-size:16px;'>-->
			<input type='hidden' name='Submit' />
				<table cellspacing='0' cellpadding='0' border='0'>
					<tr>
						<td><img src="../images/sumi_buttons_04.png" width="11" height="19" alt=""></td>
						<td class='singlebutton'><a title='Amend' onclick="javascript:document.ContactForm.submit();" href='#'>Amend Premier Member</a></td>
						<td><img src="../images/sumi_buttons_06.png" width="11" height="19" alt=""></td>
					</tr>
  				</table>
  			</td>
       	</tr>
	</table>
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