<?php

class AccountModel extends BackendModel
{

    private $_columns = array('id', 'username', 'password', 'group_id', 'email', 'group_acp', 'created', 'created_by', 'modified', 'modified_by', 'status', 'ordering', 'phone', 'address', 'fullname');

    public function __construct()
    {
        parent::__construct();
        $this->setTable(TBL_USER);
    }


    public function saveItem($arrParam, $option = null)
    {

        if ($option == null) {
            $arrParam['form']['modified']       = $this->_time;
            $arrParam['form']['modified_by']    = $this->_user;
            $data    = array_intersect_key($arrParam['form'], array_flip($this->_columns));
            unset($data['username']);
            $this->update($data, array(array('id', $this->_id)));
            $this->message('success', SUCCESS_EDIT);
        }
    }

    public function editPassword($arrParam, $option = null)
    {
        if ($option == null) {
            $arrParam['form']['password']       = md5($arrParam['passWordNew']);
            $data    = array_intersect_key($arrParam['form'], array_flip($this->_columns));
            $this->update($data, array(array('id', $this->_id)));
            $this->message('success', 'Thay đổi password thành công');
        }
    }

    public function infoItem($arrParam, $option = null)
    {
        if ($option == null) {
            $query[]    = "SELECT `id`,`username`,`fullname`,`phone`,`address`";
            $query[]    = "FROM `$this->table`";
            $query[]    = "WHERE `id` = '" . $this->_id . "'";
            $query      = implode(" ", $query);
            $result     = $this->fetchRow($query);
            return $result;
        }
    }

    
    public function getUser(){
		$username 		=  (Session::get('user'))['info']['username'];
		$query[] 		= 'SELECT `id`,`username`,`password`,`email`,`fullname`,`address`,`phone`';
		$query[] 		= "FROM `".TBL_USER."`";
		$query[] 		= 'WHERE `username` = "'.$username .'"';
		$query		    = implode(" ", $query);
		$result		    = $this->fetchRow($query);
		return $result;
	}
}
