<?php
// Author: VOONG TZE HOWE
// Date Writen: 02-11-2014
// Description : checkout
// Last Modification:

include('session_config.php');
include("connection/pbmartconnection.php");
get_UsrInfo();
GLOBAL $member_commercial_status;

if(isset($_REQUEST['act']))
{
	$act = $_REQUEST['act'];
}

//CHECKING DATE VALIDATION
function date_validate($shipping_date)
{
	if($shipping_date < get_currentDateTime())
	{
		//echo ('ship_date: '.$shipping_date.' < '.get_currentDateTime()); exit;
		$message = "Warning! Shipping Date not match! Please try again!";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo "<script language='JavaScript'>window.top.location ='checkout_page.php?hyperlink=home';</script>";
		exit;
	}
}

//a function use to get current time and date base on the selected timezone set
function get_currentDateTime()
{
	date_default_timezone_set('Asia/Kuching'); // CDT

	$crt_date = new DateTime();
	
	$info = getdate();
	$date = $info['mday'];
	$month = $info['mon'];
	$year = $info['year'];
	$hour = $info['hours'];
	$min = $info['minutes'];
	$sec = $info['seconds'];

	$crt_date->setDate($year, $month, $date);
	
	$current_date = $crt_date->format('Y-m-d');
	return $current_date;
}

function get_currentTime()
{
	date_default_timezone_set('Asia/Kuching'); // CDT

	$crt_date = new DateTime();
	
	$info = getdate();
	$date = $info['mday'];
	$month = $info['mon'];
	$year = $info['year'];
	$hour = $info['hours'];
	$min = $info['minutes'];
	$sec = $info['seconds'];

	$Time = $hour.':'.$min.':'.$sec;
	$newTime = date('g:i:s A', strtotime($Time));
	return $newTime;
}

