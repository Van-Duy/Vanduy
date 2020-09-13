<?php
$result             = ($this->arrParam)['form'];

// create (Save-close)
$linkSave          = URL::createLink('backend', 'account', 'changePass', array('type' => 'save'));
$save              = Html::cmsButtonSave('Save', 'btn-success', $linkSave, 'submit');

$linkCancel        = URL::createLink('backend', 'dashboard', 'index');
$cancel            = Html::cmsButtonSave('Cancel', 'btn-danger', $linkCancel);

// create (input)
$inputName          = Html::cmsInput('form[username]', 'text', 'readonly', $result['username']);
$inputPass          = Html::cmsInput('form[password]', 'text', '', $result['password']);

// create div
$nameDiv            = Html::cmsDiv('username', $inputName);
$passwordDiv        = Html::cmsDiv('password', $inputPass, true);
$inputID            = Html::cmsInput('form[id]', 'text', 'readonly', $result['id']);
$idDiv              = Html::cmsDiv('ID', $inputID);

$div = $nameDiv  . $passwordDiv;

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
                    <?php echo $div . $idDiv; ?>
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