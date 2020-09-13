<?php

echo '<pre>';
print_r($this);
echo '</pre>';
if (($this->iteams != null)) {
    foreach ($this->iteams as $value) {
        $nameCart   = $value['id'];
        $date       = date("H:i d/m/Y", strtotime($value['date']));
        $html .= '<div class="check" style="border: 2px solid black;margin-top: 50px;margin-bottom: 50px;padding: 21px;"><h1>Đơn hàng : ' . $nameCart . ' - Thời gian : ' . $date . '</h1>';

        $arrId          = json_decode($value['books']);
        $arrPrices      = json_decode($value['prices']);
        $arrQuantities  = json_decode($value['quantities']);
        $arrNames       = json_decode($value['names']);
        $arrPictures    = json_decode($value['pictures']);
        $sumPrice       = 0;
        $status         = ($value['status'] == 0) ? "Đang xét duyệt ..." : 'Chờ giao hàng ...';


        foreach ($arrId as $keyB => $valueB) {
            $linkProduct        = URL::createLink('fontend', 'category', 'list', ['id' => $valueB]);
            $img                = Html::createImage($arrPictures,$arrPictures[$keyB],'book','98x150-',array('max-width' => 200,'max-height' => 200));
            $name       = $arrNames[$keyB];
            $quantities = $arrQuantities[$keyB];
            $price      = number_format($arrPrices[$keyB]);
            $sum        = number_format($arrPrices[$keyB] * $quantities) . " VND ";
            $sumPrice  += ($arrPrices[$keyB] * $quantities);

            $html .= '<div class="col-md-3 cart-items">
                                    <div class="cart-header">
                                        <div class="cart-sec simpleCart_shelfItem">
                                            <div class="cart-item cyc">
                                                ' . $img . '
                                            </div>
                                            <div class="cart-item-info">
                                                <h3><a href="' . $linkProduct . '">' . $name . '</a><span>Tổng : ' . $sum . '</span></h3>
                                                <ul class="qty">
                                                    <li>
                                                        <p>Quantities : ' . $quantities . '</p>
                                                    </li>
                                                    <li>
                                                        <p>Price : ' . $price . '</p>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>';
        }
        $html .= '<div class="col-md-12"><h4 style="color:red">Thành Tiền : ' . number_format($sumPrice) . ' VND - Trạng thái đơn hàng : ' . $status . '</h4></div><div class="clearfix"></div></div>';
    }
}

//pagination

$linkPa             = URL::createLink('admin','group','index');
$panigationHTML     = $this->pagination->showPagination($linkPa);
$message             =  Html::showMassage();
$xhtml = '';
 // Create Status
 $status            = Helper::creatStatus('form[status]','custom-select custom-select-sm', $arrStatus ,$result['status']);

$searchValue = $this->arrParam['search'] ?? '';
foreach ($this->items as $item) {
    $checkbox       = Helper::showItemCheckbox($item['id']);
    $id             = Helper::highLight($item['id'], $searchValue);
    $id             = Helper::highLight($item['id'], $searchValue);
    $username       = Helper::highLight($item['username'], $searchValue);
    $id_username    = Helper::showItemIdUsername($id, $username);
    
    $arrStatus      = array('inactive'=>'Chưa Duyệt','active' => 'Đã duyệt' , 'success' => 'Đã Vận chuyển');
    $status      = Helper::showItemSelect('status',$arrStatus,$item['status'],$item['id']);


    $created        = Helper::showItemHistory($item['created_by'], $item['created']);
    $modified       = Helper::showItemHistory($item['modified_by'], $item['modified']);
    $linkDelete     = URL::createLink($this->arrParam['module'], $this->arrParam['controller'], 'trash', ['id' => $item['id']]);
    $buttonAction   = Html::createButtonAction(array('edit' => $linkEdit,'delete' => "javascript:trashSingle('$linkDelete')"));
    $xhtml .= '
    <tr>
        <td class="text-center">
            ' . $checkbox . '
        </td>
        <td class="text-center">' . $id_username . '</td>
        <td class="text-center position-relative">' . $status . '</td>
        <td class="text-center position-relative">' . $ordering . '</td>
        <td class="text-center">' . $created . '</td>
        <td class="text-center">' . $modified . '</td>
        <td class="text-center">'.$buttonAction.'</td>
    </tr>
    ';
}
?>
<?php echo $message  ?>
<!-- Search & Filter -->
<?php require_once 'elements/search-filter.php' ?>

<!-- List -->
<?php require_once 'elements/list.php' ?>