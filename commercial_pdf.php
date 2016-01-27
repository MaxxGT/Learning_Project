<?php
// Author: VOONG TZE HOWE
// Date Writen: 03-03-2015
// Description : commercial_pdf
// Last Modification:

//http://stackoverflow.com/questions/4679756/show-a-pdf-files-in-users-browser-via-php-perl

require_once("session_config.php");
include("connection/pbmartconnection.php");

get_UsrInfo();
GLOBAL $member_id;
GLOBAL $member_number;

$sql_commercial_id = mysql_query("SELECT commercial_number, commercial_member_number FROM pbmart_commercial WHERE commercial_member_number ='$member_number'", $link);
					$rw_commercial_id = @mysql_fetch_assoc($sql_commercial_id);
					$commercial_numbers = $rw_commercial_id['commercial_number'];
					
$member_file = $commercial_numbers;
$filename = $_GET['filename']; /* Note: Always use .pdf at the end. */

$file = "cmanage/commercial/commercial_form/$member_file/$filename";

header('Content-type: application/pdf');
header('Content-Disposition: inline; filename="' . $filename . '"');
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . filesize($file));
header('Accept-Ranges: bytes');

@readfile($file);
?>