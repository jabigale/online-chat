<?php
include_once ('scripts/mysql.php');
$table = $_GET['tbl'];
$postid = $_GET['pid'];
$referpage = $_GET['p'];
$currentuid = $_COOKIE['uid'];
if(isset($_GET['t']))
{
$t = $_GET['t'];
}
if($referpage == '1')
{
$endpage = "index.php";
}

if($postid>'1')
{
echo "Are you sure you want to delete this post?<br />\n";
echo "<a href=\"javascript: self.close()\"><input type=\"button\" value=\"No\"></a><a href=\"deletepost.php?tbl=".$table."&pid=".$postid."&p=".$referpage."&f=".$pfbid."&t=1\"><input type=\"button\" value=\"Yes\"></a>";
}
if($t==='1'&&$postid>'1')
{
$sql1 = "UPDATE `".$table."` SET `f` = '1',`flagger` = '".$pfbid."' WHERE `id` = '".$postid."'";
$query1 = mysqli_query($sqlcxn,$sql1);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<script>
function closeBrowser(){
    window.close();
</script>
</head>
 <body onload="self.close();">
 </body>
</html>
<?php
}
?>