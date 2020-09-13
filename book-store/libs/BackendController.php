<?php
class BackendController extends Controller
{
    protected $_module ;
	protected $_controller;
	// user
	protected $_user        = "";
	protected $_time        = "";

	public function __construct($arrParams)
	{
		parent::__construct($arrParams);
		$this->_templateObj->setFolderTemplate('admin/adminlte/');
		$this->_templateObj->setFileTemplate('index.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();

		$this->_module = $this->_arrParam['module'];
		$this->_controller = $this->_arrParam['controller'];
		$user = Session::get('user');
		if(isset($user)){
			$this->_user	    = date('Y-m-d h:t:s', time());
			$this->_time    	= $user['info']['username'];
		}
    }
    
    public function changeStatusAction()
	{
		$this->_model->changeStatus($this->_arrParam, array('task' => 'changeStatus'));
		URL::redirect($this->_module, $this->_controller, 'index');
	}
	
    public function changeMutiAction()
	{
		$task = $this->_arrParam['type'];
		if($task == 'multi-delete'){
			$this->_model->deleteItem($this->_arrParam, array('task' => 'deleteMuti'));
		}else{
			$this->_model->changeMuti($this->_arrParam, array('task' => $task));
		}
		URL::redirect($this->_module, $this->_controller, 'index');
    }
    
	public function trashAction()
	{
		if (isset($this->_arrParam)) {
			$this->_model->deleteItem($this->_arrParam, array('task' => 'delete'));
			URL::redirect($this->_module, $this->_controller, 'index');
		}
	}

	public function saveRedirect($id)
	{
		if($this->_arrParam['type'] == 'save-close') 	URL::redirect($this->_module, $this->_controller, 'index');
		if($this->_arrParam['type'] == 'save-new') 		URL::redirect($this->_module, $this->_controller, 'form');
		if($this->_arrParam['type'] == 'save') 			URL::redirect($this->_module, $this->_controller, 'form', array('id' => $id));
	}

	

}