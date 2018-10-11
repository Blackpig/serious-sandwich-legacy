<?php
class mysql extends database {

	function private_connect () {
		if (false === $this -> link = @mysql_connect ($this -> config['HOST'], $this -> config['USER'], $this -> config['PWD'])) {
			return false;
		} else {
			return true;
		}
	}

	function private_select_base () {
		 if (false === @mysql_select_db($this->config['BD'], $this->link)) {
			return false;
		 } else {
		 	return true;
		 }
 	}

	function private_close() {
		mysql_close($this-> link);
	}


	function private_query () {
		return @mysql_query ($this -> sql, $this -> link);
	}

	function private_num_rows ($qry) {
		return @mysql_num_rows ($qry);
	}

	function private_fetch_assoc ($qry) {
		return @mysql_fetch_assoc ($qry);
	}

	function private_fetch_array ($qry) {
		return @mysql_fetch_array ($qry);
	}

	function private_fetch_row ($qry) {
		return @mysql_fetch_row ($qry);
	}

	function private_insert_id () {
		return @mysql_insert_id ($this -> link);
	}

	function private_errno () {
		return @mysql_errno ($this -> link);
	}

	function private_error () {
		return @mysql_error ($this -> link);
	}
}
?>