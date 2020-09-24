<?php
//pagination

$linkPa             = URL::createLink('admin','slider','index');
$panigationHTML     = $this->pagination->showPagination($linkPa);

$xhtml = '';
$searchValue = $this->arrParam['search'] ?? '';
if(!empty($this->items)){
    foreach ($this->items as $item) {
        $checkbox       = Helper::showItemCheckbox($item['id']);
        $id             = Helper::highLight($item['id'], $searchValue);
        $name           = Helper::highLight($item['name'], $searchValue);
        $linkStatus     = URL::createLink($this->arrParam['module'], $this->arrParam['controller'], 'changeStatus', ['id' => $item['id'], 'status' => $item['status']]);
        $linkShowHome   = URL::createLink($this->arrParam['module'], $this->arrParam['controller'], 'changeShowHome', ['id' => $item['id'], 'showHome' => $item['showHome']]);
        $status         = Helper::showItemState($linkStatus, $item['status']);
        $modified       = Helper::showItemHistory($item['modified_by'], $item['modified']);
        $linkDelete     = URL::createLink($this->arrParam['module'], $this->arrParam['controller'], 'trash', ['id' => $item['id']]);
        $linkEdit       = URL::createLink($this->arrParam['module'], $this->arrParam['controller'], 'form', ['id' => $item['id']]);
        $img            = Html::createImage($item['thumb'],$item['thumb'],'slider','',array('width' => 360,'height' => 160));
        $buttonAction   = Html::createButtonAction(array('edit' => $linkEdit,'delete' => "javascript:trashSingle('$linkDelete')"));
        $xhtml .= '
        <tr>
            <td class="text-center">
                ' . $checkbox . '
            </td>
            <td class="text-center">' . $id . '</td>
            <td class="text-center text-wrap" style="min-width: 180px">' . $name . '</td>
            <td class="text-center">' . $img . '</td>
            <td class="text-center position-relative">' . $status . '</td>
            <td class="text-center modified-'.$id.'">' . $modified . '</td>
            <td class="text-center">'.$buttonAction.'</td>
        </tr>
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