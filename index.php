<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 08.03.2017
 * Time: 17:22
 */

namespace App;

use App\Forms\Form;
use App\Forms\TextInput;
use App\Forms\Email;
use App\Forms\Textarea;
use App\Forms\Captcha;
use App\Forms\Submit;


require_once 'Autoloader.php';

class AppGuest extends Application
{
    const DB_HOST = 'localhost';
    const DB_NAME = 'guest';
    const DB_USER = 'root';
    const DB_PASS = '';

    static public $db;

    static public function start()
    {
        new self();
    }

    protected function init()
    {
        parent::init();
        session_start();
        ob_start();
        self::$db = new \PDO(sprintf("mysql:host=%s;dbname=%s", static::DB_HOST, static::DB_NAME), static::DB_USER, static::DB_PASS);

    }

    protected function actionDefault()
    {


        $formAttrs = array(
            'method' => 'POST',
            'name' => 'guest'
        );
        $form = new Form($formAttrs);
        $form
            ->addControl('name', TextInput::class, array('label' => 'Имя', 'required' => true))
            ->addControl('email', Email::class, array('label' => 'Email', 'required' => true))
            ->addControl('header', TextInput::class, array('label' => 'Заголовок', 'required' => true))
            ->addControl('text', Textarea::class, array('label' => 'Текст сообщения', 'required' => true))
            ->addControl('captcha', Captcha::class, array('label' => 'Введите цифры', 'required' => true))
            ->addControl('submit', Submit::class, array('value' => 'Отправить'));

        $guest = new Guest();

        $form->execute();
        if ($form->isSubmit()) {
            if($form->isValid()) {
                if($guest->addMessage($form->getValues())) {
                    $form->clean();
                    $this->redirect('');
                }

            }

        }


        return $this->render('index',
            array(
                'content' =>
                    $this->render('messages_list', array('messages' => $guest->getMessagesApprove())).
                    $form->render()
            )
        );


    }

    protected function actionList()
    {
        $guest = new Guest();
        return $this->render('index',
            array(
                'content' => $this->render('messages_list', array('messages' => $guest->getMessages()))
            )
        );
    }

    protected function actionAdmin()
    {
        $guest = new Guest();
        if ($this->getRequestVar('action')) {
            switch ($this->getRequestVar('action')) {
                case 'approve':
                    $guest->approve($this->getRequestVarInt('message_id'), $this->getRequestVarInt('approve', 0));
                    break;
                case 'delete':
                    $guest->delete($this->getRequestVarInt('message_id'));
                    break;
            }
            $this->redirect('admin');
        }


        return $this->render('index',
            array(
                'content' => $this->render('messages_list_admin', array('messages' => $guest->getMessages()))
            )
        );
    }

    protected function actionCaptcha()
    {
        Captcha::renderImage();
    }

    protected function actionView()
    {
        $guest = new Guest();
        $id = $this->getRequestVarInt('message_id');

        return $this->render('index',
            array(
                'content' => $this->render('message', array('message' => $guest->getMessage($id)))
            )
        );
    }




}


AppGuest::start();
