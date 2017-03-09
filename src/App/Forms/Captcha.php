<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 08.03.2017
 * Time: 20:36
 */

namespace App\Forms;


class Captcha extends Control
{
    private $complete = false;
    private $captchaParams;

    /**
     * Captcha constructor.
     */
    public function __construct($name, $params)
    {
        $this->type = 'captcha';

        parent::__construct($name, $params);
        if(!isset($_SESSION['captcha'])) {
            $_SESSION['captcha'] = array();
        }

        $this->captchaParams = array_replace(array(
            'code' => ''
        ), $_SESSION['captcha']);
        if(empty($this->captchaParams['code'])) {
            $this->captchaParams['code'] = rand(0,9).rand(0,9).rand(0,9).rand(0,9);
            $_SESSION['captcha'] = array_replace($_SESSION['captcha'], $this->captchaParams);
        }
    }

    public function render() {
        $output = parent::render();

        $output .= '<img src="/captcha" />';
        return $output;
    }


    public static function renderImage() {

        header('Content-Type: image/png');
        $im = imagecreate(175, 30);
        $bgColor = imagecolorallocate($im, 0, 0, 0);
        if(!empty($_SESSION['captcha']['code'])) {
            $textColor = imagecolorallocate($im, 255, 255, 255);
            imagestring($im, 5, rand(5, 100), rand(5, 10), $_SESSION['captcha']['code'] , $textColor);
        }
        imagepng($im);
        imagedestroy($im);
        exit();

    }

    public function validate() {
        if(parent::validate() && ((string)$this->captchaParams['code'] !== (string)$this->getValue())) {
            $this->setError('Неверные цифры');
            return false;
        }
        return true;
    }

    public function clean()
    {
        parent::clean();
        unset($_SESSION['captcha']);
    }
}