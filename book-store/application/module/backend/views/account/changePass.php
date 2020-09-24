<?php
$result             = ($this->arrParam)['form'];

// create (Save-close)
$linkSave          = URL::createLink('backend', 'account', 'changePass', array('type' => 'save'));
$save              = Html::cmsButtonSave('Save', 'btn-success', $linkSave, 'submit');

$linkCancel        = URL::createLink('backend', 'dashboard', 'index');
$cancel            = Html::cmsButtonSave('Cancel', 'btn-danger', $linkCancel);

// create (input)
$inputPass          = Html::cmsInput('form[passWordOld]', 'password', '', '');
$inputPassNew       = Html::cmsInput('form[passWordNew]', 'password', '', '');
$inputPassNewRe     = Html::cmsInput('form[passNewRe]', 'password', '', '');

// create div
$PassOldDiv         = Html::cmsDiv('Mật khẩu củ', $inputPass, true);
$PassNewDiv         = Html::cmsDiv('Mật khẩu Mới', $inputPassNew, true);
$PassNewReDiv       = Html::cmsDiv('Nhập lại mật khẩu', $inputPassNewRe, true);

$div =  $PassOldDiv . $PassNewDiv . $PassNewReDiv;

echo $this->errors;

?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Show error -->
        <?php echo $ErrorsValidate; ?>
        <div class="card card-info card-outline">
            <div class="card-body">
                <form action="#" method="post" class="mb-0" id="form" name="form">
                    <?php echo $div ; ?>
                    <input type="hidden" id="form[token]" name="form[token]" value="1596364518">
                </form>
            </div>
            <div class="card-footer">
                <div class="col-12 col-sm-8 offset-sm-2">
                    <?php echo $save . $cancel; ?>
                </div>
            </div>
        </div>
</section>