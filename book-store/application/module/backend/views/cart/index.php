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
        $date           = Helper::highLight($item['date'], $searchValue);
        $name           = Helper::highLight($item['username'], $searchValue);
        $arrStatus      = array(0 => 'Đơn hàng mới', 1 => 'Đang xử lí', 2 => 'Hoàn tất');
        $status         = Helper::showItemSelectNumber('status_name', $arrStatus, $item['status'], $item['id']);
        $linkDelete     = URL::createLink($this->arrParam['module'], $this->arrParam['controller'], 'trash', ['id' => $item['id']]);
        $linkView       = URL::createLink($this->arrParam['module'], $this->arrParam['controller'], 'view', ['id' => $item['id']]);
        $buttonAction   = Html::createButtonAction(array('view' => "javascript:viewCart('$linkView')",'delete' => "javascript:trashSingle('$linkDelete')"));
    
        $xhtml .= '
        <tr>
            <td class="text-center">
                ' . $checkbox . '
            </td>
            <td class="text-center">' . $id . '</td>
            <td class="text-center">' . $name . '</td>
            <td class="text-center position-relative">' . $status . '</td>
            <td class="text-center position-relative">' . $date . '</td>
            <td class="text-center">' . $buttonAction . '</td>
       <tr>
        ';
    }
}else{
    $xhtml = ' <td class="text-center" colspan="9"> Không tìm thấy dữ liệu !!! </td>';
}

?>
<!-- Search & Filter -->
<?php require_once 'elements/search-filter.php' ?>

<!-- List -->
<?php require_once 'elements/list.php' ?>