if($act == 'add')
{
	if(isset($_POST['member_point']) && $_POST['member_point']!='0')
	{
		$member_point = $_POST['member_point'];
	}
	
	if(isset($_POST['total_point_reward']) && $_POST['total_point_reward']!='0')
	{
		$total_point_reward = $_POST['total_point_reward'];
	}else
	{
		$total_point_reward = '0';
	}
	
	if($_POST['shp_time']=='0')	
	{
			$message = "Error: Please select preferred shipping time!";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo "<script language='JavaScript'>window.top.location ='checkout_page.php?hyperlink=home';</script>";
			exit;
	}	
	
	if(isset($_POST['shp_time']) && $_POST['shp_time']!='0')
	{
		$shp_time = $_POST['shp_time'];
	}else{
			$message = "Error: Please select preferred shipping time!";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo "<script language='JavaScript'>window.top.location ='checkout_page.php?hyperlink=home';</script>";
			exit;
	}

	if($shp_time !='3')
	{
		if(isset($_POST['shp_date']) && $_POST['shp_date']!='')
		{
			$shp_date = $_POST['shp_date'];
			$d = date_create($shp_date);
			$shp_date = date_format($d, 'Y-m-d');
			date_validate($shp_date);
		}else{
			$message = "Error: Please select preferred shipping date!";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo "<script language='JavaScript'>window.top.location ='checkout_page.php?hyperlink=home';</script>";
			exit;
		}
	}else
	{
		$shp_date = date("Y-m-d");
	}

	if(isset($_POST['cash_on_delivery_rd']) && $_POST['cash_on_delivery_rd']!="")
	{
		$odr_payment_type = $_POST['cash_on_delivery_rd'];
	}else{
		$message = "Error: Please select payment type! Thanks!";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo "<script language='JavaScript'>window.top.location ='checkout_page.php?hyperlink=home';</script>";
		exit;
	}

	//gather account information
	if(isset($_POST['first_name']) && $_POST['first_name']!="")
	{
		$first_name = $_POST['first_name'];
	}else{
		$message = "Error: Please key in your first name! Thanks!";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo "<script language='JavaScript'>window.top.location ='checkout_page.php?hyperlink=home';</script>";
		exit;
	}

	if(isset($_POST['last_name']) && $_POST['last_name']!="")
	{
		$last_name = $_POST['last_name'];
	}else{
		$message = "Error: Please key in your last name! Thanks!";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo "<script language='JavaScript'>window.top.location ='checkout_page.php?hyperlink=home';</script>";
		exit;
	}

	if(isset($_POST['user_email']) && $_POST['user_email']!="")
	{
		$user_email = $_POST['user_email'];
	}else{
		$message = "Error: Please key in your email! Thanks!";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo "<script language='JavaScript'>window.top.location ='checkout_page.php?hyperlink=home';</script>";
		exit;
	}

	if(isset($_POST['tel']) && $_POST['tel']!="")
	{
		$tel = $_POST['tel'];
	}else{
		$tel = "";
	}

	if(isset($_POST['mobile']) && $_POST['mobile']!="")
	{
		$mobile = $_POST['mobile'];
	}else{
		$message = "Error: Please key in your mobile number! Thanks!";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo "<script language='JavaScript'>window.top.location ='checkout_page.php?hyperlink=home';</script>";
		exit;
	}

	//gather delivery address information

	if(isset($_POST['street_name']) && $_POST['street_name']!="")
	{
		$street_name = $_POST['street_name'];
	}else{
		$message = "Error: Please key in your street name! Thanks!";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo "<script language='JavaScript'>window.top.location ='checkout_page.php?hyperlink=home';</script>";
		exit;
	}

	if(isset($_POST['flr_num']) && $_POST['flr_num']!="")
	{
		$flr_num = $_POST['flr_num'];
	}else
	{
		$flr_num = "0";
	}

	if(isset($_POST['dlvy_type']) && $_POST['dlvy_type']!="")
	{
		$dlvy_type = $_POST['dlvy_type'];
		if($dlvy_type == '0')
		{
			$flr_num = "0";
		}
	}

	if(isset($_POST['city']) && $_POST['city']!='0')
	{
		$city = $_POST['city'];
	}else{
		$message = "Error: Please select your city! Thanks!";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo "<script language='JavaScript'>window.top.location ='checkout_page.php?hyperlink=home';</script>";
		exit;
	}

	if(isset($_POST['region_state']) && $_POST['region_state']!='0')
	{
		$region_state = $_POST['region_state'];
	}else{
		$message = "Error: Please select your region state! Thanks!";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo "<script language='JavaScript'>window.top.location ='checkout_page.php?hyperlink=home';</script>";
		exit;
	}

	if(isset($_POST['country']) && $_POST['country']!='0')
	{
		$country = $_POST['country'];
	}else{
		$message = "Error: Please select your country! Thanks!";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo "<script language='JavaScript'>window.top.location ='checkout_page.php?hyperlink=home';</script>";
		exit;
	}

	if(isset($_POST['pst_code']) && $_POST['pst_code']!='0')
	{
		$pst_code = $_POST['pst_code'];
	}else{
		$message = "Error: Please select your postcode! Thanks!";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo "<script language='JavaScript'>window.top.location ='checkout_page.php?hyperlink=home';</script>";
		exit;
	}
	
	if(isset($_POST['chk_tnc']) && $_POST['chk_tnc']=='1')
	{
		
	}else
	{
		$message = "Error: Please read and accept the services provided area. Thanks!";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo "<script language='JavaScript'>window.top.location ='checkout_page.php?hyperlink=home';</script>";
		exit;
	}

$order_handling = (isset($_REQUEST['total_handling_charge']) ? $_REQUEST['total_handling_charge'] : '');
$total_flat_handling = '0';
$total_flat_handling = (isset($_REQUEST['total_flat_handling']) ? $_REQUEST['total_flat_handling'] : '');

$table_name = "pbmart_order";
$odr_cst_id = $_SESSION['usr_id'];

//get latest order number and convert to new order num
$sql_orders = "SELECT MAX(order_id) AS odr_id FROM pbmart_order";
$rs_orders = mysql_query($sql_orders, $link);
$rw_orders = @mysql_fetch_assoc($rs_orders);
$odr_id = $rw_orders['odr_id']; 

$sql_orders2 = mysql_query("SELECT order_id, order_number FROM pbmart_order WHERE order_id = '$odr_id'");
$rw_orders2 = @mysql_fetch_assoc($sql_orders2);
$odr_num2 = $rw_orders2['order_number'];

$order_num = "";

if($odr_num2 == "")
{
	$odr_num2 = "OR000000";
	$order_num = "OR000000";
}else
{
	$orders_number = explode("OR", $odr_num2);
	$f_orders_num = $orders_number[1] + 1;
	$order_num = 'OR'.str_pad($f_orders_num, 6, '0', STR_PAD_LEFT);

	//check for order number existing
	$sql_odr_num = mysql_query("SELECT order_number FROM pbmart_order WHERE order_number = '$order_num'");
	$odr_count = @mysql_num_rows($sql_odr_num);
	if($odr_count !='0')
	{
		$message = "Error! Please try again later! Thank you!";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo "<script language='JavaScript'>window.top.location ='checkout_page.php?hyperlink=home';</script>";
		exit;
	}
}
$order_total_point = $total_point_reward;
$order_amount = $_POST['sub_total'];
$order_date = date("Y-m-d");
$order_date_time = get_currentTime();
$order_delivery = $shp_date;
$order_customer_name = $_SESSION['usr_name'];
$order_customer_id = $_SESSION['usr_id'];
//order_validate($order_customer_id);

$order_payment_status = "0";
$order_status = "0";

$order_customer_address = $street_name.", ".$pst_code." ".$city.", ".$region_state.", ".$country;

		//update client informations
		$query_member_update = "UPDATE pbmart_member
									SET
										member_first_name='$first_name',
										member_last_name='$last_name',
										member_email='$user_email',
										member_telephone='$tel',
										member_contact='$mobile',
										
										member_street_name='$street_name',
										member_flat_status = '$dlvy_type',
										member_flat_floor='$flr_num',
										
										member_postcode='$pst_code',
										member_city='$city',
										member_state='$region_state',
										member_country='$country'
										
									WHERE member_id='$order_customer_id'";
									
		$member_update = @mysql_query($query_member_update);
		
		if($member_update)
		{
			//update session usr_name
			$usr_name = $first_name.' '.$last_name;
			$_SESSION['usr_name'] = $usr_name;
			$order_payment_type = cvrt_paymentType($odr_payment_type);
			if($order_payment_type== 'Cash')
			{
				$ePaymentStatus = '0';
			}else
			{
				$ePaymentStatus = '1';
			}
				
			$sql_pbmart_order = "INSERT INTO $table_name(order_number,order_amount,flat_handling,order_handling,order_date,order_time_date,order_delivery,order_time,order_customer_id,order_customer_name, order_customer_telephone, order_customer_contact, order_customer_address, order_payment_type, order_payment_status, order_total_point, order_status, ePaymentStatus)

			VALUES ('$order_num','$order_amount','$total_flat_handling','$order_handling','$order_date','$order_date_time','$order_delivery','$shp_time','$order_customer_id','$order_customer_name','$mobile','$mobile','$order_customer_address','$order_payment_type','$order_payment_status','$order_total_point','$order_status','$ePaymentStatus')";

			$result = @mysql_query($sql_pbmart_order);    

			if($result)
			{	
				$total_handling_charge = '0';
				
				if(!empty($_SESSION['order_qty']))
				{
					for($i=0; $i<$_SESSION['order_qty']; $i++)
					{
						$product_id = $_SESSION['product_id'][$i];
						
						//if selected product is package, then...
						if(strpos($product_id, 'PKG_') !== false)
						{
							//gas order type
							if(isset($_SESSION['odr_gas_type'][$i]))
							{
								$odr_gas_type = $_SESSION['odr_gas_type'][$i];
							}
							
							$product_ids = explode("PKG_", $product_id);
							$product_ids2 = $product_ids[1];
							
							$sql_pbmart_product = "Select 
													promotion_package_name,
													promotion_product_name AS prd_name,
													promotion_product_model,
													promotion_item_name AS itm_name,
													promotion_package_price,
													promotion_package_point,
													promotion_package_double_point,
													promotion_product_price AS prd_price,
													promotion_product_sale,
													promotion_item_price AS itm_price,
													promotion_item_sale,
													promotion_package_stock AS product_stock,
													'0' AS product_sale1,
													'0' AS product_sale_percentage1,
													'0' AS product_sale2,
													'0' AS product_sale_percentage2,
													'0' AS product_sale3,
													'0' AS product_sale_percentage3,
													promotion_category_id,
													promotion_package_sale
													
							FROM pbmart_promotion WHERE promotion_id = '$product_ids2'";
							$rs = mysql_query($sql_pbmart_product, $link);
							$rw2 = mysql_fetch_array($rs);
							
							$order_product_class = "Promotion";
							$promotion_package_name = $rw2['promotion_package_name'];
							$prd_name = $rw2['prd_name'];
							$promotion_product_model = $rw2['promotion_product_model'];
							$itm_name = $rw2['itm_name'];
							$promotion_package_price = $rw2['promotion_package_price'];
							$promotion_package_point = $rw2['promotion_package_point'];
							$promotion_package_double_point = $rw2['promotion_package_double_point'];
							
							if($promotion_package_double_point =='1')
							{
								$prm_unit_points = $promotion_package_point * 2;
							}else
							{
								$prm_unit_points = $promotion_package_point;
							}
							
							
							$prd_price = $rw2['prd_price'];
							$promotion_product_sale = $rw2['promotion_product_sale'];
							$promotion_product_handling = $promotion_product_sale - $prd_price;
							$itm_price = $rw2['itm_price'];
							$promotion_item_sale = $rw2['promotion_item_sale'];
							$promotion_unit_price = $prd_price;
							
							
							
							$product_stock = $rw2['product_stock'];
							$promotion_category_id = $rw2['promotion_category_id'];
							$promotion_package_sale = $rw2['promotion_package_sale'];
							
							$product_name_gas = $promotion_package_name.' '.$prd_name;
							$product_name_item = $promotion_package_name.' '.$itm_name;
							$product_price = $promotion_package_price;
							
							//access category of product_sale and product_sale_percentage
							$product_sale1 = $rw2['product_sale1'];
							$product_sale_percentage1 = $rw2['product_sale_percentage1'];
							$product_sale2 = $rw2['product_sale2'];
							$product_sale_percentage2 = $rw2['product_sale_percentage2'];
							$product_sale3 = $rw2['product_sale3'];
							$product_sale_percentage3 = $rw2['product_sale_percentage3'];
							
							
							$pro_amount = $_SESSION['product_qty'][$i];
							$remain_pro = $product_stock - $pro_amount;
							$total_product_sale = $promotion_package_sale + $_SESSION['product_qty'][$i];
							
							$product_sale_percentage = cal_prd_sales($product_price, $pro_amount, $product_sale1, $product_sale_percentage1, $product_sale2, $product_sale_percentage2, $product_sale3, $product_sale_percentage3);
							
							//flat handling
							if($promotion_category_id == '1' || $promotion_category_id == '3' || $promotion_category_id == '4' || $promotion_category_id == '5' || $promotion_category_id == '6' || $promotion_category_id == '7' || $promotion_category_id == '8')
							{
								$total_flat_handling = $total_flat_handling + ($pro_amount * $member_flat_floor);
							}else
							{
								$total_flat_handling = $total_flat_handling + 0;
							}
							
							
							
							$sql_gas = "INSERT INTO pbmart_order_list(order_number, order_product_id, order_product_class, order_product_name, order_product_model, order_product_price, order_product_handling, order_product_point, order_product_sale, order_product_amount)
							VALUES('$order_num', '$product_ids2', '$order_product_class', '$product_name_gas', '$promotion_product_model', '$promotion_unit_price', '$promotion_product_handling', '$prm_unit_points', '$product_sale_percentage', '$pro_amount')";
							
							$result_gas = @mysql_query($sql_gas);
							if(!$result_gas)
							{
								echo $sql_gas;
								echo ("Failed to create $sql_gas record");
							}
							
							$sql_item = "INSERT INTO pbmart_order_list(order_number, order_product_id, order_product_class, order_product_name, order_product_price, order_product_handling, order_product_point, order_product_sale, order_product_amount)

							VALUES ('$order_num', '$product_ids2', '$order_product_class', '$product_name_item', '$promotion_item_sale', '', '', '$product_sale_percentage', '$pro_amount')";

							$result2 = @mysql_query($sql_item);
							if(!$result2)
							{
								echo $sql;
								echo ("Failed to create $sql_item record");
							}
							
							if($order_payment_type == "Cash")
							{
								$prd_pkg_stock = pkg_validations($product_ids2);
								if($prd_pkg_stock == '0' || $prd_pkg_stock < '0')
								{
									$message = "Error! Please try again later! Thank you!";
									ord_del($order_num, $order_customer_id);
									echo "<script type='text/javascript'>alert('$message');</script>";
									echo "<script language='JavaScript'>window.top.location ='checkout_page.php?hyperlink=home';</script>";
									exit;
								}
								
									if($remain_pro < '0')
									{
										$message = "Error! Please try again later! Thank you!";
										ord_del($order_num, $order_customer_id);
										echo "<script type='text/javascript'>alert('$message');</script>";
										echo "<script language='JavaScript'>window.top.location ='checkout_page.php?hyperlink=home';</script>";
										exit;
									}else
									{
										$query="UPDATE pbmart_promotion
										SET
											promotion_package_stock = '$remain_pro',
											promotion_package_sale = '$total_product_sale'
											WHERE promotion_id = '$product_ids2'";
										$result3 = @mysql_query($query);
										if(!$result3)
										{
											echo ("Failed to update table. DEBUG: .$query");
										}
									}
							}
						}else
						{
							$total_handling_charge = '0';
							$product_unit_price = '0';
							
							//for non package product
							$sql_pbmart_product = "SELECT * FROM pbmart_product WHERE product_id = '$product_id'";
							$rs = @mysql_query($sql_pbmart_product, $link);
							$rw2 = @mysql_fetch_array($rs);
							$order_product_class = 'Product';
							$product_name = $rw2['product_name'];
							$product_category_id = $rw2['product_category_id'];
							$product_model = $rw2['product_model'];
							$product_price = $rw2['product_price'];
							$product_commercial_price = $rw2['product_commercial_price'];
							$product_commercial_price2 = $rw2['product_commercial_price2'];
							$product_handling = $rw2['product_handling'];
							$product_handling_show = $rw2['product_handling_show'];
							$product_commercial_handling = $rw2['product_commercial_handling'];
							$product_commercial_handling2 = $rw2['product_commercial_handling2'];
							$product_commercial_handling_show = $rw2['product_commercial_handling_show'];
							$product_commercial_handling_show2 = $rw2['product_commercial_handling_show2'];
							$product_point = $rw2['product_point'];
							$product_commercial_point = $rw2['product_commercial_point'];
							$product_commercial_point2 = $rw2['product_commercial_point2'];
							
							$product_double_point = $rw2['product_double_point'];
							$product_commercial_double_point = $rw2['product_commercial_double_point'];
							$product_commercial_double_point2 = $rw2['product_commercial_double_point2'];
							
							$product_stock = $rw2['product_stock'];
							$product_sale = $rw2['product_sale'];
							
							//access category of product_sale and product_sale_percentage
							$product_sale1 = $rw2['product_sale1'];
							$product_sale_percentage1 = $rw2['product_sale_percentage1'];
							$product_sale2 = $rw2['product_sale2'];
							$product_sale_percentage2 = $rw2['product_sale_percentage2'];
							$product_sale3 = $rw2['product_sale3'];
							$product_sale_percentage3 = $rw2['product_sale_percentage3'];
							
							$pro_amount = $_SESSION['product_qty'][$i];
							$remain_pro = $product_stock - $pro_amount;
							$total_product_sale = $product_sale + $_SESSION['product_qty'][$i];
							
							//price checking here...
							if($member_commercial_status == '0')
							{
								if($product_handling_show == '0')
								{
									$product_unit_price = $product_price + $product_handling;
									$total_handling_charge = '0';
								}else
								{
									$product_unit_price = $product_price;
									$total_handling_charge = $total_handling_charge + $product_handling;
								}
								//point checking for double point
								if($product_double_point == '1')
								{
									$prd_points = $product_point * 2;
									//$prd_points = $product_point;
								}else
								{
									$prd_points = $product_point;
								}
							}else if($member_commercial_status == '1')
							{
								
								if($member_commercial_class == '1')
								{
									if($product_commercial_handling_show == '0')
									{
										$product_unit_price = $product_commercial_price + $product_commercial_handling;
										$total_handling_charge = '0';
									}else
									{
										$product_unit_price = $product_commercial_price;
										$total_handling_charge = $total_handling_charge + $product_commercial_handling;
									}
									//point checking for double point
									if($product_commercial_double_point == '1')
									{
										$prd_points = $product_commercial_point * 2;
										//$prd_points = $product_commercial_point;
									}else
									{
										$prd_points = $product_commercial_point;
									}
								}else if($member_commercial_class == '2')
								{
									if($product_commercial_handling_show2 == '0')
									{
										$product_unit_price = $product_commercial_price2 + $product_commercial_handling2;
										$total_handling_charge = '0';
									}else
									{
										$product_unit_price = $product_commercial_price2;
										$total_handling_charge = $total_handling_charge + $product_commercial_handling2;
									}
									//point checking for double point
									if($product_commercial_double_point2 == '1')
									{
										$prd_points = $product_commercial_point * 2;
										//$prd_points = $product_commercial_point2;
									}else
									{
										$prd_points = $product_commercial_point2;
									}
								}else
								{
									if($product_commercial_handling_show == '0')
									{
										$product_unit_price = $product_commercial_price + $product_commercial_handling;
										$total_handling_charge = '0';
									}else
									{
										$product_unit_price = $product_commercial_price;
										$total_handling_charge = $total_handling_charge + $product_commercial_handling;
									}
									//point checking for double point
									if($product_commercial_double_point == '1')
									{
										$prd_points = $product_commercial_point * 2;
										//$prd_points = $product_commercial_point;
									}else
									{
										$prd_points = $product_commercial_point;
									}
								}
								
								if($product_id =='1')
								{
									$prd_points = $prd_points + $commercial_additional_point;
								}
							}else
							{
								if($product_handling_show == '0')
								{
									$product_unit_price = $product_price + $product_handling;
									$total_handling_charge = '0';
								}else
								{
									$product_unit_price = $product_price;
									$total_handling_charge = $total_handling_charge + $product_handling;
								}
								if($product_double_point == '1')
								{
									$prd_points = $product_point * 2;
									//$prd_points = $product_point;
								}else
								{
									$prd_points = $product_point;
								}
							}
							
							//flat handling
							if($product_category_id == '1' || $product_category_id== '3')
							{
								$total_flat_handling = $total_flat_handling + ($pro_amount * $member_flat_floor);
							}else
							{
								$total_flat_handling = $total_flat_handling + '0';
							}

							$product_sale_percentage = cal_prd_sales($product_unit_price, $pro_amount, $product_sale1, $product_sale_percentage1, $product_sale2, $product_sale_percentage2, $product_sale3, $product_sale_percentage3);
							
							$sql2 = "INSERT INTO pbmart_order_list(order_number, order_product_id, order_product_class, order_product_name, order_product_model, order_product_price, order_product_handling, order_product_point, order_product_sale, order_product_amount)

							VALUES ('$order_num', '$product_id', '$order_product_class', '$product_name', '$product_model', '$product_unit_price', '$total_handling_charge', '$prd_points', '$product_sale_percentage', '$pro_amount')";

							$result2 = @mysql_query($sql2);
							if(!$result2)
							{
								echo $sql;
								echo ("Failed to create $table_name record");
							}
							
							if($order_payment_type == "Cash")
							{
								
								$prd_stk_stock = prd_validations($product_id);
								if($prd_stk_stock == '0' || $prd_stk_stock < '0')
								{	
									
									$message = "Error! Please try again later! Thank you!";
									ord_del($order_num, $order_customer_id);
									echo "<script type='text/javascript'>alert('$message');</script>";
									echo "<script language='JavaScript'>window.top.location ='checkout_page.php?hyperlink=home';</script>";
									exit;
								}
									if($remain_pro < '0')
									{
										$message = "Error! Please try again later! Thank you!";
										ord_del($order_num, $order_customer_id);
										echo "<script type='text/javascript'>alert('$message');</script>";
										echo "<script language='JavaScript'>window.top.location ='checkout_page.php?hyperlink=home';</script>";
										exit;
									}else
									{
										$query="UPDATE pbmart_product
										SET
											product_sale = '$total_product_sale',
											product_stock = '$remain_pro'
											WHERE product_id = '$product_id'";
										$result3 = @mysql_query($query);
										if(!$result3)
										{
											echo ("Failed to update table. DEBUG: .$query");
										}
									}
							}
						} 
					}
				}

				//manage the redemption order here...
				if($_SESSION['redeem_order_qty'] !='0')
				{
					$total_remain_point = '0';
					$redemption = @mysql_query("SELECT MAX(redemption_id) FROM pbmart_redemption_list", $link);
					$redemption_count = @mysql_fetch_row($redemption);
					$rdm_ids = $redemption_count[0];
					$sql_redemption_num = @mysql_query("SELECT redemption_id, redemption_number FROM pbmart_redemption_list WHERE redemption_id='$rdm_ids'", $link);
					$rs_redemption_num = @mysql_fetch_assoc($sql_redemption_num);
					$redeem_no = $rs_redemption_num['redemption_number'];
					if($redeem_no == "")
					{
						$redeem_no = "RE000000";
					}else
					{
						$rdm_no = explode("RE", $redeem_no);
						$redeem_no = $rdm_no[1] + 1; 
						$redeem_no = 'RE'.str_pad($redeem_no, 6, '0', STR_PAD_LEFT);
					}
					
					for($x_value='0'; $x_value < $_SESSION['redeem_order_qty']; $x_value++)
					{
						$table_name_redeem = "pbmart_redemption_list";
						$redeem_id = $_SESSION['redeem_id'][$x_value];
						$sql = "SELECT * FROM pbmart_redeem WHERE redeem_id ='$redeem_id'";
						$rs = @mysql_query($sql);
						$rw = @mysql_fetch_array($rs);
						
						$redeem_name = $rw['redeem_name'];
						$redemption_status = '0';

						$redemption_order_ref = $order_num;
						$redemption_member_id = $_SESSION['usr_id'];
						$redemption_member_name = $_SESSION['usr_name'];
						$redemption_member_address = $street_name.", ".$pst_code.", ".$city.", ".$region_state.", ".$country;
						$redemption_item_id = $redeem_id;
						$redemption_item = $redeem_name;
						$redemption_image = $rw['redeem_image'];
						$redemption_amount = $_SESSION['redeem_qty'][$x_value];
						
						$redeem_point = $rw['redeem_point'];
						$redeem_stock = $rw['redeem_stock'];
						$redemption_token = $rw['redeem_token'];
						$redemption_points = $redeem_point;
						
						$sql_redemption = "INSERT INTO $table_name_redeem(redemption_number, redemption_date, redemption_time, redemption_delivery_date, redemption_order_ref, redemption_member_id, redemption_member_name, redemption_member_address, redemption_item_id, redemption_item, redemption_amount, redemption_points, redemption_token, redemption_status)
						VALUES ('$redeem_no','$order_date','$order_date_time','$shp_date','$redemption_order_ref','$redemption_member_id','$redemption_member_name','$redemption_member_address','$redemption_item_id','$redemption_item', '$redemption_amount', '$redemption_points', '$redemption_token', '$redemption_status')";

						$result4 = @mysql_query($sql_redemption);
						
						if(!$result4)
						{
							echo ("Failed to create $table_name_redeem. DEBUG: .$sql_redemption");
						}else
						{
							//update the redeem product(remaining stock)
							$total_point = $redeem_point * $redemption_amount;
							$total_remain_point = $total_remain_point + $total_point;
							
							$remain_stock = $redeem_stock - $redemption_amount;
							
								$redeem_product_stock = get_rdm_stock($redeem_id);
								if($redeem_product_stock == '0' || $redeem_product_stock < '0')
								{	
									$message = "Error! Please try again later! Thank you!";
									rdm_ord_del($redeem_no, $redemption_order_ref);
									//delete product or promotion order if order_qty is not empty
									if(!empty($_SESSION['order_qty']))
									{
										ord_del($order_num, $order_customer_id);
									}
									echo "<script type='text/javascript'>alert('$message');</script>";
									echo "<script language='JavaScript'>window.top.location ='checkout_page.php?hyperlink=home';</script>";
									exit;
								}
									if($remain_stock < '0')
									{
										$message = "Error! Please try again later! Thank you!";
										rdm_ord_del($redeem_no, $redemption_order_ref);
										//delete product or promotion order if order_qty is not empty
										if(!empty($_SESSION['order_qty']))
										{
											ord_del($order_num, $order_customer_id);
										}
										echo "<script type='text/javascript'>alert('$message');</script>";
										echo "<script language='JavaScript'>window.top.location ='checkout_page.php?hyperlink=home';</script>";
										exit;
									}else
									{
										//update stock for redeem product
										$query_upd_redeem="UPDATE pbmart_redeem
													SET
														redeem_stock = '$remain_stock'
														WHERE redeem_id = '$redeem_id'";
										$result_upd_redeem = @mysql_query($query_upd_redeem);
										
										if(!$result_upd_redeem)
										{
											echo ("Failed to update table. DEBUG: .$query_upd_redeem");
										}
									}
						}
					}
							$remain_point = $member_point - $total_remain_point;
							//update point for member
							$query_upd_member="UPDATE pbmart_member
										SET
											member_point = '$remain_point'
											WHERE member_id = '$order_customer_id'";
							$result_upd_member = @mysql_query($query_upd_member);
							
							if(!$result_upd_member)
							{
								echo ("Failed to update table. DEBUG: .$query_upd_member");
							}
				}
				
				if(isset($result3))
				{
					if($order_payment_type == "Cash")
					{
						echo "<script type='text/javascript'>alert('Thanks for your orders! An Order Confirmation email has been send to your mail! Please check your mail thanks!');</script>";
						echo "<script>window.top.location ='PHPMailer-master/send_mail_receipt.php?order_num=$order_num';</script>";
					}	
				}else
				{
					if($order_payment_type == "Cash")
					{
						echo "<script type='text/javascript'>alert('Thanks for your orders! An Order Confirmation email has been send to your mail! Please check your mail thanks!');</script>";
						echo "<script>window.top.location ='PHPMailer-master/send_mail_receipt.php?order_num=$order_num';</script>";
					}
				}
			}else{
				echo $sql;
				echo ("Failed to create $table_name record");
			}
		}else
		{
			echo ("Failed to update table. DEBUG: .$member_update");
		}
}

