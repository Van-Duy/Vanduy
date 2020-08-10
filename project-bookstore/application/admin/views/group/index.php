<?php 
    Session::init();


    // Colum
    $ID             = Helper::creatFill('ID','ID',$this->arrParam['namePost'],$this->arrParam['namePostDir']);
    $Name           = Helper::creatFill('Name','name',$this->arrParam['namePost'],$this->arrParam['namePostDir']);
    $Status         = Helper::creatFill('Status','status',$this->arrParam['namePost'],$this->arrParam['namePostDir']);
    $Group_acp      = Helper::creatFill('Group_acp','group_acp',$this->arrParam['namePost'],$this->arrParam['namePostDir']);
    $Ordering       = Helper::creatFill('Ordering','ordering',$this->arrParam['namePost'],$this->arrParam['namePostDir']);
    $Created        = Helper::creatFill('Created','created',$this->arrParam['namePost'],$this->arrParam['namePostDir']);
    $Modified       = Helper::creatFill('Modified','modified',$this->arrParam['namePost'],$this->arrParam['namePostDir']);
    


    // Create All - Active - Inactive (ButtonHeader)
    $All            = Helper::cmsButtonHeader('All','default','15');
    $Active         = Helper::cmsButtonHeader('Active',1,'16');
    $Inactive       = Helper::cmsButtonHeader('Inactive',0,'17');

    // Create Search
    $arrSearch      = array('default'=>'Search by All','1' => 'Search by ID' , '2' => 'Search by Name');
    $search         = Helper::creatStatus('search-by','custom-select select-search-field',$arrSearch,$this->arrParam['search-by']);
    
    // Create click all
    $arrGroupAcp    = array('default'=>'- Fill_Acp -',1 => 'Yes' , 0 => 'No');
    $groupAcp       = Helper::creatStatus('filter_groupAcp','btn-default btn mr-1',$arrGroupAcp,$this->arrParam['filter_groupAcp']);
     // Create click (muty-delete,changeAllStatus)
    $arrMuty       = array('default'=>'- Choose value -', 1 => 'Change Active',0 => 'change Inactive',2 => 'muty-delete');
    $groupMuty     = Helper::creatStatus('muti-change','btn-default btn mr-1',$arrMuty,$this->arrParam['muti-change']);
    
    // Create status
    $arrStatus      = array(1=>'Active',0 => 'Inactive');
    
    // link
    $linkNew        = URL::creatLink('admin','group','form',array('type' => 'add'));
    $linkLoad       = URL::creatLink('admin','group','index');
    $linkSave       = URL::creatLink('admin','group','changeOrdering');

    //pagination
    $link               = URL::creatLink('admin','group','index');
    $panigationHTML     = $this->pagination->showPagination($link);


    $message  = Session::get('message');

    if(isset($message)){
        $htmlSuccess = '<div id="alert" class="alert alert-'.$message['class'].' alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-check"></i> Thành công!</h5>
                            '.$message['content'].'
                        </div>';
    }
    Session::delete('message');

