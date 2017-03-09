<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 08.03.2017
 * Time: 20:36
 */

namespace App\Forms;


abstract class Control
{
    protected $value;
    protected $required;
    protected $label;
    protected $type;
    protected $name;
    protected $attributes;
    protected $error;

    /**
     * Control constructor.
     * @param $value
     */
    public function __construct($name, $params)
    {
        $params = array_replace(
            array(
                'attributes' => array(),
                'label' => '',
                'required' => '',
                'value' => ''
            ),
            $params
        );

        $this->name = $name;
        $this->label = $params['label'];
        $this->required = !empty($params['required']);
        $this->value = $params['value'];
        $attributes = array_intersect_key($params['attributes'], array(
            'class' => '',
            'id' => ''
        ));
        $this->attributes = $attributes;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    public function render()
    {
        $required = $this->required;
        $value = htmlspecialchars($this->value);

        $attributes = $this->getAttributesString();
        $label = '';
        if($this->label) {
            $label = htmlspecialchars($this->label);
            $label = <<<LABEL
            <label>{$label}</label>
LABEL;
        }
        $error = '';

        if($this->error) {
            $errorText = htmlspecialchars($this->error);
            $error = <<<ERROR
            <div class="error">{$errorText}</div>
ERROR;
        }

        return <<<INPUT
            {$label}
            {$error}
            <div><input type="{$this->type}" name="{$this->name}" value="{$value}" {$attributes} /></div>
INPUT;
    }

    public function validate()
    {
        if($this->required && strlen($this->getValue()) < 1) {
            $this->setError('Обязательно для заполнения');
            return false;
        }
        return true;
    }


    public function getAttributesString()
    {
        if (count($this->attributes) == 0) {
            return '';
        }
        $keys = array_keys($this->attributes);
        $values = array_values($this->attributes);
        array_map('htmlspecialchars', $this->attributes);
        array_map('htmlspecialchars', $this->attributes);
        return trim(vsprintf(implode('="%s" ', $keys) . '="%s"', $values));

    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param mixed $error
     */
    public function setError($error)
    {
        $this->error = $error;
    }

    public function clean()
    {
        $this->value = '';
    }







}