<?php
if(isset($_SESSION['usr_name']))
{
	get_UsrInfo();
}
?>

<script type="text/javascript">
$(document).ready(function() {
var text_max = 3000;
$('#textarea_feedback').html(text_max + ' characters remaining');

$('#commentBox').keyup(function() {
    var text_length = $('#commentBox').val().length;
    var text_remaining = text_max - text_length;

    $('#textarea_feedback').html(text_remaining + ' characters remaining');
});

});
</script>


<div id="feedbackform">
	<table border="0" width="720px">
		<form action="contact_action.php" method="post">
				<tr>
					<td colspan="2"><h2><strong>Feedback Form</strong></h2></td>
				</tr>
				<tr>
					<td>&nbsp;&nbsp;&nbsp;</td>
					<td>&nbsp;&nbsp;&nbsp;</td>
				</tr>
				<tr>
					<td><span style = "color:red">*</span> Your Name</td>
					<?php
					if(!isset($_SESSION['usr_name']))
						{ ?>
							<td><input type="text" name="name" value="" autofocus></td>
						<?php }
						else
						{?>
							<td><input type="text" name="name" value="<?php echo $member_first_name.' '.$member_last_name; ?>"></td></td>
					<?php	}
					?>	
					
				</tr>
				<tr>
					<td>&nbsp;&nbsp;&nbsp;</td>
					<td>&nbsp;&nbsp;&nbsp;</td>
				</tr>
				<!--
				<tr>
					<td><span style = "color:red">*</span> Your Email</td>
					<?php
						if(!isset($_SESSION['usr_name']))
						{ ?>
							<td><input type="email" name="email" value=""></td>
						<?php }
						else
						{?>
							<td><input type="email" name="email" value=<?php echo $member_email; ?>></td>
					<?php	}
					?>	
				</tr>
				
				<tr>
					<td>&nbsp;&nbsp;&nbsp;</td>
					<td>&nbsp;&nbsp;&nbsp;</td>
				</tr>
				-->
				<tr>
					<td><span style = "color:red">*</span> Gender</td>
					<td><input type="radio" name="gender" value="male">  Male  | <input type="radio" name="gender" value="female"> Female</td>
				</tr>
				<tr>
					<td>&nbsp;&nbsp;&nbsp;</td>
					<td>&nbsp;&nbsp;&nbsp;</td>
				</tr>
				<tr>
					<td><span style = "color:red">*</span> Your Experience</td>
					<td><input type="radio" name="feedback_experience" value="amazing"> Amazing |    
					<input type="radio" name="feedback_experience" value="verygood"> Excellent |  
					<input type="radio" name="feedback_experience" value="good"> Good | 
					<input type="radio" name="feedback_experience" value="average"> Average |  
					<input type="radio" name="feedback_experience" value="poor"> Poor   </td>
				</tr>				
				<tr>
					<td>&nbsp;&nbsp;&nbsp;</td>
					<td>&nbsp;&nbsp;&nbsp;</td>
				</tr>
				<tr>
					<td><span style = "color:red">*</span> Feedback Type</td>
					<td>
						<select type="feedbackType" name="feedbackType">
							<option value="">-- Select --</option>							<option value="feedback"> Feedback </option>
							<option value="complaint"> Complaint </option>
							<option value="suggestion"> Suggestion </option>
						</select>
					</td>
				</tr>				
				<tr>
					<td>&nbsp;&nbsp;&nbsp;</td>
					<td>&nbsp;&nbsp;&nbsp;</td>
				</tr>
				<tr>		
					<td class="feedbackformfield"> <label for="textarea"><span style = "color:red">*</span> Your Feedback</td>
					<td>
						<textarea name="commentBox" id="commentBox" rows="6" cols="83"  maxlength="3000"></textarea>
					</td>
				</tr>
				<tr>
					<td align='right' colspan='2'>
						<div id="textarea_feedback"></div>
					</td>
				<tr>
					<td>&nbsp;&nbsp;&nbsp;</td>
					<td>&nbsp;&nbsp;&nbsp;</td>
				</tr>
				<tr>
					<td colspan="2">
						<table width="710px">
							<tr>
								<td align="left"><strong><font size="2">Note: All fields marked with "<span style = "color:red">*</span>" are mandatory</font></strong></td>
								<td align="right"><input type="submit" value="Submit" <?php if(isset($_SESSION['usr_name'])){ echo "onclick='return confirm('Are you sure to submit your feedback?')'";	} ?> title="Click to submit your feedback"></button></td>
							</tr>
						</table>
					</td>
				</tr>
				<input type="hidden" name="act" value="add"></input>
				<input type="hidden" name="email" value="<?php echo $member_email; ?>"></input>
				<input type="hidden" name="hyperlink" value="contact"></input>
		</form>
	</table>	
</div>