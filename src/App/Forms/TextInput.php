<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 08.03.2017
 * Time: 20:36
 */

namespace App\Forms;


class TextInput extends Control
{


    /**
     * TextInput constructor.
     */
    public function __construct($name, $params)
    {
        parent::__construct($name, $params);
        $this->type = 'text';
    }
}