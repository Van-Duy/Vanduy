<?php
class IndexModel extends Model
{
	private $_columns = array(
		'id',
		'username',
		'password',
		'group_id',
		'email',
		'group_acp',
		'created',
		'created_by',
		'modified',
		'modified_by',
		'register_date',
		'register_ip',
		'status',
		'ordering'
	);

	public function __construct()
	{
		parent::__construct();
		$this->setTable(TBL_USER);
		Session::init();
	}

	public function topProduct()
	{
		$query = "SELECT `b`.`id`,`b`.`picture`,`b`.`name`,`b`.`description`,`b`.`price`,`b`.`category_id`,`b`.`sale_off`,`c`.`name` AS `category_name` FROM " . TBL_BOOK . " AS `b` LEFT JOIN `" . TBL_CATEGORY . "` AS `c` ON `b`.`category_id` = `c`.`id` WHERE `b`.`status` = 'active'AND `b`.`special` = 1 LIMIT 0,8";
		$result = $this->fetchAll($query);
		return $result;
	}

	public function topCategory()
	{
		$query = "SELECT `id`,`name` FROM " . TBL_CATEGORY . " WHERE `showHome` = 'active' LIMIT 0,3";
		$result = $this->fetchAll($query);
		return $result;
	}

	public function topCategoryItems()
	{
		$query = "SELECT `id` FROM " . TBL_CATEGORY . " WHERE `showHome` = 'active' LIMIT 0,3";
		$resultO = $this->fetchAll($query);
		foreach ($resultO as $value) {
			$id = $value['id'];
			$queryN = "SELECT `b`.`id`,`b`.`picture`,`b`.`name`,`b`.`description`,`b`.`price`,`b`.`category_id`,`b`.`sale_off`,`c`.`name` AS `category_name` FROM " . TBL_BOOK . " AS `b` LEFT JOIN `" . TBL_CATEGORY . "` AS `c` ON `b`.`category_id` = `c`.`id` WHERE `b`.`status` = 'active'AND `b`.`category_id` = $id LIMIT 0,4";
			$result[$id] = $this->fetchAll($queryN);
		}
		return $result;
	}

	public function showSlider()
	{
		$query = "SELECT `id`,`name`,`thumb`,`status` FROM " . TBL_SLIDER . " WHERE `status` = 'active' LIMIT 0,4";
		$result = $this->fetchAll($query);
		return $result;
	}

	public function save($arrParam, $option = null)
	{
		if ($option['task'] == 'register') {

			$arrParam['form']['password'] 		= md5($arrParam['form']['password']);
			$arrParam['form']['register_date'] 	= date('Y-m-d H:m:s', time());
			$arrParam['form']['register_ip'] 	= $_SERVER['REMOTE_ADDR'];
			$arrParam['form']['status'] 		= 'inactive';
			$data = array_intersect_key($arrParam['form'], array_flip($this->_columns));

			$this->insert($data);
			return $this->lastID();
		}
	}

	public function infoItem($arrParam, $option = null)
	{
		if ($option == null) {
			$email = $arrParam['form']['email'];
			$password = md5($arrParam['form']['password']);

			$query[] 	= "SELECT `u`.`id`,`u`.`username`,`u`.`email`,`u`.`password`,`u`.`group_id`,`g`.`group_acp`";
			$query[] 	= "FROM `$this->table` AS `u` LEFT JOIN `" . TBL_GROUP . "` AS g ON `u`.`group_id` = `g`.`id`";
			$query[] 	= "WHERE `u`.`email` = '" . $email . "' AND `u`.`password` = '" . $password . "'";

			$query		= implode(" ", $query);
			$result		= $this->fetchRow($query);

			Session::set('message', array('class' => 'success', 'content' => 'Đăng nhập thành công !!! Chào mừng bạn đến với BookStore'));

			// if($result['group_acp'] == 1){
			// 	$arrPermission = explode(',',$result['permission_id']);
			// 	foreach($arrPermission AS $permiId) $permissionId .= "'".$permiId."',";

			// 	$queryP[] 	= "SELECT `id`, CONCAT(`module`,'-',`controller`,'-',`action`) AS `name`";
			// 	$queryP[] 	= "FROM `permission`";
			// 	$queryP[] 	= "WHERE `id` IN ($permissionId'0')";

			// 	$queryP					= implode(" ", $queryP);
			// 	$result['permiss']		= $this->fetchParis($queryP);

			// }
			return $result;
		}
	}

	public function view($arrParam, $option = null)
	{
		if ($option == null) {
			$id = $arrParam['id'];
			$query = "SELECT `b`.`id`,`b`.`picture`,`b`.`name`,`b`.`description`,`b`.`price`,`b`.`category_id`,`b`.`sale_off`,`c`.`name` AS `category_name` FROM `" . TBL_BOOK . "` AS `b` LEFT JOIN `" . TBL_CATEGORY . "` AS c ON `b`.`category_id` = `c`.`id` WHERE `b`.`status` = 'active'AND `b`.`id` = $id";
			$result = $this->fetchRow($query);
			$result['src']   		= Html::createImageSrc($result['picture'], $result['picture'], 'book', '252x323-', array('height' => 252, 'min-height' => 323));
			$link 					= URL::filterURL("$result[category_name]") . "/" . URL::filterURL("$result[name]") . "-$result[category_id]-$result[id].html";
			$result['linkretail'] 	= URL::createLink('frontend', 'category', 'list', ['list' => $result['category_id'], 'id' => $id],$link);

			return $result;
		}
	}
}
