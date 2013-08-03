<?php include 'database/databaseconnect.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Asian Dinner Club - for Single Asian Professionals :: past events ::  Asian Dinner Club</title>
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
<li><a class="active" href="past_events.php" target="_self">PAST<br/>EVENTS</a></li>
<li><a href="membership.php" target="_self">MEMBERSHIP</a></li>
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
.style1 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>
















	<div id="contentcol1">

		<h1><img src="images/past_events.gif" alt="Past Events" width="210" height="50"/></h1>

     	<?php 	$query = "SELECT * FROM Events WHERE Date < CURDATE() ORDER BY Date DESC";
     			$result = mysql_query($query) or die(mysql_error());
     			if(mysql_num_rows($result)!=0)
     			{
     				while($row = mysql_fetch_array($result))
     				{?>
                       <div>
                         <p><span class="righthandpic"><a name="<?php echo $row['Venue'];?>" id="<?php echo $row['Venue'];?>"></a><img src="images/<?php echo $row['Image_Path'];?>" alt="<?php echo $row['Venue'];?>" width="188" height="168" border='0' /></span></p>
                         <table width="390" height="112" border="0" cellpadding="0" cellspacing="0">
                           <tr>
                             <th width="88" align='left'>Venue:</th>
                             <td width="10">&nbsp;</td>
                             <th width="252" align='left'><?php echo $row['Venue'];?></th>
                           </tr>
                           <tr>
						                                <td>&nbsp;</td>
						                                <td>&nbsp;</td>
						                                <td>&nbsp;</td>
                           </tr>
                           <tr>
							<th width="88" align='left'>Event Type:</th>
							<td width="10">&nbsp;</td>
							<td><?php echo $row['Event_Type'];?></td>
                           </tr>
                           <tr>
						                                <td>&nbsp;</td>
						                                <td>&nbsp;</td>
						                                <td>&nbsp;</td>
                           </tr>
						   <!--<tr>
							<th width="88" align='left'>City:</th>
							<td width="10">&nbsp;</td>
							<td><?php echo $row['City'];?></td>
                           </tr>
                           <tr>
						                                <td>&nbsp;</td>
						                                <td>&nbsp;</td>
						                                <td>&nbsp;</td>
                           </tr>-->
						    <tr>
								<th width="88" align='left'>Member Type:</th>
								<td width="10">&nbsp;</td>
								<td><?php if($row['Member_Type'] == ''){echo 'All';}else{echo $row['Member_Type'];}?></td>
                            </tr>
                            <tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
                           </tr>
                           <tr>
                             <th align='left'>Address:</th>
                             <td>&nbsp;</td>
                             <td><?php echo $row['Address_Street'];?></td>
                           </tr>
                           <?php if($row['Address_Town'] != '')
                           {?>
                           <tr>
                             <td>&nbsp;</td>
                             <td>&nbsp;</td>
                             <td><?php echo $row['Address_Town'];?></td>
                           </tr>
                           <?php }
                           if($row['Address_City'] != '')
                           {?>
                           <tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td><?php echo $row['Address_City'];?></td>
                           </tr>
                           <?php } ?>
                           <tr>
							 <td>&nbsp;</td>
							 <td>&nbsp;</td>
							 <td><?php echo $row['Address_PostCode'];?></td>
                           </tr>
                           <tr>
                             <td>&nbsp;</td>
                             <td>&nbsp;</td>
                             <?php 	if(stristr($row['Address_PostCode'], ' '))
									{
										$post = str_replace(' ', '+', $row['Address_PostCode']);
									}
									else
									{
										$post = $row['Address_PostCode'];
							  		}?>
                             <td><a style='text-decoration:none;' href="http://maps.google.co.uk/maps?f=q&hl=en&geocode=&q=<?php echo $post;?>" target="_blank">google map</a></td>
                           </tr>
                           <tr>
                             <td>&nbsp;</td>
                             <td>&nbsp;</td>
                             <td>&nbsp;</td>
                           </tr>
                           <tr>
                             <th align='left'>Date:</th>
                             <td>&nbsp;</td>
                             <?php $date = date('jS F Y', strtotime($row['Date']));?>
							 <td><?php echo $date;?></td>
                           </tr>
                           <tr>
						                                <td>&nbsp;</td>
						                                <td>&nbsp;</td>
						                                <td>&nbsp;</td>
                           </tr>
                           <tr>
                             <th align='left'>Price:</th>
                             <td>&nbsp;</td>
                             <td>&pound;<?php echo $row['Price'];?> per person </td>
                           </tr>
                           <tr>
                             <td>&nbsp;</td>
                             <td>&nbsp;</td>
                             <td>&nbsp;</td>
                           </tr>
                         </table>
                       </div>
                       <p><hr/></p>
                   <?php } }?>
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

	 	 $query2 = "SELECT * FROM LoveItems LIMIT $firstid, 10";
	 	 $result2 = mysql_query($query2) or die(mysql_error());
	 	 ?>
	 	 <span class='lefthandpic'>
	 	 <br/>
	 	 &nbsp;<img src="images/adclovessmall.gif" alt="Asian Dinner Club Loves" width="190" />
	 	 &nbsp;<marquee behaviour='scroll' direction='up' scrollamount='1' width='180' style='border:1px solid #FF00FF;'>
	 	 <?php
	 	 $i = 1;
	 	 while($row2 = mysql_fetch_array($result2))
	 	 {
	 			$id = $row2['ID'];
	 			$title = $row2['Title'];
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