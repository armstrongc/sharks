<?php class galleryObj extends Default_Table
{
    // additional class variables go here
    function galleryObj ()
    {
        $this->tablename       = 'tblgallery';
        $this->dbname          = 'web120-armo2013';
        $this->rows_per_page   = 0;
		$this->pageno   	   = 0;
        $this->fieldlist       = array(
										'gallery_id'
									, 	'gallery_name'
									,	'gallery_description'
									, 	'is_live'
									, 	'display_order'
									);
        $this->fieldlist['gallery_id'] = array('pkey' => 'y');
    } // end class constructor

} // end class
?>