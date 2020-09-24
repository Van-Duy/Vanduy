<?php
require_once LIBRARY_EXT_PATH . 'XML.php';
$nameBook = HtmlFront::createNameLogin('Tất cả sách');
$idListBook  = $this->arrParam['list'];
//show category
$categories = XML::getContentXML('categories.xml');
if (!empty($idListBook)) {
    foreach ($categories as $value) {
        if ($idListBook == $value->id) {
            $nameBook = HtmlFront::createNameLogin($value->name);
            break;
        }
    }
}
// show category
if (isset($categories)) {
    $listCategory = "";
    foreach ($categories as $value) {
        $id                 = $value->id;
        $name               = $value->name;
        $nameURL            = URL::filterURL($name);
        $link               = URL::createLink($this->arrParam['module'], $this->arrParam['controller'], 'index', array('list' => $value->id), "$nameURL-$id.html");
        $listCategory      .= HtmlFront::createCategory($name, $link, $id, $this->arrParam['list']);
    }
}
//show sách nổi bật
if (isset($this->TopItems)) {
    $htmlTopProduct   = HtmlFront::createproductTop($this->TopItems, $this->arrParam['module'], $this->arrParam['controller']);
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