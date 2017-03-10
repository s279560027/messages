<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 08.03.2017
 * Time: 20:36
 */

namespace App\Forms;


class Label extends Control
{

    public function render()
    {
        $text = htmlspecialchars($this->value);
        return <<<INPUT
            <div><span class="label label-success">{$text}</span></div>
INPUT;
    }
}