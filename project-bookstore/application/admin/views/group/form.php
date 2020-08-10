 <?php 
 Session::init();
 $result             = ($this->arrParam)['form'];
 // Create Status
 $arrStatus      = array('default'=>'--choose select--',1 => 'Active' , 0 => 'Inactive');
 $status        = Helper::creatStatus('form[status]','custom-select custom-select-sm', $arrStatus ,$result['status']);
 
 // Create Group_acp
 $arrGroupAcp    = array('default'=>'- Fill_Acp -',1 => 'Yes' , 0 => 'No');
 $groupAcp       = Helper::creatStatus('form[group_acp]','custom-select custom-select-sm',$arrGroupAcp,$result['group_acp']);

 // create (Save-close)
 $linkSave          = URL::creatLink('admin','group','form',array('type' => 'save'));
 $save              = Helper::cmsButtonSave('Save','btn-success',$linkSave,'submit');

 $linkSaveClose     = URL::creatLink('admin','group','form',array('type' => 'save-close'));
 $saveClose         = Helper::cmsButtonSave('Save &amp; Close','btn-success',$linkSaveClose,'submit');

 $linkSaveNew       = URL::creatLink('admin','group','form',array('type' => 'save-new'));
 $saveNew           = Helper::cmsButtonSave('Save &amp; New','btn-success',$linkSaveNew,'submit');

 $linkCancel        = URL::creatLink('admin','group','index');
 $cancel            = Helper::cmsButtonSave('Cancel','btn-danger',$linkCancel);


// create (input)
$inputName          = Helper::cmsInput('form[name]','text','',$result['name']);
$inputOrdering      = Helper::cmsInput('form[ordering]','number','',$result['ordering']);
 
// create div
$nameDiv            = Helper::cmsDiv('name',$inputName,true);
$orderingDiv        = Helper::cmsDiv('ordering',$inputOrdering);
$statusDiv          = Helper::cmsDiv('status',$status);
$group_acpDiv       = Helper::cmsDiv('group Acp',$groupAcp);

if(!empty($result['id'])){
    $inputID        = Helper::cmsInput('form[id]','text','readonly',$result['id']);
    $idDiv          = Helper::cmsDiv('ID',$inputID);
}


$message  = Session::get('message');

if(isset($message)){
    $htmlSuccess = '<div id="alert" class="alert alert-'.$message['class'].' alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> Thành công!</h5>
                        '.$message['content'].'
                    </div>';
}
Session::delete('message');
if(isset($this->errors)){
    $htmlError = '<div id="alert" class="alert alert-danger alert-dismissible">';
    $htmlError .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
    $htmlError .= $this->errors;
    $htmlError .= ' </div>';
}


?>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Show error -->
                    <?php echo $htmlError . $htmlSuccess; ?>
                    <div class="card card-info card-outline">
                        <div class="card-body">
                            <form action="#" method="post" class="mb-0" id="form" name="form">
                                <?php echo $nameDiv . $orderingDiv . $statusDiv . $group_acpDiv . $idDiv; ?>
                                <input type="hidden" id="form[token]" name="form[token]" value="1596364518">
                            </form>
                        </div>
                        <div class="card-footer">
                            <div class="col-12 col-sm-8 offset-sm-2">
                               <?php echo $save . $saveClose . $saveNew . $cancel ; ?>
                        </div>
                    </div>
                </div>
            </section>
      