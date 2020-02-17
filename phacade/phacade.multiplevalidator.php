<?php

class MultipleValidator
{

    private $validators = array();

    function MultipleValidator()
    {
        foreach (func_get_args() as $v) {
            $this->add($v);
        }
    }

    public function validate($input)
    {
        foreach ($this->validators as $validator) {
            if (!$validator->validate($input)) return false;
        }
        return true;
    }

    public function add($validator)
    {
        $this->validators[] = $validator;
    }
}


?>