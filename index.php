<?php
// Author: VOONG TZE HOWE
// Date Writen: 09-10-2014
// Description : index home page
// Last Modification: 11-10-2014

include('header.php');
include("connection/pbmartconnection.php");


//perform site checking for site maintenance
$sql="Select * FROM pbmart_product";
$rs = @mysql_query($sql, $link);
$count = @mysql_num_rows($rs);	

if($count=='0')	
{		
	echo "<script language='JavaScript'>window.top.location ='site_maintainance.php';</script>";		
	exit;	
}
?>
<html>
<body>
	<table border='0'>
		<tr>
			<td valign='top'>
				<?php include('sidebar.php'); ?>
			</td>
			<td valign='center'>
				<?php include('content_slider.php'); ?>
				
					<?php //include('weekly_promotion.php'); ?>
					<BR/><BR/>
					<?php include('tupperware_hamper.php'); ?>
					<BR/><BR/>
					<?php include('refill_gas_promotion.php'); ?>
					<BR/><BR/><BR/>
					<?php include('special_promotion_2016.php'); ?>
					<BR/>
					<?php include('welcome_2016.php'); ?>
					<BR/><BR/>
					<?php include('special_promotion_index2.php'); ?>
					<BR/>
					<BR/>
					<?php include('gawai_promotion.php'); ?>
					<BR/>
					<?php include('product_index.php'); ?>
					<BR/>
					<?php include('promoA_index.php'); ?>
					<BR/>
					<?php include('promoB_index.php'); ?>
				  <!-- End Content Slider -->
			</td>
		</tr>
	</table>
	<!-- End Content -->
<?php
	include('more_product.php');
	include('sidefull.php');
	include('footer.php');
?>
	</div>
	<!--End Main -->
</div>
<!-- End Shell -->
</body>
</html>
