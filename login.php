<?php
include "scripts/mysql.php";
include "scripts/global.php";
$lsalt = "kjsdf$2#SADF0";
$errMsg1 = '';
$errMsg2 = '';
$ui = '0';
session_start();
if(isset($_POST['createaccount']))
{
$name = $_POST['newname'];
$enteredemail = $_POST['newemail'];
$email = strtolower($enteredemail);
$password = $_POST['newpassword'];
if(isset($_POST['avatar'])){
$selectedavatar = $_POST['avatar'];
}
else{
	$selectedavatar = rand(1,30);
}
//verify there isn't an email in the database
$sth4 = $dbh->prepare('SELECT userid FROM users WHERE email = :email');
$sth4->bindParam(':email', $email);
$sth4->execute();
$results4 = $sth4->fetch(PDO::FETCH_ASSOC);
if( ! $results4){
$characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
$rsalt = '';
$vsalt = '';
$usalt = '';
$usalt1 = '';
$max = '35';
 for ($i = 0; $i < '10'; $i++) {
      $rsalt .= $characters[mt_rand(0, $max)];
}
 for ($i = 0; $i < '20'; $i++) {
      $vsalt .= $characters[mt_rand(0, $max)];
}
 while($ui = '0')
 {
 for ($i = 0; $i < '10'; $i++) {
      $usalt .= $characters[mt_rand(0, $max)];
}
 for ($i = 0; $i < '5'; $i++) {
      $usalt1 .= $characters[mt_rand(0, $max)];
}
$csalt = $lsalt.$rsalt;
$hashpass = hash_hmac('sha256',$password,$csalt);
$usalt2 = $usalt.$usalt1;
	$sth3 = $dbh->prepare('SELECT userid FROM users WHERE usalt = :usalt2');
	$sth3->bindParam(':usalt2', $usalt2);
	$sth3->execute();
	$results3 = $sth3->fetch(PDO::FETCH_ASSOC);
	if( ! $results3)
{
$sql1 = "INSERT INTO `users` (`email`,`password`,`name`,`salt`,`avatar`,`vsalt`,`usalt`) VALUES (:email,:password,:name,:salt,:avatar,:vsalt,:usalt)";
      // Prepare the SQL query
$sth1 = $dbh->prepare($sql1);
      // Bind parameters to statement variables
$sth1->bindParam(':email',$email);
$sth1->bindParam(':password',$hashpass);
$sth1->bindParam(':name',$name);
$sth1->bindParam(':salt',$rsalt);
$sth1->bindParam(':avatar',$selectedavatar);
$sth1->bindParam(':vsalt',$vsalt);
$sth1->bindParam(':usalt',$usalt2);
      // Execute statement
$sth1->execute();
// The message
$ui = '1';
}
else
{
$ui = '0';
}}
$link = "https://www.whatcomputertobuy.com/chabate/validate.php?email=".$email."&vs=".$vsalt;
$message ='<html>
<head>
<style>
body
{
background: #fff;
font-family: "lucida grande", tahoma, verdana;
font-size:16px;
font-weight: bold;
color: #fff;
}
.content{
overflow:hidden;
background-color: #fff;
margin: 10px;
padding:10px;
}
</style>
</head>
<body>
<div class="content">
Thank you for joining Chabate, to confirm your email address, please follow the link below<br /><br />	
<center><a href="'.$link.'"><img src="https://www.whatcomputertobuy.com/chabate/images/validate.png" /></a></center><br /><br /><br /><br/ >
If you are having problems with following that link copy and paste the following in a web browser:<br/><br /><br />'.$link.'
</div>
</body>';
//to send HTML mail, the Content-type header must be set:
$headers='MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html;charset=iso-8859-1' . "\r\n";
$headers .= 'From: Chabate <noreply@chabate.com>' . "\r\n";

$subject = 'Chabate validation email';
// Send
mail($email,$subject,$message,$headers);
header('location:https://www.whatcomputertobuy.com/chabate/validate.php?new=1');
}
else{
$errMsg2 .= '<a href="forgotpassword.php"><font size="2">Email is already in use<br />Reset Password?</font></a>';
}
}
if(isset($_POST['login']))
{
$enteredemail = $_POST['email'];
$email = strtolower($enteredemail);
$password2 = $_POST['password'];
		//username and password sent from Form
if($email == '')
{
	$errMsg1 .= '<a href="forgotpassword.php"><font size="2">You must enter your email</font></a><br>';
}
if($errMsg1 == ''){
	$sth2 = $dbh->prepare('SELECT `salt`,`userid`,`password`,`usalt` FROM `users` WHERE `email` = :email');
	$sth2->bindParam(':email', $email);
	$sth2->execute();
	$results2 = $sth2->fetch(PDO::FETCH_ASSOC);
	if( ! $results2)
{
    $errMsg2 .= '<a href=""><font size="2">Email Does Not Exist!<br />Create a new account below</font>';
}
else
{
	$dbpassword = $results2['password'];
	$dbsalt = $results2['salt'];
	$usalt = $results2['usalt'];
	$userid = $results2['userid'];
	$csalt2 = $lsalt.$dbsalt;
	$enteredpassword = hash_hmac('sha256',$password2,$csalt2);
if ($enteredpassword===$dbpassword) {
    session_set_cookie_params(86400,"/");
	session_start();
	$_SESSION['login'] = '1';
	$_SESSION['userid'] = $userid;
header('location:https://www.whatcomputertobuy.com/chabate/');
}
else{
			$errMsg1 .= '<a href="forgotpassword.php"><font size="2">Email or Password were incorrect<br /></font></a>';
}
}
}
}
  require_once('scripts/facebook/facebook.php');
  $config = array(
    'appId' => '1405400109698336',
    'secret' => '6cb5f19dacd595a15b1ab7a514f16d62',
    'allowSignedRequest' => false // optional but should be set to false for non-canvas apps
  );
  $facebook = new Facebook($config);
  $login_url = $facebook->getLoginUrl();
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
    } else {
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
<?php
      $login_url = $facebook->getLoginUrl();
echo '<a href="' . $login_url . '"><img src="http://whatcomputertobuy.com/chabate/images/fblogin.png" width="210" alt="Facebook Login"></a>';
?>
<div class="form-style-5">
<form name="login" method="POST" action="login.php">
<fieldset>
<legend><span class="number">1</span>Log In</legend>
<input type="email" name="email" placeholder="Your Email">
<input type="text" name="password" onfocus="this.type='password'" placeholder="Password">
<?php
echo $errMsg1;
?>
<a href="forgotpassword.php"><font size="2">Forgot Password?</font></a>
<input type="hidden" name="login" value="1">
</fieldset>
<input type="submit" value="Login" />
</form>
<form name="signup" method="POST" action="login.php">
<fieldset>
<legend><span class="number">2</span>Create a New Account</legend>
<?php
echo $errMsg2;
?>
<input type="text" name="newname" placeholder="Your Name *">
<input type="email" name="newemail" placeholder="Your Email *">
<input type="text" name="newpassword" id="newpassword" onfocus="this.type='password'" placeholder="Password"/>
<img src="images/verifypw.png" onmouseover="mouseoverPass();" onmouseout="mouseoutPass();" />
Select Avatar:
<!--<table border="0" align="center" cellpadding="2" cellspacing="2">
<tr>
	<td><img src="images/avatars/1.png" alt="" width="40" height="40" /></td>
	<td><input type="radio" value="1" name="avatar" /></td>
	<td><img src="images/avatars/2.png" alt="" width="40" height="40" /></td>
	<td><input type="radio" value="2" name="avatar" /></td>
	<td><img src="images/avatars/3.png" alt="" width="40" height="40" /></td>
	<td><input type="radio" value="3" name="avatar" /></td>
</tr><tr>
	<td><img src="images/avatars/4.png" alt="" width="40" height="40" /></td>
	<td><input type="radio" value="4" name="avatar" /></td>
	<td><img src="images/avatars/5.png" alt="" width="40" height="40" /></td>
	<td><input type="radio" value="5" name="avatar" /></td>
	<td><img src="images/avatars/6.png" alt="" width="40" height="40" /></td>
	<td><input type="radio" value="6" name="avatar" /></td>
</tr><tr>
	<td><img src="images/avatars/7.png" alt="" width="40" height="40" /></td>
	<td><input type="radio" value="7" name="avatar" /></td>
	<td><img src="images/avatars/8.png" alt="" width="40" height="40" /></td>
	<td><input type="radio" value="8" name="avatar" /></td>
	<td><img src="images/avatars/9.png" alt="" width="40" height="40" /></td>
	<td><input type="radio" value="9" name="avatar" /></td>
</tr><tr>
	<td><img src="images/avatars/10.png" alt="" width="40" height="40" /></td>
	<td><input type="radio" value="10" name="avatar" /></td>
	<td><img src="images/avatars/11.png" alt="" width="40" height="40" /></td>
	<td><input type="radio" value="11" name="avatar" /></td>
	<td><img src="images/avatars/12.png" alt="" width="40" height="40" /></td>
	<td><input type="radio" value="12" name="avatar" /></td>
</tr><tr>
	<td><img src="images/avatars/13.png" alt="" width="40" height="40" /></td>
	<td><input type="radio" value="13" name="avatar" /></td>
	<td><img src="images/avatars/14.png" alt="" width="40" height="40" /></td>
	<td><input type="radio" value="14" name="avatar" /></td>
	<td><img src="images/avatars/15.png" alt="" width="40" height="40" /></td>
	<td><input type="radio" value="15" name="avatar" /></td>
</tr><tr>
	<td><img src="images/avatars/16.png" alt="" width="40" height="40" /></td>
	<td><input type="radio" value="16" name="avatar" /></td>
	<td><img src="images/avatars/17.png" alt="" width="40" height="40" /></td>
	<td><input type="radio" value="17" name="avatar" /></td>
	<td><img src="images/avatars/18.png" alt="" width="40" height="40" /></td>
	<td><input type="radio" value="18" name="avatar" /></td>
</tr><tr>
	<td><img src="images/avatars/19.png" alt="" width="40" height="40" /></td>
	<td><input type="radio" value="19" name="avatar" /></td>
	<td><img src="images/avatars/20.png" alt="" width="40" height="40" /></td>
	<td><input type="radio" value="20" name="avatar" /></td>
	<td><img src="images/avatars/21.png" alt="" width="40" height="40" /></td>
	<td><input type="radio" value="21" name="avatar" /></td>
</tr><tr>
	<td><img src="images/avatars/22.png" alt="" width="40" height="40" /></td>
	<td><input type="radio" value="22" name="avatar" /></td>
	<td><img src="images/avatars/23.png" alt="" width="40" height="40" /></td>
	<td><input type="radio" value="23" name="avatar" /></td>
	<td><img src="images/avatars/24.png" alt="" width="40" height="40" /></td>
	<td><input type="radio" value="24" name="avatar" /></td>
</tr><tr>
	<td><img src="images/avatars/25.png" alt="" width="40" height="40" /></td>
	<td><input type="radio" value="25" name="avatar" /></td>
	<td><img src="images/avatars/26.png" alt="" width="40" height="40" /></td>
	<td><input type="radio" value="26" name="avatar" /></td>
	<td><img src="images/avatars/27.png" alt="" width="40" height="40" /></td>
	<td><input type="radio" value="27" name="avatar" /></td>
</tr><tr>
	<td><img src="images/avatars/28.png" alt="" width="40" height="40" /></td>
	<td><input type="radio" value="28" name="avatar" /></td>
	<td><img src="images/avatars/29.png" alt="" width="40" height="40" /></td>
	<td><input type="radio" value="29" name="avatar" /></td>
	<td><img src="images/avatars/30.png" alt="" width="40" height="40" /></td>
	<td><input type="radio" value="30" name="avatar" /></td>
</tr></table>
-->
<input type="hidden" name="createaccount" value="1">
</fieldset>
<input type="submit" value="Create Account" />
</form>
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