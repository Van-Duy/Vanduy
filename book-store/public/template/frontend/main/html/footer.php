<?php
$content        = HtmlFront::createTitleForFooter('BookStore', 'Tự hào là website bán sách trực tuyến lớn nhất Việt Nam, cung cấp đầy đủ các thể loại sách, đặc biệt với những đầu sách độc quyền trong nước và quốc tế');
$phoneRing      = HtmlFront::createPhonering('036313681');

//Danh mục nổi bật
$model          = new Model();
$query          = "SELECT `id`,`name` FROM " . TBL_CATEGORY . " WHERE `status` = 'active' AND `showHome` = 'active' ORDER BY `ordering` ASC LIMIT 0,3";
$result         = $model->fetchAll($query);
$arrTopCategory = [];
foreach ($result as $value) {
    $id         = $value['id'];
    $name       = $value['name'];
    $nameURL    = URL::filterURL($name);
    $link       = URL::createLink($this->arrParam['module'], 'category', 'index', array('list' => $key), "$nameURL-$id.html");
    $arrTopCategory[$link]   =  $name;
}
$topCategory    = HtmlFront::createlistForFooter('Danh mục nổi bật', $arrTopCategory);

// Chính sách
$arrPolicy  = array('#1' => 'Điều khoản sử dụng', '#2' => 'Chính sách bảo mật', '#3' => 'Hợp tác phát hành', '#4' => 'Phương thức vận chuyển');
$Policy     = HtmlFront::createlistForFooter('Chính sách', $arrPolicy);


?>

<!-- footer -->
<?php echo $phoneRing; ?>

<footer class="footer-light mt-5">
    <section class="section-b-space light-layout">
        <div class="container">
            <div class="row footer-theme partition-f">
                <?php echo $content; ?>
                <div class="col offset-xl-1">
                    <?php echo $topCategory; ?>
                </div>
                <div class="col">
                    <?php echo $Policy; ?>
                </div>
                <div class="col">
                    <div class="sub-title">
                        <div class="footer-title">
                            <h4>Thông tin</h4>
                        </div>
                        <div class="footer-contant">
                            <ul class="contact-list">
                                <li><i class="fa fa-phone"></i>Hotline 1: <a href="tel:0905744470">090 5744 470</a></li>
                                <li><i class="fa fa-phone"></i>Hotline 2: <a href="tel:0383308983">0383 308 983</a></li>
                                <li><i class="fa fa-envelope-o"></i>Email: <a href="mailto:training@zend.vn" class="text-lowercase">training@zend.vn</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="sub-footer">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-md-6 col-sm-12">
                    <div class="footer-end">
                        <p><i class="fa fa-copyright" aria-hidden="true"></i> 2020 ZendVN</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer> <!-- footer end -->

<!-- tap to top -->
<div class="tap-top top-cls">
    <div>
        <i class="fa fa-angle-double-up"></i>
    </div>
</div>
<!-- tap to top end -->