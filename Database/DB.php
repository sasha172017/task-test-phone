<?php

namespace Database;

use PDO;
use PDOException;

class DB {

    protected static $instance;

    private static $dsn = 'mysql:host=localhost;dbname=phone';

    private static $username = 'root';

    private static $password = '1';

    private function __construct() {
        try {
            self::$instance = new PDO(self::$dsn, self::$username, self::$password);
        } catch (PDOException $e) {
            echo "MySql Connection Error: " . $e->getMessage();
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            new DB();
        }

        return self::$instance;
    }

}
