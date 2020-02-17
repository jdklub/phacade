<?php

class Listbox extends PhacadeControl
{
    public $name;
    public $multiple = false;
    public $size;
    public $items = array();
    public $selected = array();

    function ListBox($name)
    {
        $this->name = $name;
        $this->selected = $_REQUEST[$this->name];
    }

    function add($key, $item = '')
    {
        if (!$item) $item = $key;
        if ($key) {
            $this->items[$key] = $item;
        } else {
            $this->items[] = $item;
        }
    }

    function addItems($items)
    {
        if (is_array($items)) {
            foreach ($items as $key => $val) {
                if (is_array($val)) {
                    $this->addItems($val);
                } else {
                    $this->add($key, $val);
                }
            }
        } else {
            $this->add($items, $items);
        }
    }

    function remove($key)
    {
        if ($key) {
            unset($this->items[$key]);
        }
    }

    function sort()
    {
        asort($this->items);
    }

    function contains($key)
    {
        if ($key) {
            if ($this->items[$key]) {
                return true;
            }
        }
        return false;
    }

    function render()
    {
        $e = '<select ';
        $e .= ($this->multiple) ? ('name="' . $this->name . '[]" ') : ('name="' . $this->name . '" ');
        $e .= ($this->multiple) ? ('multiple="multiple" ') : ('');
        $e .= ($this->size) ? ('size="' . $this->size . '" ') : '';
        $e .= ($this->cssClass) ? ('class="' . $this->cssClass . '" ') : '';
        $e .= $this->renderProperties();
        $e .= ' >';


        while (list($key, $item) = each($this->items)) {
            if (is_array($this->selected)) {
                if (!in_array($key, $this->selected)) {
                    $e .= '<option value="' . $key . '">' . $item . '</option>';
                } else {
                    $e .= '<option selected="selected" value="' . $key . '">' . $item . '</option>';
                }
            } else {
                if ($this->selected == $key) {
                    $e .= '<option value="' . $key . '" selected="selected">' . $item . '</option>';
                } else {
                    $e .= '<option value="' . $key . '">' . $item . '</option>';
                }
            }
        }

        $e .= '</select>';

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