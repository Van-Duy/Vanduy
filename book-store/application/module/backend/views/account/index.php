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
$inputName          = Html::cmsInput('form[username]', 'text', 'readonly', $result['username']);
$inputFullName      = Html::cmsInput('form[fullname]', 'text', '', $result['fullname']);
$inputPhone         = Html::cmsInput('form[phone]', 'text', '', $result['phone']);
$inputAddress       = Html::cmsInput('form[address]', 'text', '', $result['address']);

// create div
$nameDiv            = Html::cmsDiv('username', $inputName,true);
$fullnameDiv        = Html::cmsDiv('Họ Tên', $inputFullName);
$phoneDiv           = Html::cmsDiv('Số điện thoại', $inputPhone);
$addressDiv         = Html::cmsDiv('Địa chỉ', $inputAddress);


$div = $nameDiv . $fullnameDiv . $phoneDiv . $addressDiv;

echo $this->errors;


?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Show error -->
        <div class="card card-info card-outline">
            <div class="card-body">
                <form action="#" method="post" class="mb-0" id="form" name="form">
                    <?php echo $div ; ?>
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