<?php
require_once LIBRARY_EXT_PATH . 'XML.php';
$nameBook = HtmlFront::createNameLogin('Tất cả sách');


//show category
$categories = XML::getContentXML('categories.xml');
// show category
if (isset($categories)) {
    $listCategory = "";
    foreach ($categories as $value) {
        $id                 = $value->id;
        $name               = $value->name;
        $nameURL            = URL::filterURL($name);
        $link               = URL::createLink($this->arrParam['module'], $this->arrParam['controller'], 'index', array('list' => $value->id),"$nameURL-$id.html");
        $listCategory      .= HtmlFront::createCategory( $name , $link,$id, $this->arrParam['list']);
    }
}


//show sách nổi bật
$htmlTopProduct = "";
if (isset($this->TopItems)) {
    $htmlTopProduct .= "<div>";
    $count          = 0;
    foreach ($this->TopItems as $value) {
        $id                 = $value['id'];
        $list               = $value['category_id'];
        $name               = $value['name'];
        $price              = $value['price'];
        $description        = $value['description'];
        $sale_off           = $value['sale_off'];
        $img                = Html::createImageSrc($value['picture'], $value['picture'], 'book', '252x323-');
        $link               = URL::createLink($this->arrParam['module'], $this->arrParam['controller'], 'list', ['list' => $list, 'id' => $id]);
        $htmlTopProduct    .= HtmlFront::createproductTop($name, $sale_off, $link, $img, 4, $description, $price);
        $count++;
        if ($count == 4) $htmlTopProduct .= '</div><div>';
    }
    $htmlTopProduct .= "</div>";
}



?>
<?php echo $nameBook; ?>
<section class="section-b-space j-box ratio_asos">
    <div class="collection-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 collection-filter">
                    <!-- side-bar colleps block stat -->
                    <div class="collection-filter-block">
                        <!-- brand filter start -->
                        <div class="collection-mobile-back"><span class="filter-back"><i class="fa fa-angle-left" aria-hidden="true"></i> back</span></div>
                        <div class="collection-collapse-block open">
                            <h3 class="collapse-block-title">Danh mục</h3>
                            <div class="collection-collapse-block-content">
                                <div class="collection-brand-filter">
                                    <?php echo $listCategory; ?>
                                    <div class="custom-control custom-checkbox collection-filter-checkbox pl-0 text-center">
                                        <span class="text-dark font-weight-bold" id="btn-view-more">Xem thêm</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="theme-card">
                        <h5 class="title-border">Sách nổi bật</h5>
                        <div class="offer-slider slide-1">
                            <?php echo $htmlTopProduct; ?>
                        </div>
                    </div>
                    <!-- silde-bar colleps block end here -->
                </div>