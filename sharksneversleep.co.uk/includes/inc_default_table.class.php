<?php 
// http://www.tonymarston.net/php-mysql/sample-application.html
class Default_Table
{
	var $tablename;         // table name
	var $dbname;            // database name
	var $rows_per_page;     // used in pagination
	var $pageno;            // current page number
	var $lastpage;          // highest page number
	var $fieldlist;         // list of fields in this table
	var $data_array;        // data from the database
	var $errors;            // array of error messages
	
	var $sql_select;
	var $sql_from;
	var $sql_where;
	var $sql_groupby;
	var $sql_having;
	var $sql_orderby;

	function Default_Table ()
	{
		$this->tablename       = 'default';
		$this->dbname          = 'default';
		$this->rows_per_page   = 10;
		
		$this->fieldlist = array('column1', 'column2', 'column3');
		$this->fieldlist['column1'] = array('pkey' => 'y');
	} // constructor
	
	function getData ($where)
	{
		
		$this->data_array = array();
		$pageno          = $this->pageno;
		$rows_per_page   = $this->rows_per_page;
		$this->numrows   = 0;
		$this->lastpage  = 0;
		
		global $dbconnect, $query;
		$dbconnect = db_connect($this->dbname) or trigger_error("SQL", E_USER_ERROR);

		if (empty($this->sql_select)) {
		$select_str = '*';    // the default is all fields
		} else {
		$select_str = $this->sql_select;
		} // if
		
		if (empty($this->sql_from)) {
		$from_str = $this->tablename;   // the default is current table
		} else {
		$from_str = $this->sql_from;
		} // if
		
		if (empty($where)) {
		   $where_str = NULL;
		} else {
		   $where_str = "WHERE $where";
		} // if
		
		if (!empty($this->sql_where)) {
		   if (!empty($where_str)) {
		      $where_str .= " AND $this->sql_where";
		   } else {
		      $where_str = "WHERE $this->sql_where";
		   } // if
		} // if
		
		if (!empty($this->sql_groupby)) {
		   $group_str = "GROUP BY $this->sql_groupby";
		} else {
		   $group_str = NULL;
		} // if
		
		if (!empty($this->sql_having)) {
		   $having_str = "HAVING $this->sql_having";
		} else {
		   $having_str = NULL;
		} // if
		
		if (!empty($this->sql_orderby)) {
		   $sort_str = "ORDER BY $this->sql_orderby";
		} else {
		   $sort_str = NULL;
		} // if
		
		if ($rows_per_page > 0) {
		   $limit_str = 'LIMIT ' .($pageno - 1) * $rows_per_page .',' .$rows_per_page;
		} else {
		   $limit_str = NULL;
		} // if
		
		
		
		// count the number of rows which satisfy the current selection criteria:
		$query = "SELECT count(*)
		          FROM $from_str 
		          $where_str 
		          $group_str 
		          $having_str 
		          $sort_str 
		          $limit_str";
		$result = mysql_query($query, $dbconnect) or trigger_error("SQL", E_USER_ERROR);
		$query_data = mysql_fetch_row($result);
		$this->numrows = $query_data[0];
		
		// no data? then exit
		if ($this->numrows <= 0) {
		$this->pageno = 0;
		return;
		} 	// if
		
		// calculate how many pages it will take based on the page size given in
		if ($rows_per_page > 0) {
		$this->lastpage = ceil($this->numrows/$rows_per_page);
		} else {
		$this->lastpage = 1;
		} // if
		
		// ensure that the requested page number is within range.
		if ($pageno == '' OR $pageno <= '1') {
		$pageno = 1;
		} elseif ($pageno > $this->lastpage) {
		$pageno = $this->lastpage;
		} // if
		$this->pageno = $pageno;


	  	// build the query string and run it.
		$query = "SELECT $select_str
            	FROM $from_str 
                $where_str 
                $group_str 
                $having_str 
                $sort_str 
                $limit_str";
		$result = mysql_query($query, $dbconnect) or trigger_error("SQL", E_USER_ERROR);
		
		// extract the data and convert it into an associative array
		while ($row = mysql_fetch_assoc($result)) {
			$this->data_array[] = $row;
		} // while
		
		// release the database resourc
		mysql_free_result($result);
		
		// return the multi-dimensional array containing all the data.
		return $this->data_array;
	
	} // getData
	
	function insertRecord ($fieldarray)
	{
		$this->errors = array();
		global $dbconnect, $query;
		$dbconnect = db_connect($this->dbname) or trigger_error("SQL", E_USER_ERROR);
		
		$fieldlist = $this->fieldlist;
		foreach ($fieldarray as $field => $fieldvalue) {
			if (!in_array($field, $fieldlist)) {
				unset ($fieldarray[$field]);
			} // if
		} // foreach
		
		$query = "INSERT INTO $this->tablename SET ";
		foreach ($fieldarray as $item => $value) {
			$query .= "$item='$value', ";
		} // foreach
		
		$query = rtrim($query, ', ');
		$result = @mysql_query($query, $dbconnect);
		if (mysql_errno() <> 0) {
			if (mysql_errno() == 1062) {
				$this->errors[] = "A record already exists with this ID.";
			} else {
				trigger_error("SQL", E_USER_ERROR);
			} // if
		} // if
		
		return;
	
	} // insertRecord
	
	function updateRecord ($fieldarray)
	{
		$this->errors = array();
		
		global $dbconnect, $query;
		$dbconnect = db_connect($this->dbname) or trigger_error("SQL", E_USER_ERROR);
		
		$fieldlist = $this->fieldlist;
		foreach ($fieldarray as $field => $fieldvalue) {
			if (!in_array($field, $fieldlist)) {
				unset ($fieldarray[$field]);
			} // if
		} // foreach
		
		$where  = NULL;
		$update = NULL;
		foreach ($fieldarray as $item => $value) {
			if (isset($fieldlist[$item]['pkey'])) {
				$where .= "$item='$value' AND ";
			} else {
				$update .= "$item='$value', ";
			} // if
		} // foreach
		
		$where  = rtrim($where, ' AND ');
		$update = rtrim($update, ', ');
		
		$query = "UPDATE $this->tablename SET $update WHERE $where";
		
		$result = mysql_query($query, $dbconnect) or trigger_error("SQL", E_USER_ERROR);
		
		return;
	
	} // updateRecord

	function deleteRecord ($fieldarray)
	{
		$this->errors = array();
		
		global $dbconnect, $query;
		$dbconnect = db_connect($this->dbname) or trigger_error("SQL", E_USER_ERROR);
		
		$fieldlist = $this->fieldlist;
		$where  = NULL;
		foreach ($fieldarray as $item => $value) {
			if (isset($fieldlist[$item]['pkey'])) {
				$where .= "$item='$value' AND ";
			} // if
		} // foreach
		
		$where  = rtrim($where, ' AND ');
		
		$query = "DELETE FROM $this->tablename WHERE $where";
		$result = mysql_query($query, $dbconnect) or trigger_error("SQL", E_USER_ERROR);
		
		return;
	
	} // deleteRecord

	
	function getErrors ()
	{
		return $this->errors; 
	} // getErrors 

}	    
?>