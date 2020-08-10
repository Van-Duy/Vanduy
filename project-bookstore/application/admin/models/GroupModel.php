<?php
class GroupModel extends Model{
	private $_columns = array('id', 'name', 'group_acp', 'created', 'created_by', 'modified', 'modified_by', 'status', 'ordering');
	protected $_tableName = TBL_GROUP;
	public function __construct(){
		parent::__construct();
		$this->setTable($this->_tableName);
		Session::init();
	}
	
	public function listItem($arrParam,$option  = null){
		$query[] 	= 'SELECT `id`,`name`,`group_acp`,`created_by`,`created`,`modified`,`modified_by`,`status`,`ordering`';
		$query[] 	= "FROM `$this->_tableName`";
		$query[] 	= 'WHERE `id` > 0';
		// key search
		if(!empty($arrParam['filter_search'])){
			if(isset($arrParam['search-by']) && $arrParam['search-by'] != 'default'){
				$key 		= ($arrParam['search-by'] == 1) ? 'id' : 'name';
				$keyword 	= '\'%'.$arrParam['filter_search'].'%\''; 
				$query[]	= "AND `".$key."` LIKE $keyword ";
			}else{
				$keyword 	= '\'%'.$arrParam['filter_search'].'%\''; 
				$query[]	= "AND `name` LIKE $keyword ";
			}
			
		}

		// key search status
		if(isset($arrParam['statusAll'])){
			$statusAll = Session::get('statusAll');
			if($statusAll != 'default'){
				$query[]	= "AND `status` =" . $statusAll ;
			}
		}
	
		// key search groupACp
		if(isset($arrParam['filter_groupAcp']) && $arrParam['filter_groupAcp'] != 'default'){
				$query[]	= "AND `group_acp` =" . $arrParam['filter_groupAcp'] ;
		}
		// Fill
		if(!empty($arrParam['namePost']) && !empty($arrParam['namePostDir'])){
			$name 		= $arrParam['namePost'];
			$nameDir 	= $arrParam['namePostDir'];
			$query[]	= "ORDER BY `$name` $nameDir";
		}else{
			$query[]	= "ORDER BY `id` asc";
		}

		// pagination
		
		$pagination				= $arrParam['pagination'];
		$currentPage 			= $pagination['currentPage'];
		$totalItemsPerPage		= $pagination['totalItemsPerPage'];
		$position				= ($currentPage-1)*$totalItemsPerPage;
		$query[]				= "LIMIT $position, $totalItemsPerPage";
		


		$query		= implode(" ", $query);
		$result		= $this->listRecord($query);
		return $result;
	}

	public function countItem($arrParam,$option  = null){
		$query[] 	= 'SELECT COUNT(`id`) AS `total`';
		$query[] 	= "FROM `$this->_tableName`";
		$query[] 	= 'WHERE `id` > 0';
		// key search
		if(!empty($arrParam['filter_search'])){
			$keyword 	= '\'%'.$arrParam['filter_search'].'%\''; 
			$query[]	= "AND `name` LIKE $keyword ";
		}
		// key search status
		if(isset($arrParam['filter_groupAcp']) && $arrParam['filter_groupAcp'] != 'default'){
				$query[]	= "AND `group_acp` =" . $arrParam['filter_groupAcp'] ;
		}
		// Fill
		if(!empty($arrParam['namePost']) && !empty($arrParam['namePostDir'])){
			$name 		= $arrParam['namePost'];
			$nameDir 	= $arrParam['namePostDir'];
			$query[]	= "ORDER BY `$name` $nameDir";
		}else{
			$query[]	= "ORDER BY `name` asc";
		}

		

		$query		= implode(" ", $query);
		$result		= $this->singleRecord($query);
		return $result;
	}

