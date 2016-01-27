<?php
// Author: VOONG TZE HOWE
// Date Writen: 10-10-2014
// Description : contact action file that will do the sending email to admin
// Last Modification: 27-11-2014
require_once("connection/pbmartconnection.php");
include('session_config.php');

if(!isset($_SESSION['usr_name']))
{
	if(isset($_REQUEST['hyperlink']))
	{
		if($_REQUEST['hyperlink']=='contact')
		{	
			$message = "Please login to send feedback! Thanks!";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo "<script language='JavaScript'>window.top.location ='contact.php?hyperlink=contact';</script>";
			exit;
		}
	}
}else
{
	if(isset($_REQUEST['act']))
	{
		$act = htmlentities($_REQUEST['act']);
	}else
	{
		$act = "";
	}
}

if(isset($_POST['name']))
{	
	$name = htmlentities($_POST['name']);
	$name = strip_tags(trim($name));
}
else
{	
	$name="";
}

if(isset($_POST['email']))
{	
	$email = htmlentities($_POST['email']);
}else
{	
	$email="";
}

if(isset($_POST['gender']))
{	
	$gender = htmlentities($_POST['gender']);
}else
{	
	$gender="";
}

if(isset($_POST['feedback_experience']))
{	
	$feedback_experience = htmlentities($_POST['feedback_experience']);
}else
{	
	$feedback_experience="";
}

if(isset($_POST['feedbackType']))
{	
	$feedbackType = htmlentities($_POST['feedbackType']);
}else
{	
	$feedbackType="";
}

if(isset($_POST['commentBox']))
{	
	$commentBox = htmlentities($_POST['commentBox']);
}else
{	
	$commentBox="";
}

if($act == 'add')
{
    form_validate($name, $email, $gender, $feedback_experience, $feedbackType, $commentBox);	
	echo "<script type='text/javascript'>alert('Thanks for your feedback! We value every piece of feedback we receive. We cannot respond individually to every one, but we will use your comments as we strive to improve your shopping experience.');</script>";		
	//echo "<script>window.top.location ='PHPMailer-master/send_mail_feedback.php?name=$name&email=$email&gender=$gender&feedback_experience=$feedback_experience&feedbackType=$feedbackType&commentBox=$commentBox';</script>";
	?>
	<FORM method="post" id="feedbackForm" name="feedbackForm" action="PHPMailer-master/send_mail_feedback.php">
		<INPUT type="hidden" name="name" value="<?php echo $name; ?>">
		<INPUT type="hidden" name="email" value="<?php echo $email; ?>">
		<INPUT type="hidden" name="gender" value="<?php echo $gender; ?>">
		<INPUT type="hidden" name="feedback_experience" value="<?php echo $feedback_experience; ?>">
		<INPUT type="hidden" name="feedbackType" value="<?php echo $feedbackType; ?>">
		<INPUT type="hidden" name="commentBox" value="<?php echo $commentBox; ?>">
		<script language="JavaScript">document.feedbackForm.submit();</script>
	</FORM>	
<?php }

function form_validate($name, $email, $gender, $feedback_experience, $feedbackType, $commentBox)
{     
	if(empty($name) || $name=="" ){
        $message = "ERROR: Please provide your name!";		
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo "<script language='JavaScript'>window.top.location ='contact.php?hyperlink=contact';</script>";
		exit;
    }
	if(empty($email) || $email=="" ){
		$message = "ERROR: Please provide your email address!";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo "<script language='JavaScript'>window.top.location ='contact.php?hyperlink=contact';</script>";
		exit;
    }
	if(empty($gender) || $gender=="" ){
		$message = "ERROR: Please select gender!";
        echo "<script type='text/javascript'>alert('$message');</script>";
		echo "<script language='JavaScript'>window.top.location ='contact.php?hyperlink=contact';</script>";		exit;
    } 
	if(empty($feedback_experience) || $feedback_experience=="" ){
        $message = "ERROR: Please provide your experience!";		echo "<script type='text/javascript'>alert('$message');</script>";		echo "<script language='JavaScript'>window.top.location ='contact.php?hyperlink=contact';</script>";		exit;
    } 
	if(empty($feedbackType) || $feedbackType=="" ){
        $message = "ERROR: Please select feedback type!";
        echo "<script type='text/javascript'>alert('$message');</script>";		echo "<script language='JavaScript'>window.top.location ='contact.php?hyperlink=contact';</script>";		exit;
    } 
	if(empty($commentBox) || $commentBox=="" ){
		$message = "ERROR: Please provide your commentBox!";
        echo "<script type='text/javascript'>alert('$message');</script>";		echo "<script language='JavaScript'>window.top.location ='contact.php?hyperlink=contact';</script>";		exit;
    }
}
?>
