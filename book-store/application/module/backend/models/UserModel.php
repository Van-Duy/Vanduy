<?php

class UserModel extends BackendModel
{

    private $_columns = array('id', 'username', 'password', 'group_id', 'email', 'group_acp', 'created', 'created_by', 'modified', 'modified_by', 'status', 'ordering');

    private $fieldSearchAccepted = ['id', 'username'];
    public function __construct()
    {
        parent::__construct();

        $this->setTable(TBL_USER);
    }

    public function listItems($arrParam, $options = null)
    {
        $query[]        = 'SELECT `u`.`id`,`u`.`username`,`u`.`email`,`g`.`name` AS `group_name`,`u`.`created_by`,`u`.`created`,`u`.`modified`,`u`.`modified_by`,`u`.`status`,`u`.	`ordering`';
        $query[]        = "FROM `$this->table` AS `u` LEFT JOIN `" . TBL_GROUP . "` AS g ON `u`.`group_id` = `g`.`id`";
        $query[]        = "WHERE `u`.`id` > 0";
        //Xóa tk User đăng nhập
        $query[]        = "AND `u`.`id` != " . $this->_id;

        // FILTER : KEYWORD
        if (!empty($arrParam['search'])) {
            $query[]    = "AND (";
            $keyword    = "'%{$arrParam['search']}%'";
            foreach ($this->fieldSearchAccepted as $field) {
                $query[] = "`u`.`$field` LIKE $keyword";
                $query[] = "OR";
            }
            array_pop($query);
            $query[] = ")";
        }

        // key search status
        if (!empty($arrParam['statusSearch']) && $arrParam['statusSearch'] != "all") {
            $query[]    = "AND `u`.`status` ='" . $arrParam['statusSearch'] . "'";
        }


        // key search filter_group_name
        if (!empty($arrParam['filter_group_name']) && $arrParam['filter_group_name'] != "default") {
            $query[]    = "AND `g`.`id` ='" . $arrParam['filter_group_name'] . "'";
        }

        // Fill
        if (!empty($arrParam['namePost']) && !empty($arrParam['namePostDir'])) {
            $name         = $arrParam['namePost'];
            $nameDir     = $arrParam['namePostDir'];
            $query[]    = "ORDER BY `$name` $nameDir";
        } else {
            $query[]    = "ORDER BY `u`.`id` desc";
        }


        // pagination

        $pagination                 = $arrParam['pagination'];
        $currentPage                = $pagination['currentPage'];
        $totalItemsPerPage          = $pagination['totalItemsPerPage'];
        $position                   = ($currentPage - 1) * $totalItemsPerPage;
        $query[]                    = "LIMIT $position, $totalItemsPerPage";



        $query      = implode(" ", $query);
        $result     = $this->fetchAll($query);
        return $result;
    }

    public function countItem($arrParam, $option  = null)
    {
        $query[]        = 'SELECT COUNT(`u`.`id`) AS `total`';
        $query[]        = "FROM `$this->table` AS `u` LEFT JOIN `" . TBL_GROUP . "` AS g ON `u`.`group_id` = `g`.`id`";
        $query[]        = "WHERE `u`.`id` > 0";
        $query[]        = "AND `u`.`id` != " . $this->_id;

        // FILTER : KEYWORD
        if (!empty($arrParam['search'])) {
            $query[]    = "AND (";
            $keyword    = "'%{$arrParam['search']}%'";
            foreach ($this->fieldSearchAccepted as $field) {
                $query[] = "`u`.`$field` LIKE $keyword";
                $query[] = "OR";
            }
            array_pop($query);
            $query[] = ")";
        }

        // key search status
        if (!empty($arrParam['statusSearch']) && $arrParam['statusSearch'] != "all") {
            $query[]    = "AND `u`.`status` ='" . $arrParam['statusSearch'] . "'";
        }

        // key search filter_group_name
        if (!empty($arrParam['filter_group_name']) && $arrParam['filter_group_name'] != "default") {
            $query[]    = "AND `g`.`id` ='" . $arrParam['filter_group_name'] . "'";
        }

        $query              = implode(" ", $query);
        $result             = $this->fetchRow($query);
        return $result;
    }

    public function countStatus($arrParam, $option  = null)
    {
        $query[]     = 'SELECT COUNT(`id`) AS `total`';
        $query[]     = "FROM `$this->table`";
        $query[]     = "WHERE `id` > 0";
        //Count Active
        if (isset($option['task'])) {
            $number = ($option['task'] == 'active') ? 'active' : 'inactive';
            $query[]     = "AND `status` = '$number'";
        }
        $query        = implode(" ", $query);
        $result        = $this->fetchRow($query);
        return $result;
    }

