<?php
require_once 'sidebar/sidebar.php';
require_once 'sidebar/modal.php';
// show sách
$html  = "";
if (!empty($this->Items)) {
    $html       = HtmlFront::createproductForList($this->Items, $this->arrParam['module'], $this->arrParam['controller']);
    $pagination = $this->pagination->showPaginationFront($linkpagination);
    $count      = HtmlFront::createPaginationCount($this->pagination->totalItemsPerPage, $this->pagination->totalItems, $this->pagination->currentPage);
} else {
    $count  = 'Đang cập nhật ...';
}

// sort
$arrSort    = array('default' => ' - Sắp xếp - ', 'price_asc' => 'Giá tăng dần', 'price_desc' => 'Giá giảm dần', 'latest' => 'Mới nhất');
$htmlSort   = HtmlFront::sort('sort', 'sort', $arrSort);

?>

<div class="collection-content col">
    <div class="page-main-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="collection-product-wrapper">
                    <div class="product-top-filter">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="filter-main-btn">
                                    <span class="filter-btn btn btn-theme"><i class="fa fa-filter" aria-hidden="true"></i> Filter</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="product-filter-content">
                                    <?php echo HtmlFront::createCollection($this->_dirImg); ?>
                                    <?php echo $htmlSort ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-wrapper-grid" id="my-product-list">
                        <div class="row margin-res">
                            <?php echo $html; ?>
                        </div>
                    </div>
                    <div class="product-pagination">
                        <div class="theme-paggination-block">
                            <div class="container-fluid p-0">
                                <div class="row">
                                    <div class="col-xl-6 col-md-6 col-sm-12">
                                        <?php echo $pagination; ?>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-sm-12">
                                        <?php echo $count ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</section>