<?php class accessxrefnavigationObj extends Default_Table
{
    // additional class variables go here
    function accessxrefnavigationObj ()
    {
        $this->tablename       = 'accessxrefnavigation';
        $this->dbname          = 'web120-armo2013';
        $this->rows_per_page   = 0;
		$this->pageno   	   = 0;
        $this->fieldlist       = array(
										'xref_id'
									, 	'admin_access_type_id'
									, 	'admin_nav_id'
									);
        $this->fieldlist['xref_id'] = array('pkey' => 'y');
    } // end class constructor

} // end class
?>