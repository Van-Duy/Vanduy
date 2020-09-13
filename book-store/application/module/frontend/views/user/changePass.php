<?php
require_once 'element/sideBarHistory.php';

$nameHistory            = HtmlFront::createNameLogin('Thay đổi mật khẩu');
$PassOldDiv             = HtmlFront::createFormGroup('Mật khẩu củ', 'passWordOld','','');
$PassNewDiv             = HtmlFront::createFormGroup('Mật khẩu Mới', 'passWordNew','','');
$PassNewReDiv           = HtmlFront::createFormGroup('Nhập lại mật khẩu', 'passWordNewRe','','');

$xhtml = $PassOldDiv . $PassNewDiv . $PassNewReDiv;
?>
<?php echo $nameHistory; ?>
<section class="faq-section section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="account-sidebar">
                    <a class="popup-btn">Menu</a>
                </div>
                <h3 class="d-lg-none">Thay đổi mật khẩu</h3>
                <?php echo $htmlSideBar; ?>
            </div>
            <div class="col-lg-9">
                <div class="dashboard-right">
                    <div class="dashboard">
                        <form action="" method="post" id="admin-form" class="theme-form">
                            <?php echo $xhtml; ?>
                            <input type="hidden" id="form[token]" name="form[token]" value="1599258345">
                            <button type="submit" id="submit" name="submit" value="Cập nhật thông tin" class="btn btn-solid btn-sm">Thay đổi mật khẩu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>