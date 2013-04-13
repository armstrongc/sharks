<?php class adminNavigationObj extends Default_Table
{
    // additional class variables go here
    function adminNavigationObj ()
    {
        $this->tablename       = 'tbladminnavigation';
        $this->dbname          = 'web120-armo2013';
        $this->rows_per_page   = 0;
		$this->pageno   	   = 0;
        $this->fieldlist       = array(
										'admin_nav_id'
									, 	'nav_item'
									, 	'directory'
									, 	'display_order'
									, 	'is_live'
									);
        $this->fieldlist['admin_nav_id'] = array('pkey' => 'y');
    } // end class constructor

} // end class
?>