<?php
/*
Line 1 : Make sure this file is included instead of requested directly
Line 2 : Check if step is defined and the value is two
Line 3 : The POST request must come from this page but the value of step is one
*/
if (!defined('WEB_ROOT')
    || !isset($_GET['step']) || (int)$_GET['step'] != 2
	|| $_SERVER['HTTP_REFERER'] != 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?step=1') {
	exit;
}

$errorMessage = '&nbsp;';

/*
 Make sure all the required field exist is $_POST and the value is not empty
 Note: txtShippingAddress2 and txtPaymentAddress2 are optional
*/
$requiredField = array('txtShippingFirstName', 'txtShippingLastName', 'txtShippingAddress1', 'txtShippingPhone', 'txtShippingDistrict',
                       'txtPaymentFirstName', 'txtPaymentLastName', 'txtPaymentAddress1', 'txtPaymentPhone', 'txtPaymentDistrict');
					   
if (!checkRequiredPost($requiredField)) {
	$errorMessage = 'Input not complete';
}
					   

$cartContent = getCartContent();

?>
<table width="550" border="0" align="center" cellpadding="10" cellspacing="0">
    <tr> 
        <td>Step 2 Of 3 : Confirm Order </td>
    </tr>
</table>
<p id="errorMessage"><?php echo $errorMessage; ?></p>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>?step=3" method="post" name="frmCheckout" id="frmCheckout">

//<?php
//}
//?>
    <table width="550" border="0" align="center" cellpadding="5" cellspacing="1" class="infoTable">
        <tr class="infoTableHeader"> 
            <td colspan="3">Ordered Item</td>
        </tr>
        <tr class="label"> 
            <td>Item</td>
            <td>Unit Price</td>
            <td>Total</td>
        </tr>
        <?php
