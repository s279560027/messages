<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 08.03.2017
 * Time: 23:36
 */

namespace App;


class Guest
{
    public function __construct()
    {

    }


    public function addMessage($params)
    {

        $insertParams = array_intersect_key($params, array(
            'name' => '',
            'email' => '',
            'header' => '',
            'text' => ''
        ));

        $insertParams['approve'] = 0;

        $columns = array_keys($insertParams);
        $columns = '`'.implode('`,`', $columns).'`';
        $placeholders = trim(str_repeat('?, ', count($insertParams)), ', ');


        $stmt = AppGuest::$db->prepare("INSERT INTO messages({$columns}) VALUES({$placeholders})");
        $stmt->execute(array_values($insertParams));

        if(AppGuest::$db->lastInsertId() > 0) {
            return true;
        }

    }


    public function getMessages()
    {
        $stmt = AppGuest::$db->query("SELECT * FROM messages");
        return $stmt->fetchAll();
    }

    public function getMessagesApprove()
    {
        $stmt = AppGuest::$db->query("SELECT * FROM messages WHERE approve = 1");
        return $stmt->fetchAll();
    }

    public function approve($message_id, $approve) {
        $stmt = AppGuest::$db->prepare("UPDATE messages SET approve = ? WHERE id = ?");
        $stmt->execute(array($approve, $message_id));
    }

    public function delete($message_id) {
        $stmt = AppGuest::$db->prepare("DELETE FROM messages WHERE id = ?");
        $stmt->execute(array($message_id));
    }

    public function getMessage($message_id)
    {
        $stmt = AppGuest::$db->prepare("SELECT * FROM messages WHERE id = ?");
        $stmt->execute(array($message_id));
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}