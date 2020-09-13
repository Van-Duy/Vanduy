<?php
class BookValidate extends Validate
{
        public function __construct($arrParams)
        {
                parent::__construct($arrParams['form']);
        }

        public function validate()
        {
                $this->addRule('name', 'string', array('min' => 3, 'max' => 150))
                        ->addRule('price', 'int', array('min' => 0, 'max' => 10000000000))
                        ->addRule('picture', 'file', array("extension" => array('jpg', 'png'), "min" => 500, "max" => 800000), false)
                        ->addRule('sale_off', 'int', array('min' => 0, 'max' => 100))
                        ->addRule('ordering', 'int', array('min' => 0, 'max' => 100))
                        ->addRule('status', 'status', array('deny' => array('default')))
                        ->addRule('special', 'status', array('deny' => array('default')))
                        ->addRule('category_id', 'status', array('deny' => array('default')));
                $this->run();
        }
}
