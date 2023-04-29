<style>
textarea  {
font-family: Verdana, Geneva, sans-serif;}
</style>
<?php
include "scripts/mysql.php";
$id = $_GET['id'];
$ar = '1';
echo "<table width=\"100%\">";
$sql1 = "SELECT `id`,`u`,`d`,`p` FROM `".$id."` WHERE `f` = '0' ORDER BY `id` DESC";
$query1 = mysqli_query($sqlcxn,$sql1);
while($row1 = mysqli_fetch_assoc($query1))
{
$sd = $row1['d'];
$ndate = date('M jS \a\t g:i a', strtotime($sd));
$post = $row1['p'];
$userid = $row1['u'];
$sql2 = "SELECT `name`,`fbid`,`avatar` FROM `users` WHERE `userid` = '".$userid."'";
$query2 = mysqli_query($sqlcxn,$sql2);
while($row2 = mysqli_fetch_assoc($query2))
{
if($ar%6==0)
{
?>
<tr><td colspan="2">
<div class="tablead">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- chabate-mobile -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-2057589821822878"
     data-ad-slot="2039298040"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script></div>
</td></tr>
<?php
}
$avatar = $row2['avatar'];
$name = $row2['name'];
echo "<tr><td rowspan=\"2\" width=\"50px\"><img src=\"/chabate/images/avatars/".$avatar.".png\" class=\"left\" width=\"40\" /></td><td><a href=\"account.php?uid=".$userid."\" ><font size=\"2em\" color=\"blue\">".$name."</font></a>&nbsp;&nbsp;<font size=\"0.75em\">".$ndate."</font></td></tr>\n";
echo "<td class=\"left\"><font color=\"#888888\" size=\"2em\">".$post."</font></td></tr>";
echo "<tr><tr><td bgcolor=\"lightgray\" colspan=\"2\"></td></tr>\n";
$ar++;
}
}
echo "</table>";
?>