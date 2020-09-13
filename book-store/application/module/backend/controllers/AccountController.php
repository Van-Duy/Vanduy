<?php

class AccountController extends BackendController
{
	private $_setController = 'account';

	public function __construct($arrParams)
	{
		parent::__construct($arrParams);
	}

	public function indexAction()
	{
		$this->_view->_title 			= ucfirst($this->_setController) . ' :: Change';
		$this->_view->selectCreate 		= $this->_model->createSelect();
		$this->_view->_title 			= $this->_setController . ' : Edit';
		$this->_arrParam['form'] 		= $this->_model->infoItem($this->_arrParam);

		if ($this->_arrParam['type'] == 'save') {
			$this->_validate->validate($this->_view, $this->_model);
			$this->_arrParam['form'] 	= $this->_validate->getResult();
			if ($this->_validate->isValid() == false) {
				$this->_view->errors 	= $this->_validate->showErrors();
			} else {
				$this->_model->saveItem($this->_arrParam);
			}
		}

		$this->_view->arrParam 			= $this->_arrParam;
		$this->_view->render($this->_setController . '/index');
	}

	public function changePassAction()
	{
		$this->_view->_title 		= ucfirst($this->_setController) . ': ChangePass';
		$this->_view->title 		= 'Edit Password';
		$this->_arrParam['form'] 	= $this->_model->infoItem($this->_arrParam);
		if ($this->_arrParam['type'] == 'save') {
			$this->_validate->validatePass();
			$this->_arrParam['form'] = $this->_validate->getResult();
			if ($this->_validate->isValid() == false) {
				$this->_view->errors = $this->_validate->showErrors();
			} else {
				$this->_model->editPassword($this->_arrParam);
				Session::delete('user');
				URL::redirect('frontend','index','login');
			}
		}

		$this->_view->arrParam = $this->_arrParam;
		$this->_view->render($this->_setController . '/changePass');
	}
}
