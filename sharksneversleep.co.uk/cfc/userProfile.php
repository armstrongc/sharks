<?php class userProfileObj extends Default_Table
{
    // additional class variables go here
    function userProfileObj ()
    {
        $this->tablename       = 'tblUserProfile';
        $this->dbname          = 'web120-armo2013';
        $this->rows_per_page   = 0;
		$this->pageno   	   = 0;
        $this->fieldlist       = array(
										'user_profile_id'
									, 	'user_id'
									, 	'display_name'
									, 	'telephone'
									, 	'primary_email'
									,	'about_text'
									,	'skills_text'
									,	'profile_image'
									);
        $this->fieldlist['user_profile_id'] = array('pkey' => 'y');
    } // end class constructor

} // end class
?>