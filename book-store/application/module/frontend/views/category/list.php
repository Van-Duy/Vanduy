<?php
require_once 'sidebar/modal.php';
// show items
if (isset($this->listSingle)) {
    $nameBook       = HtmlFront::createNameLogin($this->listSingle['name']);
    $html           = HtmlFront::createListItem($this->listSingle,$this->arrParam['module'],$this->arrParam['controller']);
}
//show sách nổi bật
$htmlTopProduct = "";
if (isset($this->TopItems)) {
    $htmlTopProduct   = HtmlFront::createproductTop($this->TopItems,$this->arrParam['module'],$this->arrParam['controller']);
}

//show sách mới
$htmlNewProduct = "";
if (isset($this->NewItems)) {
    $htmlNewProduct = HtmlFront::createproductTop($this->NewItems,$this->arrParam['module'],$this->arrParam['controller']);
}

//show sách liên quan
if (isset($this->relateBook)) {
    $htmlRelateProduct = HtmlFront::createproductRelate($this->relateBook,$this->arrParam['module'],$this->arrParam['controller']);
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