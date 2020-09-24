<?php

class UserController extends FrontendController
{

	public function cartAction()
	{
		$this->_view->items = $this->_model->ShowProductInCart();

		$source = $this->_arrParam['form'];
		if (isset($source)) {
			$this->_model->saveProduct($this->_arrParam);
			URL::redirect('frontend', 'index', 'index', '', 'index.html');
		}  
		if(empty($this->_view->items)){
			Session::set('message', array('class' => 'warning', 'content' => 'Chưa có sản phẩm nào trong giỏ hàng'));
		}

		$this->_view->render('user/cart');
	}

	public function buyAction()
	{
		$arr = $this->_model->buyProduct($this->_arrParam);
		echo (json_encode($arr));
	}

	public function deleteProductAction()
	{
		$value = $this->_model->deleteProduct($this->_arrParam);
		echo json_encode($value);
	}

	public function changeQuantifyAction()
	{
		$message = $this->_model->changeQuantify($this->_arrParam);
		echo json_encode($message);
	}

	public function historyAction()
	{
		$this->_view->iteams = $this->_model->getProduct();

		$this->_view->render('user/history');
	}

	public function changePassAction()
	{
		$source  = $this->_arrParam['form'];
		if (isset($source['token'])) {
			$pass 	= $this->_model->getUser()['password'];

			if ($pass == md5($source['passWordOld'])) {
				$validate = new Validate($source);
				$validate->addRule('passWordNew', 'password', array('action' => 'add'), true);
				$validate->run();
				$this->_arrParam['form'] = $validate->getResult();
				if ($validate->isValid() == false) {
					Session::set('message', array('class' => 'error', 'content' => $validate->showErrors()));
				} else {
					if ($source['passWordNew'] == $source['passWordNewRe']) {
						$this->_model->savePassWord($source);
						URL::redirect('frontend', 'index', 'login', '', 'login.html');
					} else {
						Session::set('message', array('class' => 'warning', 'content' => 'Mật khẩu mới phải trùng nhau..'));
					}
				}
			} else {
				Session::set('message', array('class' => 'error', 'content' => 'Nhập sai mật khẩu cũ..'));
			}
		}
		$this->_view->render('user/changePass');
	}

	public function infoAction()
	{
		$this->_view->user  = $this->_model->getUser();
		$source  = $this->_arrParam['form'];

		if (isset($source['token'])) {
			$this->_model->updateUser($source);
			URL::redirect('frontend', 'user', 'info', '', 'info.html');
		}

		$this->_view->render('user/info');
	}
}
