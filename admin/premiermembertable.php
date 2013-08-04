<html>
<head>
<style type='text/css'>
.table {
	font-size:11px;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	height: 20px;
	cursor:pointer;
}

.tablehover {
	background-color: #ec008c;
}

.singlebutton {
	 background-image:url(../images/sumi_buttons_05.png);
	 background-repeat:repeat-x;
}

.singlebutton a {
	text-decoration:none;
	color:white;
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	font-weight:bold;
	cursor:pointer;
}
</style>
</head>
<body style="background-color:transparent;">
<?php session_start();
include '../database/databaseconnect.php';

if(isset($_GET['approved']))
{
	$appid = $_GET['approved'];
	$query2 = "SELECT * FROM Premier_Membership WHERE ID = '$appid'";
	$result2 = mysql_query($query2) or die(mysql_error());
	$row2 = mysql_fetch_array($result2);
	$email = $row2['EmailAddress'];
	$to = $email;
	$dob = str_replace('-', '', $row2['DOB']);
	$year = substr($dob, 2, 2);
	$month = substr($dob, 4, 2);
	$day = substr($dob, -2);
	
	$pass = $day . $month . $year;
	//$to = 'sumita.biswas@gmail.com';
	$subject = 'Asian Dinner Club Premier Membership';
	$body = "<html><head><title>Asian Dinner Club Premier Membership</title></head><body>";
	$body .= "<p>Dear Member,</p>";
	$body .= "<p>Thank you for joining our Premier Membership.</p>";
	$body .= "<p>Below are the details which will enable you to log-on and book tickets for all Premier events.</p>";
	$body .= "<p><br/></p><p><b>Login- in details</b></p>";
	$body .= "<p>Username: $email</p>";
	$body .= "<p>Password: $pass</p>";
	$body .= "<p><br/></p><p>Best regards,</p>";
	$body .= "<p><br/></p><p>Asian Dinner Club</p>";
	$body .= "<p><img src='http://www.asiandinnerclub.com/images/logo.gif' alt='Asian Dinner Club' border='0' /></p></body></html>";

	$headers = "MIME-Version: 1.0 \r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1 \r\n";
	$headers .= "From: Asian Dinner Club <info@asiandinnerclub.com> \r\n";

	if(mail($to, $subject, $body, $headers))
	{
		$fullname = $row2['Forename'] . ' ' . $row2['Surname'];?>
		<script>
		alert("Thank You! Member - <?php echo $fullname;?> has been approved!");
		</script>
	<?php
	}
	else
	{?>
		<p><b>System Error</b></p><p>A system error has occurred -  we apologise for any inconvenience caused. Use the link below to manually email this member.</p>
		<p><a href="mailto:<?php echo $row2['EmailAddress'];?>" style='text-decoration:none;'><?php echo $row2['EmailAddress'];?></a></p>
	<?php
	}

	$joined = $row2['DateJoined'];

	$expire = date('Y-m-d H:i', strtotime(date("Y-m-d H:i", strtotime($joined)) . " +1 year"));

	$query3 = "UPDATE Premier_Membership SET Approved = 'Yes', DateExpire = '$expire' WHERE ID = '$appid'";
	$result3 = mysql_query($query3) or die(mysql_error());
}


