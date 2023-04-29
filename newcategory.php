<?php
include "scripts/mysql.php";
include "scripts/global.php";

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
                                      'link' => 'http://www.chabate.com',
                                      'message' => $lcpost
                                 ));
}
if($lcpost === "Add a comment")
{
		header("Location: http://www.chabate.com/");
}
else
{
$csql3 = "SELECT `p` FROM `".$lctbl."` ORDER BY `id` DESC LIMIT 1";
$cquery3 = mysqli_query($sqlcxn,$csql3);
while($crow3 = mysqli_fetch_array($cquery3))
{
$cp3 = $crow3['p'];
}
if($cp3 === $lcpost)
{
		header("Location: http://www.chabate.com/");
}
else
{
$sql3 = "INSERT INTO `".$lctbl."` (`u`, `p`, `fid`) VALUES ('".$username."', '".$lcpost."', '".$fbid."')";
$query3 = mysqli_query($sqlcxn,$sql3);
}
}
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
                                      'link' => 'www.chabate.com',
                                      'message' => $hcpost
                                 ));
}
if($hcpost === "Add a comment")
{
		header("Location: http://www.chabate.com/");
}
else
{
$csql4 = "SELECT `p` FROM `".$hctbl."` ORDER BY `id` DESC LIMIT 1";
$cquery4 = mysqli_query($sqlcxn,$csql4);
while($crow4 = mysqli_fetch_array($cquery4))
{
$cp4 = $crow4['p'];
}
if($cp4 === $hcpost)
{
		header("Location: http://www.chabate.com/");
}
else
{
$sql4 = "INSERT INTO `".$hctbl."` (`u`, `p`, `fid`) VALUES ('".$username."', '".$hcpost."', '".$fbid."')";
$query4 = mysqli_query($sqlcxn,$sql4);
$sql6 = "UPDATE `questions` SET `posts` = `posts` + 1,`lcdate` = '".time()."' WHERE `id` = '".$hctbl."'";
$query6 = mysqli_query($sqlcxn,$sql6);
}
}
}
if(isset($_POST['cpost']))
{
$cpost = $_POST['cpost'];
if($cpost === "comment")
{
header('Location:http://www.chabate.com');
}
else
{
$hcfb = $_POST['hcfb'];
$cpid = $_POST['cpid'];
$qid = $_POST['qid'];
$ctbl = "c".$qid;
if($hcfb === '1')
{
$ret_obj = $facebook->api('/me/feed', 'POST',
                                    array(
                                      'link' => 'www.chabate.com',
                                      'message' => $ccpost
                                 ));
}
$sql4a = "INSERT INTO `".$ctbl."` (`u`,`p`,`fid`,`pid`) VALUES ('".$username."','".$cpost."','".$user_id."','".$cpid."')";
$query4a = mysqli_query($sqlcxn,$sql4a);
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
<script src="scripts/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="scripts/mootools-core-1.4.2.js"></script>
<script type="text/javascript" src="scripts/mootools-more-1.4.0.1.js"></script>
<script type="text/javascript" src="scripts/PopUpWindow.js"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-48030612-1', 'chabate.com');
  ga('send', 'pageview');
</script><script>
 $(document).ready(function() {
 	 $("#latestchabate").load("latestchabate.php?id=<?php echo $latestid; ?>&fbid=<?php echo $user_id; ?>");
   var refreshId = setInterval(function() {
      $("#latestchabate").load('latestchabate.php?id=<?php echo $latestid; ?>&fbid=<?php echo $user_id; ?>');
   }, 9000000);
   $.ajaxSetup({ cache: true });
});
</script>
<script>
 $(document).ready(function() {
 	 $("#hotestchabate").load("hotestchabate.php?id=<?php echo $hotestid; ?>&fbid=<?php echo $user_id; ?>");
   var refreshId = setInterval(function() {
      $("#hotestchabate").load('hotestchabate.php?id=<?php echo $hotestid; ?>&fbid=<?php echo $user_id; ?>');
   }, 9000000);
   $.ajaxSetup({ cache: true });
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
<div id="menu-wrapper">
	<div id="menu">
		<ul>
<?php
echo $menulist;
?>
</li>
		</ul>
	</div>
</div>
<div id="header-wrapper">
	<div id="header">
		<div id="logo">
			<a href="http://www.chabate.com"><img src="images/cblogo.jpg" width="218" border="0"></a>
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
echo "<li><a href=\"categories.php?categoryid=".$id5."\">".$cat5."</a></li>";
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
	<p>Copyright (c) 2013 chabate.com. All rights reserved.</p>
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
<?php
echo $metaog;
?>
<title>Social Chats and Debates</title>
<link href="http://fonts.googleapis.com/css?family=Arvo" rel="stylesheet" type="text/css" />
<link href="http://fonts.googleapis.com/css?family=Coda:400,800" rel="stylesheet" type="text/css" />
<link href="scripts/style.css?<?php echo rand(0,99999);?>" rel="stylesheet" type="text/css" media="screen" />
<script src="scripts/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="scripts/mootools-core-1.4.2.js"></script>
<script type="text/javascript" src="scripts/mootools-more-1.4.0.1.js"></script>
<script type="text/javascript" src="scripts/PopUpWindow.js"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-48030612-1', 'chabate.com');
  ga('send', 'pageview');
</script><script>
 $(document).ready(function() {
 	 $("#hotestchabate").load("hotestchabate.php?id=<?php echo $hotestid; ?>");
   var refreshId = setInterval(function() {
      $("#hotestchabate").load('hotestchabate.php?id=<?php echo $hotestid; ?>');
   }, 9000000);
   $.ajaxSetup({ cache: true });
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
   $.ajaxSetup({ cache: true });
});
</script>
</head>
<body>
<div id="menu-wrapper">
	<div id="menu">
		<ul>
<?php
echo $menulist;
?>
	</div>
</div>
<div id="header-wrapper">
	<div id="header">
		<div id="logo">
			<a href="http://www.chabate.com"><img src="images/cblogo.jpg" width="218" border="0"></a>
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
Please Log in with Facebook to Post
<?php
      $login_url = $facebook->getLoginUrl();
      echo '<a href="' . $login_url . '"><img src="http://www.chabate.com/images/fblogin.png" width="250" border=\"0\"></a><br />';
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
	<p>Copyright (c) 2013 chabate.com. All rights reserved.</p>
</div>
</body>
</html>
<?php
}
?>