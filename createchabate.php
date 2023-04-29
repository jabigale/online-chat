<?php
include "scripts/mysql.php";
include "scripts/global.php";
session_start();

  if($_SESSION['login']=='1') { 

?>
<?php
if(isset($_POST['submit']))
{
$nchabate = $_POST['title'];
$fbid = $_POST['fbid'];
$c1 = $_POST['1'];
$c2 = $_POST['2'];
$c3 = $_POST['3'];
$c4 = $_POST['4'];
$c5 = $_POST['5'];
$c6 = $_POST['6'];
$c7 = $_POST['7'];
$c8 = $_POST['8'];
$c9 = $_POST['9'];
$c10 = $_POST['10'];
$c11 = $_POST['11'];
$c12 = $_POST['12'];
$c13 = $_POST['13'];
$c14 = $_POST['14'];
$c15 = $_POST['15'];
$c16 = $_POST['16'];
$c17 = $_POST['17'];
$c18 = $_POST['18'];
$c19 = $_POST['19'];
$c20 = $_POST['20'];
if($c1 === "1")
{
	$cat1 = '1';
}
if($c2 === "1")
{
	$cat2 = '1';
}
if($c3 === "1")
{
	$cat3 = '1';
}
if($c4 === "1")
{
	$cat4 = '1';
}
if($c5 === "1")
{
	$cat5 = '1';
}
if($c6 === "1")
{
	$cat6 = '1';
}
if($c7 === "1")
{
	$cat7 = '1';
}
if($c8 === "1")
{
	$cat8 = '1';
}
if($c9 === "1")
{
	$cat9 = '1';
}
if($c10 === "1")
{
	$cat10 = '1';
}
if($c11 === "1")
{
	$cat11 = '1';
}
if($c12 === "1")
{
	$cat12 = '1';
}
if($c13 === "1")
{
$cat13 = '1';
}
if($c14 === "1")
{
$cat14 = '1';
}
if($c15 === "1")
{
$cat15 = '1';
}
if($c16 === "1")
{
$cat16 = '1';
}
if($c17 === "1")
{
$cat17 = '1';
}
if($c18 === "1")
{
$cat18 = '1';
}
if($c19 === "1")
{
$cat19 = '1';
}
if($c20 === "1")
{
$cat20 = '1';
}
$sql3 = "INSERT INTO `questions` (`title`,`cat1`,`cat2`,`cat3`,`cat4`,`cat5`,`cat6`,`cat7`,`cat8`,`cat9`,`cat10`,`cat11`,`cat12`,`cat13`,`cat14`,`cat15`,`cat16`,`cat17`,`cat18`,`cat19`,`cat20`,`fbid`) VALUES (:nchabate,'".$cat1."','".$cat2."','".$cat3."','".$cat4."','".$cat5."','".$cat6."','".$cat7."','".$cat8."','".$cat9."','".$cat10."','".$cat11."','".$cat12."','".$cat13."','".$cat14."','".$cat15."','".$cat16."','".$cat17."','".$cat18."','".$cat19."','".$cat20."','".$fbid."')";
      // Prepare the SQL query
$sth3 = $dbh->prepare($sql3);
      // Bind parameters to statement variables
$sth3->bindParam(':nchabate', $nchabate);
$sth3->bindParam(':lcpost', $lcpost);
$sth3->bindParam(':fbid', $fbid);
      // Execute statement
$sth3->execute();

$sql3 = "INSERT INTO `questions` (`title`,`cat1`,`cat2`,`cat3`,`cat4`,`cat5`,`cat6`,`cat7`,`cat8`,`cat9`,`cat10`,`cat11`,`cat12`,`cat13`,`cat14`,`cat15`,`cat16`,`cat17`,`cat18`,`cat19`,`cat20`,`fbid`) VALUES ('".$nchabate."','".$cat1."','".$cat2."','".$cat3."','".$cat4."','".$cat5."','".$cat6."','".$cat7."','".$cat8."','".$cat9."','".$cat10."','".$cat11."','".$cat12."','".$cat13."','".$cat14."','".$cat15."','".$cat16."','".$cat17."','".$cat18."','".$cat19."','".$cat20."','".$fbid."')";
$query3 = mysqli_query($sqlcxn,$sql3);
$sql3a = "SELECT `id` FROM `questions` ORDER BY `id` DESC LIMIT 1";
$query3a = mysqli_query($sqlcxn,$sql3a);
while($row3a = mysqli_fetch_array($query3a))
{
$ncid = $row3a['id'];
}
$sql3b = "CREATE TABLE `realetp3_chabate`.`".$ncid."` ( `id` int( 10 ) NOT NULL AUTO_INCREMENT,`u` varchar( 256 ),`d` timestamp DEFAULT CURRENT_TIMESTAMP,`p` text,`f` tinyint( 1 ) DEFAULT '0',`fid` bigint( 20 ),`flagger` bigint( 10 ),PRIMARY KEY ( `id` ) ) ENGINE = InnoDB DEFAULT CHARSET = latin1;";
$query3b = mysqli_query($sqlcxn,$sql3b);
$nctblid = "c".$ncid;
$sql3c = "CREATE TABLE `realetp3_chabate`.`".$nctblid."` ( `id` int( 10 ) NOT NULL AUTO_INCREMENT,`pid` int( 1 ) NOT NULL,`u` varchar( 256 ),`d` timestamp DEFAULT CURRENT_TIMESTAMP,`p` text,`f` tinyint( 1 ) DEFAULT '0',`fid` bigint( 20 ),`flagger` bigint( 10 ),PRIMARY KEY ( `id` ) ) ENGINE = InnoDB DEFAULT CHARSET = latin1;";
$query3c = mysqli_query($sqlcxn,$sql3c);

header("Location:http://www.whatcomputertobuy.com/chabate/chabates.php?chabateid=".$ncid."&sr=0&rc=30");
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
<link href="scripts/searchstyle.css?<?php echo rand(0,99999);?>" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="scripts/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="scripts/mootools-core-1.4.2.js"></script>
<script type="text/javascript" src="scripts/mootools-more-1.4.0.1.js"></script>
<script type="text/javascript" src="scripts/PopUpWindow.js"></script>

<script type="text/javascript">
  function valform() {
if($('input[type=checkbox]').is(':checked')==true)
{
document.getElementById('newchabate').submit();
  }
else
{
	alert('Please select at least 1 category')
	return false;
}
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
						<h2 class="title"><a href="#">Create a New Chabate</a></h2>
					</div>
					<div class="post">
<table><tr bgcolor="#f7f7f7"><td>
<form name="newchabate" id="newchabate" method="post" onsubmit="return valform();">
<input type="textbox" name="title" class="styleinput" onfocus="clearField(this);" size="50" onblur="restoreField(this);" value="Chabate Title"><br>
<p>Select Up to 3 Categories</p>
<?php
$sql1 = "SELECT `id`,`category` FROM `categories` ORDER BY `category` ASC";
$query1 = mysqli_query($sqlcxn,$sql1);
while($row1 = mysqli_fetch_array($query1))
{
$id1 = $row1['id'];
$cat1 = $row1['category'];
echo "<label for=\"c".$id1."\"><input type=\"checkbox\" name=\"".$id1."\" id=\"c".$id1."\" value=\"1\"><font size=\1em\" color=\"grey\">".$cat1."</font></label><br/>\n";
}
?>
<script type='text/javascript'>
  $(function() {
    $('textarea').autogrow();
  });
</script>
<?php
echo "<input type=\"hidden\" name=\"fbid\" value=\"".$user_id."\">";
?>
<br/><br/>
<input type="hidden" name="submit" value="submit">
<input type="image" src="images/buttons/create.png">
</form>
</td></tr>
<tr><td>&nbsp;</td></tr>
<!---<tr><td><a href="newcategory.php"><b>Suggest a New Category</b></a></td></tr> --->
</table>
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
echo "<li><a href=\"categories.php?categoryid=".$id5."\">".$cat5."</a></li>";
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
<?php
echo $metaog;
?>
<title>Social Chats and Debates</title>
<link href="http://fonts.googleapis.com/css?family=Arvo" rel="stylesheet" type="text/css" />
<link href="http://fonts.googleapis.com/css?family=Coda:400,800" rel="stylesheet" type="text/css" />
<link href="scripts/searchstyle.css?<?php echo rand(0,99999);?>" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="scripts/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="scripts/mootools-core-1.4.2.js"></script>
<script type="text/javascript" src="scripts/mootools-more-1.4.0.1.js"></script>
<script type="text/javascript" src="scripts/PopUpWindow.js"></script>

</head>
<body>
	<div id="fb-root"></div>

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
						<h2 class="title"><a href="#">Create a New Chabate</a></h2>
					</div>
					<div class="post">
						<p>Please login to create a Chabate.</p>
<a href="login.php"><img src="images/buttons/emlogin.png" alt="email login" align="middle"></a>
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