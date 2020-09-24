<?php
$result             = ($this->arrParam)['form'];

// Create Status
$arrStatus         = array('default' => '--choose select--', 'active' => 'Active', 'inactive' => 'Inactive');
$status            = Helper::creatStatus('form[status]', 'custom-select custom-select-sm', $arrStatus, $result['status']);

// Create category_name
$arrSelect          = ($this->selectCreate);
$selectCa           = Html::creatStatusNumber('form[category_id]', 'custom-select custom-select-sm', $arrSelect, $result["category_id"]);

// Create special
$arrSpecial         = array('default' => '--Search special--', 1 => 'yes', 0 => 'no');
$special            = Html::creatStatusNumber('form[special]', 'custom-select custom-select-sm', $arrSpecial, $result['special']);

// create (Save-close)
$linkSave          = URL::createLink('backend', 'book', 'form', array('type' => 'save'));
$save              = Html::cmsButtonSave('Save', 'btn-success', $linkSave, 'submit');

$linkSaveClose     = URL::createLink('backend', 'book', 'form', array('type' => 'save-close'));
$saveClose         = Html::cmsButtonSave('Save &amp; Close', 'btn-success', $linkSaveClose, 'submit');

$linkSaveNew       = URL::createLink('backend', 'book', 'form', array('type' => 'save-new'));
$saveNew           = Html::cmsButtonSave('Save &amp; New', 'btn-success', $linkSaveNew, 'submit');

$linkCancel        = URL::createLink('backend', 'book', 'index');
$cancel            = Html::cmsButtonSave('Cancel', 'btn-danger', $linkCancel);

// create (input)
$inputName          = Html::cmsInput('form[name]', 'text', '', $result['name']);
$inputPicture       = Html::cmsInput('picture', 'file', '', $result['picture']);
$priceName          = Html::cmsInput('form[price]', 'text', '', $result['price']);
$sale_offName       = Html::cmsInput('form[sale_off]', 'text', '', $result['sale_off']);
$inputOrdering      = Html::cmsInput('form[ordering]', 'number', '', $result['ordering']);
$decriptionG        = '<textarea style="width: inherit;" name="form[description]" cols="5" rows="2">' . $result['description'] . '</textarea>';
$decriptionMain     = '<textarea name="form[description_main]" id="editor" style="width: inherit;" rows="10" cols="80">' . $result['description_main'] . '</textarea>';

// create div
$nameDiv            = Html::cmsDiv('book-name', $inputName, true);
$pictureDiv         = Html::cmsDiv('picture', $inputPicture);
$priceDiv           = Html::cmsDiv('price', $priceName, true);
$sale_offDiv        = Html::cmsDiv('sale_off', $sale_offName, true);
$orderingDiv        = Html::cmsDiv('ordering', $inputOrdering, true);
$statusDiv          = Html::cmsDiv('status', $status, true);
$specialDiv         = Html::cmsDiv('special', $special, true);
$category_nameDiv   = Html::cmsDiv('category_id', $selectCa, true);
$desription         = Html::cmsDiv('content', $decriptionG);
$desription_main    = Html::cmsDiv('description_main', $decriptionMain);



if (!empty($result['id'])) {
    $inputID        = Html::cmsInput('form[id]', 'text', 'readonly', $result['id']);
    $idDiv          = Html::cmsDiv('ID', $inputID);

    $img            = Html::createImage($result['picture'], $result['picture'], 'book', '', ['max-width' => 200, 'max-hight' => 200]);
    $imgDiv         = Html::cmsDiv('Image', $img);
    $inputPictureHidden = Html::cmsInput('form[picture_hidden]', 'hidden', '', $result['picture']);
}

$div = $nameDiv . $imgDiv . $inputPictureHidden . $pictureDiv . $priceDiv . $sale_offDiv . $orderingDiv . $statusDiv . $specialDiv  . $category_nameDiv . $desription . $desription_main;

echo $this->errors;

?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Show error -->
        <?php echo  $ErrorsValidate ?>
        <div class="card card-info card-outline">
            <div class="card-body">
                <form action="#" method="post" class="mb-0" id="form" name="form" enctype="multipart/form-data">
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



    
    

