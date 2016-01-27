<?php
include("connection/pbmartconnection.php");
include('session_config.php');
get_UsrInfo();
if($member_token < 5)
{
	$message = "*Note: You do not have enough PB Tokens convert to PB Points!";
	echo "<script type='text/javascript'>alert('$message');</script>";
	echo "<script language='JavaScript'>window.top.location ='myaccount.php?hyperlink=myaccount';</script>";
	exit;
}else
{
	$aft_pbPoints = $member_point + 200;
	$aft_pbTokens = $member_token - 5;
	
	$sql_member_upd = "UPDATE pbmart_member
						SET
							member_point = '$aft_pbPoints', 
							member_token = '$aft_pbTokens'
						WHERE member_id = '$member_id'";
	
	$member_update = @mysql_query($sql_member_upd);
	if(!$member_update)
	{
		echo ("Failed to update table. DEBUG: .$member_update");
	}else
	{
		$message = "PB Tokens has been convert successfully!";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo "<script language='JavaScript'>window.top.location ='myaccount.php?hyperlink=myaccount';</script>";
		exit;
	}
}
?>