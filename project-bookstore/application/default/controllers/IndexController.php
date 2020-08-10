<?php
class IndexController extends Controller{
	
	public function __construct($arrParams){
		parent::__construct($arrParams);
		$this->_templateObj->setFolderTemplate('default/main/');
		$this->_templateObj->setFileTemplate('index.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();
	}
	
	public function indexAction(){
		$this->_view->setImage(TEMPLATE_URL .'default/main/img/');
		$this->_view->setPlugins(TEMPLATE_URL .'default/main/plugins/');
		$this->_view->render('index/index');
	}

	
	
}