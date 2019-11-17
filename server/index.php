<?php

include "Control/chat.php";
use Server\Control\Chat;

if (isset($_POST['method']) === true && empty($_POST['method'] === false)) {

    switch($_POST['method']) {
        case 'fetch':
            echo json_encode((new Chat())->fetchMessages());
            break;
        case 'send':
            echo (new Chat())->storeMessage();
            break;
        default:
            throw new Exception('There is not such an action');
    }
}



