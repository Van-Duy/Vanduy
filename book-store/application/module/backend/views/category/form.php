<?php

Session::init();
$result             = ($this->arrParam)['form'];
// Create Status
$arrStatus         = array('default' => '--choose select--', 'active' => 'Active', 'inactive' => 'Inactive');
$status            = Helper::creatStatus('form[status]', 'custom-select custom-select-sm', $arrStatus, $result['status']);

// ShowHome
$arrShowHome      = array('default' => '--choose select--', 'active' => 'Active', 'inactive' => 'Inactive');
$showHome         = Helper::creatStatus('form[showHome]', 'custom-select custom-select-sm', $arrShowHome, $result['showHome']);

// create (Save-close)
$linkSave          = URL::createLink('backend', 'category', 'form', array('type' => 'save'));
$save              = Html::cmsButtonSave('Save', 'btn-success', $linkSave, 'submit');

$linkSaveClose     = URL::createLink('backend', 'category', 'form', array('type' => 'save-close'));
$saveClose         = Html::cmsButtonSave('Save &amp; Close', 'btn-success', $linkSaveClose, 'submit');

$linkSaveNew       = URL::createLink('backend', 'category', 'form', array('type' => 'save-new'));
$saveNew           = Html::cmsButtonSave('Save &amp; New', 'btn-success', $linkSaveNew, 'submit');

$linkCancel        = URL::createLink('backend', 'category', 'index');
$cancel            = Html::cmsButtonSave('Cancel', 'btn-danger', $linkCancel);

// create (input)
$inputName          = Html::cmsInput('form[name]', 'text', '', $result['name']);
$inputPicture       = Html::cmsInput('picture', 'file', '', $result['picture']);
$inputOrdering      = Html::cmsInput('form[ordering]', 'number', '', $result['ordering']);

// create div
$nameDiv            = Html::cmsDiv('name', $inputName, true);
$pictureDiv         = Html::cmsDiv('picture', $inputPicture);
$orderingDiv        = Html::cmsDiv('ordering', $inputOrdering,true);
$statusDiv          = Html::cmsDiv('status', $status,true);
$showHomeDiv        = Html::cmsDiv('showHome', $showHome,true);

if (!empty($result['id'])) {
    $inputID        = Html::cmsInput('form[id]', 'text', 'readonly', $result['id']);
    $idDiv          = Html::cmsDiv('ID', $inputID);

    $img            = Html::createImage($result['picture'],$result['picture'],'category','',['max-width' => 200,'max-hight' => 200]);
    $imgDiv         = Html::cmsDiv('Image', $img);
    $inputPictureHidden = Html::cmsInput('form[picture_hidden]', 'hidden', '', $result['picture']);
}

echo $this->errors;


?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Show error -->
        <div class="card card-info card-outline">
            <div class="card-body">
                <form action="#" method="post" class="mb-0" id="form" name="form" enctype="multipart/form-data">
                    <?php echo $nameDiv . $imgDiv . $pictureDiv . $orderingDiv . $statusDiv . $showHomeDiv . $idDiv . $inputPictureHidden; ?>
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