<?php
require_once 'element/sideBarHistory.php';

$nameHistory        = HtmlFront::createNameLogin('Thông tin tài khoản');

if (isset($this->user)) {
    $id                 = $this->user['id'];
    $email              = $this->user['email'];
    $fullname           = $this->user['fullname'];
    $address            = $this->user['address'];
    $phone              = $this->user['phone'];

    $emailDiv           = HtmlFront::createFormGroup('Email', 'email', $email, $id);
    $fullnameDiv        = HtmlFront::createFormGroup('Họ Tên', 'fullname', $fullname, $id);
    $addressDiv         = HtmlFront::createFormGroup('Địa chỉ', 'address', $address, $id);
    $phoneDiv           = HtmlFront::createFormGroup('Số điện thoại', 'phone', $phone, $id);
}

$xhtml = $emailDiv . $fullnameDiv . $phoneDiv . $addressDiv;
?>
<?php echo $nameHistory; ?>
<section class="faq-section section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="account-sidebar">
                    <a class="popup-btn">Menu</a>
                </div>
                <h3 class="d-lg-none">Tài khoản</h3>
                <?php echo $htmlSideBar; ?>
            </div>
            <div class="col-lg-9">
                <div class="dashboard-right">
                    <div class="dashboard">
                        <form action="" method="post" id="admin-form" class="theme-form">
                            <?php echo $xhtml; ?>
                            <input type="hidden" id="form[token]" name="form[token]" value="1599258345">
                            <button type="submit" id="submit" name="submit" value="Cập nhật thông tin" class="btn btn-solid btn-sm">Cập nhật thông tin</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>