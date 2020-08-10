<?php
class DashboarModel extends Model{
	public function __construct(){
		parent::__construct();
	}
	
	public function listItems(){
		echo '<h3>' . __METHOD__ . '</h3>';
	}
}