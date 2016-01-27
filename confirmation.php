<?php 
	include('header.php');
	$usr_email = $_REQUEST['usr_email'];
	$usr_id = $_REQUEST['usr_id'];
	
	$first_name = $_REQUEST['first_name'];
	$last_name = $_REQUEST['last_name'];
	$usr_regDate = $_REQUEST['usr_regDate'];
	$usr_id = $_REQUEST['usr_id'];
	$usr_vcode = $_REQUEST['usr_vcode'];
?>
<table border=0>
  <tr>
	<td>
		<form method="post" action="PHPMailer-master/send_mail.php">
			<table border='0' width="940px" height="400px">
				
				<tr>
					<td align="center">
						<img src="css/images/thankyoured.png"></img>
					</td>
				</tr>
				
				<tr>
					<td>
						<BR>
						<!--<font size='3'/>Please check your mail <?php echo $usr_email; ?> for confirmation! Thank you! -->
						
						<font size='4'/>
						&nbsp;&nbsp;&nbsp;&nbsp;Don't see the confirmation email? Click the button below to resend.<BR><BR>
						&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Resend Email" onclick="return confirm('Are you sure to resend the confirmation email?')"></input>
						<BR><BR><BR>
					</td>
				</tr>
				
				<input type="hidden" name="usr_id" value="<?php echo $usr_id; ?>"></input>
				<input type="hidden" name="first_name" value="<?php echo $first_name; ?>"></input>
				<input type="hidden" name="last_name" value="<?php echo $last_name; ?>"></input>
				<input type="hidden" name="user_email" value="<?php echo $usr_email; ?>"></input>
				<input type="hidden" name="usr_regDate" value="<?php echo $usr_regDate; ?>"></input>
				<input type="hidden" name="usr_vcode" value="<?php echo $usr_vcode; ?>"></input>
			</table>
		</form>
	</td>
  </tr>
  <tr>
	
	<td>
		<table border=0>
			
		</table>
	</td>
  </tr>
</table>
<?php include('footer.php'); ?>
