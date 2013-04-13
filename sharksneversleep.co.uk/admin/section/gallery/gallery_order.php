<?php // get data
$where = "";
$qcontent = $dbobject->getData($where);

// if the item has been moved up the list
if($_POST['new_display_order'] < $_POST['current_display_order']){
	
	// loop over the list of items
	foreach ($qcontent as $row) {
		
		// if the item in the list is between the new and old values
		if($row['display_order'] >= $_POST['new_display_order'] && $row['display_order'] < $_POST['current_display_order']){
			
			// increment its display_order and update it
			$_GLOBALS['gallery_id'] = $row['gallery_id'];
			$_GLOBALS['display_order'] = $row['display_order'] + 1;
			
			$fieldarray = $dbobject->updateRecord($_GLOBALS);
			$errors = $dbobject->getErrors();
		
		}
	
	}
	
	// update the order of the changed item

	$_GLOBALS['gallery_id'] = $_POST['moved_item_id'];
	$_GLOBALS['display_order'] = $_POST['new_display_order'];
	
	$fieldarray = $dbobject->updateRecord($_GLOBALS);
	$errors = $dbobject->getErrors();

// if the item has been moved down the list
} else {

	// loop over the list of items
	foreach ($qcontent as $row) {
		
		// if the item in the list is between the new and old values
		if($row['display_order'] > $_POST['current_display_order'] && $row['display_order'] <= $_POST['new_display_order']){
			
			// decrement its display_order and update it
			$_GLOBALS['gallery_id'] = $row['gallery_id'];
			$_GLOBALS['display_order'] = $row['display_order'] - 1;
			
			$fieldarray = $dbobject->updateRecord($_GLOBALS);
			$errors = $dbobject->getErrors();

		}
	
	}
	
	// update the order of the changed item
	$_GLOBALS['gallery_id'] = $_POST['moved_item_id'];
	$_GLOBALS['display_order'] = $_POST['new_display_order'];
	
	$fieldarray = $dbobject->updateRecord($_GLOBALS);
	$errors = $dbobject->getErrors();

}

$_GLOBALS['action']='reorder';
?>