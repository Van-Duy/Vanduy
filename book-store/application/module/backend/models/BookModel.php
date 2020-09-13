<?php

class BookModel extends BackendModel
{

    private $_columns = array('id', 'name', 'price', 'description', 'picture', 'sale_off', 'special', 'category_id', 'created', 'created_by', 'modified', 'modified_by', 'status', 'ordering');

    private $fieldSearchAccepted = ['id', 'name'];
    public function __construct()
    {
        parent::__construct();
        $this->setTable(TBL_BOOK);
    }

    public function listItems($arrParam, $options = null)
    {
        $query[]     = 'SELECT `b`.`id`,`b`.`name`,`b`.`description`,`b`.`picture`,`b`.`price`,`b`.`sale_off`,`b`.`special`,`c`.`name` AS `category_name`,`b`.`created_by`,`b`.`created`,`b`.`modified`,`b`.`modified_by`,`b`.`status`,`b`.`ordering`';
        $query[]     = "FROM `$this->table` AS `b` LEFT JOIN `" . TBL_CATEGORY . "` AS c ON `b`.`category_id` = `c`.`id`";
        $query[]     = "WHERE `b`.`id` > 0";

        // FILTER : KEYWORD
        if (!empty($arrParam['search'])) {
            $query[]    = "AND (";
            $keyword    = "'%{$arrParam['search']}%'";
            foreach ($this->fieldSearchAccepted as $field) {
                $query[] = "`b`.`$field` LIKE $keyword";
                $query[] = "OR";
            }
            array_pop($query);
            $query[] = ")";
        }

        // key search status
        if (!empty($arrParam['statusSearch']) && $arrParam['statusSearch'] != "all") {
            $query[]    = "AND `b`.`status` ='" . $arrParam['statusSearch'] . "'";
        }

        // key search special
        if (isset($arrParam['filter_special']) && $arrParam['filter_special'] != "default") {
            $query[]    = "AND `b`.`special` ='" . $arrParam['filter_special'] . "'";
        }


        // key search filter_category_name
        if (!empty($arrParam['filter_category_name']) && $arrParam['filter_category_name'] != "default") {
            $query[]    = "AND `c`.`id` ='" . $arrParam['filter_category_name'] . "'";
        }

        // Fill
        if (!empty($arrParam['namePost']) && !empty($arrParam['namePostDir'])) {
            $name           = $arrParam['namePost'];
            $nameDir        = $arrParam['namePostDir'];
            $query[]        = "ORDER BY `$name` $nameDir";
        } else {
            $query[]        = "ORDER BY `b`.`id` desc";
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
        $query[]     = 'SELECT COUNT(`b`.`id`) AS `total`';
        $query[]     = "FROM `$this->table` AS `b` LEFT JOIN `" . TBL_CATEGORY . "` AS c ON `b`.`category_id` = `c`.`id`";
        $query[]     = "WHERE `b`.`id` > 0";

        // FILTER : KEYWORD
        if (!empty($arrParam['search'])) {
            $query[]    = "AND (";
            $keyword    = "'%{$arrParam['search']}%'";
            foreach ($this->fieldSearchAccepted as $field) {
                $query[] = "`b`.`$field` LIKE $keyword";
                $query[] = "OR";
            }
            array_pop($query);
            $query[] = ")";
        }

        // key search status
        if (!empty($arrParam['statusSearch']) && $arrParam['statusSearch'] != "all") {
            $query[]    = "AND `b`.`status` ='" . $arrParam['statusSearch'] . "'";
        }

        // key search special
        if (isset($arrParam['filter_special']) && $arrParam['filter_special'] != "default") {
            $query[]    = "AND `b`.`special` ='" . $arrParam['filter_special'] . "'";
        }


        // key search filter_category_name
        if (!empty($arrParam['filter_category_name']) && $arrParam['filter_category_name'] != "default") {
            $query[]    = "AND `c`.`id` ='" . $arrParam['filter_category_name'] . "'";
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
            } else if ($option['task'] == 'multi-status') {
                // Thay đổi tất cả phần tử sang Active
                $status     = ($arrParam['type'] == 'multi-active') ? 'active' : 'inactive';
                $cID        = implode(',', $arrParam['checkbox']);

                $where         = "Update `$this->table` SET `status` = '$status',`modified` = '$this->_time',`modified_by` = '$this->_user' WHERE  id IN ($cID,0)";
                $this->query($where);
                if ($this->affectedRows()) {
                    $this->message('success', SUCCESS);
                } else {
                    $this->message('warning', ERROR_CHANGE);
                }
            }
        }
    }

