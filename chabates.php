<?php
include "scripts/mysql.php";
include "scripts/global.php";
date_default_timezone_set('America/Chicago');
$year = date("Y");
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
$cid = $_GET['chabateid'];
if(is_numeric($cid)=='TRUE')
{
  $cidval = '1';
}else{
$cidval = '0';
header('location:index.php');
}

$sr = $_GET['sr'];
$rc = $_GET['rc'];
$clc = "45";
if($sr < '1')
{
$sr = '0';
}
if($rc < '1')
{
$rc = '30';
}
$sql1a = "SELECT `id` FROM `".$cid."`";
$query1a = mysqli_query($sqlcxn,$sql1a);
if ($query1a) {
$rowcheck1a = mysqli_num_rows($query1a);
} 
$sql1 = "SELECT `title` FROM `questions` WHERE `id` = '".$cid."' ";
$query1 = mysqli_query($sqlcxn,$sql1);
$rowcheck1 = mysqli_num_rows($query1);
$sql1b = "SELECT `id` FROM `questions` ";
$query1b = mysqli_query($sqlcxn,$sql1b);
$rowcheck1b = mysqli_num_rows($query1b);
if($rowcheck1<'1')
{
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="chabate, social chats and debates, debate, debate topics, controversy, social, chat, social networking, " />
<meta name="description" content="A chabate is a user created topic that is open to the public for you or other users to post comments or debate their side of the topic." />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php
echo $metaog;
?>
<title>Social Chats and Debates</title>
<link href="http://fonts.googleapis.com/css?family=Arvo" rel="stylesheet" type="text/css" />
<link href="http://fonts.googleapis.com/css?family=Coda:400,800" rel="stylesheet" type="text/css" />
<link href="scripts/cstyle.css?<?php echo rand(0,99999);?>" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="scripts/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="scripts/mootools-core-1.4.2.js"></script>
<script type="text/javascript" src="scripts/mootools-more-1.4.0.1.js"></script>
<script type="text/javascript" src="scripts/PopUpWindow.js"></script>
<script>
 $(document).ready(function() {
 	 $("#currentchabate").load("currentchabate.php?id=<?php echo $cid; ?>&fbid=<?php echo $user_id; ?>&sr=<?php echo $sr; ?>&rc=<?php echo $rc; ?>");
   var refreshId = setInterval(function() {
      $("#currentchabate").load('currentchabate.php?id=<?php echo $cid; ?>&fbid=<?php echo $user_id; ?>&sr=<?php echo $sr; ?>&rc=<?php echo $rc; ?>');
   }, 9000000);
   $.ajaxSetup({ cache: false });
});
</script>
<script>
 $(document).ready(function() {
 	 $("#chabatelist").load("chabatelist.php");
   var refreshId = setInterval(function() {
      $("#chabatelist").load('chabatelist.php');
   }, 900000000);
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
	                            -->
</script>
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
						<b>CHABATES</b>
					</div>
					<div class="post">
<?php
$co = $_GET['co'];
echo "<table cellpadding=\"5\"><tr><td><b>Order By:</b></td>\n";
if($co === '1')
{
echo "<td class=\"active\"><a href=\"chabates.php?co=1\"><b>Latest Activity</b></a></td>\n";
}
else
	{
		echo "<td><a href=\"chabates.php?co=1\"><b>Latest Activity</b></a></td>\n";
	}
if($co === '2')
{
echo "<td class=\"active\"><a href=\"chabates.php?co=2\"><b>Most Popular</b></a></td>\n";
}
else
	{
		echo "<td><a href=\"chabates.php?co=2\"><b>Most Popular</b></a></td>\n";
	}
if($co === '3')
{
echo "<td class=\"active\"><a href=\"chabates.php?co=3\"><b>Newest</b></a></td>\n";
}
else
	{
		echo "<td><a href=\"chabates.php?co=3\"><b>Newest</b></a></td>\n";
	}
		echo "<td><a href=\"categories.php\"><b>Category</b></a></td>\n";
echo "</table><br/>\n";
if($co === '1')
{
$sql7 = "SELECT `id`,`title` FROM `questions` ORDER BY `lcdate` DESC LIMIT ".$clc."";
}
elseif($co === '2')
{
$sql7 = "SELECT `id`,`title` FROM `questions` ORDER BY `posts` DESC LIMIT ".$clc."";
}
elseif($co === '3')
{
$sql7 = "SELECT `id`,`title` FROM `questions` ORDER BY `date` DESC LIMIT ".$clc."";
}
else
{
$sql7 = "SELECT `id`,`title` FROM `questions` ORDER BY `id` DESC LIMIT ".$clc."";
}
$query7 = mysqli_query($sqlcxn,$sql7);
echo "<table cellpadding=\"5\">";
$i = '1';
while($row7 = mysqli_fetch_array($query7))
{
$id7 = $row7['id'];
$title7 = $row7['title'];
$sql8 = "SELECT `id` FROM `".$id7."` WHERE `f` = '0'";
$query8 = mysqli_query($sqlcxn,$sql8);
$nrows8 = mysqli_num_rows($query8);
if($nrows8<'1')
{
$nrows8 = '0';
}
if($i %2 != 0)
{
echo "<tr><td bgcolor=\"#ededed\"><a href=\"chabates.php?chabateid=".$id7."&sr=0&rc=30\"><div style=\"height:100%;width:100%\">".$title7." (".$nrows8.")</div></a></td></tr>\n";
}
else
{
echo "<tr><td><a href=\"chabates.php?chabateid=".$id7."&sr=0&rc=30\"><div style=\"height:100%;width:100%\">".$title7." (".$nrows8.")</div></a></td></tr>\n";
}
$i++;
}
echo "</table>";
if($sr>'1')
{
$psr = $sr - $rc;
echo "<a href=\"chabates.php?sr=".$psr."&rc=".$rc."\"><img align=\"left\" src=\"images/buttons/prev.png\" alt=\"Previous Arrow\"></a>";
}
$er = $sr + $rc;
if($rowcheck1b>$er)
{
$nsr = $sr + $rc;
echo "<a href=\"chabates.php?sr=".$nsr."&rc=".$rc."\"><img align=\"right\" src=\"images/buttons/next.png\" alt=\"Next Arrow\"></a>";
}
?>
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
else {
while($row1 = mysqli_fetch_array($query1))
{
$currentchabate = $row1['title'];
}
//If Not Logged in
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="chabate, social chats and debates, debate, debate topics, controversy, social, chat, social networking, " />
<meta name="description" content="A chabate is a user created topic that is open to the public for you or other users to post comments or debate their side of the topic." />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php
echo $metaog;
?>
<title>Social Chats and Debates</title>
<link href="http://fonts.googleapis.com/css?family=Arvo" rel="stylesheet" type="text/css" />
<link href="http://fonts.googleapis.com/css?family=Coda:400,800" rel="stylesheet" type="text/css" />
<link href="scripts/style.css?<?php echo rand(0,99999);?>" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="scripts/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="scripts/mootools-core-1.4.2.js"></script>
<script type="text/javascript" src="scripts/mootools-more-1.4.0.1.js"></script>
<script type="text/javascript" src="scripts/PopUpWindow.js"></script>
<script>
 $(document).ready(function() {
 	 $("#currentchabate").load("currentchabate.php?id=<?php echo $cid; ?>&fbid=<?php echo $user_id; ?>&sr=<?php echo $sr; ?>&rc=<?php echo $rc; ?>");
   var refreshId = setInterval(function() {
      $("#currentchabate").load('currentchabate.php?id=<?php echo $cid; ?>&fbid=<?php echo $user_id; ?>&sr=<?php echo $sr; ?>&rc=<?php echo $rc; ?>');
   }, 9000000);
   $.ajaxSetup({ cache: false });
});
</script>
<script>
 $(document).ready(function() {
 	 $("#chabatelist").load("chabatelist.php");
   var refreshId = setInterval(function() {
      $("#chabatelist").load('chabatelist.php');
   }, 9000000);
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
	                            -->
</script>
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
						<center><b>CHABATES</b></center>
					</div>
					<div class="post">
<?php
$sql7 = "SELECT `id`,`title` FROM `questions` ORDER BY `id` DESC LIMIT ".$clc."";
$query7 = mysqli_query($sqlcxn,$sql7);
while($row7 = mysqli_fetch_array($query7))
{
$id7 = $row7['id'];
$title7 = $row7['title'];
$sql8 = "SELECT `id` FROM `".$id7."`";
$query8 = mysqli_query($sqlcxn,$sql8);
$nrows8 = mysqli_num_rows($query8);
if ($nrows8 < '1')
{
$nrows8 = "0";
}
echo "<li><a href=\"chabates.php?chabateid=".$id7."&sr=0&rc=30\">".$title7." (".$nrows8.")</a></li><br/>\n";
}
?>
					</div>
				</div>
<div id="contentright">
					<div class="post">
<?php 
echo "<b>".$currentchabate."</b>";
?>
					</div>
					<div class="post">
<div id="currentchabate"></div>
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
echo "<li><a href=\"categories.php?categoryid=".$id4."\">".$cat4."</a></li>";
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