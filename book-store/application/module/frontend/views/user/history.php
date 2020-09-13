<?php
require_once 'element/sideBarHistory.php';
$nameHistory        = HtmlFront::createNameLogin('Lịch sử mua hàng');
$html = "";
if (($this->iteams != null)) {
    foreach ($this->iteams as $value) {
        $nameCart   = $value['id'];
        $date       = date("H:i d/m/Y", strtotime($value['date']));
        $html .= '<div class="card">
                <div class="card-header"><h5 class="mb-0"><button style="text-transform: none;" class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#' . $nameCart . '">Mã đơn hàng: ' . $nameCart . '</button>&nbsp;&nbsp;Thời gian: ' . $date . '</h5></div>
                <div id="' . $nameCart . '" class="collapse" data-parent="#accordionExample">
                <div class="card-body table-responsive">
                    <table class="table btn-table">
                        <thead>
                            <tr>
                                <td>Hình ảnh</td>
                                <td>Tên sách</td>
                                <td>Giá</td>
                                <td>Số lượng</td>
                                <td>Thành tiền</td>
                            </tr>
                        </thead>';

        $arrId          = json_decode($value['books']);
        $arrPrices      = json_decode($value['prices']);
        $arrQuantities  = json_decode($value['quantities']);
        $arrNames       = json_decode($value['names']);
        $arrPictures    = json_decode($value['pictures']);
        $sumPrice       = 0;


        foreach ($arrId as $keyB => $valueB) {
            $linkProduct        = URL::createLink('frontend', 'category', 'list', ['id' => $valueB]);
            $src                = Html::createImageSrc($arrPictures, $arrPictures[$keyB], 'book', '252x323-');;
            $name               = $arrNames[$keyB];
            $quantities         = $arrQuantities[$keyB];
            $price              = number_format($arrPrices[$keyB] * 1000) . " đ";
            $sum                = number_format($arrPrices[$keyB] * $quantities * 1000) . " đ";
            $sumPrice           += ($arrPrices[$keyB] * $quantities * 1000);

            $html .= '  <tr>
                            <td><a href="' . $linkProduct . '"><img src="' . $src . '" alt="' . $name . '" style="width: 80px"></a></td>
                            <td style="min-width: 200px">' . $name . '</td>
                            <td style="min-width: 100px">' . $price . '</td>
                            <td>' . $quantities . '</td>
                            <td style="min-width: 150px">' . $sum . '</td>
                        </tr>';
        }
        $html .= '<tr></tr></tbody><tfoot><tr class="my-text-primary font-weight-bold"><td colspan="4" class="text-right">Tổng: </td><td>' . number_format($sumPrice) . ' đ</td></tr></tfoot></table></div></div></div>';
    }
}
?>
<?php echo $nameHistory; ?>

<section class="faq-section section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="account-sidebar"><a class="popup-btn">Menu</a></div>
                <h3 class="d-lg-none">Lịch sử mua hàng</h3>
                <?php echo $htmlSideBar; ?>
            </div>
            <div class="col-lg-9">
                <div class="accordion theme-accordion" id="accordionExample">
                    <div class="accordion theme-accordion" id="accordionExample">
                        <?php echo $html; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>