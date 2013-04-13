<?php class blogpostObj extends Default_Table
{
    // additional class variables go here
    function blogpostObj ()
    {
        $this->tablename       = 'tblblogpost';
        $this->dbname          = 'web120-armo2013';
        $this->rows_per_page   = 0;
		$this->pageno   	   = 0;
        $this->fieldlist       = array(
										'post_id'
									, 	'category_id'
									, 	'author_id'
									, 	'post_title'
									, 	'post_date'
                                    ,   'post_description'
                                    ,   'post_keywords'
                                    ,   'image_file'
									, 	'post_copy'
									, 	'is_live'
									);
        $this->fieldlist['post_id'] = array('pkey' => 'y');
    } // end class constructor

} // end class
?>