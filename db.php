<?php
class Database {
    private $host = "localhost"; // cPanel domain without https://
    private $db_name = "database_name"; // provided database name
    private $username = "database_user"; // provided database username
    private $password = "user_password"; // provided database password
    public $conn;

    // Get the database connection
    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
