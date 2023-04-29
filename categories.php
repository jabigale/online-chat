<?php
include "scripts/mysql.php";
include "scripts/global.php";
session_start();
if($_SESSION['login']=='1')
{
$catid = $_GET['categoryid'];
$catid2 = "cat".$catid;
$start = $_GET['sr'];
$count = $_GET['rc'];
$co = $_GET['co'];
$clc = '45';
if($start<'1')
{
	$start = '0';
}
if($count<'1')
{
	$count = '30';
}
$cid = $_GET['chabateid'];
  require_once('scripts/facebook/facebook.php');
  $config = array(
    'appId' => '1405400109698336',
    'secret' => '6cb5f19dacd595a15b1ab7a514f16d62',
    'allowSignedRequest' => false // optional but should be set to false for non-canvas apps
  );
  $facebook = new Facebook($config);
  $user_id = $facebook->getUser();
    if($user_id) {
    	$fbid = $user_id;
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
if($catid<'1')
{
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
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
 	 $("#currentchabate").load("currentchabate-c.php?cid=<?php echo $cid; ?>&id=<?php echo $fbid; ?>&sr=<?php echo $start; ?>&rc=<?php echo $count; ?>");
   var refreshId = setInterval(function() {
      $("#currentchabate").load('currentchabate-c.php?cid=<?php echo $cid; ?>&id=<?php echo $fbid; ?>&sr=<?php echo $start; ?>&rc=<?php echo $count; ?>');
   }, 9000000);
   $.ajaxSetup({ cache: false });
});
</script>
<script>
 $(document).ready(function() {
 	 $("#chabatelist").load("chabatelist.php");
   var refreshId = setInterval(function() {
      $("#chabatelist").load('chabatelist.php');
   }, 90000000);
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
					</div>
					<div class="post">
<table width="90%" cellpadding="5"><tr>
<?php
$sql5 = "SELECT `id`,`category` FROM `categories` ORDER BY `category` ASC";
$query5 = mysqli_query($sqlcxn,$sql5);
$i='1';
while($row5 = mysqli_fetch_array($query5))
{
$id5 = $row5['id'];
$cat5 = $row5['category'];
if($i %2 != 0)
{
echo "<td><a href=\"categories.php?categoryid=".$id5."\"><img src=\"/images/buttons/categories/".$id5.".png\" alt=\" ".$cat5."\"></a></td>";
}
else
{
echo "<td><a href=\"categories.php?categoryid=".$id5."\"><img src=\"/images/buttons/categories/".$id5.".png\" alt=\" ".$cat5."\"></a></td></tr><tr>";
}
$i++;
}
?>
</table>
<!---<br /><br /><a href="newcategory.php"><b>Suggest a New Category</b></a>--->
<br /><br />
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
if($id4 === $catid)
{
echo "<li class=\"active\"><a href=\"categories.php?categoryid=".$id4."\">".$cat4."</a></li>";
}
else
{
echo "<li><a href=\"categories.php?categoryid=".$id4."\">".$cat4."</a></li>";
}
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
if($cid<'1')
{
$sql1 = "SELECT `id`,`title` FROM `questions` WHERE `".$catid2."` = '1' ORDER BY `date` DESC LIMIT 1";
$query1 = mysqli_query($sqlcxn,$sql1);
while($row1 = mysqli_fetch_array($query1))
{
$currentchabate = $row1['title'];
$cid = $row1['id'];
}
}
else {
$sql1 = "SELECT `title` FROM `questions` WHERE `id` = '".$cid."'";
$query1 = mysqli_query($sqlcxn,$sql1);
while($row1 = mysqli_fetch_array($query1))
{
$currentchabate = $row1['title'];
}
}
$sql1a = "SELECT `id` FROM `".$cid."`";
$query1a = mysqli_query($sqlcxn,$sql1a);
$rowcheck1a = mysqli_num_rows($query1a);
if(isset($_POST['ccsubmit']))
{
$ccpost = $_POST['ccpost'];
$fbccpost = "\"".$_POST['ccpost']."\" on the Chabate: ".$currentchabate;
$checkfb = $_POST['ccfb'];
$fbid = $_POST['fbid'];
$fblink = "http://www.whatcomputertobuy.com/chabate/fblink.php?t=".$cctbl;
$csql4 = "SELECT `p` FROM `".$cid."` ORDER BY `id` DESC LIMIT 1";
$cquery4 = mysqli_query($sqlcxn,$csql4);
while($crow4 = mysqli_fetch_array($cquery4))
{
$cp4 = $crow4['p'];
}
if($ccpost === "Add a comment")
{
		header("Location: http://www.whatcomputertobuy.com/chabate/categories.php?categoryid=".$catid."&chabateid=".$cid."&sr=0&rc=30");
}
else if($cp4 === $ccpost)
{
		header("Location: http://www.whatcomputertobuy.com/chabate/categories.php?categoryid=".$catid."&chabateid=".$cid."&sr=0&rc=30");
}
else
{
$sql3 = "INSERT INTO `".$cid."` (`u`, `p`, `fid`) VALUES (:username, :ccpost, :fbid)";
      // Prepare the SQL query
$sth3 = $dbh->prepare($sql3);
      // Bind parameters to statement variables
$sth3->bindParam(':username', $username);
$sth3->bindParam(':ccpost', $ccpost);
$sth3->bindParam(':fbid', $fbid);
      // Execute statement
$sth3->execute();
$sql3a = "UPDATE `questions` SET `posts` = `posts` + 1,`lcdate` = '".time()."' WHERE `id` = '".$cid."'";
$query3a = mysqli_query($sqlcxn,$sql3a);
$fbpost = "fbpost.php?t=".$cid."&f=".$fbid."&p=1";
}
}
  ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
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
 	 $("#currentchabate").load("currentchabate-c.php?cid=<?php echo $cid; ?>&id=<?php echo $fbid; ?>&sr=<?php echo $start; ?>&rc=<?php echo $count; ?>");
   var refreshId = setInterval(function() {
      $("#currentchabate").load('currentchabate-c.php?cid=<?php echo $cid; ?>&id=<?php echo $fbid; ?>&sr=<?php echo $start; ?>&rc=<?php echo $count; ?>');
   }, 9000000);
   $.ajaxSetup({ cache: false });
});
</script>
<script>
 $(document).ready(function() {
 	 $("#chabatelist").load("chabatelist.php");
   var refreshId = setInterval(function() {
      $("#chabatelist").load('chabatelist.php');
   }, 90000000);
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
<script>
(function($)
{
    $.fn.autogrow = function(options)
    {
        return this.filter('textarea').each(function()
        {
            var self         = this;
            var $self        = $(self);
            var minHeight    = $self.height();
            var noFlickerPad = $self.hasClass('autogrow-short') ? 0 : parseInt($self.css('lineHeight')) || 0;
            var shadow = $('<div></div>').css({
                position:    'absolute',
                top:         -10000,
                left:        -10000,
                width:       $self.width(),
                fontSize:    $self.css('fontSize'),
                fontFamily:  $self.css('fontFamily'),
                fontWeight:  $self.css('fontWeight'),
                lineHeight:  $self.css('lineHeight'),
                resize:      'none',
    			'word-wrap': 'break-word'
            }).appendTo(document.body);
            var update = function(event)
            {
                var times = function(string, number)
                {
                    for (var i=0, r=''; i<number; i++) r += string;
                    return r;
                };
                var val = self.value.replace(/</g, '&lt;')
                                    .replace(/>/g, '&gt;')
                                    .replace(/&/g, '&amp;')
                                    .replace(/\n$/, '<br/>&nbsp;')
                                    .replace(/\n/g, '<br/>')
                                    .replace(/ {2,}/g, function(space){ return times('&nbsp;', space.length - 1) + ' ' });
				// Did enter get pressed?  Resize in this keydown event so that the flicker doesn't occur.
				if (event && event.data && event.data.event === 'keydown' && event.keyCode === 13) {
					val += '<br />';
				}
                shadow.css('width', $self.width());
                shadow.html(val + (noFlickerPad === 0 ? '...' : '')); // Append '...' to resize pre-emptively.
                $self.height(Math.max(shadow.height() + noFlickerPad, minHeight));
            }
            $self.change(update).keyup(update).keydown({event:'keydown'},update);
            $(window).resize(update);
            update();
        });
    };
})(jQuery);
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

<script>
    $(function(){
      // bind change event to select
      $('#dynamic_select').bind('change', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
      });
    });
</script>

<table width="90%" cellpadding="5">
<?php
echo "<table cellpadding=\"5\"><tr><td><b>Order By:</b>\n";
if($co === '1')
{
?>
<select id="dynamic_select">
    <option value="" selected>Most Popular</option>
    <option value="http://www.whatcomputertobuy.com/chabate/categories.php?categoryid=<?php echo $catid; ?>&co=2">Latest Activity</option>
    <option value="http://www.whatcomputertobuy.com/chabate/categories.php?categoryid=<?php echo $catid; ?>&co=3">Newest</option>
</select>
<?php
}
else if($co === '2')
{
?>
<select id="dynamic_select">
    <option value="" selected>Latest Activity</option>
    <option value="http://www.whatcomputertobuy.com/chabate/categories.php?categoryid=<?php echo $catid; ?>&co=1">Most Popular</option>
    <option value="http://www.whatcomputertobuy.com/chabate/categories.php?categoryid=<?php echo $catid; ?>&co=3">Newest</option>
</select>
<?php
}
else if($co === '3')
{
?>
<select id="dynamic_select">
    <option value="" selected>Newest</option>
    <option value="http://www.whatcomputertobuy.com/chabate/categories.php?categoryid=<?php echo $catid; ?>&co=1">Most Popular</option>
    <option value="http://www.whatcomputertobuy.com/chabate/categories.php?categoryid=<?php echo $catid; ?>&co=2">Latest Activity</option>
</select>
<?php
}
else
	{
?>
<select id="dynamic_select">
    <option value="" selected>Most Popular</option>
    <option value="http://www.whatcomputertobuy.com/chabate/categories.php?categoryid=<?php echo $catid; ?>&co=2">Latest Activity</option>
    <option value="http://www.whatcomputertobuy.com/chabate/categories.php?categoryid=<?php echo $catid; ?>&co=3">Newest</option>
</select></td>
<?php
}
echo "<tr><td><br /></td></tr>";
if($co === '1')
{
$sql7 = "SELECT `id`,`title` FROM `questions` WHERE `".$catid2."` = '1' ORDER BY `posts` DESC LIMIT ".$clc."";
}
elseif($co === '2')
{
$sql7 = "SELECT `id`,`title` FROM `questions` WHERE `".$catid2."` = '1' ORDER BY `lcdate` DESC LIMIT ".$clc."";
}
elseif($co === '3')
{
$sql7 = "SELECT `id`,`title` FROM `questions` WHERE `".$catid2."` = '1' ORDER BY `date` DESC LIMIT ".$clc."";
}
else
{
$sql7 = "SELECT `id`,`title` FROM `questions` WHERE `".$catid2."` = '1' ORDER BY `posts` DESC LIMIT ".$clc."";
}
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
if($i %2 != 0)
{
echo "<tr><td><a href=\"categories.php?categoryid=".$catid."&chabateid=".$id7."&sr=0&rc=30\">".$title7." (".$nrows8.")</a></td></tr>\n";
}
else
{
echo "<tr><td bgcolor=\"#ededed\"><a href=\"categories.php?categoryid=".$catid."&chabateid=".$id7."&sr=0&rc=30\">".$title7." (".$nrows8.")</a></td></tr>\n";
}
$i++;
}
?>
</table>
					</div>
				</div>
								<div id="contentright">
					<div class="post">
<?php 
echo "<b>".$currentchabate."</b>";
?>
					</div>
					<div class="post">
<table><tr bgcolor="#f7f7f7"><td>
<?php
echo "<img src=\"https://graph.facebook.com/".$user_id."/picture\" alt=\"Facebook User Picture\">\n";
echo "</td><td>";
echo "<form name=\"currentchabate\" method=\"post\" action=\"categories.php?categoryid=".$catid."&chabateid=".$cid."\">";
?>
<pre></pre>
<textarea rows="2" name="ccpost" class="styleinput" onfocus="clearField(this);" onblur="restoreField(this);">Add a comment</textarea><br>
<input type="checkbox" name="ccfb" id="ccfb" value="1" checked="checked"><label for="ccfb"><font size="0.9em" color="grey">Post to Facebook&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></label>
<script type='text/javascript'>
  $(function() {
    $('textarea').autogrow();
  });
</script>
<input type="hidden" name="ccsubmit" value="ccsubmit">
<?php
echo "<input type=\"hidden\" name=\"fbid\" value=\"".$user_id."\">";
?>
<input type="image" src="images/buttons/post.png">
</form>
</td></tr>
<tr><td>&nbsp;</td></tr></table>
<div id="currentchabate"></div>
<?php
$nr = $start + '30';
$pr = $start - '30';
echo "<table><tr><td>\n";
if ($start > '1')
{
echo "<a href=\"categories.php?categoryid=".$catid."&chabateid=".$cid,"&sr=".$pr."&rc=30\"><img src=\"images/buttons/prev.png\" alt=\"Prevoius Arrow\"></a></td>";
}
else{
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
}
echo "<td>&nbsp;&nbsp;</td>";
if($rowcheck1a > $nr)
echo "<td><a href=\"categories.php?categoryid=".$catid."&chabateid=".$cid."&sr=".$nr."&rc=30\"><img src=\"images/buttons/next.png\" alt=\"Next Arrow\"></a></td>";
echo "</table>";
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
$sql5 = "SELECT `id`,`category` FROM `categories` ORDER BY `category` ASC";
$query5 = mysqli_query($sqlcxn,$sql5);
while($row5 = mysqli_fetch_array($query5))
{
$id5 = $row5['id'];
$cat5 = $row5['category'];
if($id5 === $catid)
{
echo "<li class=\"active\"><a href=\"categories.php?categoryid=".$id5."\">".$cat5."</a></li>";
}
else
{
echo "<li><a href=\"categories.php?categoryid=".$id5."\">".$cat5."</a></li>";
}
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
}
else
{
//If Not Logged in
if($catid<'1')
{
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
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
 	 $("#currentchabate").load("currentchabate-c.php?cid=<?php echo $cid; ?>&id=<?php echo $fbid; ?>&sr=<?php echo $start; ?>&rc=<?php echo $count; ?>");
   var refreshId = setInterval(function() {
      $("#currentchabate").load('currentchabate-c.php?cid=<?php echo $cid; ?>&id=<?php echo $fbid; ?>&sr=<?php echo $start; ?>&rc=<?php echo $count; ?>');
   }, 9000000);
   $.ajaxSetup({ cache: false });
});
</script>
<script>
 $(document).ready(function() {
 	 $("#chabatelist").load("chabatelist.php");
   var refreshId = setInterval(function() {
      $("#chabatelist").load('chabatelist.php');
   }, 90000000);
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
<table width="90%" cellpadding="7">
<?php
if($_SESSION['login']!='1')
{
	?>
<tr><td>
<a href="login.php"><img src="images/buttons/emlogin.png" width="225"></a></td><td>
</tr>
<?php
}
?><tr>
<?php
$sql5 = "SELECT `id`,`category` FROM `categories` ORDER BY `category` ASC";
$query5 = mysqli_query($sqlcxn,$sql5);
$i='1';
while($row5 = mysqli_fetch_array($query5))
{
$id5 = $row5['id'];
$cat5 = $row5['category'];
if($i %2 != 0)
{
echo "<td><a href=\"categories.php?categoryid=".$id5."\"><img src=\"/images/buttons/categories/".$id5.".png\" alt=\" ".$cat5."\"></a></td>";
}
else
{
echo "<td><a href=\"categories.php?categoryid=".$id5."\"><img src=\"/images/buttons/categories/".$id5.".png\" alt=\" ".$cat5."\"></a></td></tr><tr>";
}
$i++;
}
?>
</table>					</div>
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
if($id4 === $catid)
{
echo "<li class=\"active\"><a href=\"categories.php?categoryid=".$id4."\">".$cat4."</a></li>";
}
else
{
echo "<li><a href=\"categories.php?categoryid=".$id4."\">".$cat4."</a></li>";
}
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
if($cid<'1')
{
$sql1 = "SELECT `id`,`title` FROM `questions` WHERE `".$catid2."` = '1' ORDER BY `date` DESC LIMIT 1";
$query1 = mysqli_query($sqlcxn,$sql1);
while($row1 = mysqli_fetch_array($query1))
{
$currentchabate = $row1['title'];
$cid = $row1['id'];
}
}
else {
$sql1 = "SELECT `title` FROM `questions` WHERE `id` = '".$cid."'";
$query1 = mysqli_query($sqlcxn,$sql1);
while($row1 = mysqli_fetch_array($query1))
{
$currentchabate = $row1['title'];
}
}
$sql1a = "SELECT `id` FROM `".$cid."`";
$query1a = mysqli_query($sqlcxn,$sql1a);
$rowcheck1a = mysqli_num_rows($query1a);
  ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
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
 	 $("#currentchabate").load("currentchabate-c.php?cid=<?php echo $cid; ?>&sr=<?php echo $start; ?>&rc=<?php echo $count; ?>");
   var refreshId = setInterval(function() {
      $("#currentchabate").load('currentchabate-c.php?cid=<?php echo $cid; ?>&sr=<?php echo $start; ?>&rc=<?php echo $count; ?>');
   }, 9000000);
   $.ajaxSetup({ cache: false });
});
</script>
<script>
 $(document).ready(function() {
 	 $("#chabatelist").load("chabatelist.php");
   var refreshId = setInterval(function() {
      $("#chabatelist").load('chabatelist.php');
   }, 90000000);
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
<script>
(function($)
{
    $.fn.autogrow = function(options)
    {
        return this.filter('textarea').each(function()
        {
            var self         = this;
            var $self        = $(self);
            var minHeight    = $self.height();
            var noFlickerPad = $self.hasClass('autogrow-short') ? 0 : parseInt($self.css('lineHeight')) || 0;
            var shadow = $('<div></div>').css({
                position:    'absolute',
                top:         -10000,
                left:        -10000,
                width:       $self.width(),
                fontSize:    $self.css('fontSize'),
                fontFamily:  $self.css('fontFamily'),
                fontWeight:  $self.css('fontWeight'),
                lineHeight:  $self.css('lineHeight'),
                resize:      'none',
    			'word-wrap': 'break-word'
            }).appendTo(document.body);
            var update = function(event)
            {
                var times = function(string, number)
                {
                    for (var i=0, r=''; i<number; i++) r += string;
                    return r;
                };
                var val = self.value.replace(/</g, '&lt;')
                                    .replace(/>/g, '&gt;')
                                    .replace(/&/g, '&amp;')
                                    .replace(/\n$/, '<br/>&nbsp;')
                                    .replace(/\n/g, '<br/>')
                                    .replace(/ {2,}/g, function(space){ return times('&nbsp;', space.length - 1) + ' ' });
				// Did enter get pressed?  Resize in this keydown event so that the flicker doesn't occur.
				if (event && event.data && event.data.event === 'keydown' && event.keyCode === 13) {
					val += '<br />';
				}
                shadow.css('width', $self.width());
                shadow.html(val + (noFlickerPad === 0 ? '...' : '')); // Append '...' to resize pre-emptively.
                $self.height(Math.max(shadow.height() + noFlickerPad, minHeight));
            }
            $self.change(update).keyup(update).keydown({event:'keydown'},update);
            $(window).resize(update);
            update();
        });
    };
})(jQuery);
</script>
</head>
<body>
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
<table width="90%" cellpadding="5">
<?php
$i = '1';
$sql7 = "SELECT `id`,`title` FROM `questions` WHERE `".$catid2."` = '1' ORDER BY `id` DESC";
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
if($i %2 != 0)
{
echo "<tr><td><a href=\"categories.php?categoryid=".$catid."&chabateid=".$id7."&sr=0&rc=30\">".$title7." (".$nrows8.")</a></td></tr>\n";
}
else
{
echo "<tr><td bgcolor=\"#ededed\"><a href=\"categories.php?categoryid=".$catid."&chabateid=".$id7."&sr=0&rc=30\">".$title7." (".$nrows8.")</a></td></tr>\n";
}
$i++;
}
?>
</table>
					</div>
				</div>
								<div id="contentright">
					<div class="post">
<?php 
echo "<b>".$currentchabate."</b>";
?>
					</div>
					<div class="post">
<table><tr bgcolor="#f7f7f7"><td>

</td></tr>
<tr><td>&nbsp;</td></tr></table>
<div id="currentchabate"></div>
<?php
$nr = $start + '30';
$pr = $start - '30';
echo "<table><tr><td>\n";
if ($start > '1')
{
echo "<a href=\"categories.php?categoryid=".$catid."&chabateid=".$cid,"&sr=".$pr."&rc=30\"><img src=\"images/buttons/prev.png\" alt=\"Previous Arrow\"></a></td>";
}
else{
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
}
echo "<td>&nbsp;&nbsp;</td>";
if($rowcheck1a > $nr)
echo "<td><a href=\"categories.php?categoryid=".$catid."&chabateid=".$cid."&sr=".$nr."&rc=30\"><img src=\"images/buttons/next.png\" alt=\"Next Arrow\"></a></td>";
echo "</table>";
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
$sql5 = "SELECT `id`,`category` FROM `categories` ORDER BY `category` ASC";
$query5 = mysqli_query($sqlcxn,$sql5);
while($row5 = mysqli_fetch_array($query5))
{
$id5 = $row5['id'];
$cat5 = $row5['category'];
if($id5 === $catid)
{
echo "<li class=\"active\"><a href=\"categories.php?categoryid=".$id5."\">".$cat5."</a></li>";
}
else
{
echo "<li><a href=\"categories.php?categoryid=".$id5."\">".$cat5."</a></li>";
}
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
}}
else{
	header('location:login.php');
}
?>
?>