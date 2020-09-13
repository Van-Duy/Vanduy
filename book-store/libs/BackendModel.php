<?php
class BackendModel extends Model
{
	// user
	protected $_id          = "";
	protected $_user        = "";
	protected $_time        = "";

	protected function __construct()
	{
		parent::__construct();
        $user = Session::get('user');
		if(isset($user)){
            $this->_id              = $user['info']['id'];
            $this->_user            = $user['info']['username'];
            $this->_time            = date('Y-m-d h:t:s', time());
		}
	}
	
	public function changeMuti($arrParam, $option  = null){
        if (!empty($arrParam)) {
           if ($option['task'] == 'multi-active' || $option['task'] == 'multi-inactive') {
                // Thay đổi tất cả phần tử sang Active
                $status     = ($arrParam['type'] == 'multi-active') ? 'active' : 'inactive';
                $cID        = implode(',', $arrParam['checkbox']);

                $where         = "Update `$this->table` SET `status` = '$status',`modified` = '$this->_time',`modified_by` = '$this->_user' WHERE  id IN ($cID,0)";
                $this->query($where);
                if ($this->affectedRows()) {
                    $this->message('success',SUCCESS);
                } else {
                    $this->message('warning',ERROR_CHANGE);
                }
            }else if ($option['task'] == 'showhome-active' || $option['task'] == 'showhome-inactive'){
                // Thay đổi showhome
                $showHome     = ($arrParam['type'] == 'showhome-active') ? 'active' : 'inactive';
                $cID        = implode(',', $arrParam['checkbox']);
                $where         = "Update `$this->table` SET `showHome` = '$showHome',`modified` = '$this->_time',`modified_by` = '$this->_user' WHERE  id IN ($cID,0)";
                $this->query($where);
                if ($this->affectedRows()) {
                    $this->message('success',SUCCESS);
                } else {
                    $this->message('warning',ERROR_CHANGE);
                }
            }
        }
    }

    public function deleteItem($arrParam, $option  = null){
        if (!empty($arrParam)) {
            if ($option['task'] == 'deleteMuti') {
                // Xóa nhiều phần tử
                $cID        = $arrParam['checkbox'];
                $this->delete($cID);
                if ($this->affectedRows()) {
                    $this->message('success',SUCCESS_DELETE);
                }else {
                    $this->message('danger',ERROR);
                }
            } else if ($option['task'] == 'delete') {
                // Xóa 1 phần tử
                $id        = [$arrParam['id']];
                $this->delete($id);
                if ($this->affectedRows()) {
                    $this->message('success',SUCCESS_DELETE);
                }else {
                    $this->message('danger',ERROR);
                }
            }
        }
    }
	
	public function message($icon,$notice){
        Session::set('message', array('class' => $icon, 'content' => $notice));
    }

    public function setModified(){
        $htmlModified = '<p class="mb-0 history-by"><i class="far fa-user"> '.$this->_user.'</i></p><p class="mb-0 history-time"><i class="far fa-clock"> '.$this->_time.'</i></p>';
        return $htmlModified;
    }
}