//a function use to delete the orders for product or promotion order
function ord_del($odr_num, $order_cst_id)
{
	$sql_del_pbmartOrder = "DELETE FROM pbmart_order WHERE order_number='$odr_num' AND order_customer_id='$order_cst_id'";
	$del_result = @mysql_query($sql_del_pbmartOrder);
	if($del_result)
	{
		$sql_del_pbmartOrderList = "DELETE FROM pbmart_order_list WHERE order_number = '$odr_num'";
		$del_result2 = @mysql_query($sql_del_pbmartOrderList);
		if(!$del_result2)
		{
			echo $sql_del_pbmartOrderList;
			echo ("Failed to delete pbmart_order_list record");
		}
	}else
	{
		echo $sql_del_pbmartOrder;
		echo ("Failed to delete pbmart_order record");
	}
}

function rdm_ord_del($rdm_num, $rdm_odr_ref)
{
	$sql_del_pbmartRdmList = "DELETE FROM pbmart_redemption_list WHERE redemption_number='$rdm_num' AND redemption_order_ref = '$rdm_odr_ref'";
	$rdm_del_result = @mysql_query($sql_del_pbmartRdmList);
	if(!$rdm_del_result)
	{
		echo $sql_del_pbmartRdmList;
		echo ("Failed to delete pbmart_redemption_list record");
	}
}

