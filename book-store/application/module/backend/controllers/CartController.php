<?php
class CartController extends BackendController
{

	public function __construct($arrParams)
	{
		parent::__construct($arrParams);
	}

	public function indexAction()
	{
		$this->_view->_title = 'Cart Manager :: List';
		$this->_view->items = $this->_model->listItems($this->_arrParam);

		$totalItem	= $this->_model->countItem($this->_arrParam);
		$this->setPagination(array('totalItemsPerPage' => 5,'pageRange'=> 3));
		$this->_view->pagination = new Pagination($totalItem['total'],$this->_pagination);
		


		$this->_view->render('cart/index');
	}


	public function changeGroupNameAction(){
		$this->_model->changeGroupName($this->_arrParam);
	}

}
