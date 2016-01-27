<?php
require_once("connection/pbmartconnection.php");
include('header.php');

	$act = $_GET['act'];
	if($act == 'confirmation')
	{
		$usr_id = $_GET['usr_id'];
		$first_name = $_GET['first_name'];
		$last_name = $_GET['last_name'];
		$user_email = $_GET['user_email'];
		$usr_regDate = $_GET['usr_regDate'];
		$usr_vcode = $_GET['usr_vcode'];
		
		//do checking user mail verification
		
		$sql = "Select * FROM pbmart_member WHERE member_id='$usr_id' AND
										   member_first_name='$first_name' AND 
										   member_last_name='$last_name' AND 
										   member_email='$user_email' AND
										   member_regis_date='$usr_regDate' AND
										   member_vcode ='$usr_vcode'";
		$checkforValidate = @mysql_query($sql, $link)or die($myQuery."<br/><br/>".mysql_error());
		//echo mysql_num_rows($checkforValidate); exit;
		if(mysql_num_rows($checkforValidate) != 0)
		{
			 echo "<script>window.top.location ='register_action.php?act=update2&usr_id=$usr_id&first_name=$first_name&last_name=$last_name';</script>";
		}else
		{
			$message1 = "Error";
			$message2 = "Email varification is fail! Please try again later! Thanks!";	
		}
	}
	
	if($act == 'activated')
	{
		$first_name = $_GET['first_name'];
		$last_name = $_GET['last_name'];
		
		$message1 = "Congratulation!";
		$message2 = $first_name." ".$last_name;
		$message2.= "<BR>Your account has been activated.";
	}
?>
<table class="tblD" border="0" cellspacing="0" cellpadding="0" width="100%" height="15%">
	<tr>
		<td height=40%>	
			&nbsp;
		</td>
		<td>
		</td>
	</tr>
	
	<tr>
		<td height=5%>
			
			<BR>
			<BR>
		</td>
		<td>
		</td>
	</tr>
	
	<tr>
		<td align="center"><img src="css/images/welcome.png"></img><BR><BR><BR></td>
		<td align="left">
			<font face="verdana" size="5"><strong><?php //echo $message1; ?></strong></font><BR><BR>
			<font face="verdana" size="2"><?php //echo $message2; ?></font>
		</td>
	</tr>
	
</table>
<?php include('footer.php');