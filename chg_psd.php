<?php
// Author: VOONG TZE HOWE
// Date Writen: 16-11-2014
// Description : change password
// Last Modification:

include('header.php');

if(isset($_GET['member_first_name']))
{
	$member_first_name = $_GET['member_first_name'];
}
if(isset($_GET['member_vcode']))
{
	$member_vcode = $_GET['member_vcode'];
}
if(isset($_GET['member_email']))
{
	$member_email = $_GET['member_email'];
}
?>

<form action="rst_psd_validate.php" method="post">
<table border="0" width="960px" height="850px" valign="center">
		<tr>
			<td height="40px">
				<BR>
				<h2>
					<font size="4">Password Reset: Choose Your New Password</font>
				</h2>
			</td>
		</tr>
		
		<tr>
			<td height="10px">
				<BR>
				Enter New Password: &nbsp;&nbsp;&nbsp;
				<input type="password" name='usr_password' placeholder="Your password" size="24" autofocus></input>
			</td>
		</tr>
		
		<tr>
			<td height="10px">
				
				Re-enter the Password:
				<input type="password" name='cfr_password' placeholder="Password" size="24"></input><BR>
			</td>
		</tr>
		
		<tr>
			<td height="10px">
				 &nbsp;&nbsp;&nbsp;
				  &nbsp;&nbsp;&nbsp;
				   &nbsp;&nbsp;&nbsp;
				    &nbsp;&nbsp;&nbsp;
					 &nbsp;&nbsp;&nbsp;
					  &nbsp;&nbsp;&nbsp;
					   &nbsp;&nbsp;&nbsp;
					    &nbsp;&nbsp;&nbsp;
						 &nbsp;&nbsp;&nbsp;
						  &nbsp;&nbsp;&nbsp;
						  &nbsp;&nbsp;&nbsp;
						  &nbsp;&nbsp;&nbsp;&nbsp;

				
				<input type="submit" value="Reset Password"></input>
				<input type="hidden" name="act" value="reset_password"></input>
				<input type="hidden" name="member_email" value="<?php echo $member_email; ?>"></input>
				<input type="hidden" name="member_first_name" value="<?php echo $member_first_name; ?>"></input>
				<input type="hidden" name="member_vcode" value="<?php echo $member_vcode; ?>"></input>
			</td>
		</tr>
		
		<tr>
			<td height="650px">
				&nbsp;
			</td>
		</tr>
	</table>
</form>
<?php
	include('footer.php');
?>	