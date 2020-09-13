<?php
class DashboardController extends BackendController
{
	private $_setController 	= 'dashboard';

	public function indexAction()
	{
		$this->_view->_title 			= ucfirst($this->_setController);
		$this->_view->countGroup 		= $this->_model->countItems($this->_arrParam, ['task' => 'group']);
		$this->_view->countUser 		= $this->_model->countItems($this->_arrParam, ['task' => 'user']);
		$this->_view->countCategory 	= $this->_model->countItems($this->_arrParam, ['task' => 'category']);
		$this->_view->countBook 		= $this->_model->countItems($this->_arrParam, ['task' => 'book']);
		$this->_view->render($this->_setController . '/index');
	}
}