    public function changeStatus($arrParam, $option  = null)
    {
        if (!empty($arrParam)) {
            if ($option['task'] == 'changeStatus') {
                // Thay đổi 1 phần tử sang Active
                $id         = $arrParam['id'];
                $status     = ($arrParam['status'] == 'inactive') ? 'active' : 'inactive';
                $where      = "Update `$this->table` SET `status` = '$status',`modified` = '$this->_time',`modified_by` = '$this->_user' WHERE  id = " . $id . "";
                $this->query($where);
                if ($this->affectedRows()) {
                    $this->message('success', SUCCESS);
                } else {
                    $this->message('danger', ERROR_CHANGE);
                }
            } else if ($option['task'] == 'multi-status') {
                // Thay đổi tất cả phần tử sang Active
                $status     = ($arrParam['type'] == 'multi-active') ? 'active' : 'inactive';
                $cID        = implode(',', $arrParam['checkbox']);
                $where      = "Update `$this->table` SET `status` = '$status',`modified` = '$this->_time',`modified_by` = '$this->_user' WHERE  id IN ($cID,0)";
                $this->query($where);
                if ($this->affectedRows()) {
                    $this->message('success', SUCCESS);
                } else {
                    $this->message('warning', ERROR_CHANGE);
                }
            }
        }
    }

    public function changeGroupName($arrParam, $option  = null)
    {
        if ($option == null) {
            $id         = $arrParam['id'];
            $value      = $arrParam['value'];
            $where      = "Update `$this->table` SET `group_id` = '$value',`modified` = '$this->_time',`modified_by` = '$this->_user' WHERE  id = " . $id . "";
            $this->query($where);
            $htmlModified = $this->setModified();
            return array('id' => $id, 'modified' => $htmlModified);
        }
    }

    public function deleteItem($arrParam, $option  = null)
    {
        $user = Session::get('user');
        if (!empty($arrParam)) {
            $userId = $user['info']['id'];
            if ($userId == $arrParam['id']) {
                $this->message('warning', ERROR);
                URL::redirect('backend', 'user', 'index');
            }

            if ($option['task'] == 'deleteMuti') {
                // Xóa nhiều phần tử
                $cID        = $arrParam['checkbox'];
                $this->delete($cID);
                if ($this->affectedRows()) {
                    $this->message('success', SUCCESS_DELETE);
                } else {
                    $this->message('danger', ERROR);
                }
            } else if ($option['task'] == 'delete') {
                // Xóa 1 phần tử
                $id        = [$arrParam['id']];
                $this->delete($id);
                if ($this->affectedRows()) {
                    $this->message('success', SUCCESS_DELETE);
                } else {
                    $this->message('danger', ERROR);
                }
            }
        }
    }

    public function saveItem($arrParam, $option = null)
    {
        if ($option['task'] == 'add') {
            $arrParam['form']['password']       = md5($arrParam['form']['password']);
            $arrParam['form']['created']        = $this->_time;
            $arrParam['form']['created_by']     = $this->_user;
            $data    = array_intersect_key($arrParam['form'], array_flip($this->_columns));
            $this->insert($data);
            $this->message('success', SUCCESS_ADD);
            return $this->lastID();
        }
        if ($option['task'] == 'edit') {
            // kiểm tra có đang xóa admin
            if ($this->_id == $arrParam['id']) {
                $this->message('warning', ERROR);
                URL::redirect('backend', 'user', 'index');
            }
            $arrParam['form']['modified']       = $this->_time;
            $arrParam['form']['modified_by']    = $this->_user;
            $data    = array_intersect_key($arrParam['form'], array_flip($this->_columns));
            unset($data['username']);
            $this->update($data, array(array('id', $arrParam['form']['id'])));
            $this->message('success', SUCCESS_EDIT);
            return $arrParam['form']['id'];
        }
    }

    public function editPassword($arrParam, $option = null)
    {
        if ($option['task'] == 'edit') {
            $arrParam['form']['password']       = md5($arrParam['form']['password']);
            $arrParam['form']['modified']       = $this->_time;
            $arrParam['form']['modified_by']    = $this->_user;
            $data    = array_intersect_key($arrParam['form'], array_flip($this->_columns));
            $this->update($data, array(array('id', $arrParam['form']['id'])));
            $this->message('success', 'Thay đổi password thành công');
            return $arrParam['form']['id'];
        }
    }

    public function infoItem($arrParam, $option = null)
    {
        if ($option == null) {
            $query[]    = "SELECT `id`,`username`,`email`,`group_id`,`status`,`ordering`";
            $query[]    = "FROM `$this->table`";
            $query[]    = "WHERE `id` = '" . $arrParam['id'] . "'";
            $query      = implode(" ", $query);
            $result     = $this->fetchRow($query);
            return $result;
        }
    }

    public function createSelect()
    {
        $query              = 'SELECT `id`,`name` FROM ' . "`" . TBL_GROUP . "`";
        $result             = $this->fetchPairs($query);
        $result['default']  = '-- Group --';
        ksort($result);
        return $result;
    }

    public function createSelectIndex()
    {
        $query    = 'SELECT `id`,`name` FROM ' . "`" . TBL_GROUP . "`";
        $result = $this->fetchPairs($query);
        return $result;
    }

    public function changeOrdering($arrParam, $option  = null)
    {
        if ($option == null) {
            // thay đổi ordering
            $id          = $arrParam['id'];
            $ordering    = $arrParam['value'];
            $where       = "Update `$this->table` SET `ordering` = '$ordering',`modified` = '$this->_time',`modified_by` = '$this->_user' WHERE  id =" . $id;
            $this->query($where);
            $htmlModified = $this->setModified();
            return array('id' => $id, 'modified' => $htmlModified);
        }
    }
}
