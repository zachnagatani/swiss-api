<?php
    class Db {
        private static $dbhost = "localhost";
        private static $dbuser = "root";
        private static $dbpass = "";
        private static $dbname = "swiss-tournament";

        public static function connect() {
            $conn = new PDO("mysql:host=" . self::$dbhost . ";dbname=" . self::$dbname, self::$dbuser, self::$dbpass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }
    }
?>