function get_rdm_stock($rdm_id)
{
	$query_rdm_stock = "SELECT redeem_id, redeem_stock FROM pbmart_redeem WHERE redeem_id = '$rdm_id'";
	$rs_rdm_stock = @mysql_query($query_rdm_stock);
	$rw_rdm_stock = @mysql_fetch_array($rs_rdm_stock);
	return $rw_rdm_stock['redeem_stock'];
}

function pkg_validations($pkg_id)
{
	$query_pkg_stock = "SELECT promotion_id, promotion_package_stock FROM pbmart_promotion WHERE promotion_id = '$pkg_id'";
	$rs_pkg_stock = @mysql_query($query_pkg_stock);
	$rw_pkg_stock = @mysql_fetch_array($rs_pkg_stock);
	return $rw_pkg_stock['promotion_package_stock'];
}

function prd_validations($product_id)
{
	$query_stk_stock = "SELECT product_id, product_stock FROM pbmart_product WHERE product_id = '$product_id'";
	$rs_stk_stock = @mysql_query($query_stk_stock);
	$rw_stk_stock = @mysql_fetch_array($rs_stk_stock);
	return $rw_stk_stock['product_stock'];
}

function cal_prd_sales($prd_price, $prd_qty, $prd_sales1, $prd_sales_percentage1, $prd_sales2, $prd_sales_percentage2, $prd_sales3, $prd_sales_percentage3)
{
	if($prd_qty >= '1' && $prd_qty < $prd_sales1)
	{
		$prd_sales_percentage = '0';
	}else if($prd_qty >= $prd_sales1 && $prd_qty < $prd_sales2)
	{
		$prd_sales_percentage = $prd_sales_percentage1;
	}else if($prd_qty >= $prd_sales2 && $prd_qty < $prd_sales3)
	{
		$prd_sales_percentage = $prd_sales_percentage2;
	}else if($prd_qty >= $prd_sales3)
	{
		$prd_sales_percentage = $prd_sales_percentage3;
	}else
	{
		echo ('Internal Error! Please contact webmaster to fix the issue!');
		exit;
	}

	$tl_price = $prd_price * $prd_qty;
	$discount = ($tl_price * $prd_sales_percentage)/100;
	//return $tl_price - $discount;
	return $prd_sales_percentage;
}

function cvrt_paymentType($payment_type)
{
	if($payment_type == 0)
	{
		$PaymentType = "Cash";
	}
	
	if($payment_type == 2)
	{
		$PaymentType = "Credit Card";
	}
	return $PaymentType;
}

//a function use to delete invalid orders made by users
function order_validate($odr_customer_id)
{
	$sql_order = "Select * FROM pbmart_order WHERE order_customer_id='$odr_customer_id' AND ePaymentStatus='1'";
	$rs_order = @mysql_query($sql_order);
	while($rw_order = @mysql_fetch_array($rs_order))
	{
		$order_nums = $rw_order['order_number'];
		$query2 ="DELETE FROM pbmart_order WHERE order_number='$order_nums' AND order_customer_id='$odr_customer_id' AND ePaymentStatus='1'";
		$result_delete = @mysql_query($query2);

		if(!$result_delete)
		{
			echo ("Failed to delete table. DEBUG: .$query2");
		}
		
		$query3 = "DELETE FROM pbmart_order_list WHERE order_number='$order_nums'";
		$result_delete2 = @mysql_query($query3);
		
		if(!$result_delete2)
		{
			echo ("Failed to delete table. DEBUG: .$query3");
		}
	}
}
?>