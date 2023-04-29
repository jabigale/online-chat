<?php
// Include the mobile device detect class
include 'scripts/mobiledetect.php';
// Init the class
$detect = new Mobile_Detect();
$checkfb = '0';
$loggedin = '0';
session_start();
// And here is the magic - checking if the user comes with a mobile device
if ($detect->isMobile()) {
    // Detects any mobile device.
    // Redirecting
    header("Location: https://www.whatcomputertobuy.com/chabate/mobile/"); exit;
}
include "scripts/mysql.php";
include "scripts/global.php";

//Logout
if(isset($_GET['logout'])&&$_GET['logout']=='1')
{
	session_destroy();
	header('location:https://www.whatcomputertobuy.com/chabate/');
}
//Get Logged in Value

if(session_status() === PHP_SESSION_ACTIVE && $_SESSION['login'] == '1')
{
    $userid = $_SESSION['userid'];
    $sth2 = $dbh->prepare('SELECT `name`,`avatar`,`fbid`,`userid`,`validated`,`usalt` FROM `users` WHERE `userid` = :userid');
    $sth2->bindParam(':userid',$userid);
    $sth2->execute();
    $results2 = $sth2->fetch(PDO::FETCH_ASSOC);
    if(!$results2){
    $loggedin = "0";
    }
    else{
    $currentname = $results2['name'];
    $currentavatar = $results2['avatar'];
    $currentfbid = $results2['fbid'];
    $isvalidated = $results2['validated'];
    if($isvalidated<'1')
    {
        $isvalidated = '0';
    }
    $loggedin = "1";
    }
}
else{
	$header = 'Location: login.php';
	header($header);
}



$sql1 = "SELECT `id`,`title` FROM `questions` ORDER BY `date` DESC LIMIT 1";
$query1 = mysqli_query($sqlcxn,$sql1);
while($row1 = mysqli_fetch_array($query1))
{
$latestchabate = $row1['title'];
$latestid = $row1['id'];
}
$sql2 = "SELECT `id`,`title` FROM `questions` ORDER BY `posts` DESC LIMIT 1";
$query2 = mysqli_query($sqlcxn,$sql2);
while($row2 = mysqli_fetch_array($query2))
{
$hotestchabate = $row2['title'];
$hotestid = $row2['id'];
}
if($hotestid ===$latestid)
{
$sql1 = "SELECT `id`,`title` FROM `questions` ORDER BY `date` DESC LIMIT 1,1";
$query1 = mysqli_query($sqlcxn,$sql1);
while($row1 = mysqli_fetch_array($query1))
{
$latestchabate = $row1['title'];
$latestid = $row1['id'];
}
}
$cid = $_GET['chabateid'];
$sql1a = "SELECT `id` FROM `".$latestid."`";
$query1a = mysqli_query($sqlcxn,$sql1a);
$rowcheck1a = mysqli_num_rows($query1a);
$sql2a = "SELECT `id` FROM `".$hotestid."`";
$query2a = mysqli_query($sqlcxn,$sql2a);
$rowcheck2a = mysqli_num_rows($query2a);


