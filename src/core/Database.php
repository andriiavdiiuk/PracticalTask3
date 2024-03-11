<?php declare(strict_types=1);
require_once "Application.php";
class Database
{

    private PDO $PDO;

    function getPDO() : PDO
    {
        return $this->PDO;
    }
    function __construct()
    {
        $this->connect();
    }
    private function connect() : void
    {
        try
        {
            $config = Application::getDatabase();
            $this->PDO = new PDO("mysql:host={$config['host']};dbname={$config['dbname']}", $config['user'], $config['password']);
        }
        catch (PDOException $e)
        {
            die("Connection failed: " . $e);
        }

    }
}