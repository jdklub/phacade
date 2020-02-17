<?php

class Radio extends PhacadeControl
{
    public $name;
    public $value;
    public $option;

    function Radio($name)
    {
        $this->name = $name;
        $this->value = $_REQUEST[$this->name];
    }

    function render()
    {
        $e = '<input type="radio" name="' . $this->name . '" value="' . $this->option . '" ';
        $e .= (trim($this->value) == trim($this->option)) ? ('checked="checked" ') : '';
        $e .= $this->renderProperties();
        $e .= ' />';

        return $e;
    }

    function display($opt = '')
    {
        if ($opt) $this->option = $opt;
        echo $this->render();
    }

    function __toString()
    {
        return $this->render();
    }

}