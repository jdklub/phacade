<?php

class RichListbox extends PhacadeControl
{
    public $name;
    public $multiple = false;
    public $size = 10;
    public $items = array();
    public $selected = array();
    public $iframecss = array();
    public $cssClass; // div on root page
    public $fill = false;


    function RichListBox($name)
    {
        $this->name = $name;
        $this->selected = $_REQUEST[$this->name];
    }

    function add($key, $item, $attrs = '')
    {
        if ($key) {
            $next = sizeof($this->items[$key]);

            $this->items[$key][$next][0] = $item;
            $this->items[$key][$next][1] = $attrs;
        } else {
            //$this->items[][0] = $item;
            //$this->items[][1] = $attrs;
        }
    }

    function render()
    {

        // normal select holds actual selections (but will be hidden)
        $e = '<select style="visibility:hidden; display:none;"';
        $e .= 'id="' . $this->name . '" ';
        //$e .= ($this->multiple) ? ('name="' . $this->name . '[]" ') :('name="' . $this->name . '[]" ');
        $e .= 'name="' . $this->name . '[]" ';
        $e .= ($this->multiple) ? ('multiple="multiple" ') : '';
        $e .= ($this->size) ? ('size="' . $this->size . '" ') : '';
        $e .= ' >';

        while (list($key, $item) = each($this->items)) {
            //echo "<pre>" . print_r($item) . "</pre>";
            if (is_array($this->selected)) {
                if (!in_array($key, $this->selected)) {
                    $e .= '<option value="' . $key . '">' . $item[0][0] . '</option>';
                } else {
                    $e .= '<option selected="selected" value="' . $key . '">' . $item[0][0] . '</option>';
                }
            } else {
                if ($this->selected == $key) {
                    $e .= '<option value="' . $key . '" selected="selected">' . $item[0][0] . '</option>';
                } else {
                    $e .= '<option value="' . $key . '">' . $item[0][0] . '</option>';
                }
            }
        }
        reset($this->items);
        $e .= '</select>';

        // create iframe
        $e .= '<iframe id="' . $this->name . '" name="' . $this->name . '_iframe" ';
        $e .= ($this->cssClass) ? ('class="' . $this->cssClass . '" ') : '';
        $e .= '></iframe>';

        // css for iframe
        $css_table = $this->iframecss['table'];
        $css_link = $this->iframecss['link'];
        $css_row = $this->iframecss['row'];
        $css_altrow = $this->iframecss['altrow'];
        $css_cell = $this->iframecss['cell'];
        $css_altcell = $this->iframecss['altcell'];

        // create html to write in iframe
        $w .= '<link rel="stylesheet" href="' . $css_link . '" type="text/css">';
        $w .= '<table class="' . $css_table . '">';
        $idxr = 0;
        $maxcells = $this->maxCells($this->items); // max num of cells in any row
        while (list($key, $data) = each($this->items)) {

            // write row
            $w .= ($idxr % 2) ? ('<tr class="' . $css_altrow . '">') : ('<tr class="' . $css_row . '">');

            // selection mode
            $mode = ($this->multiple) ? ('checkbox') : ('radio');
            $suffix = ($this->multiple) ? ("_chk[$idx]") : '';

            // cell with checkbox/radio
            if (is_array($this->selected)) {
                if (in_array($key, $this->selected)) {
                    $w .= '<td width="20"><input type="' . $mode . '" name="' . $this->name . $suffix . '" onclick="window.parent.' . $this->name . "_toggle(this.checked, $idxr)\" checked=\"checked\"></td>";
                } else {
                    $w .= '<td width="20"><input type="' . $mode . '" name="' . $this->name . $suffix . '" onclick="window.parent.' . $this->name . "_toggle(this.checked, $idxr)\"></td>";
                }
            } else {
                if ($this->selected == $key) {
                    $w .= '<td width="20"><input type="' . $mode . '" name="' . $this->name . $suffix . '" onclick="window.parent.' . $this->name . "_toggle(this.checked, $idxr)\ selected=\"selected\"></td>";
                } else {
                    $w .= '<td width="20"><input type="' . $mode . '" name="' . $this->name . $suffix . '" onclick="window.parent.' . $this->name . "_toggle(this.checked, $idxr)\"></td>";
                }
            }

            $idxr++;

            // write cell data
            $idxc = 0;
            $cellcount = sizeof($data);
            $rcount = 0;
            while (list($junk, $cell) = each($data)) {
                $item = $cell[0];
                $attrs = $cell[1];

                $w .= '<td ';
                $w .= ($idxc % 2) ? ('class="' . $css_cell . '" ') : ('class="' . $css_altcell . '" ');
                $idxc++;

                if ($this->fill) {
                    $w .= ($idxc == $cellcount) ? ('width="100%"') : '';
                }


                // attributes for cell
                if (is_array($attrs)) {
                    while (list($attr, $val) = each($attrs)) {
                        $w .= "$attr=\"$val\" ";
                    }
                }

                $w .= ">$item</td>";
                $rcount++;
            }

            // if num of cells in this row < max, add remaining cells
            if ($rcount < $maxcells) {
                for ($c = 0; $c < ($maxcells - $rcount); $c++) {
                    $td_class = ($idxc % 2) ? ('class="' . $css_cell . '" ') : ('class="' . $css_altcell . '" ');
                    $w .= '<td ' . $td_class . '>&nbsp;</td>';
                    $idxc++;
                }
            }

            // close row
            $w .= '</tr>';


        }
        reset($this->items);
        $w .= '</table>';

        // script that does the actual writing to iframe
        $e .= "<script>\n";
        $e .= 'function ' . $this->name . '_load()';
        $e .= "{\n ";
        $e .= "window.frames['" . $this->name . "_iframe'].document.open();\n";
        $e .= "window.frames['" . $this->name . "_iframe'].document.write(\"<html><body>\");\n";
        $e .= "window.frames['" . $this->name . "_iframe'].document.write(\"" . addslashes($w) . "\");\n";
        $e .= "window.frames['" . $this->name . "_iframe'].document.write(\"</body></html>\");\n";
        $e .= "window.frames['" . $this->name . "_iframe'].document.close();\n";
        $e .= "}\n";
        $e .= "function " . $this->name . "_toggle(state, key)\n";
        $e .= "{\n";
        $e .= "if(state)\n";
        $e .= "{\n";
        $e .= "document.getElementById('" . $this->name . "').options[key].selected = true;\n";
        $e .= "}\n";
        $e .= "else\n";
        $e .= "{\n";
        $e .= "document.getElementById('" . $this->name . "').options[key].selected = false;\n";
        $e .= "}\n";
        $e .= "}\n";
        $e .= $this->name . "_load();\n";
        $e .= "</script>\n";

        return $e;
    }

    function display()
    {
        echo $this->render();
    }

    private function maxCells($items)
    {
        $max = 0;
        reset($items);
        while (list($key, $data) = each($items)) {
            $row = sizeof($data);
            if ($row > $max) $max = $row;
        }
        return $max;
    }

    function __toString()
    {
        return $this->render();
    }

}


?>