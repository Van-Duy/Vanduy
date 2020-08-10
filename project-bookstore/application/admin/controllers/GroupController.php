<?php
class GroupController extends Controller{
	private $_fileView = "group/";
	public function __construct($arrParams){
		parent::__construct($arrParams);
		$this->_templateObj->setFolderTemplate('admin/main/');
		$this->_templateObj->setFileTemplate('index.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();
	}
	
	public function indexAction(){
		$this->_view->title = 'List';
		$this->_view->setTitle('Group-List');
		$this->_view->setImage(TEMPLATE_URL .'admin/main/images/');
		$this->_view->appendJS(array('group/js/custom.js','group/js/sweetalert2.min.js'));
		$this->_view->appendCSS(array('group/css/bootstrap-4.min.css'));
		
		$totalItem = $this->_model->countItem($this->_arrParam, null);
		$this->setPagination(array('totalItemsPerPage' => 5,'pageRange'=> 3));
		$this->_view->pagination = new Pagination($totalItem['total'],$this->_pagination);
		$this->_view->iteam = $this->_model->listItem($this->_arrParam, null);

		$this->_view->render($this->_fileView .'index', true);
	}

	public function formAction(){
		$this->_view->setTitle('ADD');
		$this->_view->appendJS(array('group/js/custom.js'));
		$this->_view->setImage(TEMPLATE_URL .'admin/main/images/');
		$this->_view->_title = 'User Groups : Add';
		$this->_view->title = 'Add';
		if(isset($this->_arrParam['id'])){
			$this->_view->_title = 'User Groups : Edit';
			$this->_view->title = 'Edit';
			$this->_arrParam['form'] = $this->_model->infoItem($this->_arrParam);
			if(empty($this->_arrParam['form'])) URL::redirect(URL::createLink('admin', 'group', 'index'));
		}
		
		if($this->_arrParam['form']['token'] > 0){
			
			$validate = new Validate($this->_arrParam['form']);
			$validate->addRule('name', 'string', array('min' => 3, 'max' => 255))
					 ->addRule('ordering', 'int', array('min' => 1, 'max' => 100))
					 ->addRule('status', 'status', array('deny' => array('default')))
					 ->addRule('group_acp', 'status', array('deny' => array('default')));
			$validate->run();
			$this->_arrParam['form'] = $validate->getResult();
			if($validate->isValid() == false){
				$this->_view->errors = $validate->showErrors();
			}else{
				$task	= (isset($this->_arrParam['form']['id'])) ? 'edit' : 'add';
				$id	= $this->_model->saveItem($this->_arrParam, array('task' => $task));
				if($this->_arrParam['type'] == 'save-close') 	URL::redirect('admin', 'group', 'index');
				if($this->_arrParam['type'] == 'save-new') 		URL::redirect('admin', 'group', 'form');
				if($this->_arrParam['type'] == 'save') 			URL::redirect('admin', 'group', 'form', array('id' => $id));
			}
		}
		
		$this->_view->arrParam = $this->_arrParam;
		$this->_view->render('group/form');
	}

	public function changeStatusAction(){
		$result = $this->_model->changStatus($this->_arrParam ,array('task' => 'changeStatus'));
		echo json_encode($result);
	}
	
	public function changeGroupAcpAction(){
		$result = $this->_model->changStatus($this->_arrParam ,array('task' => 'changeGroupAcp'));
		echo json_encode($result);
	}

	public function changeOrderingAction(){
		$result = $this->_model->changOrdering($this->_arrParam);
		URL::redirect('admin','group','index');
	}

	public function trashAction(){
		$result = $this->_model->trash($this->_arrParam);
		echo json_encode($result);
	}

	public function lastIdGetAction(){
		$result = $this->_model->lastIdGet($this->_arrParam);
		echo json_encode($result);
	}
	
	public function changeAllAction(){
		$result = $this->_model->changStatus($this->_arrParam ,array('task' => 'changeAll'));
		echo json_encode($result);
	}

	public function addSeccionAction(){
		$result = $this->_model->addSeccion($this->_arrParam);
	}
}