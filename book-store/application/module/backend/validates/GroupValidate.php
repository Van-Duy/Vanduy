<?php
class GroupValidate extends Validate
{
	public function __construct($arrParams)
	{
		parent::__construct($arrParams['form']);
    }
    
    public function validate()
	{
        $this   ->addRule('name', 'string', array('min' => 3, 'max' => 255))
                ->addRule('ordering', 'int', array('min' => 1, 'max' => 100))
                ->addRule('status', 'status', array('deny' => array('default')))
                ->addRule('group_acp', 'status', array('deny' => array('default')));

        $this->run();
	}

}