if($loggedin > '0')
{
if(isset($_POST['lcsubmit']))
{
$lcpost = $_POST['lcpost'];
$checkfb = $_POST['lcfb'];
$lctbl = $_POST['lcid'];
$fbid = $_POST['fbid'];
$fblink = "https://www.whatcomputertobuy.com/chabate/fblink.php?t=".$lctbl;
$csql3 = "SELECT `p` FROM `".$lctbl."` ORDER BY `id` DESC LIMIT 1";
$cquery3 = mysqli_query($sqlcxn,$csql3);
while($crow3 = mysqli_fetch_array($cquery3))
{
$cp3 = $crow3['p'];
}
if($lcpost === "Add a comment")
{
		header("Location: https://www.whatcomputertobuy.com/chabate/");
}
else if($cp3 === $lcpost)
{
		header("Location: https://www.whatcomputertobuy.com/chabate/");
}
else
{

$sql3 = "INSERT INTO `".$lctbl."` (`u`, `p`, `fid`) VALUES (:username, :lcpost, :fbid)";
      // Prepare the SQL query
$sth3 = $dbh->prepare($sql3);
      // Bind parameters to statement variables
$sth3->bindParam(':username', $currentid);
$sth3->bindParam(':lcpost', $lcpost);
$sth3->bindParam(':fbid', $fbid);
      // Execute statement
$sth3->execute();


$sql6 = "UPDATE `questions` SET `posts` = `posts` + 1,`lcdate` = '".time()."' WHERE `id` = '".$hctbl."'";
$query6 = mysqli_query($sqlcxn,$sql6);
$fbpost = "fbpost.php?t=".$lctbl."&f=".$fbid."&p=1";

}
}
if(isset($_POST['hcsubmit']))
{
$hcpost = $_POST['hcpost'];
$checkfb = $_POST['hcfb'];
$hctbl = $_POST['hcid'];
$fbid = $_POST['fbid'];
$hcfblink = "https://www.whatcomputertobuy.com/chabate/fblink.php?t=".$hctbl;
$csql4 = "SELECT `p` FROM `".$hctbl."` ORDER BY `id` DESC LIMIT 1";
$cquery4 = mysqli_query($sqlcxn,$csql4);
while($crow4 = mysqli_fetch_array($cquery4))
{
$cp4 = $crow4['p'];
}
if($hcpost === "Add a comment")
{
		header("Location: https://www.whatcomputertobuy.com/chabate/");
}
else if($cp4 === $hcpost)
{
		header("Location: https://www.whatcomputertobuy.com/chabate/");
}
else
{
$sql4 = "INSERT INTO `".$hctbl."` (`u`, `p`, `fid`) VALUES (:username, :hcpost, :fbid)";
      // Prepare the SQL query
$sth4 = $dbh->prepare($sql4);
      // Bind parameters to statement variables
$sth4->bindParam(':username', $currentid);
$sth4->bindParam(':hcpost', $hcpost);
$sth4->bindParam(':fbid', $fbid);
      // Execute statement
$sth4->execute();


$sql6 = "UPDATE `questions` SET `posts` = `posts` + 1,`lcdate` = '".time()."' WHERE `id` = '".$hctbl."'";
$query6 = mysqli_query($sqlcxn,$sql6);
$fbpost = "fbpost.php?t=".$hctbl."&f=".$fbid."&p=1";
}
}
if(isset($_POST['cpost']))
{
$cpost = $_POST['cpost'];
if($cpost === "comment")
{
header('Location:https://www.whatcomputertobuy.com/chabate');
}
else
{
$hcfb = $_POST['hcfb'];
$cpid = $_POST['cpid'];
$qid = $_POST['qid'];
$ctbl = "c".$qid;
$cfblink = "https://www.whatcomputertobuy.com/chabate/fblink.php?t=".$ctbl;
if($hcfb === '1')
{
$ret_obj = $facebook->api('/me/feed', 'POST',
                                    array(
                                      'link' => $hcfblink,
                                      'message' => $ccpost
                                 ));
}

$sql4a = "INSERT INTO `".$ctbl."` (`u`,`p`,`fid`,`pid`) VALUES ('".$currentid."','".$cpost."','".$user_id."','".$cpid."')";
$query4a = mysqli_query($sqlcxn,$sql4a);

}
}
}
  ?>
<!DOCTYPE html>
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="chabate, social chats and debates, debate, debate topics, controversy, social, chat, social networking, " />
<meta name="description" content="A chabate is a user created topic that is open to the public for you or other users to post comments or debate their side of the topic. Chabate reawards users with prizes" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php
echo $metaog;
?>
<title>Social Chats and Debates</title>
<link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Coda:400,800" rel="stylesheet" type="text/css" />
<link href="scripts/style.css?<?php echo rand(0,99999);?>" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="scripts/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="scripts/mootools-core-1.4.2.js"></script>
<script type="text/javascript" src="scripts/mootools-more-1.4.0.1.js"></script>
<script type="text/javascript" src="scripts/PopUpWindow.js"></script>
<script>
 $(document).ready(function() {
 	 $("#hotestchabate").load("hotestchabate.php?id=<?php echo $hotestid; ?>");
   var refreshId = setInterval(function() {
      $("#hotestchabate").load('hotestchabate.php?id=<?php echo $hotestid; ?>');
   }, 120000);
   $.ajaxSetup({ cache: false });
});
</script>
<script type="text/javascript">
<!--  to hide script contents from old browsers
		function clearField(t) {
	                            if (t.defaultValue == t.value) t.value='';
	                            }
                function restoreField(t) {	
	                            if (t.value == '') t.value=t.defaultValue;
	                            }
</script>
<script>
 $(document).ready(function() {
 	 $("#latestchabate").load("latestchabate.php?id=<?php echo $latestid; ?>");
   var refreshId = setInterval(function() {
      $("#latestchabate").load('latestchabate.php?id=<?php echo $latestid; ?>');
   }, 120000);
   $.ajaxSetup({ cache: false });
});
</script>
<?php
if ($checkfb === '1')
{
?>
<script type="text/javascript">
        $.ajax({
            type: 'POST',
            url: '<?php echo $fbpost; ?>',
            data: 'id=someid',
});
</script>
<?php
}
?>
</head>
<body>
<div id="menu-wrapper">
	<div id="menu">
		<ul>
<?php
echo $menulist;
?>
		</ul>
	</div>
