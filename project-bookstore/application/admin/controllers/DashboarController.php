<?php
class DashboarController extends Controller{
	private $_fileView = "dashboar/";
	public function __construct($arrParams){
		parent::__construct($arrParams);
		$this->_templateObj->setFolderTemplate('admin/main/');
		$this->_templateObj->setFileTemplate('index.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();
	}
	
	public function indexAction(){
		$this->_view->title = 'Dashboar';
		$this->_view->setTitle('Dashboar');
		$this->_view->setImage(TEMPLATE_URL .'admin/main/images/');

		$this->_view->render($this->_fileView .'index', true);
	}
	

}