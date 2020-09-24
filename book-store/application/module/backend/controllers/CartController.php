<?php
class CartController extends BackendController
{
	private $_setController = 'cart';

	public function __construct($arrParams)
	{
		parent::__construct($arrParams);
	}

	public function indexAction()
	{
		$this->_view->_title = ucfirst($this->_setController) . ' :: List';
		$this->_view->items = $this->_model->listItems($this->_arrParam);
		$totalItem	= $this->_model->countItem($this->_arrParam);
		$this->_view->pagination = new Pagination($totalItem['total'], $this->_pagination);

		$this->_view->render($this->_setController . '/index');
	}

	public function changeStatusNameAction()
	{
		$result 	= $this->_model->ajaxStatus($this->_arrParam);
		return $result;
	}

	public function viewAction()
	{
		$this->_view->item = $this->_model->showItem($this->_arrParam);
		$this->_view->render($this->_setController . '/view');
	}
}
