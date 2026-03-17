<?php
/**
 * SmartFlat CMS v3 - Database Connection
 */

class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        $config = $this->getConfig();

        try {
            $dsn = "mysql:host={$config['host']};dbname={$config['name']};charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
            ];

            $this->pdo = new PDO($dsn, $config['user'], $config['pass'], $options);
        } catch (PDOException $e) {
            error_log("Database connection failed: " . $e->getMessage());
            throw new Exception("Database connection failed");
        }
    }

    private function getConfig() {
        // Try to load from environment or config file
        $configFile = __DIR__ . '/../../config/database.php';

        if (file_exists($configFile)) {
            return require $configFile;
        }

        // Check for environment variables first
        $host = getenv('DB_HOST');
        $name = getenv('DB_NAME');
        $user = getenv('DB_USER');
        $pass = getenv('DB_PASS');

        // If all env vars are set, use them
        if ($host && $name && $user) {
            return [
                'host' => $host,
                'name' => $name,
                'user' => $user,
                'pass' => $pass ?: ''
            ];
        }

        // In production, require explicit configuration
        $isProduction = getenv('APP_ENV') === 'production' ||
                        (isset($_SERVER['HTTP_HOST']) &&
                         !preg_match('/^(localhost|127\.0\.0\.1|192\.168\.)/', $_SERVER['HTTP_HOST']));

        if ($isProduction) {
            error_log('SECURITY WARNING: Database config file or environment variables not found in production');
            throw new Exception('Database configuration required. Set DB_HOST, DB_NAME, DB_USER, DB_PASS environment variables or create config/database.php');
        }

        // Development fallback only
        error_log('WARNING: Using default database credentials. This should only happen in development.');
        return [
            'host' => 'localhost',
            'name' => 'smartflat_claude_html',
            'user' => 'root',
            'pass' => ''
        ];
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->pdo;
    }

    public function query($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function fetchAll($sql, $params = []) {
        return $this->query($sql, $params)->fetchAll();
    }

    public function fetchOne($sql, $params = []) {
        return $this->query($sql, $params)->fetch();
    }

    public function fetchColumn($sql, $params = []) {
        return $this->query($sql, $params)->fetchColumn();
    }

    public function insert($table, $data) {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));

        $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";
        $this->query($sql, array_values($data));

        return $this->pdo->lastInsertId();
    }

    public function update($table, $data, $where, $whereParams = []) {
        $set = implode(', ', array_map(function($col) {
            return "{$col} = ?";
        }, array_keys($data)));

        $sql = "UPDATE {$table} SET {$set} WHERE {$where}";
        $params = array_merge(array_values($data), $whereParams);

        return $this->query($sql, $params)->rowCount();
    }

    public function delete($table, $where, $params = []) {
        $sql = "DELETE FROM {$table} WHERE {$where}";
        return $this->query($sql, $params)->rowCount();
    }

    public function beginTransaction() {
        return $this->pdo->beginTransaction();
    }

    public function commit() {
        return $this->pdo->commit();
    }

    public function rollback() {
        return $this->pdo->rollBack();
    }

    public function lastInsertId() {
        return $this->pdo->lastInsertId();
    }
}

// Helper function for quick access
function db() {
    return Database::getInstance();
}
?>
