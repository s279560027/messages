<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 08.03.2017
 * Time: 20:36
 */

namespace App\Forms;


class Form
{
    private $state = array();
    private $controls = array();
    private $attrs = array();
    private $errors = array();

    public function __construct($attrs = array())
    {
        $this->attrs = $attrs;
        return $this;
    }

    public function addControl($name, $type, $params = array())
    {
        if (!isset($this->controls[$name])) {
            $this->controls[$name] = new $type($name, $params);
        }

        return $this;
    }

    public function execute()
    {
        $this->errors = array();

        if (!empty($_REQUEST['submit'])) {
            $this->state['isSubmit'] = true;
        }


        $this->state['values'] = $_REQUEST;


        foreach ($this->controls as $control) {
            $controlName = $control->getName();
            if (isset($this->state['values'][$controlName])) {
                $control->setValue($this->state['values'][$controlName]);
            }
        }

        if ($this->state['isSubmit']) {
            foreach ($this->controls as $control) {
                if (!$control->validate()) {
                    $this->errors[$controlName] = $control->getError();
                }
            }

        }


    }

    public function getValues()
    {
        $values = array();
        foreach ($this->controls as $control) {
            $values[$control->getName()] = $control->getValue();
        }
        return $values;
    }

    public function render()
    {

        $output = '<form ' . $this->getAttrsString($this->attrs) . '>';
        foreach ($this->controls as $control) {
            $output .= $control->render();
        }
        $output .= '</form>';

        return $output;
    }

    public function isSubmit()
    {
        return !empty($this->state['isSubmit']);
    }

    public function isValid()
    {

        return count($this->errors) === 0;
    }

    private function getAttrsString($attrs)
    {
        $keys = array_keys($attrs);
        $values = array_values($attrs);
        array_map('htmlspecialchars', $keys);
        array_map('htmlspecialchars', $values);
        return vsprintf(implode('="%s" ', $keys) . '="%s"', $values);
    }

    public function clean()
    {
        foreach ($this->controls as $control) {
            $controlName = $control->clean();
        }
    }


}