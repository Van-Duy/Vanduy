<?php
require_once 'sidebar/modal.php';
// show items
if (isset($this->listSingle)) {
    $value              = $this->listSingle;
    $nameBook           = HtmlFront::createNameLogin($value['name']);
    $id                 = $value['id'];
    $list               = $value['category_id'];
    $name               = $value['name'];
    $price              = $value['price'];
    $description        = $value['description'];
    $sale_off           = $value['sale_off'];
    $img                = Html::createImageSrc($value['picture'], $value['picture'], 'book', '252x323-');

    $html               .= HtmlFront::createListItem($name, $price, $sale_off, $description, $img,$id);
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
        $link               = URL::createLink($this->arrParam['module'], $this->arrParam['controller'], 'list', ['list' => $list,'id' => $id]);

        $htmlTopProduct    .= HtmlFront::createproductTop($name, $sale_off,$link,$img, 4, $description, $price);
        $count++;
        if ($count == 4) $htmlTopProduct .= '</div><div>';
    }
    $htmlTopProduct .= "</div>";
}

//show sách mới
$htmlNewProduct = "";
if (isset($this->NewItems)) {
    $htmlNewProduct .= "<div>";
    $count          = 0;
    foreach ($this->NewItems as $value) {
        $id                 = $value['id'];
        $list               = $value['category_id'];
        $name               = $value['name'];
        $price              = $value['price'];
        $description        = $value['description'];
        $sale_off           = $value['sale_off'];
        $img                = Html::createImageSrc($value['picture'], $value['picture'], 'book', '252x323-');
        $link               = URL::createLink($this->arrParam['module'], $this->arrParam['controller'], 'list', ['list' => $list,'id' => $id]);
        $htmlNewProduct    .= HtmlFront::createproductTop($name, $sale_off,$link, $img, 4, $description, $price);
        $count++;
        if ($count == 3) $htmlNewProduct .= '</div><div>';
    }
    $htmlNewProduct .= "</div>";
}

//show sách liên quan
$htmlRelateProduct = "";
if (isset($this->relateBook)) {
    foreach ($this->relateBook as $value) {
        $id                 = $value['id'];
        $list               = $value['category_id'];
        $name               = $value['name'];
        $price              = $value['price'];
        $description        = $value['description'];
        $sale_off           = $value['sale_off'];
        $img                = Html::createImageSrc($value['picture'], $value['picture'], 'book', '252x323-');
        $link               = URL::createLink($this->arrParam['module'], $this->arrParam['controller'], 'list', ['list' => $list,'id' => $id]);
        $htmlRelateProduct    .= HtmlFront::createproductRelate($name, $sale_off,$link, $img, 4, $description, $price,$id);
        $count++;
    }
}

?>

<?php echo $nameBook ?>
<section class="section-b-space">
    <div class="collection-wrapper">
        <div class="container">
            <div class="row">
                <?php echo $html ?>
                <div class="col-sm-3 collection-filter">
                    <div class="collection-filter-block">
                        <div class="collection-mobile-back">
                            <span class="filter-back"><i class="fa fa-angle-left" aria-hidden="true"></i> back</span>
                        </div>
                        <?php require_once 'sidebar/serviceList.php' ?>
                    </div>

                    <div class="theme-card">
                        <h5 class="title-border">Sách nổi bật</h5>
                        <div class="offer-slider slide-1">
                            <?php echo $htmlTopProduct; ?>
                        </div>
                    </div>

                    <div class="theme-card mt-4">
                        <h5 class="title-border">Sách mới</h5>
                        <div class="offer-slider slide-1">
                            <?php echo $htmlNewProduct; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <section class="section-b-space j-box ratio_asos pb-0">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 product-related">
                                <h2>Sản phẩm liên quan</h2>
                            </div>
                        </div>
                        <div class="row search-product">
                            <?php echo $htmlRelateProduct ?>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>