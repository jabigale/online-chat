<?php
// Include the mobile device detect class
include 'scripts/mobiledetect.php';
// Init the class
$detect = new Mobile_Detect();
// And here is the magic - checking if the user comes with a mobile device
if ($detect->isMobile()) {
    // Detects any mobile device.
    // Redirecting
    header("Location: http://m.chabate.com"); exit;
}
include "scripts/mysql.php";
include "scripts/global.php";
$aid = rand(1,30);

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
if(isset($_GET['action']) && $_GET['action'] === 'logout'){
        $facebook->destroySession();
header('Location:http://www.chabate.com');
    }
  ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="chabate, social chats and debates, debate, debate topics, controversy, social, chat, social networking, " />
<meta name="description" content="A chabate is a user created topic that is open to the public for you or other users to post comments or debate their side of the topic. Chabate reawards users with prizes" />
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
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-48030612-1', 'chabate.com');
  ga('send', 'pageview');
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
echo $menulist_loggedin;
?>
		</ul>
	</div>
</div>
<div id="header-wrapper">
	<div id="header">
		<div id="logo">
			<a href="http://www.chabate.com"><img src="images/logos/cblogo400.jpg" width="218" alt="Chabate Logo"></a>
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
				<div id="content">
					<div class="post">
						<h2 class="title">My Account</h2>
					</div>
					<div class="post">
Username:
<br/>
<br/>
Name:
<br/>
<br/>
E-mail:
<br/>
<br/>
Avatar: 
<br/>
<br/>
<a href="account.pgp?e=1">edit</a>




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
<meta name="keywords" content="chabate, social chats and debates, debate, debate topics, controversy, social, chat, social networking, " />
<meta name="description" content="A chabate is a user created topic that is open to the public for you or other users to post comments or debate their side of the topic. Chabate reawards users with prizes" />
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
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-48030612-1', 'chabate.com');
  ga('send', 'pageview');
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
</head>
<body>
<?php
$i = "1";
while($i < "31")
{
echo "<image src=\"images/avatars/".$i.".png\">";
echo "<br />";
$i ++
}
?>
</body>
</html>
<?php
}
?>