if(isset($_GET['renew']))
{
	$renid = $_GET['renew'];
	$query3 = "SELECT * FROM Premier_Membership WHERE ID = '$renid'";
	$result3 = mysql_query($query3) or die(mysql_error());
	$row3 = mysql_fetch_array($result3);
	$email = $row3['EmailAddress'];
	$to = $email;
	$dob = str_replace('-', '', $row2['DOB']);
	$year = substr($dob, 2, 2);
	$month = substr($dob, 4, 2);
	$day = substr($dob, -2);
	
	$pass = $day . $month . $year;
	//$to = 'sumita.biswas@gmail.com';
	$subject = 'Renewed Premier Membership to Asian Dinner Club';
	$body = "<html><head><title>Renewed Premier Membership to Asian Dinner Club</title></head><body>";
	$body .= "<p>Dear Premier Member,</p>";
	$body .= "<p>Thank you for renewing your Premier Membership for a further year.</p>";
	$body .= "<p>Please use the following to login to buy tickets to events for Premier Members.</p>";
	$body .= "<p><br/></p><p><b>Login- in details</b></p>";
	$body .= "<p>Username: $email</p>";
	$body .= "<p>Password: $pass</p>";
	$body .= "<p><br/></p><p>Best Wishes,</p>";
	$body .= "<p><br/></p><p>Asian Dinner Club</p>";
	$body .= "<p><img src='http://www.asiandinnerclub.com/images/logo.gif' alt='Asian Dinner Club' border='0' /></p></body></html>";

	$headers = "MIME-Version: 1.0 \r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1 \r\n";
	$headers .= "From: Asian Dinner Club <info@asiandinnerclub.com> \r\n";

	if(mail($to, $subject, $body, $headers))
	{
		$fullname = $row3['Forename'] . ' ' . $row3['Surname'];?>
		<script>
		alert("Thank You! Premier Member - <?php echo $fullname;?> has been renewed!");
		</script>
	<?php
	}
	else
	{?>
		<p><b>System Error</b></p><p>A system error has occurred -  we apologise for any inconvenience caused. Use the link below to manually email this member.</p>
		<p><a href="mailto:<?php echo $row3['EmailAddress'];?>" style='text-decoration:none;'><?php echo $row3['EmailAddress'];?></a></p>
	<?php
	}


	$expire = date('Y-m-d H:i', strtotime(date("Y-m-d H:i", strtotime($row3['DateExpire'])) . " +1 year"));

	$query4 = "UPDATE Premier_Membership SET Approved = 'Yes', DateExpire = '$expire' WHERE ID = '$renid'";
	$result4 = mysql_query($query4) or die(mysql_error());
}

$query = "SELECT * FROM Premier_Membership";

if($_POST['sorted']=='forename')
{
	$query .= " ORDER BY Forename ASC";
}
elseif($_POST['sorted']=='surname')
{
	$query .= " ORDER BY Surname ASC";
}
elseif($_POST['sorted']=='approved')
{
	$query .= " ORDER BY Approved ASC";
}
else
{
	$query .= " ORDER BY Forename ASC";
}

$result = mysql_query($query) or die(mysql_error());
$numfields = mysql_num_fields($result);
for ($i=0; $i < $numfields; $i++)
{
	$fieldname[] = mysql_field_name($result, $i);
}?>

<table class='table' style="border:1px solid #d0d3d5;" cellspacing='2' cellpadding='2' align='center' border='0'>
<tr style="background-color:#999999;">
		<th>Amend</th>
		<form method="post" name="sortedthird" action='premiermembertable.php'>
		<input type="hidden" name="sorted" value="approved" />
		<th>
		<a href="#" style="color:black; text-decoration:none;" onclick="sorts3();" style="color:black; text-decoration:none;"><img src="../images/marker-right.GIF" height="10" width="10" style="border: none;" alt="sort by approved" align="left" class="closed2" />
<?php	if($_POST['sorted'] == 'approved')
		{?>
			<style type="text/css">img.closed2 {display:none;}
			</style>
			<img src="../images/marker-down.GIF" alt="sorted by approved" align="left" class="arrow" height="10" width="10" style="border: none;" />
		<?php
		}?>Approved</a>
		</th></form>
		<th>Image</th>

<?php 	foreach($fieldname as $field)
		{
			if($field!='ID' && $field !='Cities' && $field!='Drink' && $field!='Height' && $field!='Interests' && $field!='DietaryReq' && $field!='Image_Path' && $field!='Approved')
			{
				if($field=='Forename')
				{?>
					<form method="post" name="sortedfirst" action='premiermembertable.php'>
					<input type="hidden" name="sorted" value="forename" />
					<th>
					<a href="#" style="color:black; text-decoration:none;" onclick="sorts1();" style="color:black; text-decoration:none;"><img src="../images/marker-down.GIF" height="10" width="10" style="border: none;" alt="sorted by forename" align="left" class="open" />
					<?php if($_POST['sorted'] == 'surname' || $_POST['sorted'] == 'approved')
					{?>
						<style type="text/css">img.open {display:none;}</style>
						<img src="../images/marker-right.GIF" height="10" width="10" style="border: none;" alt="sort by forename" align="left" class="arrow" />
					<?php
					}?>Forename</a>
					</th></form>
		<?php	}
				elseif($field=='Surname')
				{?>
					<form method="post" name="sortedsecond" action='premiermembertable.php'>
					<input type="hidden" name="sorted" value="surname" />
					<th>
						<a href="#" style="color:black; text-decoration:none;" onclick="sorts2();" style="color:black; text-decoration:none;"><img src="../images/marker-right.GIF" height="10" width="10" style="border: none;" alt="sort by surname" align="left" class="closed1" />
					<?php if($_POST['sorted'] == 'surname')
					{?>
						<style type="text/css">img.closed1 {display:none;}
						</style>
						<img src="../images/marker-down.GIF" alt="sorted by surname" align="left" class="arrow" height="10" width="10" style="border: none;" />
					<?php
					}?>Surname</a>
					</th></form>
		<?php	}
				else
				{?>
					<th><?php echo $field;?></th>
		<?php	}
			}
		} ?>