?>
<section class="content">
    <div class="container-fluid">
    <form action="" method="post" class="table-responsive" id="form-table">
        <!-- Search & Filter -->
        <div class="card card-info card-outline">
            <div class="card-header">
                <h6 class="card-title">Search & Filter</h6>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                
                    <div class="col-sm-12 col-md-6 mb-1">
                        <!-- ButtonHeader -->
                        <?php echo $All . $Active . $Inactive; ?>
                    </div>
                    <div class="col-sm-12 col-md-6 mb-1 text-right">
                        <div class="input-group">
                            <div class="input-group-prepend input-group-sm">
                                <?php echo $search; ?>
                            </div>
                            <input type="text" class="form-control form-control-sm" name="filter_search" value="<?php echo $this->arrParam['filter_search']; ?>">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-sm btn-danger" id="btn-clear-search">Clear</button>
                                <button type="button" class="btn btn-sm btn-info" id="btn-search">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $htmlSuccess; ?>
        <!-- List -->
        <div class="card card-info card-outline">
            <div class="card-header">
                <h4 class="card-title">List</h4>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <!-- Control -->

                <div class="d-flex flex-wrap align-items-center justify-content-between mb-2">
                   
                    <div class="mb-1">
                        <?php echo $groupMuty . $groupAcp; ?>
                    </div>
                    <div class="mb-1">
                        <a href="javascript:reload('<?php echo $linkSave ; ?>');" class="btn btn-sm btn-info"><i class="fas fa-save"></i> Save</a>
                        <a href="<?php echo $linkNew ; ?>" class="btn btn-sm btn-info"><i class="fas fa-plus"></i> Add New</a>
                        <a href="<?php echo $linkLoad ; ?>" class="btn btn-sm btn-info"><i class="fas fa-sync"></i> Reload</a>
                    </div>
                </div>
                <!-- List Content -->
                 
                    <table class="table table-bordered table-hover text-nowrap btn-table mb-0">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="check-all">
                                        <label for="check-all" class="custom-control-label"></label>
                                    </div>
                                </th>
                                <?php echo $ID . $Name . $Status . $Group_acp . $Ordering . $Created . $Modified ; ?>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            
                            foreach($this->iteam AS $value){
                                if($value['group_acp'] == 1){
                                    $group_acp = 'class="my-btn-state rounded-circle btn btn-sm btn-success"><i class="fas fa-check">';
                                }else{
                                    $group_acp = 'class="my-btn-state rounded-circle btn btn-sm btn-danger"><i class="fas fa-minus">';
                                }

                                // Create status
                                $classStatus    = ($value['status'] == 1) ? "success" : "warning";
                                $status         = Helper::creatStatus('status','custom-select custom-select-sm text-white bg-'.$classStatus.'',$arrStatus,$value['status'],'width: unset',$value['id'],'data-'.$value['id']);
                    
                                echo    '<tr data="data-'.$value['id'].'">
                                            <td class="text-center"><div class="custom-control custom-checkbox"><input class="custom-control-input" type="checkbox" name="checkbox" id="id-'.$value['id'].'" value="'.$value['id'].'"><label for="id-'.$value['id'].'" class="custom-control-label"></label></div></td>
                                            <td class="text-center">'.$value['id'].'</td>
                                            <td class="text-center">'.$value['name'].'</td>
                                            <td class="text-center"> '.$status.'</td>
                                            <td class="text-center position-relative"><a id="id-'.$value['id'].'" href="javascript:changeGroupAcp(\'index.php?module=admin&controller=group&action=changeGroupAcp&group='.$value['group_acp'].'&id='.$value['id'].'\')" '.$group_acp.'</i></a></td>
                                            <td class="text-center position-relative"><input type="number" name="chkOrdering['.$value['id'].']" value="'.$value['ordering'].'" class="chkOrdering form-control form-control-sm m-auto text-center" style="width: 65px" data-id="1" min="1"></td>
                                            <td class="text-center"><p class="mb-0 history-by"><i class="far fa-user"></i>'.$value['created_by'].'</p><p class="mb-0 history-time"><i class="far fa-clock"></i>'.$value['created'].'</p></td>
                                            <td class="text-center"><p class="mb-0 history-by"><i class="far fa-user"></i>'.$value['modified_by'].'</p><p class="mb-0 history-time"><i class="far fa-clock"></i>'.$value['modified'].'</p></td>
                                            <td class="text-center">
                                            <a href="index.php?module=admin&controller=group&action=form&id='.$value['id'].'" class="rounded-circle btn btn-sm btn-info" title="Edit">
                                            <i class="fas fa-pencil-alt"></i></a>
                                            <a href="javascript:trash('.$value['id'].')" class="rounded-circle btn btn-sm btn-danger" title="Delete">
                                            <i class="fas fa-trash-alt"></i></a></td>
                                        </tr>';
                    
                            }
                            
                            ?>
                        </tbody>
                    </table>
                    <div>
                        <input type="hidden" name="page" value="1">
                        <input type="hidden" name="namePost" value="name">
                        <input type="hidden" name="namePostDir" value="desc">
                    </div>
                </form>
            </div>
            <div class="card-footer clearfix"><?php echo $panigationHTML; ?></div>
        </div>
        
    </div>
</section>
