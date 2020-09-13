<?php
$result             = ($this->arrParam)['form'];

// Create Status
$arrStatus         = array('default' => '--choose select--', 'active' => 'Active', 'inactive' => 'Inactive');
$status            = Helper::creatStatus('form[status]', 'custom-select custom-select-sm', $arrStatus, $result['status']);

// Create group_name
$arrSelect          = ($this->selectCreate);
$selectACP          = Html::creatStatusNumber('form[group_id]', 'custom-select custom-select-sm', $arrSelect, $result["group_id"]);

// create (Save-close)
$linkSave          = URL::createLink('backend', 'account', 'index', array('type' => 'save'));
$save              = Html::cmsButtonSave('Save', 'btn-success', $linkSave, 'submit');

$linkCancel        = URL::createLink('backend', 'dashboard', 'index');
$cancel            = Html::cmsButtonSave('Cancel', 'btn-danger', $linkCancel);

// create (input)
$inputEmail         = Html::cmsInput('form[email]', 'email', '', $result['email']);
$inputPass          = Html::cmsInput('form[password]', 'password', '', $result['password']);
$inputOrdering      = Html::cmsInput('form[ordering]', 'number', '', $result['ordering']);

// create div
$emailDiv           = Html::cmsDiv('email', $inputEmail,true);
$passwordDiv        = Html::cmsDiv('password', $inputPass,true);
$orderingDiv        = Html::cmsDiv('ordering', $inputOrdering,true);
$statusDiv          = Html::cmsDiv('status', $status,true);
$group_nameDiv      = Html::cmsDiv('group_id', $selectACP,true);
$inputID            = Html::cmsInput('form[id]', 'text', 'readonly', $result['id']);
$idDiv              = Html::cmsDiv('ID', $inputID);
$inputName          = Html::cmsInput('form[username]', 'text', 'readonly', $result['username']);
$nameDiv            = Html::cmsDiv('username', $inputName, true);

$div = $nameDiv  . $emailDiv . $orderingDiv . $statusDiv . $group_nameDiv;

echo $this->errors;


?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Show error -->
        <div class="card card-info card-outline">
            <div class="card-body">
                <form action="#" method="post" class="mb-0" id="form" name="form">
                    <?php echo $div . $idDiv; ?>
                    <input type="hidden" id="form[token]" name="form[token]" value="1596364518">
                </form>
            </div>
            <div class="card-footer">
                <div class="col-12 col-sm-8 offset-sm-2">
                    <?php echo $save . $saveClose . $saveNew . $cancel; ?>
                </div>
            </div>
        </div>
</section>