<?php
//pagination

$linkPa             = URL::createLink('admin','group','index');
$panigationHTML     = $this->pagination->showPagination($linkPa);

$xhtml = '';
$searchValue = $this->arrParam['search'] ?? '';
foreach ($this->items as $item) {
    $checkbox       = Helper::showItemCheckbox($item['id']);
    $id             = Helper::highLight($item['id'], $searchValue);
    $name           = Helper::highLight($item['name'], $searchValue);
    $linkStatus     = URL::createLink($this->arrParam['module'], $this->arrParam['controller'], 'changeStatus', ['id' => $item['id'], 'status' => $item['status']]);
    $linkGroupACP   = URL::createLink($this->arrParam['module'], $this->arrParam['controller'], 'changeGroupACP', ['id' => $item['id'], 'group_acp' => $item['group_acp']]);
    $status         = Helper::showItemState($linkStatus, $item['status']);
    $groupACP       = Helper::showItemACP($linkGroupACP, $item['group_acp']);
    $created        = Helper::showItemHistory($item['created_by'], $item['created']);
    $modified       = Helper::showItemHistory($item['modified_by'], $item['modified']);
    $linkDelete     = URL::createLink($this->arrParam['module'], $this->arrParam['controller'], 'trash', ['id' => $item['id']]);
    $linkEdit       = URL::createLink($this->arrParam['module'], $this->arrParam['controller'], 'form', ['id' => $item['id']]);
    $buttonAction   = Html::createButtonAction(array('edit' => $linkEdit,'delete' => "javascript:trashSingle('$linkDelete')"));
    $xhtml .= '
    <tr>
        <td class="text-center">
            ' . $checkbox . '
        </td>
        <td class="text-center">' . $id . '</td>
        <td class="text-center">' . $name . '</td>
        <td class="text-center position-relative">' . $status . '</td>
        <td class="text-center position-relative groupACP-'.$id.'">' . $groupACP . '</td>
        <td class="text-center">' . $created . '</td>
        <td class="text-center modified-'.$id.'">' . $modified . '</td>
        <td class="text-center">'.$buttonAction.'</td>
    </tr>
    ';
}
?>

<?php echo $message; ?>
<!-- Search & Filter -->
<?php require_once 'elements/search-filter.php' ?>

<!-- List -->
<?php require_once 'elements/list.php' ?>
