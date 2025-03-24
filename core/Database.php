<?php
declare(strict_types=1);
require_once "./config/database.php";

class Database{

    private PDO $pdo;

    public function __construct(array $options = []){
        global $db_conf;
        
        extract($db_conf);
        $dsn = "mysql:dbname={$db};host={$host}";

        $default_options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ];

        $this->pdo =  new PDO($dsn, $username, $password, $options + $default_options);
    }

    public function execute(string $query, array $params = []): PDOStatement {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }

    public function fetchAll(string $query, array $params = []): array{
        $stmt = $this->execute($query,  $params);
        return $stmt->fetchAll();
    }

    public function fetchOne(string $query, array $params = []): mixed{
        $stmt = $this->execute($query,  $params);
        return $stmt->fetch();
    }

    public function insertLastId(string $query, array $params = []): ?string{
        $this->execute($query,  $params);
        return $this->pdo->lastInsertId();
    }

}
?>