<?php
$xhtml = '';

// create (Save-close)
$linkCancel        = URL::createLink('backend', 'cart', 'index');
$cancel            = Html::cmsButtonSave('Cancel', 'btn-danger', $linkCancel);


if (!empty($this->item)) {
    $item               = $this->item;
    $username           = $item['username'];
    $date               = $item['date'];
    $arrId              = json_decode($item['books']);
    $arrPrices          = json_decode($item['prices']);
    $arrQuantities      = json_decode($item['quantities']);
    $arrNames           = json_decode($item['names']);
    $arrPictures        = json_decode($item['pictures']);
    $sumPrice           = 0;

    foreach ($arrId as $keyB => $valueB) {
        $linkProduct        = URL::createLink('frontend', 'category', 'list', ['id' => $valueB]);
        $src                = Html::createImageSrc($arrPictures, $arrPictures[$keyB], 'book', '252x323-');
        $img                = Html::createImage($item['picture'], $item['picture'], 'book', '252x323-', array('width' => 90, 'height' => 90));
        $name               = $arrNames[$keyB];
        $quantities         = $arrQuantities[$keyB];
        $price              = number_format($arrPrices[$keyB] * 1000) . " đ";
        $sum                = number_format($arrPrices[$keyB] * $quantities * 1000) . " đ";
        $sumPrice           += ($arrPrices[$keyB] * $quantities * 1000);

        $xhtml .= '
                        <tr>
                            <td class="text-center">' . $name . '</td>
                            <td class="text-center"><a href="' . $linkProduct . '"><img src="' . $src . '" alt="' . $name . '" style="width: 80px"></a></td>
                            <td class="text-center text-wrap" style="min-width: 180px">' . $quantities . '</td>
                            <td class="text-center">' . $sum . '</td>
                        </tr>
            ';
    }
    $xhtml .= ' <td colspan="4" class="text-right"> Tổng : ' . number_format($sumPrice) . ' đ</td>';
}
?>
<div class="card card-info card-outline">
    <div class="card-header">
        <h4 class="card-title" style="color : red"><?php echo ' Khách hàng : ' . $username . ' || Ngày đặt hàng : ' . $date ?></h4>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fas fa-minus"></i></button>
        </div>
    </div>
    <div class="card-body">
        <!-- Control -->
        <!-- List Content -->
        <table class="table table-bordered table-hover text-nowrap btn-table mb-0">
            <thead>
                <tr>
                    <th class="text-center">Tên sản phẩm</th>
                    <th class="text-center">Hình ảnh</th>
                    <th class="text-center">Số lượng</th>
                    <th class="text-center">Giá tiền</th>
                </tr>
            </thead>
            <tbody>
                <?= $xhtml; ?>
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <div class="col-12 col-sm-8 offset-sm-2">
            <?php echo $cancel; ?>
        </div>
    </div>
</div>