<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 08.03.2017
 * Time: 20:36
 */

namespace App\Forms;


class Textarea extends Control
{

    /**
     * Textarea constructor.
     */
    public function __construct($name, $params)
    {
        parent::__construct($name, $params);
        $this->type = 'textarea';
    }

    public function render()
    {
        $required = $this->required;

        $attributes = $this->getAttributesString();
        $label = '';
        if ($this->label) {
            $label = htmlspecialchars($this->label);
            $label = <<<LABEL
            <label>{$label}</label>
LABEL;
        }
        $error = '';

        if ($this->error) {
            $errorText = htmlspecialchars($this->error);
            $error = <<<ERROR
            <div class="error">{$errorText}</div>
ERROR;
        }

        return <<<INPUT
            {$label}
            {$error}
            <div><textarea type="{$this->type}" name="{$this->name}" {$attributes}>{$this->value}</textarea></div>
INPUT;
    }
}