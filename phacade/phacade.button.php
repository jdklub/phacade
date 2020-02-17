<?php

class Button extends PhacadeControl
{
    public $name;
    public $submit = false;
    public $value;
    public $clicked = false;

    function Button($name, $action = '', $object = 0)
    {
        $this->name = $name;

        if ($_REQUEST[$this->name]) {
            $this->clicked = true;
            //$this->value = $_REQUEST[$this->name]; // may remove... supports the "if method" of using buttons

            if ($action) {
                if ($object) {
                    call_user_func(array($object, $action));
                } else {
                    call_user_func($action);
                }
            }
        }
    }

    function render()
    {
        $e = '<input ';
        $e .= 'name="' . $this->name . '" ';
        $e .= ($this->submit) ? ('type="submit" ') : ('type="button" ');
        $e .= ($this->value) ? ('value="' . $this->value . '" ') : '';
        $e .= $this->renderProperties();
        $e .= ' />';

        return $e;

    }

    function display($caption = '')
    {
        if ($caption) $this->value = trim($caption);
        echo $this->render();
    }

    function __toString()
    {
        return $this->render();
    }

}

?>