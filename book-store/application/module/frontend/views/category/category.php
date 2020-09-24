<?php 
$nameBook   = HtmlFront::createNameLogin('Tất cả danh mục category');
$html       = '';
if(isset($this->categoryList)){
    foreach($this->categoryList AS $value){
        $id                 = $value['id'];
        $name               = HtmlFront::formatTitle($value['name'],40);
        $nameURL            = URL::filterURL($name);
        $img                = Html::createImageSrc($value['picture'], $value['picture'], 'category', '252x323-');
        $link               = URL::createLink($module, $controller, 'list', ['list' => $list, 'id' => $id], "$nameURL-$id.html");
        $html               .= sprintf('<div class="product-box">
                                        <div class="img-wrapper">
                                            <div class="front">
                                                <a href="%s"><img src="%s" class="img-fluid blur-up lazyload bg-img" alt="%s"></a>
                                            </div>
                                        </div>
                                        <div class="product-detail">
                                            <a href="%s"><h4>%s</h4></a>
                                        </div>
                                    </div>',$link,$img,$name,$link,$name);
        
    }
}

?>

<?php echo $nameBook ?>
    <section class="ratio_asos j-box pets-box section-b-space" id="category">
        <div class="container">
            <div class="no-slider five-product row">
                <?php echo $html ?>
            </div>
        </div>
    </section>