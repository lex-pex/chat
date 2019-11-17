<?php

namespace Server\Control;

include $_SERVER['DOCUMENT_ROOT'] . '/server/db/Message.php';

use Server\Db\Message;

class Chat {

    /**
     * Return subset of all recent messages, witch are new for this client
     * @return array
     */
    public function fetchMessages() {
        $offset = $_POST['length'];
        return Message::all($offset);
    }

    /**
     * Insert the message
     */
    public function storeMessage() {
        $name_flag = isset($_POST['name']) === true && empty($_POST['name']) === false;
        $text_flag = isset($_POST['text']) === true && empty($_POST['text']) === false;
        if (!$name_flag && !$text_flag) return 'Name or Text failed';
        $name = $_POST['name'];
        $text = $_POST['text'];
        $m = new Message([$name, $text]);
        return $m->save();
    }

}
















































