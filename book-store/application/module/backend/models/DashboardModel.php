<?php
class DashboardModel extends BackendModel
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable(TBL_GROUP);
    }

    public function countItems($params, $options = [])
    {
        $result = 0;
        $query[] = "SELECT COUNT(`id`) AS `total`";
        
        if ($options['task'] == 'group')    $this->setTable(TBL_GROUP);
        if ($options['task'] == 'user')     $this->setTable(TBL_USER);
        if ($options['task'] == 'category') $this->setTable(TBL_CATEGORY);
        if ($options['task'] == 'book')     $this->setTable(TBL_BOOK);
        if ($options['task'] == 'cart')     $this->setTable(TBL_CART);
        
        $query[] = "FROM `$this->table`";
        $query = implode(' ', $query);
        
        $result = $this->fetchRow($query)['total'];
        return $result;
    }
}
