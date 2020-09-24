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

$inputHidden            = $inputHiddenModule . $inputHiddenController . $inputHiddenAction . $inputHiddenNamePost . $inputHiddennamePostDir;

// Select Search
$arrStatus          = array('default' => '--Select--', 0 => 'Đơn hàng mới', 1 => 'Đang xử lí', 2 => 'Hoàn tất');
$status             = Form::cmsSelectbox('status', 'btn btn-sm btn-warning', $arrStatus, $this->arrParam["status"], 'width: unset', "status");

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
                <?php echo $status; ?>
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