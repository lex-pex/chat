<?php
namespace Server\Db;

include $_SERVER['DOCUMENT_ROOT'] . '/server/db/Connection.php';
include $_SERVER['DOCUMENT_ROOT'] . '/server/db/Migration.php';

use db\Migration;

class Message
{
    public $name;
    public $text;

    public function __construct(array $fields = null) {
        if($fields) {
            $this->name = $fields[0];
            $this->text = $fields[1];
        }
    }

    public function save() {
        $c = Connection::getConnection();
        $sql = "INSERT INTO `messages` (`name`, `text`) VALUES ('$this->name', '$this->text');";
        return $c->query($sql);
    }

    /**
     * Retrieve all messages besides already gotten
     * @param $offset
     * @return array
     */
    public static function all($offset) {
        $c = Connection::getConnection();
//        Migration::create_messages_table($conn);
        if($offset)
            $items = $c->query("SELECT * FROM messages ORDER BY created LIMIT 500 OFFSET $offset;");
        else
            $items = $c->query("SELECT * FROM messages");
        $res = [];
        while ($row = $items->fetch_assoc())
            $res[] = $row;
        $c->close();
        return $res;
    }

}






















