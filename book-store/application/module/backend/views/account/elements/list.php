<?php
$linkReload = URL::createLink($module, $controller, $action);
$linkAddNew = URL::createLink($module, $controller, 'form');

// Select Muti
$arrMuti  = array('default' => "--Bulk Action--", "multi-active" => "Multi Active", 'multi-inactive' => 'Multi Inactive', 'multi-delete' => 'Multi Delete');
$Muti     = Helper::creatStatus('bulk-action', 'custom-select custom-select-sm mr-1', $arrMuti, $this->arrParam["bulk-action"], 'width: unset', "bulk-action");

// Colum
$ID             = Html::creatFill('ID', 'ID', $this->arrParam['namePost'], $this->arrParam['namePostDir']);
$Name           = Html::creatFill('Username', 'username', $this->arrParam['namePost'], $this->arrParam['namePostDir']);
$Email          = Html::creatFill('Email', 'email', $this->arrParam['namePost'], $this->arrParam['namePostDir']);
$Status         = Html::creatFill('Status', 'status', $this->arrParam['namePost'], $this->arrParam['namePostDir']);
$Ordering       = Html::creatFill('Ordering', 'ordering', $this->arrParam['namePost'], $this->arrParam['namePostDir']);
$Group_name     = Html::creatFill('Group', 'group_name', $this->arrParam['namePost'], $this->arrParam['namePostDir']);
$Created        = Html::creatFill('Created', 'created', $this->arrParam['namePost'], $this->arrParam['namePostDir']);
$Modified       = Html::creatFill('Modified', 'modified', $this->arrParam['namePost'], $this->arrParam['namePostDir']);

$colum = $ID . $Name .  $Status .  $Group_name . $Ordering .  $Created .  $Modified;

?>
<div class="card card-info card-outline">
    <div class="card-header">
        <h4 class="card-title">List</h4>
        <div class="card-tools">
            <a href="<?php echo $linkReload; ?>" class="btn btn-tool"><i class="fas fa-sync"></i></a>
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fas fa-minus"></i></button>
        </div>
    </div>
    <div class="card-body">
        <!-- Control -->

        <div class="d-flex flex-wrap align-items-center justify-content-between mb-2">
            <div class="mb-1">
                <?php echo $Muti; ?>
                <button id="bulk-apply" class="btn btn-sm btn-info">Apply <span class="badge badge-pill badge-danger navbar-badge" style="display: none"></span></button>
            </div>
            <a href="<?php echo $linkAddNew; ?>" class="btn btn-sm btn-info"><i class="fas fa-plus"></i> Add New</a>
        </div>
        <!-- List Content -->
        <form action="" method="post" class="table-responsive" id="form-table">
            <table class="table table-bordered table-hover text-nowrap btn-table mb-0">
                <thead>
                    <tr>
                        <th class="text-center">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="check-all">
                                <label for="check-all" class="custom-control-label"></label>
                            </div>
                        </th>
                        <?php echo $colum; ?>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?= $xhtml; ?>
                </tbody>
            </table>
        </form>
    </div>
    <div class="card-footer clearfix">
        <ul class="pagination pagination-sm m-0 float-right">
            <?php echo $panigationHTML ?>
        </ul>
    </div>
</div>