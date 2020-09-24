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
		$this->_view->_title 			= ucfirst($this->_setController) . ' :: Edit';
		if ($this->_arrParam['type'] == 'save') {
			$this->_model->saveItem($this->_arrParam);
		}
		$this->_arrParam['form'] 		= $this->_model->infoItem($this->_arrParam);
		$this->_view->arrParam 			= $this->_arrParam;
		$this->_view->render($this->_setController . '/index');
	}

	public function changePassAction()
	{
		$this->_view->_title 	= $this->_setController . ' : ChangePass';
		$source  = $this->_arrParam['form'];
		if (isset($source['token'])) {
			$pass 	= $this->_model->getUser()['password'];
			if ($pass == md5($source['passWordOld'])) {
				$this->_validate->validatePass();
				$this->_arrParam['form'] = $this->_validate->getResult();

				if ($this->_validate->isValid() == false) {
					Session::set('message', array('class' => 'error', 'content' => $this->_validate->showErrors()));
				} else {
					
					if ($source['passWordNew'] == $source['passNewRe']) {
						$this->_model->editPassword($source);
						URL::redirect('frontend', 'index', 'login', '', 'login.html');
					} else {
						Session::set('message', array('class' => 'warning', 'content' => 'Mật khẩu mới phải trùng nhau..'));
					}
				}
			} else {
				Session::set('message', array('class' => 'error', 'content' => 'Nhập sai mật khẩu cũ..'));
			}
		}
		$this->_view->render($this->_setController . '/changePass');
	}
}
