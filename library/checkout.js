function setPaymentInfo(isChecked)
{
	with (window.document.frmCheckout) {
		if (isChecked) {
			txtPaymentFirstName.value  = txtShippingFirstName.value;
			txtPaymentLastName.value   = txtShippingLastName.value;
			txtPaymentAddress1.value   = txtShippingAddress1.value;
			txtPaymentAddress2.value   = txtShippingAddress2.value;
			txtPaymentPhone.value      = txtShippingPhone.value;
			txtPaymentDistrict.value   = txtShippingDistrict.value;
			
			txtPaymentFirstName.readOnly  = true;
			txtPaymentLastName.readOnly   = true;
			txtPaymentAddress1.readOnly   = true;
			txtPaymentAddress2.readOnly   = true;
			txtPaymentPhone.readOnly      = true;
			txtPaymentDistrict.readOnly   = true;			
		} else {
			txtPaymentFirstName.readOnly  = false;
			txtPaymentLastName.readOnly   = false;
			txtPaymentAddress1.readOnly   = false;
			txtPaymentAddress2.readOnly   = false;
			txtPaymentPhone.readOnly      = false;
			txtPaymentDistrict.readOnly   = false;			
		}
	}
}


function checkShippingAndPaymentInfo()
{
	with (window.document.frmCheckout) {
		if (isEmpty(txtShippingFirstName, 'Enter first name')) {
			return false;
		} else if (isEmpty(txtShippingLastName, 'Enter last name')) {
			return false;
		} else if (isEmpty(txtShippingAddress1, 'Enter shipping address')) {
			return false;
		} else if (isEmpty(txtShippingPhone, 'Enter phone number')) {
			return false;
		} else if (isEmpty(txtShippingDistrict, 'Enter the shipping district')) {
			return false;
		} else if (isEmpty(txtPaymentFirstName, 'Enter first name')) {
			return false;
		} else if (isEmpty(txtPaymentLastName, 'Enter last name')) {
			return false;
		} else if (isEmpty(txtPaymentAddress1, 'Enter Payment address')) {
			return false;
		} else if (isEmpty(txtPaymentPhone, 'Enter phone number')) {
			return false;
		} else if (isEmpty(txtPaymentDistrict, 'Enter the Payment district')) {
			return false;
		} else {
			return true;
		}
	}
}
