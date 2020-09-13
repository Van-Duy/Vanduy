<?php
class AccountValidate extends Validate
{
        public function __construct($arrParams)
        {
                parent::__construct($arrParams['form']);
                
        }

        public function validate($view,$database){
                $task 			=  'add';
                $requirePass 	= true;
                $queryU  		= "SELECT `id` FROM `user` WHERE `username` = '" . ($view->arrParam)['form']['username'] . "'";
                $queryE  		= "SELECT `id` FROM `user` WHERE `email` = '" . ($view->arrParam)['form']['email'] . "'";
                if(isset($view->arrParam['form']['id'])){
                        $task 			= 'edit';
                        $requirePass 	= false;
                        $queryU  		.= "AND `id` <> '".$view->arrParam['form']['id']."'";
                        $queryE  		.= "AND `id` <> '".$view->arrParam['form']['id']."'";
                }
                $this->addRule('username', 'string-notExistRecord', array('min' => 3, 'max' => 50, 'database' => $database, 'query' => $queryU))
                        ->addRule('email', 'email-notExistRecord', array('database' => $database, 'query' => $queryE))
                        ->addRule('ordering', 'int', array('min' => 0, 'max' => 100))
                        ->addRule('password', 'password', array('action' => $task), $requirePass)
                        ->addRule('status', 'status', array('deny' => array('default')))
                        ->addRule('group_id', 'status', array('deny' => array('default')));
                $this->run();
         }

         public function validatePass(){
                $this   ->addRule('password', 'password',array('action' => 'edit'));
                $this->run();
        }

        
}
