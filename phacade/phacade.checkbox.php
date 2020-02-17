<?php

class Checkbox extends PhacadeControl
{
    public $name;
    public $checked;

    function Checkbox($name)
    {
        $this->name = $name;
        if (strtolower($_REQUEST[$name]) == 'on') {
            $this->checked = true;
        } else {
            $this->checked = false;
        }

    }

    function render()
    {
        $e = '<input type="checkbox" ';
        $e .= 'name="' . $this->name . '" ';
        $e .= ($this->checked) ? 'checked="checked" ' : '';
        $e .= $this->renderProperties();
        $e .= '/>';

        return $e;

    }

    function display()
    {
        echo $this->render();
    }

    function __toString()
    {
        return $this->render();
    }

}


?>