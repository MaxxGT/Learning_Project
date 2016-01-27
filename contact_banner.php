<?php
// Author: VOONG TZE HOWE
// Date Writen: 11-10-2014
// Description : contact banner
// Last Modification: 11-10-2014

require_once("connection/pbmartconnection.php");

$sql_pbmart = "Select * FROM pbmart_contact_banner";
$rs = mysql_query($sql_pbmart, $link);
while($rw = mysql_fetch_array($rs))
{
	$pbmart_banner_path = $rw['pbmart_banner_path'];
	$pbmart_banner_alt = $rw['pbmart_banner_alt'];
}
?>

<p><img src="<?php echo $pbmart_banner_path; ?>" alt="<?php echo $pbmart_banner_alt; ?>" title="<?php echo $pbmart_banner_alt; ?>" /></p>