    public function ajaxSpecial($arrParam, $option  = null)
    {
        if ($option == null) {
            // Thay đổi trạng thái special
            $id            = $arrParam['id'];
            $special       = ($arrParam['special'] == 0) ? 1 : 0;
            $where         = "Update `$this->table` SET `special` = '$special',`modified` = '$this->_time',`modified_by` = '$this->_user' WHERE  id = " . $id . "";
            $this->query($where);
            $linkSpecial   = URL::createLink('backend', 'book', 'changeSpecial', ['id' => $id, 'special' =>  $special]);
            $HtlmSpecial   = Helper::showItemSpecial($linkSpecial, $special);
            $htmlModified   = $this->setModified();
            return array('id' => $id, 'special' => $HtlmSpecial, 'modified' => $htmlModified);
        }
    }

    public function deleteItem($arrParam, $option  = null)
    {
        require_once LIBRARY_EXT_PATH . 'Upload.php';
        if (!empty($arrParam)) {
            if ($option['task'] == 'deleteMuti') {
                // Xóa nhiều phần tử
                $cID        = $arrParam['checkbox'];
                foreach ($cID as $value) {
                    $query = "SELECT `picture` FROM $this->table WHERE id  = $value ";
                    $result = $this->fetchAll($query);
                    foreach ($result as $value) {
                        Upload::removeFile('book', '252x323-' . $value['picture']);
                        Upload::removeFile('book', $value['picture']);
                    }
                }
                $this->delete($cID);
                if ($this->affectedRows()) {
                    $this->message('success', SUCCESS_DELETE);
                } else {
                    $this->message('danger', ERROR);
                }
            } else if ($option['task'] == 'delete') {
                // Xóa 1 phần tử
                $id        = [$arrParam['id']];
                $query = "SELECT `picture` FROM $this->table WHERE id  = " . $arrParam['id'];
                $result = $this->fetchRow($query);
                Upload::removeFile('book', '252x323-' . $result['picture']);
                Upload::removeFile('book', $result['picture']);
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
        require_once LIBRARY_EXT_PATH . 'Upload.php';
        if ($option['task'] == 'add') {
            $uploadObj = Upload::uploadFile($arrParam['form']['picture'], 'book', 252, 323);
            $arrParam['form']['picture']        = $uploadObj;
            $arrParam['form']['created']        = $this->_time;
            $arrParam['form']['created_by']     = $this->_user;
            $data    = array_intersect_key($arrParam['form'], array_flip($this->_columns));
            $this->insert($data);
            $this->message('success', SUCCESS_ADD);
            return $this->lastID();
        }
        if ($option['task'] == 'edit') {
            if ($arrParam['form']['picture']['name'] != null) {
                Upload::removeFile('book', $arrParam['form']['picture_hidden']);
                Upload::removeFile('book', '252x323-' . $arrParam['form']['picture_hidden']);
                $uploadObj = Upload::uploadFile($arrParam['form']['picture'], 'book', 252, 323);
                $arrParam['form']['picture']    = $uploadObj;
            } else {
                unset($arrParam['form']['picture']);
            }
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
            $query[]    = "SELECT `id`,`name`,`picture`,`description`,`price`,`category_id`,`status`,`ordering`,`special`,`sale_off`";
            $query[]    = "FROM `$this->table`";
            $query[]    = "WHERE `id` = '" . $arrParam['id'] . "'";
            $query        = implode(" ", $query);
            $result        = $this->fetchRow($query);
            return $result;
        }
    }

    public function createSelectIndex()
    {
        $query    = 'SELECT `id`,`name` FROM ' . "`" . TBL_CATEGORY . "`";
        $result = $this->fetchPairs($query);
        return $result;
    }

    public function createSelect()
    {
        $query    = 'SELECT `id`,`name` FROM ' . "`" . TBL_CATEGORY . "`";
        $result = $this->fetchPairs($query);
        $result['default'] = '--Category--';
        ksort($result);
        return $result;
    }

    public function changeCategoryName($arrParam, $option  = null)
    {
        if ($option == null) {
            $id         = $arrParam['id'];
            $value      = $arrParam['value'];
            $where      = "Update `$this->table` SET `category_id` = '$value',`modified` = '$this->_time',`modified_by` = '$this->_user' WHERE  id = " . $id . "";
            $this->query($where);
            $htmlModified = $this->setModified();
            return array('id' => $id, 'modified' => $htmlModified);
        }
    }
}
