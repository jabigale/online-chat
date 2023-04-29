<?php
include "scripts/mysql.php";
include "scripts/global.php";
$s = $_GET['s'];
session_start();
if(isset($_GET['logout'])&&$_GET['logout']=='1')
{
	session_destroy();
	header('location:https://www.whatcomputertobuy.com/chabate/');
}
//Get Logged in Value

if(session_status() === PHP_SESSION_ACTIVE && $_SESSION['login'] == '1')
{
    $userid = $_SESSION['userid'];
    $sth2 = $dbh->prepare('SELECT `name`,`avatar`,`userid`,`validated`,`usalt` FROM `users` WHERE `userid` = :userid');
    $sth2->bindParam(':userid',$userid);
    $sth2->execute();
    $results2 = $sth2->fetch(PDO::FETCH_ASSOC);
    if(!$results2){
    $loggedin = "0";
    }
    else{
    $currentname = $results2['name'];
    $currentavatar = $results2['avatar'];
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

  require_once('scripts/facebook/facebook.php');
  $config = array(
    'appId' => '1405400109698336',
    'secret' => '6cb5f19dacd595a15b1ab7a514f16d62',
    'allowSignedRequest' => false // optional but should be set to false for non-canvas apps
  );
  $facebook = new Facebook($config);
  $user_id = $facebook->getUser();
    if($user_id) { 
      // We have a user ID, so probably a logged in user.
      // If not, we'll get an exception, which we handle below.
      try {
        $user_profile = $facebook->api('/me','GET');
        $username = $user_profile['name'];
      } catch(FacebookApiException $e) {
        // If the user is logged out, you can have a 
        // user ID even though the access token is invalid.
        // In this case, we'll get an exception, so we'll
        // just ask the user to login again here.
        $login_url = $facebook->getLoginUrl(); 
        echo 'Please <a href="' . $login_url . '">login.</a>';
        error_log($e->getType());
        error_log($e->getMessage());
      }
  ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Social Chats and Debates</title>
<link href="http://fonts.googleapis.com/css?family=Arvo" rel="stylesheet" type="text/css" />
<link href="http://fonts.googleapis.com/css?family=Coda:400,800" rel="stylesheet" type="text/css" />
<link href="scripts/searchstyle.css?<?php echo rand(0,99999);?>" rel="stylesheet" type="text/css" media="screen" />
<script src="scripts/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="scripts/mootools-core-1.4.2.js"></script>
<script type="text/javascript" src="scripts/mootools-more-1.4.0.1.js"></script>
<script type="text/javascript" src="scripts/PopUpWindow.js"></script>
</head>
<body>
	<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
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
			<a href="http://www.whatcomputertobuy.com/chabate/"><img src="images/logos/cblogo400.jpg" width="218" alt="Chabate Logo"></a>
		</div>
<div id="logoads">
<?php
echo $dispad;
?>
</div>
	</div>
</div>
	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="content">
					<div class="post">
						<h2 class="title">SEARCH RESULTS</h2>
					</div>
					<div class="post">
<?php   
    
$s1 = '%'.$s.'%';
$sql1 = $dbh->prepare('SELECT `id`,`title` FROM `questions` WHERE `title` LIKE :s');
$sql1->bindParam(':s',$s1);
$sql1->execute();
$row1 = $sql1->fetch(PDO::FETCH_ASSOC);
{
$title = $row1['title'];
$cid = $row1['id'];
$sql1a = "SELECT `id` FROM `".$cid."`";
$query1a = mysqli_query($sqlcxn,$sql1a);
$nrows1a = mysqli_num_rows($query1a);
if ($nrows1a < '1')
{
$nrows1a = "0";
}

echo "<a href=\"chabates.php?chabateid=".$cid."&sr=0&rc=30\">".$title." (".$nrows1a.")</a>\n<br/><br/><br/>\n";
}
?>

<div id="latestchabate"></div>
						<h2 class="title"><a href="#"></a></h2>
						<div class="entry">
						</div>
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
$sql5 = "SELECT `id`,`category` FROM `categories` ORDER BY `category` ASC";
$query5 = mysqli_query($sqlcxn,$sql5);
while($row5 = mysqli_fetch_array($query5))
{
$id5 = $row5['id'];
$cat5 = $row5['category'];
echo "<li><a href=\"category.php?categoryid=".$id5."\">".$cat5."</a></li>";
}
?>				
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
<div id="footer">
	<p>Copyright (c) <?php echo $year; ?> chabate. All rights reserved.</p>
</div>
</body>
</html>
<?php
    } else {
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Social Chats and Debates</title>
<link href="http://fonts.googleapis.com/css?family=Arvo" rel="stylesheet" type="text/css" />
<link href="http://fonts.googleapis.com/css?family=Coda:400,800" rel="stylesheet" type="text/css" />
<link href="scripts/searchstyle.css?<?php echo rand(0,99999);?>" rel="stylesheet" type="text/css" media="screen" />
<script src="scripts/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="scripts/mootools-core-1.4.2.js"></script>
<script type="text/javascript" src="scripts/mootools-more-1.4.0.1.js"></script>
<script type="text/javascript" src="scripts/PopUpWindow.js"></script>
<script>
 $(document).ready(function() {
 	 $("#hotestchabate").load("hotestchabate.php?id=<?php echo $hotestid; ?>");
   var refreshId = setInterval(function() {
      $("#hotestchabate").load('hotestchabate.php?id=<?php echo $hotestid; ?>');
   }, 60000);
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
   }, 60000);
   $.ajaxSetup({ cache: false });
});
</script>

</head>
<body>
	<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
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
			<a href="http://www.whatcomputertobuy.com/chabate/"><img src="images/logos/cblogo400.jpg" width="218" alt="Chabate Logo"></a>
		</div>
<div id="logoads">
<?php
echo $dispad;
?>
</div>
	</div>
</div>
	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="content">
					<div class="post">
						<h2 class="title">Search Results</h2>
					</div>
					<div class="post">
<?php
$s1 = '%'.$s.'%';
$sql1 = $dbh->prepare('SELECT `id`,`title` FROM `questions` WHERE `title` LIKE :s');
$sql1->bindParam(':s',$s1);
$sql1->execute();
while($row1 = $sql1->fetch(PDO::FETCH_ASSOC))
{
$title = $row1['title'];
$cid = $row1['id'];
$sql1a = "SELECT `id` FROM `".$cid."`";
$query1a = mysqli_query($sqlcxn,$sql1a);
$nrows1a = mysqli_num_rows($query1a);
if ($nrows1a < '1')
{
$nrows1a = "0";
}

echo "<a href=\"chabates.php?chabateid=".$cid."&sr=0&rc=30\">".$title." (".$nrows1a.")</a>\n<br/><br/><br/>\n";
}
?>

<div id="latestchabate"></div>
						<h2 class="title"><a href="#"></a></h2>
						<div class="entry">
						</div>
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
echo "<li><a href=\"category.php?categoryid=".$id4."\">".$cat4."</a></li>";
}
?>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
<div id="footer">
	<p>Copyright (c) <?php echo $year; ?> chabate. All rights reserved.</p>
</div>
</body>
</html>
<?php
}
?>