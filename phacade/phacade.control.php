<?php

class PhacadeControl
{
    protected $properties = array();

    public function __set($prop, $val)
    {
        $this->properties[$prop] = $val;
    }

    public function __get($prop)
    {
        return $this->properties[$prop];
    }

    protected function renderProperties()
    {
        foreach ($this->properties as $prop => $val) {
            $e .= "$prop=\"$val\" ";
        }
        return $e;
    }


}

?>