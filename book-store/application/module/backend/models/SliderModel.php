<?php

class SliderModel extends BackendModel
{

    private $_columns = array('id', 'name', 'link', 'thumb', 'created', 'created_by', 'modified', 'modified_by', 'status');

    private $fieldSearchAccepted = ['id', 'name'];
    public function __construct()
    {
        parent::__construct();
        $this->setTable(TBL_SLIDER);
    }

    public function listItems($arrParam, $options = null)
    {
        if ($options == null) {
            $query[]    = "SELECT `id`, `name`, `thumb`, `status`, `created`, `created_by`, `modified`, `modified_by`";
            $query[]    = "FROM `$this->table`";
            $query[]    = "WHERE `id` > 0";

            // FILTER : KEYWORD
            if (!empty($arrParam['search'])) {
                $query[]    = "AND (";
                $keyword    = "'%{$arrParam['search']}%'";
                foreach ($this->fieldSearchAccepted as $field) {
                    $query[] = "`$field` LIKE $keyword";
                    $query[] = "OR";
                }
                array_pop($query);
                $query[] = ")";
            }

            // key search status
            if (!empty($arrParam['statusSearch']) && $arrParam['statusSearch'] != "all") {
                $query[]    = "AND `status` ='" . $arrParam['statusSearch'] . "'";
            }

            // key search showHome
            if (!empty($arrParam['filter_showHome']) && $arrParam['filter_showHome'] != "default") {
                $query[]    = "AND `showHome` ='" . $arrParam['filter_showHome'] . "'";
            }

            // Fill
            if (!empty($arrParam['sort_field']) && !empty($arrParam['sort_order'])) {
                $name         = $arrParam['sort_field'];
                $nameDir     = $arrParam['sort_order'];
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
    }

    public function countItem($arrParam, $option  = null)
    {
        $query[]     = 'SELECT COUNT(`id`) AS `total`';
        $query[]     = "FROM `$this->table`";
        $query[]     = "WHERE `id` > 0";

        // FILTER : KEYWORD
        if (!empty($arrParam['search'])) {
            $query[]    = "AND (";
            $keyword    = "'%{$arrParam['search']}%'";
            foreach ($this->fieldSearchAccepted as $field) {
                $query[] = "`$field` LIKE $keyword";
                $query[] = "OR";
            }
            array_pop($query);
            $query[] = ")";
        }

        // key search status
        if (!empty($arrParam['statusSearch']) && $arrParam['statusSearch'] != "all") {
            $query[]    = "AND `status` ='" . $arrParam['statusSearch'] . "'";
        }

        // key search showHome
        if (!empty($arrParam['filter_showHome']) && $arrParam['filter_showHome'] != "default") {
            $query[]    = "AND `showHome` ='" . $arrParam['filter_showHome'] . "'";
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

        // FILTER : KEYWORD
        if (!empty($arrParam['search'])) {
            $query[]    = "AND (";
            $keyword    = "'%{$arrParam['search']}%'";
            foreach ($this->fieldSearchAccepted as $field) {
                $query[] = "`$field` LIKE $keyword";
                $query[] = "OR";
            }
            array_pop($query);
            $query[] = ")";
        }

        // key search showHome
        if (!empty($arrParam['filter_showHome']) && $arrParam['filter_showHome'] != "default") {
            $query[]    = "AND `showHome` ='" . $arrParam['filter_showHome'] . "'";
        }

        $query        = implode(" ", $query);
        $result        = $this->fetchRow($query);
        return $result;
    }

    public function changeStatus($arrParam, $option  = null)
    {
        require_once LIBRARY_EXT_PATH . 'XML.php';
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
                XML::createXML($arrCategories, 'categories.xml');
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
                XML::createXML($arrCategories, 'categories.xml');
            }
        }
    }

    public function deleteItem($arrParam, $option  = null)
    {
        require_once LIBRARY_EXT_PATH . 'Upload.php';
        require_once LIBRARY_EXT_PATH . 'XML.php';
        if (!empty($arrParam)) {
            if ($option['task'] == 'deleteMuti') {
                // Xóa nhiều phần tử
                $cID        = $arrParam['checkbox'];
                foreach ($cID as $value) {
                    $query = "SELECT `picture` FROM $this->table WHERE id  = $value ";
                    $result = $this->fetchAll($query);
                    foreach ($result as $value) {
                        Upload::removeFile('slider', '1000x3000-' . $value['picture']);
                        Upload::removeFile('slider', $value['picture']);
                    }
                }
                $this->delete($cID);
                if ($this->affectedRows()) {
                    $this->message('success', SUCCESS_DELETE);
                } else {
                    $this->message('danger', ERROR);
                }
                XML::createXML($arrCategories, 'categories.xml');
            } else if ($option['task'] == 'delete') {
                // Xóa 1 phần tử
                $id        = [$arrParam['id']];
                $query = "SELECT `picture` FROM $this->table WHERE id  = " . $arrParam['id'];
                $result = $this->fetchRow($query);
                Upload::removeFile('slider', '1000x3000-' . $result['picture']);
                Upload::removeFile('slider', $result['picture']);
                $this->delete($id);
                if ($this->affectedRows()) {
                    $this->message('success', SUCCESS_DELETE);
                } else {
                    $this->message('danger', ERROR);
                }
                XML::createXML($arrCategories, 'categories.xml');
            }
        }
    }

    public function saveItem($arrParam, $option = null)
    {
        require_once LIBRARY_EXT_PATH . 'Upload.php';
        require_once LIBRARY_EXT_PATH . 'XML.php';

        if ($option['task'] == 'add') {
            $uploadObj = Upload::uploadFile($arrParam['form']['picture'], 'slider', 1000, 3000);
            $arrParam['form']['thumb']        = $uploadObj;
            $arrParam['form']['created']        = $this->_time;
            $arrParam['form']['created_by']    = $this->_user;
            $data    = array_intersect_key($arrParam['form'], array_flip($this->_columns));
            $this->insert($data);
            $id = $this->lastID();
            $this->message('success', SUCCESS_ADD);

            XML::createXML($arrCategories, 'categories.xml');
            return $id;
        }
        if ($option['task'] == 'edit') {
            if ($arrParam['form']['picture']['name'] != null) {
                Upload::removeFile('slider', $arrParam['form']['picture_hidden']);
                Upload::removeFile('slider', '1000x3000-' . $arrParam['form']['picture_hidden']);
                $uploadObj = Upload::uploadFile($arrParam['form']['picture'], 'slider', 1000, 3000);
                $arrParam['form']['thumb']    = $uploadObj;
            } else {
                unset($arrParam['form']['picture']);
            }
            $arrParam['form']['modified']    = $this->_time;
            $arrParam['form']['modified_by'] = $this->_user;
            $data    = array_intersect_key($arrParam['form'], array_flip($this->_columns));
            $this->update($data, array(array('id', $arrParam['form']['id'])));
            $this->message('success', SUCCESS_EDIT);
            XML::createXML($arrCategories, 'categories.xml');
            return $arrParam['form']['id'];
        }
    }

    public function infoItem($arrParam, $option = null)
    {
        if ($option == null) {
            $query[]    = "SELECT `id`, `name`, `thumb` as `picture`, `status`";
            $query[]    = "FROM `$this->table`";
            $query[]    = "WHERE `id` = '" . $arrParam['id'] . "'";
            $query        = implode(" ", $query);
            $result        = $this->fetchRow($query);
            return $result;
        }
    }
}
