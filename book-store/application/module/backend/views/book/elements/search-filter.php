<?php
// Khai báo
$module         = $this->arrParam['module'];
$controller     = $this->arrParam['controller'];
$action         = $this->arrParam['action'];

//input hidden
$inputHiddenModule      = Html::inputHidden('module', $this->arrParam['module']);
$inputHiddenController  = Html::inputHidden('controller', $this->arrParam['controller']);
$inputHiddenAction      = Html::inputHidden('action', $this->arrParam['action']);
$inputHiddenNamePost    = Html::inputHidden('sort_field', $this->arrParam['sort_field']);
$inputHiddennamePostDir = Html::inputHidden('sort_order', $this->arrParam['sort_order']);

$inputHidden = $inputHiddenModule . $inputHiddenController . $inputHiddenAction . $inputHiddenNamePost . $inputHiddennamePostDir;

// Select category_name'
$arrSelect              = ($this->selectCreate);
$selectcategory         = Form::cmsSelectbox('filter_category_name', 'mr-1 btn btn-sm btn-warning', $arrSelect, $this->arrParam["filter_category_name"], '', "filter_category_name");

// Select special
$arrSelectSpecial       = array('default' => "--Special--", 0 => "No", 1 => 'Yes');
$selectSpecial          = Form::cmsSelectbox('filter_special', 'mr-1 btn btn-sm btn-info', $arrSelectSpecial, $this->arrParam["filter_special"], '', "filter_special");

// Select ALL
$getStatus      = ($this->arrParam["statusSearch"] == null) ? 'all' : $this->arrParam["statusSearch"];
$arrAll         = array('all' => $this->itemsActive['total'] + $this->itemsInactive['total'], 'active' =>  $this->itemsActive['total'], 'inactive' => $this->itemsInactive['total']);
$FillterButton  = Html::showFillterButton($module, $controller, $arrAll, $getStatus);
?>

<div class="card card-info card-outline">
    <div class="card-header">
        <h6 class="card-title">Search & Filter</h6>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
        </div>
    </div>
    <div class="card-body">
        <form action="" method="GET" id='filter-bar'>
            <?php echo $inputHidden; ?>
        </form>
        <div class="row justify-content-between">
            <div class="mb-1">
                <?php echo $FillterButton; ?>
            </div>
            <div class="mb-1">
                <?php echo $selectcategory . $selectSpecial; ?>

            </div>
            <div class="mb-1">
                <div class="input-group">
                    <input type="text" class="form-control form-control-sm" name="search" value="<?= $searchValue ?>" style="min-width: 300px">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-sm btn-danger" id="btn-clear-search">Clear</button>
                        <button type="submit" class="btn btn-sm btn-info" id="btn-search">Search</button>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>