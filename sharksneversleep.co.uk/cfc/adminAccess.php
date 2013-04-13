<?php class adminAccessObj extends Default_Table
{
    // additional class variables go here
    function adminAccessObj ()
    {
        $this->tablename       = 'tbladminaccesstype';
        $this->dbname          = 'web120-armo2013';
        $this->rows_per_page   = 0;
		$this->pageno   	   = 0;
        $this->fieldlist       = array(
										'admin_access_type_id'
									, 	'admin_access_type'
									);
        $this->fieldlist['admin_access_type_id'] = array('pkey' => 'y');
    } // end class constructor

} // end class
?>