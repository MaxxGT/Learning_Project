<?php
require_once("connection/pbmartconnection.php");
?>

<script type="text/javascript">
    function upd(btnValue)
    {
        if (btnValue=="")
          {
          document.getElementById("q").innerHTML="";
          return;
          } 
        if (window.XMLHttpRequest)
          {// code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp=new XMLHttpRequest();
          }
        else
          {// code for IE6, IE5
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
          }
        xmlhttp.onreadystatechange=function()
          {
          if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
				document.getElementById("price_ajax").innerHTML=xmlhttp.responseText;
            }
          }
        xmlhttp.open("GET","gcm_user.php?q="+btnValue,true);
		 
        xmlhttp.send();
    }
	
	function test()
	{
		alert('Hey man...');
	}	
</script>

<script language=JavaScript>
var interval = 1000 * 60 * 1;
	setInterval(test(), interval);
</script>


<table border="1" >
	<tr>
		<td>
			<input type="radio" name="btnRd" value='0' onclick="upd(1);" >Home Delivery</font></input>
		</td>
	</tr>
	<?php ?>
	<span id="price_ajax">
		0.00
	</span>
	<?php ?>
</table>