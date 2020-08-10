<?php
class Controller{
	
	// View Object
	protected $_view;
	
	// Model Object
	protected $_model;
	
	// Template object
	protected $_templateObj;
	
	// Params (GET - POST)
	protected $_arrParam;

	// Params (GET - POST)
	protected $_pagination = array(
									'totalItemsPerPage' => 3,
									'pageRange' 		=> 3,
								);
	
	public function __construct($arrParams){
		$this->setModel($arrParams['module'], $arrParams['controller']);
		$this->setTemplate($this);
		$this->setView($arrParams['module']);
		$this->_pagination['currentPage'] = (isset($arrParams['page'])) ? $arrParams['page'] : 1;
	 	$arrParams['pagination'] = $this->_pagination;
		$this->setParams($arrParams);

		$this->_view->arrParam = $arrParams;
	}
	
	// SET MODEL
	public function setModel($moduleName, $modelName){
		$modelName = ucfirst($modelName) . 'Model';
		$path = APPLICATION_PATH . $moduleName . DS . 'models' .  DS . $modelName . '.php';
		if(file_exists($path)){
			$modelName;
			require_once $path;
			$this->_model	= new $modelName();
			
		}
	}
	
	// GET MODEL
	public function getModel(){
		return $this->_model;
	}
	
	// GET pagination
	public function setPagination($arrPagination){
		$this->_pagination['totalItemsPerPage'] 	= $arrPagination['totalItemsPerPage'];
		$this->_pagination['pageRange'] 			= $arrPagination['pageRange'];
		$this->_arrParam['pagination']				= $this->_pagination;
		$this->_view->arrParam 						= $this->_arrParam;

	}

	// SET VIEW
	public function setView($moduleName){
		$this->_view = new View($moduleName);
	}
	
	// GET VIEW
	public function getView(){
		return $this->_view;
	}
	
	// SET TEMPLATE
	public function setTemplate(){
		$this->_templateObj = new Template($this);	
	}
	
	// GET TEMPLATE
	public function getTemplate(){
		return $this->_templateObj;
	}
	
	// GET PARAMS
	public function setParams($arrParam){
		$this->_arrParam= $arrParam;
	}
	
	// GET PARAMS
	public function getParams($arrParam){
		$this->_arrParam= $arrParam;
	}
}