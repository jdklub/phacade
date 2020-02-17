<?php

class NumericValidator
{
    public $max;
    public $min;

    function NumericValidator($minimum = '', $maximum = '')
    {
        $this->min = $minimum;
        $this->max = $maximum;
    }

    function validate($input)
    {
        if (!is_numeric($input)) return false;
        if (is_numeric($this->max) && ($input > (int)$this->max)) return false;
        if (is_numeric($this->min) && ($input < (int)$this->min)) return false;
        return true;
    }

    function __toString()
    {
        return 'Numeric Validator: ' . $this->min . ' <-> ' . $this->max;
    }
}

?>