	public function changStatus($arrParam,$option = null){
		if(!empty($arrParam)){
			if($option['task'] == 'changeStatus'){
				$id 		= $arrParam['id'];
				$status 	= $arrParam['value'];
				
				$where 	= "Update `$this->_tableName` SET `status` = $status WHERE  id = " . $id . "";
				$this->query($where);
				$result = array(
									'id' 		=> $id,
									'status' 	=>$status,
									'success' 	=> "Đã thay đổi Status "
								);
				return $result;
			}else if($option['task'] == 'changeGroupAcp'){
				$id 		= $arrParam['id'];
				$group 		= ($arrParam['group'] == 1) ? 0 : 1;

				$where 	= "Update `$this->_tableName` SET `group_acp` = $group WHERE  id = " . $id . "";
				$this->query($where);

				$result = array(
					'id' 		=> $id,
					'group' 	=>$group,
					'success' 	=> "Đã thay đổi Group-Acp ",
					'url'		=>'index.php?module=admin&controller=group&action=changeGroupAcp&group='.$group.'&id='.$id.''
				);
				return $result;
			}else if($option['task'] == 'changeAll'){
				$id = $arrParam['id'];
				$type = $arrParam['type'];
				
				if($type == 2){

					$where 		= "DELETE FROM `$this->_tableName` WHERE `id` IN ($id'0')";
					$this->query($where);
					$number = $this->affectedRows();
					return $result = array(
											'id'		=> $id,
											'number'	=> $number,
											'success' 	=> "Đã  Xóa $number phần tử thành công"
											);
				}else if($type == 0 || $type == 1){
					$where 	= "Update `$this->_tableName` SET `status` = $type WHERE  id IN ($id'0')";
					$this->query($where);
					$number = $this->affectedRows();
					return $result = array(
										'number'	=> $number,
										'success' 	=> "Đã thay đổi $number Status thành công"
										);
				}
			}
		}
	}

	public function changOrdering($arrParam,$option = null){
		if(!empty($arrParam['chkOrdering'])){
			foreach($arrParam['chkOrdering'] AS $key => $ordering){
				$where 	= "Update `$this->_tableName` SET `ordering` = $ordering WHERE  `id` = $key";
				$this->query($where);
			}
		}
	}


	public function trash($arrParam,$option = null){
		if(!empty($arrParam['id'])){
		 	if($option == null){
				$id 		= $arrParam['id'];
				$where 		= "DELETE FROM `$this->_tableName` WHERE `id` = $id";
				$this->query($where);

				$result = array(
					'id' 		=> $id,
					'success' 	=> "Đã xóa thành công ",
				);
				return $result;
			}
		}
		
	}

	public function lastIdGet($arrParam,$option = null){
		$lastIdGet 		= explode('-',$arrParam['id']);
		$lastId 		= $lastIdGet['1'];
		$sql = "SELECT `id`,`name`,`group_acp`,`created_by`,`created`,`modified`,`modified_by`,`status`,`ordering` FROM `$this->_tableName` WHERE  id > $lastId ORDER BY `id` ASC LIMIT 1";
		
		$result = $this->query($sql);
		$book = array();
		$book = mysqli_fetch_assoc($result);
		return $book;
		
	}

	public function saveItem($arrParam, $option = null){
		if($option['task'] == 'add'){
			$arrParam['form']['created']	= date('Y-m-d', time());
			$arrParam['form']['created_by']	= 1;
			$data	= array_intersect_key($arrParam['form'], array_flip($this->_columns));
			$this->insert($data);
			Session::set('message', array('class' => 'success', 'content' => 'Dữ liệu được lưu thành công!'));
			return $this->lastID();
		}
		if($option['task'] == 'edit'){
			$arrParam['form']['modified']	= date('Y-m-d', time());
			$arrParam['form']['modified_by']= 10;
			$data	= array_intersect_key($arrParam['form'], array_flip($this->_columns));
			$this->update($data, array(array('id', $arrParam['form']['id'])));
			Session::set('message', array('class' => 'success', 'content' => 'Dữ liệu được cập nhật thành công!'));
			return $arrParam['form']['id'];
		}
	}

	public function infoItem($arrParam, $option = null){
		if($option == null){
			$query[]	= "SELECT `id`, `name`, `group_acp`, `status`, `ordering`";
			$query[]	= "FROM `$this->table`";
			$query[]	= "WHERE `id` = '" . $arrParam['id'] . "'";
			$query		= implode(" ", $query);
			$result		= $this->singleRecord($query);
			return $result;
		}
	}

	public function addSeccion($arrParam, $option = null){
		if(is_numeric($arrParam['statusAll'])){
			Session::set('statusAll',$arrParam['statusAll']);
		}else{
			Session::delete('statusAll');
		}
	}
	
}