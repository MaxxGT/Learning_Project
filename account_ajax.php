<?php
include("connection/pbmartconnection.php");
$q = $_GET["q"];

$sql = "SELECT member_username FROM pbmart_member WHERE member_username = '".$q."'";
$result = @mysql_query($sql, $link);
$iCount = mysql_num_rows($result);

if(strlen($q) < 6)
{
	echo "*Username must be at least 6 characters.";
}

if($iCount > 0)
{
	echo "Invalid Username! Please try again!";
}

mysql_close($link);

//try something new to github
?>