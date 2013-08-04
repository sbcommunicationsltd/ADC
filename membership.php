<?php
session_start(); 
include 'database/databaseconnect.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Asian Dinner Club - for Single Asian Professionals :: membership ::  Asian Dinner Club</title>
<meta name="description" content=" Asian Dinner Club, for Single Asian Professionals" />
<meta name="keywords" content="Indian, dating, party, London, Matchmaking, Asian matchmaking, Shaadi, restaurants, events, Asian Dinner Club, Asia dinner club, Indian dinner club, Supper club, Asian events, Asian dating, Asian speedating, Asian speeddating, Chillitickets, Asiana, Dating events london, Singles events asian, Singles events london, Single solution, Hindu events, Sikh events, muslim dating, Hindu dating, Sikh dating, Dinner clubs, Top table, Dinner parties, Dinner dates, Quaglinos, Asia de cuba, Asian Dinner Club, Tantric Club, Asiand8" />
</head>
<body>
<div id="wrapper">
<div id="header">
<div id="logo"><a href="http://www.asiandinnerclub.com/" target="_self"><img src="images/logo.gif" alt="Asian Dinner Club" /></a></div>
<div id="navigation">
<ul>
<li><a href="http://www.asiandinnerclub.com/" target="_self">HOME</a></li>
<li class="topnav" ><a href="aboutus.php" target="_self">ABOUT<br/>US</a></li>
<li><a href="events.php" target="_self">CURRENT<br/>EVENTS</a></li>
<li><a href="past_events.php" target="_self">PAST<br/>EVENTS</a></li>
<li><a class='active' href="membership.php" target="_self">MEMBERSHIP</a></li>
<!--<li><a href="premiermembership.php" target="_self">PREMIER<br/>MEMBERSHIP</a></li>-->
<!--<li><a href="matchmaking.php" target="_self">MATCH&nbsp;<sup style='color:white; font-size:8px; border:1px solid white; padding:1px;'>NEW</sup><br/><span style='padding-right:25px;'>MAKING</span></a></li>-->
<li><a href="press.php" target="_self">PRESS</a></li>
<!--<li><a href="eternitymembership.php" target="_self">ETERNITY&nbsp;<sup style='color:white; font-size:8px; border:1px solid white; padding:1px;'>NEW</sup><br/><span style='padding-right:25px;'>MEMBERSHIP</span></a></li>-->
<li><a href="team.php" target="_self">THE<br/>TEAM</a></li>
<li><a href="contact.php" target="_self">CONTACT</a></li>
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
	
	<h1><img src="images/membership.gif" alt="Membership" width="181" height="50"/></h1>

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
				$_POST['DOB'] = $_POST['Date_Day'] . '/' . $_POST['Date_Month'] . '/' . $_POST['Date_Year'];
			}
			
			if(!filter_input(INPUT_POST, 'EmailAddress', FILTER_VALIDATE_EMAIL))
			{
				$errors[] = "E-Mail Address is not valid";
			}

			if($_POST['EmailAddress'] != $_POST['ConEmailAddress'])
			{
				$errors[] = "The email addresses you confirmed with are not the same.";
			}
			else
			{
				$email = $_POST['EmailAddress'];
				$qu = "SELECT * FROM Members WHERE EmailAddress = '$email'";
				$re = mysql_query($qu) or die(mysql_error());
				if(mysql_num_rows($re) == 1)
				{
					$errors[] = "The email address provided has already been used to register for Membership.";
				}
			}
			
			if(!filter_input(INPUT_POST, 'DietaryReq', FILTER_SANITIZE_STRING))
			{
				$errors[] = "Please enter proper information for the Dietary Requirements";
			}
			
			if(!filter_input(INPUT_POST, 'Interests', FILTER_SANITIZE_STRING))
			{
				$errors[] = "Please enter proper information for the Interests";
			}
			
			$sPattern = '/\s*/m';
			$sReplace = '';
			
			$_POST['DietaryReq'] = str_replace("\r\n", ', ', $_POST['DietaryReq']);
			$_POST['DietaryReq'] = preg_replace( $sPattern, $sReplace, $_POST['DietaryReq'] );
			
			if(stripos($_POST['DietaryReq'], '[/url]') !== false)
			{
				$errors[] = "Please enter proper information for the Dietary Requirements without links";
			}
			
			if(stripos($_POST['Interests'], '[/url]') !== false)
			{
				$errors[] = "Please enter proper information for the Interests without links";
			}

			$_POST['Interests'] = str_replace("\r\n", ', ', $_POST['Interests']);
			$_POST['Interests'] = preg_replace( $sPattern, $sReplace, $_POST['Interests'] );

			$_POST['Mobile'] = preg_replace( $sPattern, $sReplace, $_POST['Mobile'] );
			$_POST['Mobile'] = trim($_POST['Mobile']);
			if(!is_numeric($_POST['Mobile']))
			{
				$errors[] = "The mobile number must be numeric!";
			}
			
			$target_path = 'member/images/';

			$filename = basename($_FILES['uploadedfile']['name']);
			
			$query = "SELECT MAX(ID) FROM Members";
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
				
				list($width, $height) = getimagesize($_FILES['uploadedfile']['tmp_name']) ;
				if($width > 360)
				{
					$modwidth = 360;
					$diff = $width / $modwidth;

					$modheight = $height / $diff;
					$tn = imagecreatetruecolor($modwidth, $modheight) ;
					if($extension == 'jpg' || $extension == 'jpeg')
					{
						$image = imagecreatefromjpeg($_FILES['uploadedfile']['tmp_name']);
						imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ;
						imagejpeg($tn, $_FILES['uploadedfile']['tmp_name'], 100);
					}
					else
					{
						$image = imagecreatefromgif($_FILES['uploadedfile']['tmp_name']);
						imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ;
						imagegif($tn, $_FILES['uploadedfile']['tmp_name'], 100);
					}
				}
				
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
			
			//Encrypt the posted code field and then compare with the stored key 
			/*if(md5($_POST['Captcha_Code']) != $_SESSION['key']) 
			{ 
				$errors[] = "You must enter the code correctly"; 
			}*/

			//$fields = array('Forename', 'Surname', 'Gender', 'Status', 'EmailAddress', 'ConEmailAddress', 'DOB', 'Profession', 'Mobile', 'DietaryReq', 'Religion', 'Height', 'Drink', 'HeardFrom', 'Interests', 'Achieve', 'Image_Path', 'Captcha_Code');
			$fields = array('Forename', 'Surname', 'Gender', 'Status', 'EmailAddress', 'ConEmailAddress', 'DOB', 'Profession', 'Mobile', 'DietaryReq', 'Religion', 'Height', 'Drink', 'HeardFrom', 'Interests', 'Achieve', 'Image_Path', 
							'Address_Line1', 'Address_Line2', 'Address_Town', 'Address_County', 'Address_PostCode', 'Address_Country');

			foreach($fields as $field)
			{
				$formvar = $_POST["$field"];
				if($formvar == '')
				{
					$errors[] = "You forgot to enter the '$field'";
				}
			}

			if(empty($errors))
			{
				$date = date('d/m/Y H:i');
				$query2 = "INSERT INTO Members (ID, ";
				foreach($fields as $field) {
					if ($field != 'ConEmailAddress') {
						$query2 .= "$field, ";
					}
				}
				$query2 .= "DateJoined, Approved) VALUES ('$idmax', ";
				$to = 'info@asiandinnerclub.com, sumita.biswas@gmail.com';
				//$to = 'sumita.biswas@gmail.com';
				$subject = 'Membership Form Submission for Asian Dinner Club';
				$body = '';
				foreach($fields as $field)
				{
					$formvar = $_POST["$field"];
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
				$headers = "From: Asian Dinner Club <info@asiandinnerclub.com> \r\n";
				if(mail($to, $subject, $body, $headers))
				{
					echo '<p><b>Thank You!</b></p><p>We will contact you within 48hrs to discuss your membership application.</p><p><hr/></p>';
					$result2 = mysql_query($query2) or die(mysql_error());
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
				unlink('member/images/' . $imagefile);
				echo '<p><b>Error!</b></p>
					<p>The following error(s) occurred:<br />';
					foreach ($errors as $msg) { // Print each error.
						echo " - $msg<br />\n";
					}
					echo '</p><p>Please try again.</p><p><br /></p>';
			} // End of if (empty($errors)) IF.
		}
		?>

	    <p><span class="righthandpic"><img src="images/asian_dinner_3.jpg" alt="Asian Dinner Club Membership" width="150" height="150" /></span></p>
		<p>To be considered for Membership to the Asian Dinner Club, please complete the form below. </p>

		<p>There is free membership to the Asian Dinner Club, enabling you to attend our monthly dinner parties and networking drinks.</p>
		<p>Once you have registered, and your application is successful, we will email you your login details for booking tickets for our events.</p>
		<!--<p>Our <a href='premiermembership.php' style='text-decoration:none'>Premier Membership</a> is a unique personalised membership service, assisting you to meet your ideal partner based on your requirements.</p>-->
        <p><b>Membership Form</b></p>
        <p> (<span class="style1">*</span>All Fields are compulsory)</p>
        <!-- can't get access to thanks.php - sends mail to admin - do that manually! - sb -->
		<form method="post" id="profileform" name="ContactForm" enctype="multipart/form-data">
		<div id="regformwrap">
			<div class="rowwrap">
				<div class="cell-1">First Name<span class="style1">*</span> <span class="redasterisk" id="usrForename_mark" style="display:none;"> *</span></div>
				<div class="cell-2">
					<input class="text long" name="Forename" id="usrForename" type="text" value="<?php echo $_POST['Forename'];?>" />
				</div>
			</div>
			<div class="rowwrap">
				<div class="cell-1">Surname <span class="style1">*</span><span class="redasterisk" id="usrSurname_mark" style="display:none;"> *</span></div>
				<div class="cell-2">
					<input class="text long" name="Surname" id="usrSurname" type="text" value="<?php echo $_POST['Surname'];?>" />
				</div>
			</div>
			<div class="rowwrap">
				<div class="cell-1">Gender<span class="style1">*</span> <span class="redasterisk" id="usrGender_mark" style="display:none;"> *</span></div>
				<div class="cell-2">
					<select class="drop short" name="Gender" id="usrGender">
					<option value="">Select</option>
					<option value="Female" <?php if($_POST['Gender'] == 'Female'){echo "selected='selected'";}?>>Female</option>
					<option value="Male" <?php if($_POST['Gender'] == 'Male'){echo "selected='selected'";}?>>Male</option>
					</select>
				</div>
			</div>
			<div class="rowwrap">
				<div class="cell-1">Status<span class="style1">*</span> <span class="redasterisk" id="usrStatus_mark" style="display:none;"> *</span></div>
				<div class="cell-2">
					<select class="drop short" name="Status" id="usrStatus">
					<option value="">Select</option>
					<option value="Single" <?php if($_POST['Status'] == 'Single'){echo "selected='selected'";}?>>Single</option>
					<option value="Separated" <?php if($_POST['Status'] == 'Separated'){echo "selected='selected'";}?>>Separated</option>
					<option value="Divorced" <?php if($_POST['Status'] == 'Divorced'){echo "selected='selected'";}?>>Divorced</option>
					</select>
				</div>
			</div>
			<div class="rowwrap">
				<div class="cell-1">Email Address<span class="style1">*</span> <span class="redasterisk" id="usrEmailAddress_mark" style="display:none;"> *</span></div>
				<div class="cell-2">
					<input class="text long" name="EmailAddress" id="usrEmailAddress" type="text" value="<?php echo $_POST['EmailAddress'];?>" />
				</div>
			</div>
			<div class="rowwrap">
				<div class="cell-1">Confirm Email Address<span class="style1">*</span> <span class="redasterisk" id="usrEmailAddress_mark" style="display:none;"> *</span></div>
				<div class="cell-2">
					<input class="text long" name="ConEmailAddress" id="usrConEmailAddress" type="text" value="<?php echo $_POST['ConEmailAddress'];?>" />
				</div>
			</div>
			<div class="rowwrap">
				<div class="cell-1">Date of Birth<span class="style1">*</span> <span class="redasterisk" id="usrDOB_day_mark" style="display:none;"> *</span></div>
				<div class="cell-2">
					<select name="Date_Day" id="usrDOB_day" class="drop date">
					<option value=''>--</option>
					<?php 	
					for($days=1; $days<=31; $days++)
					{
						echo "<option value=\"$days\""; if($_POST['Date_Day'] == $days){echo "selected='selected'";} echo ">"; if(strlen($days)==1){echo "0";} echo "$days</option>";
					}
					?>
					</select>
					<select name="Date_Month" id="usrDOB_month" class="drop date">
					<option value=''>--</option>
					<?php 	$months = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
					for($month=1; $month<=12; $month++)
					{
						$word = $month-1;
						echo "<option value=\"$month\"";  if($_POST['Date_Month'] == $month){echo "selected='selected'";} echo ">$months[$word]</option>";
					}
					?>
					</select>
					<select name="Date_Year" id="usrDOB_year" class="drop date">
					<option value=''>--</option>
					<?php	//$startyear = date("Y")-47;
                    $startyear = 1950;
					$endyear = date("Y")-24;
					for($year=$startyear; $year<=$endyear; $year++)
					{
						echo "<option value=\"$year\""; if($_POST['Date_Year'] == $year){echo "selected='selected'";} echo ">$year</option>";
					}
					?>
					</select>
				</div>
			</div>
			<div class="rowwrap">
				<div class="cell-1">Profession <span class="style1">*</span><span class="redasterisk" id="usrProfession_mark" style="display:none;"> *</span></div>
				<div class="cell-2">
					<select class="drop long" name="Profession" id="usrProfession" value="profession">
					<option value="Not Specified" <?php if($_POST['Profession'] == 'Not Specified'){echo "selected='selected'";}?>>Not Specified</option>
					<option value="Academic" <?php if($_POST['Profession'] == 'Academic'){echo "selected='selected'";}?>>Academic</option>
					<option value="Accounting" <?php if($_POST['Profession'] == 'Accounting'){echo "selected='selected'";}?>>Accounting</option>
					<option value="Admin / Secretarial" <?php if($_POST['Profession'] == 'Admin / Secretarial'){echo "selected='selected'";}?>>Admin / Secretarial</option>
					<option value="Arts / Media" <?php if($_POST['Profession'] == 'Arts / Media'){echo "selected='selected'";}?>>Arts / Media</option>
					<option value="Company Director" <?php if($_POST['Profession'] == 'Company Director'){echo "selected='selected'";}?>>Company Director</option>
					<option value="Construction / Property Services" <?php if($_POST['Profession'] == 'Construction / Property Services'){echo "selected='selected'";}?>>Construction / Property Services</option>
					<option value="Consultant" <?php if($_POST['Profession'] == 'Consultant'){echo "selected='selected'";}?>>Consultant</option>
					<option value="Designer" <?php if($_POST['Profession'] == 'Designer'){echo "selected='selected'";}?>>Designer</option>
					<option value="Doctor / Medical" <?php if($_POST['Profession'] == 'Doctor / Medical'){echo "selected='selected'";}?>>Doctor / Medical</option>
					<option value="Financial Services / Insurance" <?php if($_POST['Profession'] == 'Financial Services / Insurance'){echo "selected='selected'";}?>>Financial Services/ Insurance</option>
					<option value="Hospitality / Catering" <?php if($_POST['Profession'] == 'Hospitality / Catering'){echo "selected='selected'";}?>>Hospitality / Catering</option>
					<option value="Human Resources" <?php if($_POST['Profession'] == 'Human Resources'){echo "selected='selected'";}?>>Human Resources</option>
					<option value="IT / Computing" <?php if($_POST['Profession'] == 'IT / Computing'){echo "selected='selected'";}?>>IT / Computing</option>
					<option value="Legal" <?php if($_POST['Profession'] == 'Legal'){echo "selected='selected'";}?>>Legal</option>
					<option value="Leisure / Tourism" <?php if($_POST['Profession'] == 'Leisure / Tourism'){echo "selected='selected'";}?>>Leisure / Tourism</option>
					<option value="Military" <?php if($_POST['Profession'] == 'Military'){echo "selected='selected'";}?>>Military</option>
					<option value="Own Business" <?php if($_POST['Profession'] == 'Own Business'){echo "selected='selected'";}?>>Own Business</option>
					<option value="Political / Government" <?php if($_POST['Profession'] == 'Political / Government'){echo "selected='selected'";}?>>Political / Government</option>
					<option value="Sales and Marketing" <?php if($_POST['Profession'] == 'Sales and Marketing'){echo "selected='selected'";}?>>Sales and Marketing</option>
					<option value="Science / Technical" <?php if($_POST['Profession'] == 'Science / Technical'){echo "selected='selected'";}?>>Science / Technical</option>
					<option value="Teaching / Education" <?php if($_POST['Profession'] == 'Teaching / Education'){echo "selected='selected'";}?>>Teaching / Education</option>
					<option value="Writer / Journalist" <?php if($_POST['Profession'] == 'Writer / Journalist'){echo "selected='selected'";}?>>Writer / Journalist</option>
					<option value="Other" <?php if($_POST['Profession'] == 'Other'){echo "selected='selected'";}?>>Other</option>
					</select>
				</div>
			</div>
			<div class="rowwrap">
				<div class="cell-1">Mobile Number<span class="style1">*</span><span class="redasterisk" id="usrPhone_mark" style="display:none;"> *</span></div>
				<div class="cell-2">
					<input type="text" size="20" class="text phone" name="Mobile" id="usrPhone" value="<?php echo $_POST['Mobile'];?>" />
				</div>	
			</div>
			<div class="rowwrap">
				<div class="cell-1">Dietary Requirements<span class="style1">*</span><span class="redasterisk" id="usrDietary_mark" style="display:none;"></span><span class="redasterisk" id="usrPassword_mark" style="display:none;"> *</span></div>
				<div class="cell-2">
					<textarea name="DietaryReq" cols="20" class="text long" id="usrDietary"><?php echo $_POST['DietaryReq'];?></textarea>
				</div>
			</div>
		    <div class="rowwrap">
				<div class="cell-1">Religion <span class="style1">*</span><span class="redasterisk" id="usrReligion_mark" style="display:none;"> *</span></div>
				<div class="cell-2">
					<select class="drop long" name="Religion" id="usrReligion">
					<option value="">Select</option>
					<option value="Hindu" <?php if($_POST['Religion'] == 'Hindu'){echo "selected='selected'";}?>>Hindu</option>
					<option value="Sikh" <?php if($_POST['Religion'] == 'Sikh'){echo "selected='selected'";}?>>Sikh</option>
					<option value="Muslim" <?php if($_POST['Religion'] == 'Muslim'){echo "selected='selected'";}?>>Muslim</option>
					<option value="Christian" <?php if($_POST['Religion'] == 'Christian'){echo "selected='selected'";}?>>Christian</option>
					<option value="Spiritual - Not Religious" <?php if($_POST['Religion'] == 'Spiritual - Not Religious'){echo "selected='selected'";}?>>Spiritual - Not Religious</option>
					<option value="No Religion" <?php if($_POST['Religion'] == 'No Religion'){echo "selected='selected'";}?>>No Religion</option>
					<option value="Other" <?php if($_POST['Religion'] == 'Other'){echo "selected='selected'";}?>>Other</option>
					</select>
				</div>
			</div>
			<div class="rowwrap">
				<div class="cell-1">Height<span class="style1">*</span><span class="redasterisk" id="usrHeight_mark" style="display:none;"> *</span></div>
				<div class="cell-2">
					<?php $heigarr = array("4' 11in", "4' 12in", "5' 0in", "5' 1in", "5' 2in", "5' 3in", "5' 4in", "5' 5in", "5' 6in", "5' 7in", "5' 8in", "5' 9in", "5' 10in", "5' 11in", "6' 0in", "6' 1in", "6' 2in", "6' 3in", "6' 4in", "6' 5in", "6' 6in", "6' 7in");?>
					<select class="drop long" name="Height" id="usrHeight">
					<option value="">Select</option>
					<?php 
					foreach($heigarr as $heig)
					{
						echo "<option value=\"$heig\""; if($_POST['Height'] == $heig){echo "selected='selected'";} echo ">$heig</option>";
					}?>
					</select>
				</div>
			</div>
			<div class="rowwrap">
				<div class="cell-1">Do You Drink? <span class="style1">*</span><span class="redasterisk" id="usrDrink_mark" style="display:none;"> *</span></div>
				<div class="cell-2">
					<select class="drop short" name="Drink" id="usrDrink">
					<option value="">Select</option>
					<option value="Yes" <?php if($_POST['Drink'] == 'Yes'){echo "selected='selected'";}?>>Yes</option>
					<option value="No" <?php if($_POST['Drink'] == 'No'){echo "selected='selected'";}?>>No</option>
					</select>
				</div>
			</div>
			<div class="rowwrap">
				<div class="cell-1">How did you hear about us?  <span class="style1">*</span><span class="redasterisk" id="usrHear_mark" style="display:none;"> *</span></div>
				<div class="cell-2">
					<select class="drop long" name="HeardFrom" id="usrHear">
					<option value="">Select</option>
					<?php 
					$heardarr = array("Google", "Friend", "Asians in Media", "Chillitickets", "A Small World", "Magazine", "Newspaper", "Decayenne",
                                "Asiana Magazine", "Vogue Aug '11", "Eastern Eye", "Zee TV Magazine", "Linked In", "Financial World", "City AM", "Daily Mail", "Telegraph");
					sort($heardarr);
					foreach ($heardarr as $heard) {
						echo "<option value='$heard'"; if ($_POST['HeardFrom'] == $heard) {echo "selected='selected'";} echo ">$heard</option>";
					}?>
					</select>
				</div>
			</div>
			<div class="rowwrap">
				<div class="cell-1">Interests <span class="style1">*</span><span class="redasterisk" id="usrInterests_mark" style="display:none;"> *</span></div>
				<div class="cell-2">
					<textarea name="Interests" cols="20" class="text long" id="usrInterests"><?php echo $_POST['Interests'];?></textarea>
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
					<input type="text" size="20" class="text long" name="Address_Line1" value="<?php echo $_POST['Address_Line1'];?>" />
				</div>
			</div>
			<div class="rowwrap">
				<div class="cell-1">Line 2</div>
				<div class="cell-2">
					<input type="text" size="20" class="text long" name="Address_Line2" value="<?php echo $_POST['Address_Line2'];?>" />
				</div>
			</div>
			<div class="rowwrap">
				<div class="cell-1">Town</div>
				<div class="cell-2">
					<input type="text" size="20" class="text long" name="Address_Town" value="<?php echo $_POST['Address_Town'];?>" />
				</div>
			</div>
			<div class="rowwrap">
				<div class="cell-1">County</div>
				<div class="cell-2">
					<input type="text" size="20" class="text long" name="Address_County" value="<?php echo $_POST['Address_County'];?>" />
				</div>
			</div>
			<div class="rowwrap">
				<div class="cell-1">Post Code</div>
				<div class="cell-2">
					<input type="text" size="20" class="text long" name="Address_PostCode" value="<?php echo $_POST['Address_PostCode'];?>" />
				</div>
			</div>
			<div class="rowwrap">
				<div class="cell-1">Country</div>
				<div class="cell-2">
					<input type="text" size="20" class="text long" name="Address_Country" value="<?php echo $_POST['Address_Country'];?>" />
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
		            <option value="Friendship" <?php if($_POST['Achieve'] == 'Friendship'){echo "selected='selected'";}?>>Friendship</option>
		            <option value="Socialising" <?php if($_POST['Achieve'] == 'Socialising'){echo "selected='selected'";}?>>Socialising</option>
		            <option value="Serious Relationship" <?php if($_POST['Achieve'] == 'Serious Relationship'){echo "selected='selected'";}?>>Serious Relationship</option>
		            <option value="Networking" <?php if($_POST['Achieve'] == 'Networking'){echo "selected='selected'";}?>>Networking</option>
		            </select>
		        </div>
			</div>
			<input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
			<div class="rowwrap">
				<div class="cell-1">Upload Photo: <span class="style1">*</span><span class="redasterisk" id="usrPhoto_mark" style="display:none;"> *</span></div>
				<div class="cell-2"><input name="uploadedfile" type="file" id="usrPhoto" /></div>
			</div>
			<div class='rowwrap'><br/><span style='font-style:italic; font-size:12px;'>Asian Dinner Club are committed to ensuring your privacy is protected.  We will not sell or disclose your personal information to third parties unless we have your permission or are required to do so by law.</span></div>
			<div class='rowwrap'><span style='font-style:italic; color:red; font-size:12px;'>Note.. Max Image size - 2MB</span></div>
			<!--<div class="rowwrap">
            <div class="cell-1">&nbsp;</div>
            <div class="cell-2"></div>
			</div>
			<div class='rowwrap'>
			<div class='cell-1'>&nbsp;</div>
			<div class='cell-2'><img src="scripts/captcha.php" /></div>
			</div>
			<div class='rowwrap'>
			<div class='cell-1'>Write what you see above <span class="style1">*</span><span class="redasterisk" id="Captcha_Code_mark" style="display:none;"> *</span></div>
			<div class='cell-2'><input type="text" size="20" class="text phone" name="Captcha_Code" id="Captcha_Code" /></div>
			</div>-->
			<div class='rowwrap'>
				<div class='cell-1'>&nbsp;</div>
				<div class='cell-2'></div>
			</div>
			<div class="rowwrap submitbutton">
				<div class="cell-1">&nbsp;</div>
				<div class="cell-2">
					<!--<input type="submit" name="Submit" value="Submit">-->
					<input type='hidden' name='Submit' />
					<table cellspacing='0' cellpadding='0' border='0'>
					<tr>
						<td><img src="images/sumi_buttons_04.png" width="11" height="19" alt=""></td>
						<td class='singlebutton'><a title='Submit' href='javascript:document.ContactForm.submit();'>Submit</a></td>
						<td><img src="images/sumi_buttons_06.png" width="11" height="19" alt=""></td>
					</tr>
					</table>
				</div>
			</div>
			<div class='rowwrap'>
				<div class='cell-1'>&nbsp;</div>
				<div class='cell-2'></div>
			</div>
		</div>
        <p>&nbsp;</p>
		</form>
		<p>&nbsp;</p>
	    <p>&nbsp;</p>
	    <p><br></p>

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

 	 $query3 = "SELECT * FROM LoveItems LIMIT $firstid, 10";
 	 $result3 = mysql_query($query3) or die(mysql_error());
 	 ?>
 	 <span class='lefthandpic'>
 	 <br/>
 	 &nbsp;<img src="images/adclovessmall.gif" alt="Asian Dinner Club Loves" width="190" />
 	 &nbsp;<marquee behaviour='scroll' direction='up' scrollamount='1' width='180' style='border:1px solid #FF00FF;'>
 	 <?php
 	 $i = 1;
 	 while($row3 = mysql_fetch_array($result3))
 	 {
 			$id = $row3['ID'];
 			$title = $row3['Title'];
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
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
  _uacct = "UA-4965994-1";
  urchinTracker();
</script>
</div>
</body>
</html>