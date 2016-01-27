<?php
// Author: VOONG TZE HOWE
// Date Writen: 11-10-2014
// Description : pbmart contact information
// Last Modification:

require_once("connection/pbmartconnection.php");

$sql_pbmart = "Select * FROM pbmart_contact_info";
$rs = mysql_query($sql_pbmart, $link);
while($rw = mysql_fetch_array($rs))
{
	$pbmart_office_no = $rw['pbmart_office_no'];
	$pbmart_street_no = $rw['pbmart_street_no'];
	$pbmart_street_name = $rw['pbmart_street_name'];
	$pbmart_city = $rw['pbmart_city'];
	$pbmart_state = $rw['pbmart_state'];
	$pbmart_country = $rw['pbmart_country'];
	$pbmart_telephone = $rw['pbmart_telephone'];
	$pbmart_operate_hour = $rw['pbmart_operate_hour'];
	$pbmart_operate_daily = $rw['pbmart_operate_daily'];
}
?>

<a href="https://www.google.com.my/maps/dir//1.5070172,110.3210633/@1.5067892,110.322155,482m/data=!3m1!1e3!4m2!4m1!3e0" target="_new">
<BR/>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
	<div style="overflow:hidden;height:300px;width:400px;">
		<div id="gmap_canvas" style="height:300px;width:400px;"></div>
			<style>#gmap_canvas img{max-width:none!important;background:none!important}</style>
				<a class="google-map-code" href="http://wptiger.com/premium-wordpress-themes/" id="get-map-data">PULAU BURUNG SDN BHD</a>
	</div>
	<script type="text/javascript"> 
		function init_map()
		{
			var myOptions = {zoom:15,center:new google.maps.LatLng(1.5070207278520444,110.32105485186764),mapTypeId: google.maps.MapTypeId.HYBRID};
			map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);
			marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(1.5070207278520444, 110.32105485186764)});
			infowindow = new google.maps.InfoWindow({content:"<b>SYARIKAT PULAU BURUNG GAS SDN BHD</b><br/>Jalan Ketitir Batu Kawa<br/>93250 Kuching Sarawak" });
			google.maps.event.addListener(marker, "click", function(){infowindow.open(map,marker);});
			infowindow.open(map,marker);
		}
			google.maps.event.addDomListener(window, 'load', init_map);
	</script>
	<BR/>
</a>

<h2><strong>Office Address </strong></h2>
	<p><BR><?php echo $pbmart_office_no; ?>, <?php echo $pbmart_street_no; ?>, <br /><?php echo $pbmart_street_name; ?>, <?php echo $pbmart_city; ?>, <br />
	   <?php echo $pbmart_state; ?>, <br />
	   <?php echo $pbmart_country; ?>. </p><br />
	<h2><strong>Contact Number</strong></h2>
	<p><BR>Telephone(Office): <?php echo $pbmart_telephone; ?> <br /><br />
	<h2><strong>Opening Hours</strong></h2>
	<p><BR>
		<table border='0'>
		<tr>
			<td>Monday to Saturday: </td>
			<td>8.00am - 12.00pm</td>
		</tr>
		<tr>
			<td></td>
			<td>1.00pm - 5.00pm</td>
		</tr>
		<tr>
			<td>Sunday & Public Holiday: </td>
			<td>Off</td>
		</tr>
		</table>
	</p>
	<BR/>
		