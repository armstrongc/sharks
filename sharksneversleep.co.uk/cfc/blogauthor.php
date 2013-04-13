<?php class blogauthorObj extends Default_Table
{
    // additional class variables go here
    function blogauthorObj ()
    {
        $this->tablename       = 'tblblogauthor';
        $this->dbname          = 'web120-armo2013';
        $this->rows_per_page   = 0;
		$this->pageno   	   = 0;
        $this->fieldlist       = array(
										'author_id'
									, 	'author_first_name'
									, 	'author_last_name'
									, 	'author_display_name'
									, 	'author_email'
									, 	'is_live'
									);
        $this->fieldlist['author_id'] = array('pkey' => 'y');
    } // end class constructor

} // end class
?>