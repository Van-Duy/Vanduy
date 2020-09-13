<?php
if (isset($this->topProduct)) {
    $html = "";
    foreach ($this->topProduct as $key => $value) {
        $category_nameURL   = URL::filterURL($value['category_name']);
        $id                 = $value['id'];
        $list               = $value['category_id'];
        $name               = $value['name'];
        $nameURL            = URL::filterURL($name);
        $price              = $value['price'];
        $description        = $value['description'];
        $sale_off           = $value['sale_off'];
        $img                = Html::createImageSrc($value['picture'], $value['picture'], 'book', '252x323-', array('height' => 252, 'min-height' => 323));
        $link               = URL::createLink($this->arrParam['module'], 'category', 'list', ['list' => $list, 'id' => $id],"$category_nameURL/$nameURL-$list-$id.html");
        $html               .= HtmlFront::createproductBox($name, $sale_off, $link, $img, 4, $description, $price, $id);
    }
}




?>
<!-- Title-->
<div class="title1 section-t-space title5">
    <h2 class="title-inner1">Sản phẩm nổi bật</h2>
    <hr role="tournament6">
</div>


<!-- Product slider -->
<section class="section-b-space p-t-0 j-box ratio_asos">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="product-4 product-m no-arrow">
                    <?php echo  $html; ?>
                </div>
            </div>
        </div>
    </div>
</section>