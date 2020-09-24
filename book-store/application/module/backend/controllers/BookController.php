<?php
class BookController extends BackendController
{
	private $_setController = 'book';

	public function __construct($arrParams)
	{
		parent::__construct($arrParams);
	}

	public function indexAction()
	{
		$this->_view->_title 			= ucfirst($this->_setController) . ' Manager :: List';
		$this->_view->items 			= $this->_model->listItems($this->_arrParam);
		$this->_view->itemsActive 		= $this->_model->countStatus($this->_arrParam, array('task' => 'active'));
		$this->_view->itemsInactive 	= $this->_model->countStatus($this->_arrParam, array('task' => 'inactive'));
		$totalItem						= $this->_model->countItem($this->_arrParam);
		$this->_view->selectCreate 		= $this->_model->createSelect();
		$this->_view->selectIndex 		= $this->_model->createSelectIndex();
		$this->_view->pagination 		= new Pagination($totalItem['total'], $this->_pagination);
		
		$this->_view->render($this->_setController . '/index');
	}

	public function formAction()
	{
		if ($_FILES != null) {
			$this->_arrParam['form']['picture'] = $_FILES['picture'];
			$this->_validate->setSourceElement('picture', $_FILES['picture']);
		}
		$this->_view->_title 			= ucfirst($this->_setController) . ' Manager :: Form';
		$this->_view->selectCreate 		= $this->_model->createSelect();
		if (isset($this->_arrParam['id'])) {
			$this->_view->_title 		= ucfirst($this->_setController) . ' : Edit';
			$this->_view->title 		= 'Edit';
			$this->_arrParam['form'] 	= $this->_model->infoItem($this->_arrParam);
			if (empty($this->_arrParam['form'])) URL::redirect($this->_module, $this->_controller, 'index');
		}
		$source = $this->_arrParam['form'];
		if (!empty($source['token'])) {
			$this->_validate->validate();
			$this->_arrParam['form'] 	= $this->_validate->getResult();
			if ($this->_validate->isValid() == false) {
				$this->_view->errors 	= $this->_validate->showErrors();
			} else {
				$task		= (isset($this->_arrParam['form']['id'])) ? 'edit' : 'add';
				$id			= $this->_model->saveItem($this->_arrParam, array('task' => $task));
				$this->saveRedirect($id);
			}
		}
		
		$this->_view->arrParam = $this->_arrParam;
		$this->_view->render($this->_setController . '/form');
	}

	public function changeSpecialAction()
	{
		$result = $this->_model->ajaxSpecial($this->_arrParam);
		echo json_encode($result);
	}

	public function changeCategoryNameAction()
	{
		$change = $this->_model->changeCategoryName($this->_arrParam);
		echo json_encode($change);
	}
}

