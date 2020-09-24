<?php
//pagination
$linkPa             = URL::createLink('admin', 'group', 'index');
$panigationHTML     = $this->pagination->showPagination($linkPa);

$xhtml = '';
$searchValue = $this->arrParam['search'] ?? '';
if(!empty($this->items)){
    foreach ($this->items as $item) {

        $checkbox           = Helper::showItemCheckbox($item['id']);
        $id                 = Helper::highLight($item['id'], $searchValue);
        $name               = Helper::highLight($item['name'], $searchValue);
        $linkStatus         = URL::createLink($this->arrParam['module'], $this->arrParam['controller'], 'changeStatus', ['id' => $item['id'], 'status' => $item['status']]);
        $linkSpecial        = URL::createLink($this->arrParam['module'], $this->arrParam['controller'], 'changeSpecial', ['id' => $item['id'], 'special' => $item['special']]);
        $status             = Helper::showItemState($linkStatus, $item['status']);
        $special            = Helper::showItemSpecial($linkSpecial, $item['special']);
        $formatPrice        = Helper::formatPrice($item['price'], ',', '.', ' VND');
        $price              = Helper::highLight($formatPrice, $searchValue);
        $sale_off           = Helper::highLight($item['sale_off'], $searchValue);
        $arrCategoryName    = $this->selectIndex;
        $category_name      = Helper::showItemSelect('category_name', $arrCategoryName, $item['category_name'], $id, '180px');
        $modified           = Helper::showItemHistory($item['modified_by'], $item['modified']);
        $linkDelete         = URL::createLink($this->arrParam['module'], $this->arrParam['controller'], 'trash', ['id' => $item['id']]);
        $linkEdit           = URL::createLink($this->arrParam['module'], $this->arrParam['controller'], 'form', ['id' => $item['id']]);
        $img                = Html::createImage($item['picture'], $item['picture'], 'book', '252x323-', array('width' => 60, 'height' => 60));
        $buttonAction       = Html::createButtonAction(array('edit' => $linkEdit, 'delete' => "javascript:trashSingle('$linkDelete')"));
    
        $xhtml .= '
        <tr>
            <td class="text-center">
                ' . $checkbox . '
            </td>
            <td class="text-center">' . $id . '</td>
            <td class="text-center text-wrap" style="min-width: 180px">' . $name . '</td>
            <td class="text-center">' . $img  . '</td>
            <td class="text-center position-relative">' . $status . '</td>
            <td class="text-center position-relative special-' . $id . '">' . $special . '</td>
            <td class="text-center position-relative">' . $price  . ' </td>
            <td class="text-center position-relative">' . $sale_off  . ' % </td>
            <td class="text-center position-relative">' . $category_name . '</td>
            <td class="text-center modified-' . $id . '">' . $modified . '</td>
            <td class="text-center">' . $buttonAction . '</td>
        </tr>
        ';
    }
}else{
    $xhtml = ' <td class="text-center" colspan="12"> Không tìm thấy dữ liệu !!! </td>';
}

?>
<!-- Search & Filter -->
<?php require_once 'elements/search-filter.php' ?>

<!-- List -->
<?php require_once 'elements/list.php' ?>

