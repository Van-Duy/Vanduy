<?php

class CartModel extends BackendModel
{

    private $_columns = array('id', 'username', 'password', 'group_id', 'email', 'group_acp', 'created', 'created_by', 'modified', 'modified_by', 'status', 'ordering');

    private $fieldSearchAccepted = ['username'];
    public function __construct()
    {
        parent::__construct();
        $this->setTable(TBL_CART);
    }

    public function listItems($arrParam, $options = null)
    {
        $query[]    = "SELECT `id`, `username`, `status`, `date`";
        $query[]    = "FROM `$this->table`";
        $query[]    = "WHERE `status` >= 0";

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

        // FILTER : status
        if (isset($arrParam['status']) && $arrParam['status'] != 'default') {
            $query[]    = "AND `status` = " . $arrParam['status'];
        }

        // Fill
        if (!empty($arrParam['sort_field']) && !empty($arrParam['sort_order'])) {
            $name           = $arrParam['sort_field'];
            $nameDir        = $arrParam['sort_order'];
            $query[]        = "ORDER BY `$name` $nameDir";
        } else {
            $query[]        = "ORDER BY `date` desc";
        }

        $query      = implode(" ", $query);
        $result     = $this->fetchAll($query);
        return $result;
    }

    public function countItem($arrParam, $option  = null)
    {
        $query[]     = 'SELECT COUNT(`id`) AS `total`';
        $query[]     = "FROM `$this->table`";
        $query[]     = "WHERE `status` >= 0";

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

        // FILTER : status
        if (!empty($arrParam['status']) && $arrParam['status'] != 'default') {
            $query[]    = "AND `status` = " . $arrParam['status'];
        }

        $query        = implode(" ", $query);
        $result        = $this->fetchRow($query);
        return $result;
    }

    public function ajaxStatus($arrParam, $option  = null)
    {
        if ($option == null) {
            // Thay đổi trạng thái satus
            $id             = $arrParam['id'];
            $status         = $arrParam['value'];
            echo $where         = "Update `$this->table` SET `status` = '$status' WHERE  `id` = '" . $id . "'";
            $this->query($where);
        }
    }

    public function deleteItem($arrParam, $option  = null)
    {
        if (!empty($arrParam)) {
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

    public function showItem($arrParam, $option = null)
    {
        if ($option == null) {
            $id = $arrParam['id'];
            $query[]    = 'SELECT `id`,`username`,`books`,`prices`,`quantities`,`names`,`pictures`,`date`,`status`';
            $query[]    = "FROM `$this->table`";
            $query[]    = "WHERE `id` = '" . $id . "'";
            $query        = implode(" ", $query);
            $result        = $this->fetchRow($query);
            return $result;
        }
    }
}
