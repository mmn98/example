<?php
include_once 'MysqliDb.php';


class Common extends MysqliDb
{
	public function __construct()
	{
		parent::__construct();
		$this->db = new MysqliDb('localhost', 'root', '', 'myexample');

		if($this->db)
		{
			return true;
		}
		else{
			return false;
		}
	}
}
?>

