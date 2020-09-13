<?php
class CategoryController extends FrontendController
{
	// ACTION: INDEX
	public function indexAction()
	{
		$this->setPagination(['totalItemsPerPage'	=> 8, 'pageRange' => 3]);
		$this->_view->Items 	= $this->_model->showItems($this->_arrParam);
		$this->_view->TopItems 	= $this->_model->showItems($this->_arrParam, array('task' => 'topItems'));
		$count = $this->_model->countItem($this->_arrParam);

		$this->_view->pagination = new Pagination($count, $this->_pagination);
		$this->_view->render('category/index');
	}

	// ACTION: LIST GROUP
	public function listAction()
	{
		$this->_view->listSingle 	= $this->_model->single($this->_arrParam);
		$this->_view->relateBook 	= $this->_model->showItems($this->_arrParam, array('task' => 'relateBook'));
		$this->_view->TopItems 		= $this->_model->showItems($this->_arrParam, array('task' => 'topItems'));
		$this->_view->NewItems 		= $this->_model->showItems($this->_arrParam, array('task' => 'newItems'));

		$this->_view->render('category/list');
	}
}
