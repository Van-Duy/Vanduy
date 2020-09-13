<?php

class IndexController extends FrontendController{
	
	
	public function indexAction(){
	
		$this->_view->topProduct 		= $this->_model->topProduct();
		$this->_view->topCategory 		= $this->_model->topCategory();
		$this->_view->topCategoryItems 	= $this->_model->topCategoryItems();

		$this->_view->render('index/index');
	}

	public function loginAction(){
		if(isset(($this->_arrParam)['form'])){
			$source = ($this->_arrParam)['form'];
			$email = $source['email'];
			$password = md5($source['password']);

			$query 	  = "SELECT `id` FROM `user` WHERE `email` = '".$email."' AND `password` = '".$password."'";

			$validate 	= new validate($source);
			$validate->addRule('email','existRecord',array('database' => $this->_model,'query' => $query));
			$validate->run();
			$this->_arrParam['form'] = $validate->getResult();

			if($validate->isValid() == false){
				$this->_view->errors = $validate->showErrors();
			}else{
				$infoUser = $this->_model->infoItem($this->_arrParam);
				$arraySession = array(
										'login' 		=> true,
										'info' 			=> $infoUser,
										'time' 			=> time()
										//'group_acp' 	=> $infoUser['group_acp']
				);
				Session::set('user',$arraySession);
				URL::redirect('frontend','index','index','','index.html');
				
			}
			
		}
		$this->_view->arrParam = $this->_arrParam;
		$this->_view->render('index/login');
	}

	public function registerAction(){
		if(isset(($this->_arrParam)['form'])){
			$source = ($this->_arrParam)['form'];
			$queryU  	= "SELECT `id` FROM `user` WHERE `username` = '" . $source['username'] . "'";
			$queryE  	= "SELECT `id` FROM `user` WHERE `email` = '" . $source['email'] . "'";
			
			$validate 	= new validate($source);
			$validate	->addRule('username','string-notExistRecord',array('min' => 3,'max' => 50,'database' => $this->_model,'query' => $queryU))
						->addRule('fullname','string',array('min' => 3,'max' => 50))
						->addRule('email','email-notExistRecord',array('database' => $this->_model,'query' => $queryE))
						->addRule('password','password',array('action' => 'add'));
			$validate->run();
			$this->_arrParam['form'] = $validate->getResult();
			
			if($validate->isValid() == false){
				$this->_view->errors = $validate->showErrors();
			}else{
				$this->_model->save($this->_arrParam,array('task'=> 'register'));
				URL::redirect('frontend','index','notice',array('type' => 'register'));
			}
		}

		$this->_view->arrParam = $this->_arrParam;
		$this->_view->render('index/register');
	}

	public function noticeAction(){
	
		$this->_view->render('index/notice');
	}

	public function logoutAction(){
		Session::delete('user');
		Session::set('message',array('class' => 'warning','content' =>'Bạn đã đăng xuất tài khoản !!! Xin cảm ơn và hẹn gặp lại ..'));
		URL::redirect('frontend','index','index','','index.html');
	}

	public function viewAction(){
		$result = $this->_model->view($this->_arrParam);
		echo json_encode($result);
		
		
	}
	
}
	
	
