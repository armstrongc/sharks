<?php class galleryImageObj extends Default_Table
{
    // additional class variables go here
    function galleryImageObj ()
    {
        $this->tablename       = 'tblgalleryimage';
        $this->dbname          = 'web120-armo2013';
        $this->rows_per_page   = 0;
		$this->pageno   	   = 0;
        $this->fieldlist       = array(
										'gallery_image_id'
									, 	'gallery_id'
									, 	'image_file'
									,	'image_name'
									,	'image_description'
									, 	'is_live'
									, 	'display_order'
									);
        $this->fieldlist['gallery_image_id'] = array('pkey' => 'y');
    } // end class constructor

} // end class
?>