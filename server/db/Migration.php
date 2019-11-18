<?php

namespace db;

class Migration {

    /**
     * Create Messages Table for current application
     */
    public static function create_messages_table($db) {
        $sql =  "CREATE TABLE IF NOT EXISTS messages (
                 id INT(11) AUTO_INCREMENT PRIMARY KEY,
                 name VARCHAR(100) NOT NULL,
                 text VARCHAR(510) NOT NULL,
                 created TIMESTAMP DEFAULT CURRENT_TIMESTAMP);";
        if ($db->query($sql) === TRUE) {
            echo "Table Messages created successfully";
        } else {
            echo "Error creating table: " . $db->error;
        }
    }

}
