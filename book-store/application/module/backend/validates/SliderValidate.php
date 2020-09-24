<?php
class SliderValidate extends Validate
{
        
        public function __construct($arrParams)
        {
                parent::__construct($arrParams['form']);
        }

        public function validate()
        {
                $this           ->addRule('name', 'string', array('min' => 3, 'max' => 255))
                                ->addRule('picture', 'file', array("extension" => array('jpg', 'png'), "min" => 500, "max" => 500000), false)
                                ->addRule('status', 'status', array('deny' => array('default')));
                $this->run();
        }
}
