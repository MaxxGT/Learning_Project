<?php
// Author: VOONG TZE HOWE
// Date Writen: 03-02-2015
// Description : content slider for promotion
// Last Modification: 
require_once("connection/pbmartconnection.php");
?>
			<!-- Retrieve image path from db -->
			<?php
				$rw = @mysql_query("SELECT * FROM pbmart_promotion_category WHERE promotion_category_id='$promotion_ids'", $link);
				
			$rs = @mysql_fetch_array($rw);
			$promotion_category_photo = $rs['promotion_category_photo'];
			?>				
<img src="<?php echo "cmanage/promotion_category/".$promotion_category_photo; ?>" alt="#" width="720px" height="190px"></img>
        
