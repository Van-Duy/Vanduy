<?php


class CategoryModel extends Model
{

	public function __construct()
	{
		parent::__construct();

		$this->setTable(TBL_CATEGORY);
	}

	public function showItems($arrParam, $option = null)
	{
		$query[]    = "SELECT `b`.`id`,`b`.`picture`,`b`.`name`,`b`.`description`,`b`.`price`,`b`.`category_id`,`b`.`sale_off`,`c`.`name` AS `category_name`";
		$query[]    = "FROM " . TBL_BOOK . " AS `b` LEFT JOIN `" . TBL_CATEGORY . "` AS `c` ON `b`.`category_id` = `c`.`id`";

		if ($option == null) {
			$query[]    = "WHERE `b`.`status` = 'active'";
			// show category
			if (isset($arrParam['list'])) {
				$id = $arrParam['list'];
				$query[]    = "AND `b`.`category_id` = " . $id . "";
			}
			// pagination
			$pagination				= $arrParam['pagination'];
			$currentPage 			= $pagination['currentPage'];
			$totalItemsPerPage		= $pagination['totalItemsPerPage'];
			$position				= ($currentPage - 1) * $totalItemsPerPage;
			$query[]				= "LIMIT $position, $totalItemsPerPage";

			$query        	= implode(" ", $query);
			$result        	= $this->fetchAll($query);
			return $result;
		} else if ($option['task'] == 'topItems') {
			$query[]    = "WHERE `b`.`status` = 'active' AND `b`.`special` = 1";
			$query[]    = "LIMIT 0,5";

			$query        	= implode(" ", $query);
			$result        	= $this->fetchAll($query);
			return $result;
		} else if ($option['task'] == 'newItems') {
			$query[]    = "ORDER BY `b`.`id` DESC";
			$query[]    = "LIMIT 0,6";
			$query        	= implode(" ", $query);
			$result        	= $this->fetchAll($query);
			return $result;
		} else if ($option['task'] == 'relateBook') {
			$id 		= $arrParam['id'];
			$list 		= $arrParam['list'];
			$query[]    = "WHERE `b`.`category_id` = $list AND `b`.`id` != $id";
			$query[]    = "LIMIT 0,6";
			$query        	= implode(" ", $query);
			$result        	= $this->fetchAll($query);
			return $result;
		}
	}

	public function countItem($arrParam, $option = null)
	{
		if ($option == null) {
			$query[]     = 'SELECT COUNT(`id`) AS `total`';
			$query[]     = "FROM " . TBL_BOOK . "";
			$query[]     = "WHERE `id` > 0";

			// show category
			if (isset($arrParam['list'])) {
				$id = $arrParam['list'];
				$query[]    = "AND `category_id` = " . $id . "";
			}

			$query        	= implode(" ", $query);
			$result        	= $this->fetchRow($query);
			return $result['total'];
		}
	}

	public function showCategory($arrParam, $option = null)
	{
		if ($option['task'] == 'special') {
			$query = "SELECT `id`,`picture`,`name`,`price`,`category_id` FROM " . TBL_BOOK . " WHERE `status` = 'active' AND `special` = 1 ORDER BY `ordering` ASC LIMIT 0,2";
			$result = $this->fetchAll($query);
			return $result;
		}else if ($option['task'] == 'get-category') {
			$query = "SELECT `id`,`picture`,`name` FROM " . TBL_CATEGORY . " WHERE `status` = 'active' ORDER BY `id` ASC";
			$result = $this->fetchAll($query);
			return $result;
			
		}
	}

	public function single($arrParam, $option = null)
	{
		if ($option['task'] == null) {
			$id 		= $arrParam['id'];
			$query 		= "SELECT `id`,`picture`,`name`,`price`,`description`,`description_main`,`sale_off`,`category_id` FROM " . TBL_BOOK . " WHERE `id` = " . $id . "";
			$result 	= $this->fetchRow($query);
			return $result;
		} else if ($option['task'] == 'related') {
			$id = $arrParam['id'];
			$query 		= "SELECT `category_id` FROM " . TBL_BOOK . " WHERE `id` = " . $id . "";
			$related 	= $this->fetchRow($query);
			$qr 		= "SELECT `id`,`picture`,`name`,`price`,`description`,`sale_off`,`category_id` FROM " . TBL_BOOK . " WHERE `category_id` = " . $related['category_id'] . " AND `id` != " . $id . " LIMIT 0,3";
			$result 	= $this->fetchAll($qr);
			return $result;
		}
	}
}
