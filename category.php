<?php
include "scripts/mysql.php";
include "scripts/global.php";
$catid = $_GET['categoryid'];
$catid2 = "cat".$catid;
$sql1 = "SELECT `id`,`title` FROM `questions` WHERE `".$catid2."` = '1' ORDER BY `date` DESC LIMIT 1";
$query1 = mysqli_query($sqlcxn,$sql1);
while($row1 = mysqli_fetch_array($query1))
{
$latestchabate = $row1['title'];
$latestid = $row1['id'];
}
$sql2 = "SELECT `id`,`title` FROM `questions` WHERE `".$catid2."` = '1' ORDER BY `posts` DESC LIMIT 1";
$query2 = mysqli_query($sqlcxn,$sql2);
while($row2 = mysqli_fetch_array($query2))
{
$hotestchabate = $row2['title'];
$hotestid = $row2['id'];
}
if($hotestid ===$latestid)
{
$sql1 = "SELECT `id`,`title` FROM `questions` WHERE `".$catid2."` = '1' ORDER BY `date` DESC LIMIT 1,1";
$query1 = mysqli_query($sqlcxn,$sql1);
while($row1 = mysqli_fetch_array($query1))
{
$latestchabate = $row1['title'];
$latestid = $row1['id'];
}	
}
$sql1a = "SELECT `id` FROM `".$latestid."`";
$query1a = mysqli_query($sqlcxn,$sql1a);
$rowcheck1a = mysqli_num_rows($query1a);
$sql2a = "SELECT `id` FROM `".$hotestid."`";
$query2a = mysqli_query($sqlcxn,$sql2a);
$rowcheck2a = mysqli_num_rows($query2a);
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
if(isset($_POST['lcsubmit']))
{
$lcpost = $_POST['lcpost'];
$lcfb = $_POST['lcfb'];
$lctbl = $_POST['lcid'];
$fbid = $_POST['fbid'];
if($lcfb === '1')
{
$ret_obj = $facebook->api('/me/feed', 'POST',
                                    array(
                                      'link' => 'www.whatcomputertobuy.com/chabate/index.php',
                                      'message' => $lcpost
                                 ));
}
$sql3 = "INSERT INTO `".$lctbl."` (`u`, `p`, `fid`) VALUES ('".$username."', '".$lcpost."', '".$fbid."')";
$query3 = mysqli_query($sqlcxn,$sql3);
}
if(isset($_POST['hcsubmit']))
{
$hcpost = $_POST['hcpost'];
$hcfb = $_POST['hcfb'];
$hctbl = $_POST['hcid'];
$fbid = $_POST['fbid'];
if($hcfb === '1')
{
$ret_obj = $facebook->api('/me/feed', 'POST',
                                    array(
                                      'link' => 'www.whatcomputertobuy.com/chabate/index.php',
                                      'message' => $hcpost
                                 ));
}
$sql4 = "INSERT INTO `".$hctbl."` (`u`, `p`, `fid`) VALUES ('".$username."', '".$hcpost."', '".$fbid."')";
$query4 = mysqli_query($sqlcxn,$sql4);
}
  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Social Chats and Debates</title>
<link href="http://fonts.googleapis.com/css?family=Arvo" rel="stylesheet" type="text/css" />
<link href="http://fonts.googleapis.com/css?family=Coda:400,800" rel="stylesheet" type="text/css" />
<link href="style.css?<?php echo rand(0,99999);?>" rel="stylesheet" type="text/css" media="screen" />
<script src="scripts/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="scripts/mootools-core-1.4.2.js"></script>
<script type="text/javascript" src="scripts/mootools-more-1.4.0.1.js"></script>
<script type="text/javascript" src="scripts/PopUpWindow.js"></script>

