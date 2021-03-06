<?php
// show Top - Category
if (!empty($this->topCategory)) {
    $x = 0;
    foreach ($this->topCategory as $value) {
        $id         = $value['id'];
        $name       = $value['name'];
        $topHtml   .= HtmlFront::createCategoryTitle($id, $name, $x);
        $x++;
    }
}
// show  Top - Category - Items
$htmlItems = "";

if (!empty($this->topCategoryItems)) {
    $x = 0;
    foreach ($this->topCategoryItems as $key => $value) {
        $active = "";
        if ($x == 0) $active = 'active default';
        $linkAllList    = URL::createLink($this->arrParam['module'], 'category', 'index', array('list' => $key),"$nameURL-$key.html");
        $htmlItems      .= '<div id="tab-category-' . $key . '" class="tab-content ' . $active . '">
                             <div class="no-slider row tab-content-inside">';
        $htmlItems  .= HtmlFront::createproductBox($value,$this->arrParam['module'],$this->arrParam['controller']);
        $x++;
        $htmlItems .= '</div><div class="text-center"><a href="' . $linkAllList . '" class="btn btn-solid">Xem tất cả</a></div></div>';
    }
}

?>
<div class="title1 section-t-space title5">
    <h2 class="title-inner1">Danh mục nổi bật</h2>
    <hr role="tournament6">
</div>
<section class="p-t-0 j-box ratio_asos">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="theme-tab">
                    <ul class="tabs tab-title">
                        <?php echo  $topHtml; ?>
                    </ul>
                    <div class="tab-content-cls">
                        <?php echo  $htmlItems; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>