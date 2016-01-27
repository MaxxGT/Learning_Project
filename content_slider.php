<?php
// Author: VOONG TZE HOWE
// Date Writen: 09-10-2014
// Description : index content slider
// Last Modification: 11-10-2014
require_once("connection/pbmartconnection.php");
?>

<div id="slider" class="box">
	<div id="slider-holder">
        <ul>
			<!-- Retrieve image path from db -->
			<?php
				
				$table = "pbmart_banner";
				
				$sql = "SELECT * FROM $table";
				$rw = @mysql_query($sql, $link);
				
				while($rs = @mysql_fetch_array($rw))
				{
					$banner_url = $rs['banner_url'];
					$banner_path = $rs['banner_path'];
					$banner_alt = $rs['banner_alt'];
					
					?>
					<li><a href="<?php echo $banner_url; ?>"><img src="<?php echo "cmanage/banner/".$banner_path; ?>" width='720px' height='252px' title="<?php echo $banner_alt; ?>" /></a></li>
		<?php	} ?>
		
          </ul>
        </div>
        <div id="slider-nav"> <a href="#" class="active">1</a> <a href="#">2</a> <a href="#">3</a> <a href="#">4</a> </div>
</div>