$numItem  = count($cartContent);
$subTotal = 0;
for ($i = 0; $i < $numItem; $i++) {
	extract($cartContent[$i]);
	$subTotal += $pd_price * $ct_qty;
?>
        <tr class="content"> 
            <td class="content"><?php echo "$ct_qty x $pd_name"; ?></td>
            <td align="right"><?php echo displayAmount($pd_price); ?></td>
            <td align="right"><?php echo displayAmount($ct_qty * $pd_price); ?></td>
        </tr>
        <?php
}
?>
        <tr class="content"> 
            <td colspan="2" align="right">Sub-total</td>
            <td align="right"><?php echo displayAmount($subTotal); ?></td>
        </tr>
        <tr class="content"> 
            <td colspan="2" align="right">Shipping</td>
            <td align="right"><?php echo displayAmount($shopConfig['shippingCost']); ?></td>
        </tr>
        <tr class="content"> 
            <td colspan="2" align="right">Total</td>
            <td align="right"><?php echo displayAmount($shopConfig['shippingCost'] + $subTotal); ?></td>
        </tr>
    </table>
    <p>&nbsp;</p>
    <table width="550" border="0" align="center" cellpadding="5" cellspacing="1" class="infoTable">
        <tr class="infoTableHeader"> 
            <td colspan="2">Shipping Information</td>
        </tr>
        <tr> 
            <td width="150" class="label">First Name</td>
            <td class="content"><?php echo $_POST['txtShippingFirstName']; ?>
                <input name="hidShippingFirstName" type="hidden" id="hidShippingFirstName" value="<?php echo $_POST['txtShippingFirstName']; ?>"></td>
        </tr>
        <tr> 
            <td width="150" class="label">Last Name</td>
            <td class="content"><?php echo $_POST['txtShippingLastName']; ?>
                <input name="hidShippingLastName" type="hidden" id="hidShippingLastName" value="<?php echo $_POST['txtShippingLastName']; ?>"></td>
        </tr>
        <tr> 
            <td width="150" class="label">Address1</td>
            <td class="content"><?php echo $_POST['txtShippingAddress1']; ?>
                <input name="hidShippingAddress1" type="hidden" id="hidShippingAddress1" value="<?php echo $_POST['txtShippingAddress1']; ?>"></td>
        </tr>
        <tr> 
            <td width="150" class="label">Address2</td>
            <td class="content"><?php echo $_POST['txtShippingAddress2']; ?>
                <input name="hidShippingAddress2" type="hidden" id="hidShippingAddress2" value="<?php echo $_POST['txtShippingAddress2']; ?>"></td>
        </tr>
        <tr> 
            <td width="150" class="label">Phone Number</td>
            <td class="content"><?php echo $_POST['txtShippingPhone'];  ?>
                <input name="hidShippingPhone" type="hidden" id="hidShippingPhone" value="<?php echo $_POST['txtShippingPhone']; ?>"></td>
        </tr>
        <tr> 
            <td width="150" class="label">District</td>
            <td class="content"><?php echo $_POST['txtShippingDistrict']; ?> <input name="hidShippingDistrict" type="hidden" id="hidShippingDistrict" value="<?php echo $_POST['txtShippingDistrict']; ?>" ></td>
        </tr>
    </table>
    <p>&nbsp;</p>
    <table width="550" border="0" align="center" cellpadding="5" cellspacing="1" class="infoTable">
        <tr class="infoTableHeader"> 
            <td colspan="2">Payment Information</td>
        </tr>
        <tr> 
            <td width="150" class="label">First Name</td>
            <td class="content"><?php echo $_POST['txtPaymentFirstName']; ?>
                <input name="hidPaymentFirstName" type="hidden" id="hidPaymentFirstName" value="<?php echo $_POST['txtPaymentFirstName']; ?>"></td>
        </tr>
        <tr> 
            <td width="150" class="label">Last Name</td>
            <td class="content"><?php echo $_POST['txtPaymentLastName']; ?>
                <input name="hidPaymentLastName" type="hidden" id="hidPaymentLastName" value="<?php echo $_POST['txtPaymentLastName']; ?>"></td>
        </tr>
        <tr> 
            <td width="150" class="label">Address1</td>
            <td class="content"><?php echo $_POST['txtPaymentAddress1']; ?>
                <input name="hidPaymentAddress1" type="hidden" id="hidPaymentAddress1" value="<?php echo $_POST['txtPaymentAddress1']; ?>"></td>
        </tr>
        <tr> 
            <td width="150" class="label">Address2</td>
            <td class="content"><?php echo $_POST['txtPaymentAddress2']; ?> <input name="hidPaymentAddress2" type="hidden" id="hidPaymentAddress2" value="<?php echo $_POST['txtPaymentAddress2']; ?>"> 
            </td>
        </tr>
        <tr> 
            <td width="150" class="label">Phone Number</td>
            <td class="content"><?php echo $_POST['txtPaymentPhone'];  ?> <input name="hidPaymentPhone" type="hidden" id="hidPaymentPhone" value="<?php echo $_POST['txtPaymentPhone']; ?>"></td>
        </tr>
		
		
        <tr> 
            <td width="150" class="label">District</td>
            <td class="content"><?php echo $_POST['txtPaymentDistrict']; ?> <input name="hidPaymentDistrict" type="hidden" id="hidPaymentDistrict" value="<?php echo $_POST['txtPaymentDistrict']; ?>" ></td>
        </tr>
    </table>
    <p>&nbsp;</p>
    <table width="550" border="0" align="center" cellpadding="5" cellspacing="1" class="infoTable">
      <tr>
        <td width="150" class="infoTableHeader">Payment Method </td>
        <td class="content"><?php echo $_POST['optPayment'] == 'paypal' ? 'Paypal' : 'Cash on Delivery'; ?>
          <input name="hidPaymentMethod" type="hidden" id="hidPaymentMethod" value="<?php echo $_POST['optPayment']; ?>" />
        </tr>
    </table>
    <p>&nbsp;</p>
    <p align="center"> 
        <input name="btnBack" type="button" id="btnBack" value="&lt;&lt; Modify Delivery/Payment Info" onClick="window.location.href='checkout.php?step=1';" class="box">
        &nbsp;&nbsp; 
        <input name="btnConfirm" type="submit" id="btnConfirm" value="Confirm Order &gt;&gt;" class="box">
</form>
<p>&nbsp;</p>
