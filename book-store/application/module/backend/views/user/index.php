<?php
//pagination

$linkPa             = URL::createLink('admin', 'group', 'index');
$panigationHTML     = $this->pagination->showPagination($linkPa);

$xhtml = '';

$searchValue = $this->arrParam['search'] ?? '';
if(!empty($this->items)){
    foreach ($this->items as $item) {
        $checkbox       = Helper::showItemCheckbox($item['id']);
        $id             = Helper::highLight($item['id'], $searchValue);
        $name           = Helper::highLight($item['username'], $searchValue);
        $email          = Helper::highLight($item['email'], $searchValue);
        $name_email     = Helper::showItemNameEmail($name, $email);
        $linkStatus     = URL::createLink($this->arrParam['module'], $this->arrParam['controller'], 'changeStatus', ['id' => $item['id'], 'status' => $item['status']]);
        $status         = Helper::showItemState($linkStatus, $item['status']);
        $ordering       = Helper::showItemOrdering($item['id'], $item['ordering']);
        $arrGroupName   = $this->selectIndex;
        $groupName      = Helper::showItemSelect('groupName', $arrGroupName, $item['group_name'], $item['id']);
        $created        = Helper::showItemHistory($item['created_by'], $item['created']);
        $modified       = Helper::showItemHistory($item['modified_by'], $item['modified']);
        $linkDelete     = URL::createLink($this->arrParam['module'], $this->arrParam['controller'], 'trash', ['id' => $item['id']]);
        $linkEdit       = URL::createLink($this->arrParam['module'], $this->arrParam['controller'], 'form', ['id' => $item['id']]);
        $linkchangePass = URL::createLink($this->arrParam['module'], $this->arrParam['controller'], 'changePass', ['id' => $item['id']]);
        $buttonAction   = Html::createButtonAction(array('changePass' => $linkchangePass, 'edit' => $linkEdit, 'delete' => "javascript:trashSingle('$linkDelete')"));
    
        $xhtml .= '
        <tr>
            <td class="text-center">
                ' . $checkbox . '
            </td>
            <td class="text-center">' . $id . '</td>
            <td class="text-center">' . $name_email . '</td>
            <td class="text-center position-relative">' . $status . '</td>
            <td class="text-center position-relative">' . $groupName . '</td>
            <td class="text-center position-relative ordering-' . $item['id'] . '"">' . $ordering . '</td>
            <td class="text-center">' . $created . '</td>
            <td class="text-center modified-' . $item['id'] . '">' . $modified . '</td>
            <td class="text-center">' . $buttonAction . '</td>
       <tr>
        ';
    }
}else{
    $xhtml = '<tr><td class="text-center"><h2>Không có giá trị !!!</h2></td><tr>';
}

?>
<!-- Search & Filter -->
<?php require_once 'elements/search-filter.php' ?>

<!-- List -->
<?php require_once 'elements/list.php' ?>