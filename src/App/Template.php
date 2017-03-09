<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 08.03.2017
 * Time: 22:11
 */

namespace App;


class Template
{
    private $templateDir = 'template';
    private $variables = array();
    private $template = 'index';

    public function __construct($variables)
    {
        $this->variables = $variables;
    }
    public function setTemplate($name)
    {
        if(file_exists($this->templateDir.DIRECTORY_SEPARATOR.$name.'.php')) {
            $this->template = $name;
        }
    }

    public function render()
    {
        $variables = $this->variables;
        require_once $this->templateDir.DIRECTORY_SEPARATOR.$this->template.'.php';
        return ob_get_clean();
    }
}