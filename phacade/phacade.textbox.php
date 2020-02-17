<?php

class Textbox
{
    var $name;
    var $value;
    var $multiline = false;
    var $rows;
    var $columns;
    var $size = 20;
    var $cssClass = '';
    var $pattern = '/.+/';
    var $password = false;
    var $hidden = false;
    var $maxlength;
    var $validator;

    private $customAttrs = array();

    function Textbox($name)
    {
        $this->name = $name;
        if (preg_match('/(.+)\[(.+)\]/', $name, $match)) {
            $this->value = $_REQUEST[$match[1]][$match[2]];
        } else {
            $this->value = $_REQUEST[$this->name];
        }
    }

    function __set($attr, $val)
    {
        $this->customAttrs[$attr] = $val;
    }

    function __get($attr)
    {
        return $this->customAttrs[$attr];
    }

    private function customAttrs()
    {
        foreach ($this->customAttrs as $attr => $val) {
            $e .= "$attr=\"$val\" ";
        }
        return $e;
    }

    function valid()
    {
        if ($this->validator) {
            if (isset($this->value)) {
                return $this->validator->validate($this->value);
            }
            return false;
        } else {
            return (preg_match($this->pattern, $this->value)) ? true : false;
        }
    }

    function render()
    {
        if ($this->hidden) {
            $e = '<input ';
            $e .= 'type="hidden" ';
            $e .= 'name="' . $this->name . '" ';
            $e .= 'value="' . $this->value . '" ';
            $e .= $this->customAttrs();
            $e .= '/>';
        } else {
            if ($this->multiline) {
                $e = '<textarea ';
                $e .= 'name="' . $this->name . '" ';
                $e .= ($this->rows) ? ('rows="' . $this->rows . '" ') : '';
                $e .= ($this->columns) ? ('cols="' . $this->columns . '" ') : '';
                $e .= ($this->cssClass) ? ('class="' . $this->cssClass . '" ') : '';
                $e .= $this->customAttrs();
                $e .= '>';
                $e .= $this->value;
                $e .= '</textarea>';
            } else {
                $e = '<input ';
                $e .= ($this->password) ? ('type="password" ') : ('type="text" ');
                $e .= 'name="' . $this->name . '" ';
                $e .= 'value="' . $this->value . '" ';
                $e .= ($this->size) ? ('size="' . $this->size . '" ') : '';
                $e .= ($this->maxlength) ? ('maxlength="' . $this->maxlength . '" ') : '';
                $e .= ($this->cssClass) ? ('class="' . $this->cssClass . '" ') : '';
                $e .= $this->customAttrs();
                $e .= '/>';
            }
        }

        return $e;
    }

    function display()
    {
        echo $this->Render();
    }

    function __toString()
    {
        return $this->render();
    }
}

?>