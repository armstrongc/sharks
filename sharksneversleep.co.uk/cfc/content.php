<?php class contentObj extends Default_Table
{
    // additional class variables go here
    function contentObj ()
    {
        $this->tablename       = 'tblcontent';
        $this->dbname          = 'web120-armo2013';
        $this->rows_per_page   = 0;
		$this->pageno   	   = 0;
        $this->fieldlist       = array(
										'content_id'
									, 	'page_title'
									, 	'filename'
									, 	'directory'
									, 	'content'
									, 	'display_order'
									);
        $this->fieldlist['content_id'] = array('pkey' => 'y');
    } // end class constructor

} // end class
?>