</div>
<div id="header-wrapper">
	<div id="header">
		<div id="logo">
			<a href="https://www.whatcomputertobuy.com/chabate/"><img src="images/logos/cblogo400.jpg" width="218" alt="Chabate Logo"></a>
		</div>
<div id="logoads">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- chabate -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-2057589821822878"
     data-ad-slot="7732402849"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
	</div>
</div>
	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="contentright">
					<div class="post">
						<h2 class="title">Latest Chabate</h2>
					</div>
					<div class="post">
<?php
if($loggedin > '0')
{
?>
<table><tr bgcolor="#f7f7f7"><td>
<?php
echo "<img src=\"https://graph.facebook.com/".$user_id."/picture\">";
?>
</td><td>
<form name="latestchabate" method="post" action="index.php">
<pre></pre>
<textarea rows="2" name="lcpost" class="styleinput" onfocus="clearField(this);" onblur="restoreField(this);">Add a comment</textarea><br>
<input type="checkbox" name="lcfb" id="lcfb" value="1" checked="checked"><label for="lcfb"><font size="0.9em" color="grey">Post to Facebook&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></label>
<script type='text/javascript'>
  $(function() {
    $('textarea').autogrow();
  });
</script>
<input type="hidden" name="lcsubmit" value="lcsubmit">
<?php
echo "<input type=\"hidden\" name=\"fbid\" value=\"".$user_id."\">";
echo "<input type=\"hidden\" name=\"lcid\" value=\"".$latestid."\">";
?>
<input type="image" src="images/buttons/post.png">
</form>
</td></tr>
<tr><td>&nbsp;</td></tr></table>
<?php
}
else {
      echo '<a href="#"><img src="images/buttons/fblogin.png" width="250" border=\"0\"></a><br /><br /><br />';
}
echo "<b>".$hotestchabate."</b>";
?>
<div id="hotestchabate"></div>
					</div>
				</div>
								<div id="content">
					<div class="post">
						<h2 class="title">Hotest Chabate</h2>
					</div>
					<div class="post">
<?php
if($loggedin > '0')
{
?>
<table><tr bgcolor="#f7f7f7"><td>
<?php
echo "<img src=\"https://graph.facebook.com/".$user_id."/picture\">";
?>
</td><td>
<form name="hotestchabate" method="post" action="index.php">
<pre></pre>
<textarea rows="2" name="hcpost" class="styleinput" onfocus="clearField(this);" onblur="restoreField(this);">Add a comment</textarea><br>
<input type="checkbox" name="hcfb" id="hcfb" value="1" checked="checked"><label for="hcfb"><font size="0.9em" color="grey">Post to Facebook&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></label>
<script type='text/javascript'>
  $(function() {
    $('textarea').autogrow();
  });
</script>
<input type="hidden" name="hcsubmit" value="hcsubmit">
<?php
echo "<input type=\"hidden\" name=\"fbid\" value=\"".$user_id."\">";
echo "<input type=\"hidden\" name=\"hcid\" value=\"".$hotestid."\">";
?>
<input type="image" src="images/buttons/post.png">
</form>
</td></tr>
<tr><td>&nbsp;</td></tr></table>
<?php	
}
else {
      echo '<a href="login.php"><img src="images/buttons/emlogin.png" width="250" border=\"0\"></a><br /><br /><br />';
}
echo "<b>".$latestchabate."</b>";
?>
<div id="latestchabate"></div>
					</div>
				</div>
				<div id="sidebar">
					<ul>
						<li>
							<h2>Search:</h2>
							<div id="search" >
								<form method="get" action="searchchabates.php">
									<div>
										<input type="text" name="s" id="search-text" value="" />
										<input type="submit" id="search-submit" value="" />
									</div>
								</form>
							</div>
							<div style="clear: both;">&nbsp;</div>
						</li>
						<li>
							<h2>Categories</h2>
							<ul>
<?php
$sql4 = "SELECT `id`,`category` FROM `categories` ORDER BY `category` ASC";
$query4 = mysqli_query($sqlcxn,$sql4);
while($row4 = mysqli_fetch_array($query4))
{
$id4 = $row4['id'];
$cat4 = $row4['category'];
echo "<li><a href=\"categories.php?categoryid=".$id4."\">".$cat4."</a></li>";
}
?>
							</ul>
						</li>
					</ul>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- chabate-verticlelarge -->
<ins class="adsbygoogle"
     style="display:inline-block;width:160px;height:600px"
     data-ad-client="ca-pub-2057589821822878"
     data-ad-slot="7453201247"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
				</div>
			</div>
		</div>
	</div>
<div id="footer">
	<p>Copyright (c) <?php echo $year; ?> chabate. All rights reserved.</p>
</div>
</body>
</html>