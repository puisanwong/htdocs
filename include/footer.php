<?php
if (!defined('WEB_ROOT')) {
	exit;
}
?>

<table width="100%" border="0" cellspacing="0" cellpadding="10">
 <tr>
  <td align="center">
   <p>&copy; <?php echo '2012 - ' . date('Y'); ?> <?php echo $shopConfig['name']; ?><br>
    Address : <?php echo $shopConfig['address']; ?><br>
    Phone : <?php echo $shopConfig['phone']; ?><br>
    Email : <a href="mailto:<?php echo $shopConfig['email']; ?>"><?php echo $shopConfig['email']; ?></a></p>
   <p><br>
   </p></td>
 </tr>
</table>
</body>
</html>
