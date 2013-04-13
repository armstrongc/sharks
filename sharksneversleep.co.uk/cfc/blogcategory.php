<?php class blogcategoryObj extends Default_Table
{
    // additional class variables go here
    function blogcategoryObj ()
    {
        $this->tablename       = 'tblblogcategory';
        $this->dbname          = 'web120-armo2013';
        $this->rows_per_page   = 0;
		$this->pageno   	   = 0;
        $this->fieldlist       = array(
										'category_id'
									, 	'category'
                                    ,   'image_file'
                                    ,   'category_description'
									, 	'display_order'
									, 	'is_live'
									);
        $this->fieldlist['category_id'] = array('pkey' => 'y');
    } // end class constructor

} // end class
?>