<?php
class Database
{
    protected $host;
    protected $user;
    protected $password;
    protected $db_name;
    protected $conn;

    public function __construct()
    {
        $this->getConfig();
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->db_name);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        // set charset
        $this->conn->set_charset("utf8mb4");
    }

    private function getConfig()
    {
        include __DIR__ . "/../config.php";
        $this->host = $config['host'];
        $this->user = $config['username'];
        $this->password = $config['password'];
        $this->db_name = $config['db_name'];
    }

    public function query($sql)
    {
        return $this->conn->query($sql);
    }

    public function getAll($table, $where = null)
    {
        $whereClause = $where ? " WHERE " . $where : "";
        $sql = "SELECT * FROM {$table}{$whereClause}";
        $res = $this->conn->query($sql);
        $rows = [];
        if ($res) {
            while ($r = $res->fetch_assoc()) {
                $rows[] = $r;
            }
        }
        return $rows;
    }

    public function get($table, $where)
    {
        $sql = "SELECT * FROM {$table} WHERE {$where} LIMIT 1";
        $res = $this->conn->query($sql);
        if ($res && $row = $res->fetch_assoc()) {
            return $row;
        }
        return null;
    }

    public function insert($table, $data)
    {
        if (is_array($data)) {
            $columns = array_keys($data);
            $values = array_map(function($v) {
                return $this->conn->real_escape_string($v);
            }, array_values($data));

            $columns = implode(",", $columns);
            $values = "'" . implode("','", $values) . "'";
            $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$values})";
            return $this->conn->query($sql);
        }
        return false;
    }

    public function update($table, $data, $where)
    {
        if (is_array($data)) {
            $pairs = [];
            foreach ($data as $k => $v) {
                $pairs[] = "{$k}='" . $this->conn->real_escape_string($v) . "'";
            }
            $update_value = implode(",", $pairs);
            $sql = "UPDATE {$table} SET {$update_value} WHERE {$where}";
            return $this->conn->query($sql);
        }
        return false;
    }

    public function delete($table, $where)
    {
        $sql = "DELETE FROM {$table} WHERE {$where}";
        return $this->conn->query($sql);
    }
}
