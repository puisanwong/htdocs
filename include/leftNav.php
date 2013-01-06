  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">
  <head>
<script type="text/javascript" src="autocomplete/js/jquery-1.4.2.js"></script>
<script type='text/javascript' src="autocomplete/js/jquery.autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="autocomplete/js/jquery.autocomplete.css" />

<script type="text/javascript">
$().ready(function() {
$("#searchField").autocomplete("autocomplete/autoCompleteMain.php", {
width: 260,
matchContains: true,
//mustMatch: true,
//minChars: 0,
//multiple: true,
//highlight: false,
//multipleSeparator: ",",
selectFirst: false
});
});
</script>
  </head>
  <body>
  <?php
if (!defined('WEB_ROOT')) {
	exit;
}

// get all categories
$categories = fetchCategories();

// format the categories for display
$categories = formatCategories($categories, $catId);

?>

<ul>
<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>">All Category</a></li>
<?php
foreach ($categories as $category) {
	extract($category);
	// now we have $cat_id, $cat_parent_id, $cat_name
	
	$level = ($cat_parent_id == 0) ? 1 : 2;
    $url   = $_SERVER['PHP_SELF'] . "?c=$cat_id";

	// for second level categories we print extra spaces to give
	// indentation look
	if ($level == 2) {
		$cat_name = '&nbsp; &nbsp; &raquo;&nbsp;' . $cat_name;
	}
	
	// assign id="current" for the currently selected category
	// this will highlight the category name
	$listId = '';
	if ($cat_id == $catId) {
		$listId = ' id="current"';
	}
?>
<li<?php echo $listId; ?>><a href="<?php echo $url; ?>"><?php echo $cat_name; ?></a></li>
<?php
}
?>



<li>
     <a href="<?php echo WEB_ROOT; ?>admin/fb/index.php">Share with Friends</a>
</li>
<li><a href="<?php echo WEB_ROOT; ?>admin/index.php">Admin Login</a></li>
<li>
<label>Search Product: </label><input type="text" id="searchField" name="searchField">
</li>
<li>


<input type="button" id="search_btn" onclick="window.location='index.php?'Session['search_redirect']" value="Search"/>


</li>

</ul>


  </body>
  </html>

