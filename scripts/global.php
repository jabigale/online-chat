<?php
$menulist = "\n<li><a href=\"index.php\">Home</a></li>\n<li><a href=\"categories.php\">Categories</a></li>\n<li><a href=\"chabates.php\">Browse Chabates</a></li>\n<li><a href=\"createchabate.php\">Create a Chabate</a></li>\n<li><a href=\"JavaScript:void(0);\" onclick=\"App.popUp1.open(); App.popUp1.positionTo(this, -400, 0);\">What are Chabates</a>\n<div id=\"staticDiv\"><p class=\"popup\">A \"chabate\" is a user created topic that is open for any users to post comments or debate the topic.\nAny user has the ability to create a \"Chabate\" about any topic they wish.\n Any user can add comments or posts to any existing \"chabate\".</p><p><b>Rules for Chabates:</b></p><p>-The \"Chabate\" must not be derogatory to other people</p><p>-The \"Chabate\" or post must not contain explicit content</p><p>-The Comments and Posts on Chabate.com are by users and Chabate.com does not hold these beliefs</p><p>-You must be 13 to use this site</p><p>At any time your post may be deleted under the discretion of Chabate.com administrators.</p>\n\n</div><script type=\"text/javascript\">\nApp = {};\nwindow.addEvent('domready', function() {\nApp.popUp1 = new PopUpWindow('Chabates', { contentDiv: 'staticDiv', width: 400 });\n});\n</script>";

$menulist_loggedin = "\n<li><a href=\"index.php\">Home</a></li>\n<li><a href=\"categories.php\">Categories</a></li>\n<li><a href=\"chabates.php\">Browse</a></li>\n<li><a href=\"createchabate.php\">Create</a></li>\n<li><a href=\"JavaScript:void(0);\" onclick=\"App.popUp1.open(); App.popUp1.positionTo(this, -400, 0);\">What are Chabates</a></li>\n<li><a href=\"JavaScript:void(0);\" onclick=\"App.myaccount.open(); App.myaccount.positionTo(this, -400, 0);\">My Account</a></li>\n<div id=\"staticDiv\"><p class=\"popup\">A chabate is a user created topic that is open to the public for you or other users to post comments or debate their side of the topic.\nAny user has the ability to create a Chabate about any topic they wish.\n Any user can add comments or posts to any existing chabate.</p><p><b>Rules for Chabates:</b></p><p>-The Chabate must not be derogatory to other people</p><p>-The \"Chabate\" must not contain explicit content</p><p>-The Comments and Posts on Chabate.com are by users and Chabate.com does not hold these beliefs</p><p>-You must be 13 to use this site</p><p>-At any time a post may be deleted under the discretion of Chabate.com administrators</p>\n\n</div>\n<div id=\"myaccount\"><p class=\"popup1\"><a href=\"points.php\">Reward Points:</a><br /><a href=\"?action=logout\">Logout</a></p>\n\n</div><script type=\"text/javascript\">\nApp = {};\nwindow.addEvent('domready', function() {\nApp.popUp1 = new PopUpWindow('Chabates', { contentDiv: 'staticDiv', width: 400 });\n});\n</script><script type=\"text/javascript\">\nApp = {};\nwindow.addEvent('domready', function() {\nApp.myaccount = new PopUpWindow('My Account', { contentDiv: 'myaccount', width: 400 });\n});\n</script>";

$ad = rand(1,2);
$adsql = "SELECT `link` FROM `ads` WHERE `id` = ".$ad." LIMIT 1";
$adquery = mysqli_query($sqlcxn,$adsql);
$metaog = "<meta property=\"og:title\" content=\"Social Chats & Debates, Prizes Given Away Monthly\" />\n<meta property=\"og:description\" content=\"A chabate is a user created topic that is open to the public for you to post comments or debate your side of the topic.\" />\n<meta property=\"og:type\" content=\"website\" />\n<meta property=\"og:url\" content=\"http://www.chabate.com/\" />\n<meta property=\"og:image\" content=\"http://chabate.com/images/logos/cblogo.jpg\" />\n<meta property=\"fb:app_id\" content=\"1405400109698336\">\n";
while($adrow = mysqli_fetch_array($adquery))
{
$dispad = $adrow['link'];
}
date_default_timezone_set('America/Chicago');
$year = date("Y");
?>