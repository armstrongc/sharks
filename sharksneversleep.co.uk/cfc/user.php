<?php class userObj extends Default_Table
{
    // additional class variables go here
    function userObj ()
    {
        $this->tablename       = 'tbluser';
        $this->dbname          = 'web120-armo2013';
        $this->rows_per_page   = 0;
		$this->pageno   	   = 0;
        $this->fieldlist       = array(
										'user_id'
									, 	'first_name'
									, 	'last_name'
									, 	'display_name'
									, 	'email'
									, 	'password'
									, 	'admin_access_type_id'
									, 	'login_count'
									, 	'is_deleted'
									);
        $this->fieldlist['user_id'] = array('pkey' => 'y');
    } // end class constructor

} // end class
?>