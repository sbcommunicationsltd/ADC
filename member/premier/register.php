<?php
session_start(); 
include '../../database/databaseconnect.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="../../css/styles.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Asian Dinner Club - for Single Asian Professionals :: premier membership - register ::  Asian Dinner Club</title>
<meta name="description" content=" Asian Dinner Club, for Single Asian Professionals" />
<meta name="keywords" content="Indian, dating, party, London, Matchmaking, Asian matchmaking, Shaadi, restaurants, events, Asian Dinner Club, Asia dinner club, Indian dinner club, Supper club, Asian events, Asian dating, Asian speedating, Asian speeddating, Chillitickets, Asiana, Dating events london, Singles events asian, Singles events london, Single solution, Hindu events, Sikh events, muslim dating, Hindu dating, Sikh dating, Dinner clubs, Top table, Dinner parties, Dinner dates, Quaglinos, Asia de cuba" />
</head>
<body>
<div id="wrapper">
<div id="header">
<div id="logo"><a href="../premier/" target="_self"><img src="../../images/logo.gif" alt="Asian Dinner Club" /></a></div>
<div id="navigation">
<ul>
<li><a href="http://www.asiandinnerclub.com/" target="_self">HOME</a></li>
<li class="topnav" ><a href="../../aboutus.php" target="_self">ABOUT<br/>US</a></li>
<li><a href="../../events.php" target="_self">CURRENT<br/>EVENTS</a></li>
<li><a href="../../past_events.php" target="_self">PAST<br/>EVENTS</a></li>
<li><a href="../../membership.php" target="_self">MEMBERSHIP</a></li>
<li><a class="active" href="../../premiermembership.php" target="_self">PREMIER<br/>MEMBERSHIP</a></li>
<!--<li><a href="../../matchmaking.php" target="_self">MATCH&nbsp;<sup style='color:white; font-size:8px; border:1px solid white; padding:1px;'>NEW</sup><br/><span style='padding-right:25px;'>MAKING</span></a></li>-->
<li><a href="../../press.php" target="_self">PRESS</a></li>
<!--<li><a href="../../eternitymembership.php" target="_self">ETERNITY&nbsp;<sup style='color:white; font-size:8px; border:1px solid white; padding:1px;'>NEW</sup><br/><span style='padding-right:25px;'>MEMBERSHIP</span></a></li>-->
<li><a href="../../team.php" target="_self">THE<br/>TEAM</a></li>
<li><a href="../../contact.php" target="_self">CONTACT</a></li>
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




		<h1><img src="../../images/membership_side2.gif" alt="Premier Membership" width="300" height="50"/></h1>

		<?php
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
				$_POST['DOB'] = $_POST['Date_Year'] . '-' . $_POST['Date_Month'] . '-' . $_POST['Date_Day'];
			}

			if($_POST['EmailAddress'] != $_POST['ConEmailAddress'])
			{
				$errors[] = "The email addresses you confirmed with are not the same.";
			}
			else
			{
				$email = $_POST['EmailAddress'];
				$qu = "SELECT * FROM Premier_Membership WHERE EmailAddress = '$email'";
				$re = mysql_query($qu) or die(mysql_error());
				if(mysql_num_rows($re) == 1)
				{
					$errors[] = "The email address provided has already been used to register for Premier Membership. Your password is your date of birth in the following format YYMMDD.";
				}
			}

			//$_POST['Interests'] = str_replace("\r\n", ', ', $_POST['Interests']);

			$sPattern = '/\s*/m';
			$sReplace = '';

			$_POST['Mobile'] = preg_replace( $sPattern, $sReplace, $_POST['Mobile'] );
			$_POST['Mobile'] = trim($_POST['Mobile']);
			if(!is_numeric($_POST['Mobile']))
			{
				$errors[] = "The mobile number must be numeric!";
			}

			//$target_path = "/mnt/vol1/home/a/s/asiand/public_html/member/premier/images/";
			$target_path = 'images/';

			$filename = basename($_FILES['uploadedfile']['name']);

			if($filename != '')
			{
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

				$query = "SELECT MAX(ID) FROM Premier_Membership";
				$result = mysql_query($query) or die(mysql_error());
				if(mysql_num_rows($result) == 0)
				{
					$idmax = 1;
				}
				else
				{
					$row = mysql_fetch_array($result);
					$idmax = $row[0] + 1;
				}

				$imagefile = $idmax . '.' . $extension;
				$target_path = $target_path . $imagefile;
				//echo $target_path;
				//echo 'SIZE' . $_FILES['uploadedfile']['size'];


				/*if($_POST['MAX_FILE_SIZE'] < $_FILES['uploadedfile']['size'])
				{
					$errors[] = "The file size is too big for the server. Please reduce the size!";
				}*/

				if(!($extension == "jpg" || $extension == "gif" || $extension == "jpeg"))
				{
					$errors[] = "Your uploaded file must be JPG or GIF. Other file types are not allowed";
				}

				/*if(!move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path))
				{
					$errors[] = "There was an error uploading the file.";
				}*/
				
				if (!move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path))
				{
					switch ($_FILES['uploadedfile']['error'])
					{  
						case 1:
						$errors[] = 'The file is bigger than this PHP installation allows';
						break;
						case 2:
						$errors[] = 'The file is bigger than this form allows';
						break;
						case 3:
						$errors[] = 'Only part of the file was uploaded';
						break;
						case 4:
						$errors[] = 'No file was uploaded';
						break;
					}
				}
				
				$_POST['Image_Path'] = $imagefile;
			}
			
			/*if(md5($_POST['Captcha_Code']) != $_SESSION['key']) 
			{ 
				$errors[] = "You must enter the code correctly"; 
			}*/


			//$fields = array('Forename', 'Surname', 'Gender', 'Status', 'EmailAddress', 'ConEmailAddress', 'DOB', 'Profession', 'Mobile', 'Religion', 'Height', 'Interests', 'Image_Path', 'Partner_Religion', 'Partner_Age_Range', 'Partner_Height_Range', 'Captcha_Code');
			$fields = array('Forename', 'Surname', 'Gender', 'Status', 'EmailAddress', 'ConEmailAddress', 'DOB', 'Profession', 'Mobile', 'Religion', /*'Height', 'Interests', 'DietaryReq', 'Drink', 'Cities', */'Image_Path');

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
				$date = date('Y-m-d H:i');
				$query2 = "INSERT INTO Premier_Membership (ID, ";
				foreach($fields as $field) {
					if($field!='ConEmailAddress') {
						$query2 .= "$field, ";
					}
				}
				$query2 .= "DateJoined, Approved) VALUES('$idmax', ";
				//$to = 'info@asiandinnerclub.com, lovesalima@googlemail.com';
				$to = 'lovesalima@googlemail.com';
				//$to = 'sumita.biswas@gmail.com';
				$subject = 'Premier Membership Form Submission for Asian Dinner Club';
				$body = '';
				foreach($fields as $field)
				{
					$formvar = $_POST[$field];

					//if($field!='ConEmailAddress' && $field!='Captcha_Code')
					if($field!='ConEmailAddress')
					{
						$formvar = addslashes($formvar);
						$query2 .= "'$formvar', ";
					}

					$formvar2 = $formvar;
					if(strpos($formvar2, "\'")!==false)
					{
						$formvar2 = str_replace("\'", "'", $formvar2);
					}
					if(strpos($formvar2, '\"')!==false)
					{
						$formvar2 = str_replace('\"', '"', $formvar2);
					}
					//if($field!='ConEmailAddress' && $field!='Captcha_Code')
					if($field!='ConEmailAddress')
					{
						$body .= "\n$field: $formvar2 \n";
					}
				}
				$query2 .= "'$date', 'No')";
				//echo $query2;
				$headers = "From: Asian Dinner Club <sales@asiandinnerclub.com> \r\n";
				if(mail($to, $subject, $body, $headers))
				{
					echo "<p><b>Thank You</b></p><p>Please proceed to PayPal by clicking the button below.</p>";?>
					<!--<p><form method='post' action='paypal.php'><input type='submit' name='paypal' value='Proceed to PayPal' style='cursor:pointer;' /></form></p>-->
					<!--<table cellspacing='0' cellpadding='0' border='0'>
						<tr>
							<td><img src="images/sumi_buttons_04.png" width="11" height="19" alt=""></td>
							<td class='singlebutton'><a title='PayPal' href='paypal.php'>Proceed to PayPal</a></td>
							<td><img src="images/sumi_buttons_06.png" width="11" height="19" alt=""></td>
						</tr>
					</table>-->
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
					<input type="hidden" name="business" value="sales@asiandinnerclub.com">
					<input type='hidden' name='cmd' value='_xclick'>
					<input type='hidden' name='amount' value="150.00">
					<!--<input type='hidden' name='amount' value="0.01">-->
					<input type='hidden' name='currency_code' value="GBP">
					<input type='hidden' name='item_name' value="Premier Membership">
					<input type="hidden" name="return" value="http://www.asiandinnerclub.com/?success=premier">
					<input type="hidden" name="cancel_return" value="http://www.asiandinnerclub.com/?cancel=premier">
					<input type="image" src="http://www.asiandinnerclub.com/images/paypalbutton2.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
					</form>
				<?php	$result2 = mysql_query($query2) or die(mysql_error());
				}
				else
				{
					echo '<p><b>System Error</b></p><p>A system error has occurred. We apologise for the inconvenience. Please try again soon.</p>';
				}
			}
			else
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

				echo '<p><b>Error</b></p>
					<p>The following error(s) occurred:<br />';
					foreach ($errors as $msg) { // Print each error.
						echo " - $msg<br />\n";
					}
					echo '</p><p>Please try again.</p><p><br /></p>';
			} // End of if (empty($errors)) IF.
		}
		?>