<script>
 $(document).ready(function() {
 	 $("#latestchabate").load("latestchabate.php?id=<?php echo $latestid; ?>");
   var refreshId = setInterval(function() {
      $("#latestchabate").load('latestchabate.php?id=<?php echo $latestid; ?>');
   }, 9000000);
   $.ajaxSetup({ cache: false });
});
</script>
<script>
 $(document).ready(function() {
 	 $("#hotestchabate").load("hotestchabate.php?id=<?php echo $hotestid; ?>");
   var refreshId = setInterval(function() {
      $("#hotestchabate").load('hotestchabate.php?id=<?php echo $hotestid; ?>');
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
			<a href="http://www.whatcomputertobuy.com/chabate/"><img src="images/cblogo.jpg" width="218"></a>
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
						<h2 class="title"><a href="#">LATEST CHABATE</a></h2>
					</div>
					<div class="post">
<?php
echo "<b>".$latestchabate."</b>";
?>
<table><tr bgcolor="#f7f7f7"><td>
<?php
echo "<img src=\"https://graph.facebook.com/".$user_id."/picture\">\n";
echo "</td><td>\n";
echo "<form name=\"latestchabate\" method=\"post\" action=\"category.php?categoryid=".$catid."\">";
?>
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
<div id="latestchabate"></div>
<?php
$nr = '30';
if($rowcheck1a > '31')
echo "<a href=\"chabates.php?chabateid=".$latestid."&sr=".$nr."&rc=30\"><img align=\"right\" src=\"images/buttons/next.png\"></a>";
?>
					</div>
				</div>
								<div id="contentright">
					<div class="post">
						<h2 class="title"><a href="#">HOTEST CHABATE</a></h2>
					</div>
					<div class="post">
<?php
echo "<b>".$hotestchabate."</b>";
?>
<table><tr bgcolor="#f7f7f7"><td>
<?php
echo "<img src=\"https://graph.facebook.com/".$user_id."/picture\">\n";
echo "</td><td>\n";
echo "<form name=\"hotestchabate\" method=\"post\" action=\"category.php?categoryid=".$catid."\">";
?>
<pre></pre>
<textarea rows="2" name="hcpost" class="styleinput" onfocus="clearField(this);" onblur="restoreField(this);">Add a comment</textarea><br>
<input type="checkbox" name="hcfb" id="hcfb" value="1" checked="checked><label for="hcfb"><font size="0.9em" color="grey">Post to Facebook&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></label>
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
<div id="hotestchabate"></div>
<?php
$nr = '30';
if($rowcheck2a > '31')
echo "<a href=\"chabates.php?chabateid=".$hotestid."&sr=".$nr."&rc=30\"><img align=\"right\" src=\"images/buttons/next.png\"></a>";
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
echo "<li class=\"active\"><a href=\"category.php?categoryid=".$id5."\">".$cat5."</a></li>";
}
else
{
echo "<li><a href=\"category.php?categoryid=".$id5."\">".$cat5."</a></li>";
}
}
?>
							</ul>
						</li>
					</ul>
<?php
$sql6 = "SELECT `id`,`title` FROM `questions` WHERE `cat1` = '".$catid."' OR `cat2` = '".$catid."' OR `cat3` = '".$catid."' ORDER BY `id` DESC";
$query6 = mysqli_query($sqlcxn,$sql6);
while($row6 = mysqli_fetch_array($query6))
{
$id6 = $row6['id'];
$title6 = $row6['title'];
echo "<li><a href=\"chabates.php?chabateid=".$id6."\">".$title6."</a></li>";

}
?>

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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Social Chats and Debates</title>
<link href="http://fonts.googleapis.com/css?family=Arvo" rel="stylesheet" type="text/css" />
<link href="http://fonts.googleapis.com/css?family=Coda:400,800" rel="stylesheet" type="text/css" />
<link href="style.css?<?php echo rand(0,99999);?>" rel="stylesheet" type="text/css" media="screen" />
<script src="scripts/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="scripts/mootools-core-1.4.2.js"></script>
<script type="text/javascript" src="scripts/mootools-more-1.4.0.1.js"></script>
<script type="text/javascript" src="scripts/PopUpWindow.js"></script>

<script>
 $(document).ready(function() {
 	 $("#hotestchabate").load("hotestchabate.php?id=<?php echo $hotestid; ?>");
   var refreshId = setInterval(function() {
      $("#hotestchabate").load('hotestchabate.php?id=<?php echo $hotestid; ?>');
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
</script>
<script>
 $(document).ready(function() {
 	 $("#latestchabate").load("latestchabate.php?id=<?php echo $latestid; ?>");
   var refreshId = setInterval(function() {
      $("#latestchabate").load('latestchabate.php?id=<?php echo $latestid; ?>');
   }, 9000000);
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
			<a href="http://www.whatcomputertobuy.com/chabate/"><img src="images/cblogo.jpg" width="218"></a>
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
						<h2 class="title"><a href="#">LATEST CHABATE</a></h2>
					</div>
					<div class="post">
<?php
echo "<b>".$latestchabate."</b>";
?>
<div id="latestchabate"></div>
<?php
$nr = '30';
if($rowcheck1a > '31')
echo "<a href=\"chabates.php?chabateid=".$latestid."&sr=".$nr."&rc=30\"><img align=\"right\" src=\"images/buttons/next.png\"></a>";
?>
					</div>
				</div>
					<div id="contentright">
					<div class="post">
						<h2 class="title"><a href="#">HOTEST CHABATE</a></h2>
					</div>
					<div class="post">
<?php
      $login_url = $facebook->getLoginUrl();
      echo '<a href="' . $login_url . '"><img src="http://whatcomputertobuy.com/chabate/images/fblogin.png" width="250" border=\"0\"></a><br />';
echo "<b>".$hotestchabate."</b>";
?>
<div id="hotestchabate"></div>
<?php
$nr = '30';
if($rowcheck2a > '31')
echo "<a href=\"chabates.php?chabateid=".$hotestid."&sr=".$nr."&rc=30\"><img align=\"right\" src=\"images/buttons/next.png\"></a>";
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
echo "<li class=\"active\"><a href=\"category.php?categoryid=".$id5."\">".$cat5."</a></li>";
}
else
{
echo "<li><a href=\"category.php?categoryid=".$id5."\">".$cat5."</a></li>";
}
}
?>
							</ul>
						</li>
					</ul>

<?php
$sql6 = "SELECT `category` FROM `categories` WHERE `id` = '".$catid."'";
$query6 = mysqli_query($sqlcxn,$sql6);
while($row6 = mysqli_fetch_array($query6))
{
$cat6 = $row6['category'];
echo "<b>".$cat6." Chabates:</b><br/>";
}
$sql7 = "SELECT `id`,`title` FROM `questions` WHERE `cat1` = '".$catid."' OR `cat2` = '".$catid."' OR `cat3` = '".$catid."' ORDER BY `id` DESC";
$query7 = mysqli_query($sqlcxn,$sql7);
while($row7 = mysqli_fetch_array($query7))
{
$id7 = $row7['id'];
$title7 = $row7['title'];
echo "<li><a href=\"chabates.php?chabateid=".$id7."\">".$title7."</a></li><br/>\n";
}
?>
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