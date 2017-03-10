<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 08.03.2017
 * Time: 20:36
 */

namespace App\Forms;


class Email extends Control
{

    /**
     * Email constructor.
     */
    public function __construct($name, $params)
    {
        parent::__construct($name, $params);
        $this->type = 'email';
    }

    public function validate()
    {
        if (parent::validate() && !preg_match('#.+@.+#', $this->value)) {
            $this->setError('Неверный email');
            return false;
        }
        return true;
    }
}