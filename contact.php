<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Asian Dinner Club - for Single Asian Professionals :: contact us ::  Asian Dinner Club</title>
<meta name="description" content=" Asian Dinner Club, for Single Asian Professionals" />
<meta name="keywords" content="Indian, dating, party, London, Matchmaking, Asian matchmaking, Shaadi, restaurants, events, Asian Dinner Club, Asia dinner club, Indian dinner club, Supper club, Asian events, Asian dating, Asian speedating, Asian speeddating, Chillitickets, Asiana, Dating events london, Singles events asian, Singles events london, Single solution, Hindu events, Sikh events, muslim dating, Hindu dating, Sikh dating, Dinner clubs, Top table, Dinner parties, Dinner dates, Quaglinos, Asia de cuba, Asian Dinner Club, Tantric Club, Asiand8" />
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
<div id="logo"><a href="http://www.asiandinnerclub.com/" target="_self"><img src="images/logo.gif" alt="Asian Dinner Club" /></a></div>
<div id="navigation">
<ul>
<li><a href="http://www.asiandinnerclub.com/" target="_self">HOME</a></li>
<li class="topnav" ><a href="aboutus.php" target="_self">ABOUT<br/>US</a></li>
<li><a href="events.php" target="_self">CURRENT<br/>EVENTS</a></li>
<li><a href="past_events.php" target="_self">PAST<br/>EVENTS</a></li>
<li><a href="membership.php" target="_self">MEMBERSHIP</a></li>
<li><a href="press.php" target="_self">PRESS</a></li>
<li><a class="active" href="contact.php" target="_self">CONTACT</a></li>
</ul>
</div>
</div>
<div id="maincontent">
<div id="innercontent">

<!-- main content area -->




	<div id="contentcol1">

		<h1><img src="images/contact_us.gif" alt="Contact Us" width="181" height="50"/></h1>
	    <p><strong><span class="righthandpic"><img src="images/asian_dinner_1.jpg" alt="Asian Dinner Club contact" width="250" height="250" /></span></strong>
	    <table width="296" height="59" border="0" cellpadding="0" cellspacing="0">
          <tr align="left" valign="top">
            <td>For all enquiries please contact us via email at <a href="mailto:info@asiandinnerclub.com">info@asiandinnerclub.com</a></td>
          </tr>
        </table>
	    <p> <br>
        <br>
        </p>
	    <p>&nbsp;</p>
	    <p>&nbsp;</p>
	    <p>&nbsp;</p>
	    <p>&nbsp;</p>
	    <p>&nbsp;</p>
	    <p>&nbsp;</p>
	    <p>&nbsp;</p>
	    <p>&nbsp;</p>
	    </p>
</div>

<div id="contentcol2">
  <span class="lefthandpic"><img src="images/side.jpg" alt="Asian Dinner Club" width="194" height="194" /></span>
  <?php
     include('database/databaseconnect.php');
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

  	 $query = "SELECT * FROM LoveItems LIMIT $firstid, 10";
  	 $result = mysql_query($query) or die(mysql_error());
  	 ?>
  	 <span class='lefthandpic'>
  	 <br/>
  	 &nbsp;<img src="images/adclovessmall.gif" alt="Asian Dinner Club Loves" width="190" />
  	 &nbsp;<marquee behaviour='scroll' direction='up' scrollamount='1' width='180' style='border:1px solid #FF00FF;'>
  	 <?php
  	 $i = 1;
  	 while($row = mysql_fetch_array($result))
  	 {
  			$id = $row['ID'];
  			$title = $row['Title'];
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
</div>
</body>
</html>