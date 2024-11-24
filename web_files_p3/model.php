<?php

require "envLoader.php";

class SimpleDB {
    private $pdo = null;
    private $stmt = null;

    function __construct() {
        (new DotEnv(__DIR__ . '/.env'))->load();
        try {
            $this->pdo = new PDO(
                "mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'],
                $_ENV['DB_USER'],
                $_ENV['DB_PASSWORD'],
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function __destruct() {
        if ($this->stmt !== null) {
            $this->stmt = null;
        }
        if ($this->pdo !== null) {
            $this->pdo = null;
        }
    }

    function query($sql, $cond = null) {
        try {
            $this->stmt = $this->pdo->prepare($sql);
            $this->stmt->execute($cond);
            return $this->stmt->fetchAll(); // Return selected items
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
?>
