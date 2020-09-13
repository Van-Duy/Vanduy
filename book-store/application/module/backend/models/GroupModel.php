<?php

class GroupModel extends BackendModel
{

    private $_columns = array('id', 'name', 'group_acp', 'created', 'created_by', 'modified', 'modified_by', 'status', 'ordering');

    private $fieldSearchAccepted = ['id', 'name'];
    public function __construct()
    {
        parent::__construct();
        $this->setTable(TBL_GROUP);
    }

    public function listItems($arrParam, $options = null)
    {
        $query[]    = "SELECT `id`, `name`, `group_acp`, `status`, `ordering`, `created`, `created_by`, `modified`, `modified_by`";
        $query[]    = "FROM `$this->table`";
        $query[]    = "WHERE `id` > 0";

        // FILTER : KEYWORD
        if (!empty($arrParam['search'])) {
            $query[] = "AND (";
            $keyword    = "'%{$arrParam['search']}%'";
            foreach ($this->fieldSearchAccepted as $field) {
                $query[] = "`$field` LIKE $keyword";
                $query[] = "OR";
            }
            array_pop($query);
            $query[] = ")";
        }

        // key search groupACp
        if (isset($arrParam['filter_group_acp']) && $arrParam['filter_group_acp'] != 'default') {
            $query[]    = "AND `group_acp` =" . $arrParam['filter_group_acp'];
        }

        // key search statusSearch
        if (!empty($arrParam['statusSearch']) && $arrParam['statusSearch'] != "all") {
            $query[]    = "AND `status` ='" . $arrParam['statusSearch'] . "'";
        }


        // Fill
        if (!empty($arrParam['namePost']) && !empty($arrParam['namePostDir'])) {
            $name         = $arrParam['namePost'];
            $nameDir     = $arrParam['namePostDir'];
            $query[]    = "ORDER BY `$name` $nameDir";
        } else {
            $query[]    = "ORDER BY `id` desc";
        }


        // pagination

        $pagination                = $arrParam['pagination'];
        $currentPage             = $pagination['currentPage'];
        $totalItemsPerPage        = $pagination['totalItemsPerPage'];
        $position                = ($currentPage - 1) * $totalItemsPerPage;
        $query[]                = "LIMIT $position, $totalItemsPerPage";



        $query      = implode(" ", $query);
        $result     = $this->fetchAll($query);
        return $result;
    }

    public function countItem($arrParam, $option  = null)
    {
        $query[]     = 'SELECT COUNT(`id`) AS `total`';
        $query[]     = "FROM `$this->table`";
        $query[]     = "WHERE `id` > 0";

        // FILTER : KEYWORD
        if (!empty($arrParam['search'])) {
            $query[] = "AND (";
            $keyword    = "'%{$arrParam['search']}%'";
            foreach ($this->fieldSearchAccepted as $field) {
                $query[] = "`$field` LIKE $keyword";
                $query[] = "OR";
            }
            array_pop($query);
            $query[] = ")";
        }

        // key search groupACp
        if (isset($arrParam['filter_group_acp']) && $arrParam['filter_group_acp'] != 'default') {
            $query[]    = "AND `group_acp` =" . $arrParam['filter_group_acp'];
        }

        // key search groupACp
        if (!empty($arrParam['statusSearch']) && $arrParam['statusSearch'] != "All") {
            $query[]    = "AND `status` ='" . $arrParam['statusSearch'] . "'";
        }

        $query        = implode(" ", $query);
        $result        = $this->fetchRow($query);
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
                $where     = "Update `$this->table` SET `status` = '$status',`modified` = '$this->_time',`modified_by` = '$this->_user' WHERE  id = " . $id . "";
                $this->query($where);
                if ($this->affectedRows()) {
                    $this->message('success', SUCCESS);
                } else {
                    $this->message('danger', ERROR_CHANGE);
                }
            }
        }
    }
    public function ajaxGroupACP($arrParam, $option = null)
    {
        if ($option['task'] == null) {
            // Thay đổi GroupACP 
            $id             = $arrParam['id'];
            $group_acp      = ($arrParam['group_acp'] == 0) ? 1 : 0;
            $where          = "Update `$this->table` SET `group_acp` = $group_acp,`modified` = '$this->_time',`modified_by` = '$this->_user' WHERE  id = " . $id . "";
            $this->query($where);
            $linkGroupACP   = URL::createLink('backend', 'group', 'changeGroupACP', ['id' => $id, 'group_acp' =>  $group_acp]);
            $groupACP       = Helper::showItemACP($linkGroupACP, $group_acp);
            $htmlModified   = $this->setModified();
            return array('id' => $id, 'groupACP' => $groupACP, 'modified' => $htmlModified);
        }
    }

    public function saveItem($arrParam, $option = null)
    {
       
        if ($option['task'] == 'add') {
            $arrParam['form']['created']        = $this->_time;
            $arrParam['form']['created_by']     = $this->_user;
            $data    = array_intersect_key($arrParam['form'], array_flip($this->_columns));
            $this->insert($data);
            $this->message('success', SUCCESS_ADD);
            return $this->lastID();
        }
        if ($option['task'] == 'edit') {
            $arrParam['form']['modified']       = $this->_time;
            $arrParam['form']['modified_by']    = $this->_user;
            $data    = array_intersect_key($arrParam['form'], array_flip($this->_columns));
            $this->update($data, array(array('id', $arrParam['form']['id'])));
            $this->message('success', SUCCESS_EDIT);
            return $arrParam['form']['id'];
        }
    }

    public function infoItem($arrParam, $option = null)
    {
        if ($option == null) {
            $query[]        = "SELECT `id`, `name`, `group_acp`, `status`, `ordering`";
            $query[]        = "FROM `$this->table`";
            $query[]        = "WHERE `id` = '" . $arrParam['id'] . "'";
            $query          = implode(" ", $query);
            $result         = $this->fetchRow($query);
            return $result;
        }
    }
}
