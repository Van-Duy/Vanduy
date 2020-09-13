<?php
// Khai báo
$module         = $this->arrParam['module'];
$controller     = $this->arrParam['controller'];
$action         = $this->arrParam['action'];

//input hidden
$inputHiddenModule      = Html::inputHidden('module',$this->arrParam['module']);
$inputHiddenController  = Html::inputHidden('controller',$this->arrParam['controller']);
$inputHiddenAction      = Html::inputHidden('action',$this->arrParam['action']);
$inputHiddenFage        = Html::inputHidden('filter_page',1);
$inputHiddenStatus      = Html::inputHidden('statusSearch',$this->arrParam['statusSearch']);
$inputHiddenNamePost    = Html::inputHidden('namePost',$this->arrParam['namePost']);
$inputHiddennamePostDir = Html::inputHidden('namePostDir',$this->arrParam['namePostDir']);

$inputHidden = $inputHiddenModule .$inputHiddenStatus. $inputHiddenController . $inputHiddenAction . $inputHiddenFage .$inputHiddenNamePost . $inputHiddennamePostDir;

// Select Search
$arrSelect      = ($this->selectCreate);
$selectACP      = Form::cmsSelectbox('filter_group_name', 'mr-1 btn btn-sm btn-default', $arrSelect, $this->arrParam["filter_group_name"], '', "filter_group_name");


// Select ALL
$getStatus      = ($this->arrParam["statusSearch"] == null) ? 'All' : $this->arrParam["statusSearch"];
$arrAll         = array('All' => $this->itemsActive['total'] + $this->itemsInactive['total'], 'Active' =>  $this->itemsActive['total'], 'Inactive' => $this->itemsInactive['total']);
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
            <div class="row justify-content-between">
                <div class="mb-1">
                    <?php echo $FillterButton; ?>
                </div>
                <div class="mb-1">
                    <?php echo $selectACP; ?>
                    <?php echo $inputHidden; ?>
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
        </form>
    </div>
</div>
</div>