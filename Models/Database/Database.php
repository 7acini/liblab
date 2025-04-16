<?php 

require_once __DIR__."/../../Config/Config.php";

use PDO;
use PDOException;

class Database{

    private static $instance = null;
    private $pdo;
    private $option = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_CASE => PDO::CASE_NATURAL,
        PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING
    ];


    public function __construct() {

        Config::load();

        $hostname = Config::get('DB_HOST', '127.0.0.1');
        $username = Config::get('DB_USER', 'root');
        $password = Config::get('DB_PASS', '');
        $database = Config::get('DB_NAME', 'liblab');

        try {
            $this->pdo = new PDO("mysql:host=$hostname;dbname=$database;charset=utf8", $username, $password, $this->option);
        } catch (PDOException $e) {
            die("Erro na conexão com o banco de dados: " . $e->getMessage());
        }
    }
    
    public static function getInstance(){
        if(self::$instance === null){
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function getConnection() {
        return $this->pdo;
    }
}