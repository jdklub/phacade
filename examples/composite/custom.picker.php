<?php

class Picker extends PhacadeControl
{
    public $name;
    public $size;
    private $lstSource;
    private $lstChosen;
    private $lstHidden;
    private $btnAdd;
    private $btnRemove;


    function Picker($name)
    {
        $this->name = $name;

        // The items that can be chosen from. After an item has been chosen
        // it will be removed from this List
        $this->lstSource = new Listbox($this->name . ':source');

        // The items that have been chosen
        $this->lstChosen = new Listbox($this->name . ':chosen');

        // A Hidden copy of chosen items, all of which are always marked as selected
        $this->lstHidden = new Listbox($this->name . ':hidden');

        // Add and Remove buttons
        $this->btnAdd = new Button($this->name . ':add');
        $this->btnRemove = new Button($this->name . ':remove');

        $this->btnAdd->value = ' << Add';
        $this->btnAdd->submit = true;

        $this->btnRemove->value = 'Remove >>';
        $this->btnRemove->submit = true;

        // Set all Lists to mutliple
        $this->lstSource->multiple = true;
        $this->lstChosen->multiple = true;
        $this->lstHidden->multiple = true;
        // Hide this List from the user
        $this->lstHidden->style = "visibility:hidden; display:none;";

        if ($this->cssClass) {
            $css = $this->cssClass;
            $this->lstSource->cssClass = $css;
            $this->lstChosen->cssClass = $css;
            $this->btnAdd->cssClass = $css;
            $this->btnRemove->cssClass = $css;
        }

    }

    function add($key, $item = '')
    {
        $this->lstSource->add($key, $item);
        $this->lstHidden->add($key, $item);
    }

    function addItems($items)
    {
        $this->lstSource->addItems($items);
        $this->lstHidden->addItems($items);
    }

    function __get($prop)
    {
        if (strtolower($prop) == 'selected') return $this->lstHidden->selected;
    }

    function render()
    {
        $this->lstSource->size = $this->size;
        $this->lstChosen->size = $this->size;
        $this->lstHidden->size = $this->size;

        if ($this->btnAdd->clicked) {
            // add existing selections from Hidden to Chosen,
            // and remove them from Source
            if (is_array($this->lstHidden->selected)) {
                foreach ($this->lstHidden->selected as $key) {
                    $this->lstChosen->add($key, $this->lstSource->items[$key]);
                    $this->lstSource->remove($key);
                }
                reset($this->lstHidden->selected);
            }

            // add new selections from Source to Chosen and Hidden
            if (is_array($this->lstSource->selected)) {
                foreach ($this->lstSource->selected as $key) {
                    $this->lstChosen->add($key, $this->lstSource->items[$key]);
                    $this->lstHidden->add($key, $this->lstSource->items[$key]);
                    $this->lstHidden->selected[] = $key;
                    $this->lstSource->remove($key);
                }
            }
        }

        if ($this->btnRemove->clicked) {
            // remove items from Hidden that are seleceted in Chosen
            if (is_array($this->lstChosen->selected)) {
                foreach ($this->lstChosen->selected as $key) {
                    foreach ($this->lstHidden->selected as $k => $v) {
                        if ($v == $key) unset($this->lstHidden->selected[$k]);
                    }
                }
            }

            //
            if (is_array($this->lstHidden->selected)) {
                foreach ($this->lstHidden->selected as $key) {
                    $this->lstChosen->add($key, $this->lstSource->items[$key]);
                    $this->lstSource->remove($key);
                }
                reset($this->lstHidden->selected);
            }
        }

        // which Buttons should be disabled?
        if (!sizeof($this->lstSource->items)) $this->btnAdd->disabled = 'disabled';
        if (!sizeof($this->lstChosen->items)) $this->btnRemove->disabled = 'disabled';

        // render the control
        $e = '<table><tr><td>';
        $e .= $this->lstChosen->render();
        $e .= $this->lstHidden->render();
        $e .= '</td><td align="center">';
        $e .= $this->btnAdd->render() . '<br>' . $this->btnRemove->render();
        $e .= '</td><td>';
        $e .= $this->lstSource->render();
        $e .= '</td></tr></table>';

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