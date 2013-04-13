<?php class blogcommentObj extends Default_Table
{
    // additional class variables go here
    function blogcommentObj ()
    {
        $this->tablename       = 'tblblogcomment';
        $this->dbname          = 'web120-armo2013';
        $this->rows_per_page   = 0;
		$this->pageno   	   = 0;
        $this->fieldlist       = array(
										'comment_id'
									, 	'post_id'
									, 	'comment_name'
									, 	'comment_email'
									, 	'comment_location'
									, 	'comment_copy'
									, 	'comment_date'
									, 	'is_live'
									);
        $this->fieldlist['comment_id'] = array('pkey' => 'y');
    } // end class constructor

} // end class
?>