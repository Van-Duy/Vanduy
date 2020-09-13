<?php

Session::init();
$result             = ($this->arrParam)['form'];
// Create Status

$arrStatus         = array('default' => '--choose select--', 'active' => 'Active', 'inactive' => 'Inactive');
$status            = Helper::creatStatus('form[status]', 'custom-select custom-select-sm', $arrStatus, $result['status']);

// Create Group_acp
$arrGroupAcp    = array('default' => '- Fill_Acp -', 1 => 'Yes', 0 => 'No');
$groupAcp       = Html::creatStatusNumber('form[group_acp]', 'custom-select custom-select-sm', $arrGroupAcp, $result['group_acp']);

// create (Save-close)
$linkSave          = URL::createLink('backend', 'group', 'form', array('type' => 'save'));
$save              = Html::cmsButtonSave('Save', 'btn-success', $linkSave, 'submit');

$linkSaveClose     = URL::createLink('backend', 'group', 'form', array('type' => 'save-close'));
$saveClose         = Html::cmsButtonSave('Save &amp; Close', 'btn-success', $linkSaveClose, 'submit');

$linkSaveNew       = URL::createLink('backend', 'group', 'form', array('type' => 'save-new'));
$saveNew           = Html::cmsButtonSave('Save &amp; New', 'btn-success', $linkSaveNew, 'submit');

$linkCancel        = URL::createLink('backend', 'group', 'index');
$cancel            = Html::cmsButtonSave('Cancel', 'btn-danger', $linkCancel);


// create (input)
$inputName          = Html::cmsInput('form[name]', 'text', '', $result['name']);
$inputOrdering      = Html::cmsInput('form[ordering]', 'number', '', $result['ordering']);

// create div
$nameDiv            = Html::cmsDiv('name', $inputName, true);
$orderingDiv        = Html::cmsDiv('ordering', $inputOrdering, true);
$statusDiv          = Html::cmsDiv('status', $status, true);
$group_acpDiv       = Html::cmsDiv('group Acp', $groupAcp, true);

if (!empty($result['id'])) {
    $inputID        = Html::cmsInput('form[id]', 'text', 'readonly', $result['id']);
    $idDiv          = Html::cmsDiv('ID', $inputID);
}
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
                    <?php echo $nameDiv . $orderingDiv . $statusDiv . $group_acpDiv . $idDiv; ?>
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