<?php
if(!isset($_POST['Submit']))
{?>
	<p>(<span class="style1">*</span>All Fields are compulsory)</p>
	<form method="post" id="profileform" name="ContactForm" enctype="multipart/form-data">
 	<table width='100%' cellspacing='2' cellpadding='2' border='0' class='fontstyle'>
        <tr>
        	<td class='headings'>Forename: <span class="style1">*</span></td>
            <td><input name="Forename" id="usrForename" type="text" value="<?php echo $_POST['Forename'];?>" /></td>
        </tr>
        <tr>
        	<td>Surname: <span class="style1">*</span></th>
            <td><input name="Surname" id="usrSurname" type="text" value="<?php echo $_POST['Surname'];?>" /></td>
        </tr>
        <tr>
          	<td class='headings'>Gender: <span class="style1">*</span></td>
			<td><?php $genderarr = array('Female', 'Male');?>
			  	<select name="Gender" id="usrGender">
				<option value="">Select</option>
				<?php foreach($genderarr as $gen)
				{
					echo "<option value='$gen'"; if($gen == $_POST['Gender']){ echo "selected='selected'"; } echo ">$gen</option>";
				}?>
			  </select>
			</td>
		</tr>
		<tr>
			<td class='headings'>Status: <span class="style1">*</span></td>
			<td><?php $statusarr = array('Single', 'Separated', 'Divorced');?>
				<select name="Status" id="usrStatus">
				<option value="">Select</option>
				<?php foreach($statusarr as $stat)
				{
					echo "<option value='$stat'"; if($stat == $_POST['Status']){ echo "selected='selected'"; } echo ">$stat</option>";
				}?>
			  </select>
			</td>
		</tr>
		<tr>
			<td class='headings'>Email Address: <span class="style1">*</span></td>
            <td><input name="EmailAddress" id="usrEmailAddress" type="text" size='30' value="<?php echo $_POST['EmailAddress'];?>" /></td>
        </tr>
        <tr>
        	<td class='headings'>Confirm Email: <span class="style1">*</span></td>
			<td><input name="ConEmailAddress" id="usrConEmailAddress" type="text" size='30' value="<?php echo $_POST['ConEmailAddress'];?>" /></td>
        </tr>
        <tr>
        	<td class='headings'>Date of Birth: <span class="style1">*</span></td>
         	<td><select name="Date_Day" id="usrDOB_day">
                <option value=''>--</option>
                <?php 	for($days=1 ; $days<=31 ; $days++)
						{
							echo "<option value=\"$days\""; if ($_POST['Date_Day'] == $days){ echo "selected=\"selected\"";} echo ">"; if(strlen($days)==1){echo "0";} echo "$days</option>";
						}
				?>
              	</select>
              	<select name="Date_Month" id="usrDOB_month">
                <option value=''>--</option>
                <?php 	$months = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
                		for($month=1 ; $month<=12 ; $month++)
						{
							$word = $month-1;
							echo "<option value=\"$month\""; if ($_POST['Date_Month']==$month){ echo "selected=\"selected\"";} echo ">$months[$word]</option>";
						}
				?>
              	</select>
              	<select name="Date_Year" id="usrDOB_year">
              	<option value=''>--</option>
              	<?php	for($year=1968 ; $year<=1990 ; $year++)
						{
							echo "<option value=\"$year\""; if ($_POST['Date_Year']==$year){ echo "selected=\"selected\"";} echo ">$year</option>";
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
			  		echo "<option value='$pro'"; if($pro == $_POST['Profession']){ echo "selected='selected'"; } echo ">$pro</option>";
			  	}?>
			  	</select>
            </td>
       	</tr>
        <tr>
        	<td class='headings'>Mobile Number: <span class="style1">*</span></td>
            <td><input type="text" name="Mobile" id="usrPhone" value="<?php echo $_POST['Mobile'];?>" /></td>
        </tr>
        <tr>
			<td class='headings'>Religion: <span class="style1">*</span></td>
            <td><?php $relarr = array('Hindu', 'Sikh', 'Muslim', 'Christian', 'Spiritual - Not Religious', 'No Religion', 'Other');?>
			  	<select name="Religion" id="usrReligion">
			  	<option value="">Select</option>
			  	<?php foreach($relarr as $rel)
			  	      {
			  	         echo "<option value='$rel'"; if($rel == $_POST['Religion']){ echo "selected='selected'"; } echo ">$rel</option>";
			  	      }?>
			  	</select>
            </td>
       	</tr>
       	<!--<tr>
		  	<td class='headings'>Height: <span class="style1">*</span></td>
            <td>
            <?php $heigarr = array("4' 11in", "4' 12in", "5' 00in", "5' 01in", "5' 02in", "5' 03in", "5' 04in", "5' 05in", "5' 06in", "5' 07in", "5' 08in", "5' 09in", "5' 10in", "5' 11in", "6' 00in", "6' 01in", "6' 02in", "6' 03in", "6' 04in", "6' 05in", "6' 06in", "6' 07in");?>
              <select name="Height" id="usrHeight">
                <option value="">Select</option>
                <?php foreach($heigarr as $heig)
				{
					echo "<option value=\"$heig\""; if($heig == $_POST['Height']){ echo "selected='selected'"; } echo ">$heig</option>";
				}?>
              </select>
            </td>
     	</tr>
		<tr>
        	<td class='headings'>Dietary Requirements: <span class="style1">*</span></td>
            <td><textarea name="DietaryReq" cols="35" id="usrDietary"><?php echo $_POST['DietaryReq'];?></textarea></td>
        </tr>
		<tr>
		  	<td class='headings'>Do you drink?: <span class="style1">*</span></td>
            <td>
              <select name="Drink" id="usrDrink">
                <option value="">Select</option>
				<option value='Yes' <?php if($_POST['Drink'] == 'Yes'){echo "selected='selected'";}?>>Yes</option>
				<option value="No" <?php if($_POST['Drink'] == 'No'){echo "selected='selected'";}?>>No</option>
              </select>
            </td>
     	</tr>
     	<tr>
        	<td class='headings'>Interests: <span class="style1">*</span></td>
            <td><textarea name="Interests" cols="35" id="usrInterests"><?php echo $_POST['Interests'];?></textarea></td>
        </tr>-->
		<!--<tr>
		  	<td class='headings'>Which Cities are you interested in?: <span class="style1">*</span></td>
            <td>
            <?php $cityarr = array("Paris", "New York", "Dubai", "All");?>
              <select name="Cities" id="usrCity">
                <option value="">Select</option>
                <?php foreach($cityarr as $city)
				{
					echo "<option value=\"$city\""; if($city == $_POST['Cities']){ echo "selected='selected'"; } echo ">$city</option>";
				}?>
              </select>
            </td>
     	</tr>-->
        <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
		<tr>
			<td class='headings'>Upload Photo: <span class="style1">*</span></td>
			<td><input name="uploadedfile" type="file" /></td>
       	</tr>
		<!--<tr>
			<td colspan='2' height='10'>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><img src="../../scripts/captcha.php" border='0' alt='captcha code' /></td>
		</tr>
		<tr>
			<td class='headings'>Write what you see above <span class="style1">*</span></td>
			<td><input type="text" size="20" name="Captcha_Code" id="Captcha_Code" /></td>
		</tr>-->
        <tr>
			<td colspan='2'>&nbsp;</td>
        </tr>
        <tr>
        	<td colspan='2'>
        	<input type='hidden' name='Submit' />
        	<!--<input type="submit" name="Submit" value="Submit" style='cursor:pointer; font-size:16px;' />-->
        	<table cellspacing='0' cellpadding='0' border='0'>
				<tr>
					<td><img src="images/sumi_buttons_04.png" width="11" height="19" alt=""></td>
					<td class='singlebutton'><a title='Submit' onclick="javascript:document.ContactForm.submit();" href='#'>Submit</a></td>
					<td><img src="images/sumi_buttons_06.png" width="11" height="19" alt=""></td>
				</tr>
			</table>
        	</td>
        </tr>
	</table>
	</form>

<?php }?>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p><br/></p>

</div>



<div id="contentcol2">
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <span class="lefthandpic"><img src="../../images/side.jpg" alt="Asian Dinner Club" width="194" height="194" /></span>
    <p>&nbsp;</p>
</div>
<!-- end inner content -->

</div>
</div>
<div id="footer">
<div class="footer2col1"><a href="../../terms.php">TERMS</a>&nbsp;|&nbsp;<a href="../../sitemap.php">SITE MAP</a>&nbsp;|&nbsp;<a href="../../admin/">ADMINISTRATOR</a></div></div>
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