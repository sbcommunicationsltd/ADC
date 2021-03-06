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

$query = "SELECT * FROM Members";

if($_POST['sorted']=='forename')
{
	$query .= " ORDER BY Forename ASC";
}
elseif($_POST['sorted']=='surname')
{
	$query .= " ORDER BY Surname ASC";
}
elseif($app == 'true')
{
	$query .= " ORDER BY Forename ASC";
}
else
{
	$query .= " ORDER BY ID Desc";
}

$result = mysql_query($query) or die(mysql_error());
$numfields = mysql_num_fields($result);
for ($i=0; $i < $numfields; $i++)
{
	$fieldname[] = mysql_field_name($result, $i);
}?>

<table class='table' style="border:1px solid #d0d3d5;" cellspacing='2' cellpadding='2' align='center' border='0'>
<tr bgcolor="#999999" style="background-color:#999999; font-size:12px;">
	<th>Image</th>
<?php 	foreach($fieldname as $field)
		{
			if($field!='ID' && $field!='Approved' && $field!='Image_Path')
			{
				if($app == 'true')
				{
					if($field=='Forename')
					{?>
						<form method="post" name="sortedfirst" action='membertable.php'>
						<input type="hidden" name="sorted" value="forename" />
						<th>
						<a href="#" style="color:black; text-decoration:none;" onclick="sorts1();" style="color:black; text-decoration:none;"><img src="../images/marker-down.GIF" height="10" width="10" style="border: none;" alt="sorted by forename" align="left" class="open" />
						<?php if($_POST['sorted'] == 'surname')
						{?>
							<style type="text/css">img.open {display:none;}</style>
							<img src="../images/marker-right.GIF" height="10" width="10" style="border: none;" alt="sort by forename" align="left" class="arrow" />
						<?php
						}?>Forename</a>
						</th></form>
			<?php	}
					elseif($field=='Surname')
					{?>
						<form method="post" name="sortedsecond" action='membertable.php'>
						<input type="hidden" name="sorted" value="surname" />
						<th>
						<a href="#" style="color:black; text-decoration:none;" onclick="sorts2();" style="color:black; text-decoration:none;"><img src="../images/marker-right.GIF" height="10" width="10" style="border: none;" alt="sort by surname" align="left" class="closed" />
						<?php if($_POST['sorted'] == 'surname')
						{?>
							<style type="text/css">img.closed {display:none;}</style>
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
		$background_color = ( $counter % 2 == 0 ) ? ('#e9e9e9') : ('#ffffff'); ?>
		<tr class='table' bgcolor="<?php echo $background_color;?>" onmouseover="this.className='table tablehover'" onmouseout="this.className='table'" <?php if($row['Approved'] == 'No'){ echo "style='color:red;'"; } ?> onclick="window.open('memberamend.php?edit=<?php echo $id;?>', 'child', 'height=500,width=600,status=yes,resizable=yes,scrollbars=yes')">
				<td><?php if($row['Image_Path'] == ''){echo 'NO PHOTO AVAILABLE';}else{?><img src="../member/images/<?php echo $row['Image_Path'];?>" alt="<?php echo $row['Forename'];?>" border='0' height='50' /><?php }?></td>
				<?php
				foreach($fieldname as $field)
				{
					if($field!='ID' && $field!='Approved' && $field!='Image_Path')
					{?>
						<td <?php if($field=='Height' || $field=='Profession' || $field=='DietaryReq' || $field=='Interests'){echo "nowrap='nowrap'";}
						if($field=='DietaryReq' || $field=='Interests')
						{
							$row[$field] = wordwrap($row[$field], 30, "<br />\n");
						}?>><?php echo $row[$field];?></td>
			<?php	}
				} ?>
			</tr>
  <?php	}
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
</script>
</body>
</html>