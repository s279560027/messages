<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 08.03.2017
 * Time: 17:25
 */

namespace App;


abstract class Application
{
    private static $instance = null;
    private $responce = null;

    private function __clone()
    {
    }

    private function __wakeup() {

    }

    private function __construct()
    {
    }

    static public function start()
    {

        if (null === self::$instance) {
            self::$instance = new static();
            try {
                self::$instance->init();

                self::$instance->doAction();
            } catch (\Exception $e) {
                self::$instance->responce = self::$instance->render(
                    'error',
                    array(
                        'error' => $e->getMessage(),
                        'errorCode' => $e->getCode()
                    )
                );
            }
        }

        ob_end_flush();
        print self::$instance->responce;
    }

    protected function init()
    {
        $this->setConfig();
    }


    private function setConfig()
    {
    }

    private function doAction()
    {
        $uri = parse_url($_SERVER['REQUEST_URI']);
        $uri = trim($uri['path'], '/');
        $method = 'action' . ucfirst($uri);

        if (!method_exists(get_called_class(), $method)) {
            $method = 'actionDefault';
        }
        $this->responce = call_user_func(array($this, $method));

    }


    protected function render($templateName, $variables)
    {
        $template = new Template($variables);
        $template->setTemplate($templateName);
        return $template->render();
    }

    protected function getRequestVar($name, $default = '')
    {
        if (isset($_REQUEST[$name])) {
            return $_REQUEST[$name];
        }
        return $default;
    }

    protected function getRequestVarInt($name, $default = 0)
    {
        return intval($this->getRequestVar($name, $default));
    }

    protected function redirect($path)
    {
        header('Location: /' . $path);
        exit();
    }

}