</tr>
<?php
if(mysql_num_rows($result) != 0)
{
	$counter = 0;
	while($row = mysql_fetch_array($result))
	{
		$id = $row['ID'];
		$counter++;
		$background_color = ( $counter % 2 == 0 ) ? ('#e9e9e9') : ('#ffffff');
		$date = date('Y-m-d H:i');
		$dateexpire = $row['DateExpire'];?>
		<tr class='table' bgcolor="<?php echo $background_color;?>" <?php if($row['Approved'] == 'No'){ echo "style='color:red;'"; } if($dateexpire < $date){echo "style='color:blue;'";}?> onmouseover="this.className='table tablehover'" onmouseout="this.className='table'">
			<td>
			<!--<a style='text-decoration:none;' href="javascript:void(0)"><input type='button' name='amend' value='Amend' style='cursor:pointer; font-size:14px;' onclick="window.open('premmemamend.php?edit=<?php echo $id;?>', 'child', 'height=500,width=600,status=yes,resizable=yes,scrollbars=yes')" /></a>-->
			<table cellspacing='0' cellpadding='0' border='0'>
				<tr>
					<td><img src="../images/sumi_buttons_04.png" width="11" height="19" alt=""></td>
					<td class='singlebutton'><a title='Amend Profile' onclick="window.open('premmemamend.php?edit=<?php echo $id;?>', 'child', 'height=500,width=600,status=yes,resizable=yes,scrollbars=yes')" href='javascript:void(0)'>Amend</a></td>
    				<td><img src="../images/sumi_buttons_06.png" width="11" height="19" alt=""></td>
    			</tr>
    		</table>
    		</td>
			<td><?php if($row['Approved']=='No'){?><!--<input type='button' name='approve' value='Approve' style='cursor:pointer; font-size:14px;' onclick="location.href='?approved=<?php echo $id;?>';" />-->
			<table cellspacing='0' cellpadding='0' border='0'>
				<tr>
					<td><img src="../images/sumi_buttons_04.png" width="11" height="19" alt=""></td>
					<td class='singlebutton'><a title='Approve' href="?approved=<?php echo $id;?>">Approve</a></td>
					<td><img src="../images/sumi_buttons_06.png" width="11" height="19" alt=""></td>
				</tr>
			</table>
			<?php }
			elseif($row['Approved'] == 'RenewNo')
			{?>
				<table cellspacing='0' cellpadding='0' border='0'>
					<tr>
						<td><img src="../images/sumi_buttons_04.png" width="11" height="19" alt=""></td>
						<td class='singlebutton'><a title='Renew' href="?renew=<?php echo $id;?>">Renew</a></td>
						<td><img src="../images/sumi_buttons_06.png" width="11" height="19" alt=""></td>
					</tr>
				</table>
			<?php
			}
			else{ echo 'Yes';}?></td>
			<td><img src="../member/premier/images/<?php echo $row['Image_Path'];?>" alt="<?php echo $row['Forename'];?>" border='0' height='50' /></td>
			<?php
			foreach($fieldname as $field)
			{
				if($field == 'DOB')
				{
					$row[$field] = date('d/m/Y', strtotime($row[$field]));
				}

				if($field == 'DateJoined')
				{
					$row[$field] = date('d/m/Y H:i', strtotime($row[$field]));
				}

				if($field == 'DateExpire')
				{
					if ($row[$field] != '') {
						$row[$field] = date('d/m/Y H:i', strtotime($row[$field]));
					} else {
						$row[$field] = 'not approved yet';
					}
				}

				if($field!='ID' && $field!='Image_Path' && $field!='Approved' && $field!='Height' && $field!='Interests' && $field!='DietaryReq' && $field!='Cities' && $field!='Drink')
				{?>
					<td <?php if($field=='Profession' || $field=='DOB'){echo "nowrap='nowrap'";}?>><?php echo $row[$field];?></td>
		<?php	}
			} ?>
		</tr>
<?php
	}
}
?>

</table>
<script>
function sorts1()
{
	document.sortedfirst.submit();
}

function sorts2()
{
	document.sortedsecond.submit();
}

function sorts3()
{
	document.sortedthird.submit();
}
</script>
</body>
</html>