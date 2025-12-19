<?php

class SQLiteManager {
    private $db;
    
    public function __construct($dbName) {
        $this->db = new SQLite3($dbName);
    }
    
    public function __destruct() {
        $this->db->close();
    }
    
    public function createTable($tableName, $columns) {
        $cols = [];
        foreach ($columns as $name => $type) {
            $cols[] = "$name $type";
        }
        $colsStr = implode(", ", $cols);
        $query = "CREATE TABLE IF NOT EXISTS $tableName ($colsStr)";
        $this->db->exec($query);
    }
    
    public function insert($tableName, $data) {
        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), "?"));
        $query = "INSERT INTO $tableName ($columns) VALUES ($placeholders)";
        
        $stmt = $this->db->prepare($query);
        $i = 1;
        foreach ($data as $value) {
            $stmt->bindValue($i++, $value);
        }
        $stmt->execute();
    }
    
    public function insertMany($tableName, $dataList) {
        if (empty($dataList)) return;
        
        $this->db->exec('BEGIN');
        foreach ($dataList as $data) {
            $this->insert($tableName, $data);
        }
        $this->db->exec('COMMIT');
    }
    
    public function selectAll($tableName) {
        $query = "SELECT * FROM $tableName";
        $result = $this->db->query($query);
        
        $rows = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $rows[] = $row;
        }
        return $rows;
    }
    
    public function selectWhere($tableName, $conditions) {
        $where = [];
        foreach (array_keys($conditions) as $col) {
            $where[] = "$col = ?";
        }
        $whereStr = implode(" AND ", $where);
        $query = "SELECT * FROM $tableName WHERE $whereStr";
        
        $stmt = $this->db->prepare($query);
        $i = 1;
        foreach ($conditions as $value) {
            $stmt->bindValue($i++, $value);
        }
        $result = $stmt->execute();
        
        $rows = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $rows[] = $row;
        }
        return $rows;
    }
    
    public function selectWhereOr($tableName, $conditions) {
        if (empty($conditions)) {
            return $this->selectAll($tableName);
        }
        
        $where = [];
        foreach (array_keys($conditions) as $col) {
            $where[] = "$col = ?";
        }
        $whereStr = implode(" OR ", $where);
        $query = "SELECT * FROM $tableName WHERE $whereStr";
        
        $stmt = $this->db->prepare($query);
        $i = 1;
        foreach ($conditions as $value) {
            $stmt->bindValue($i++, $value);
        }
        $result = $stmt->execute();
        
        $rows = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $rows[] = $row;
        }
        return $rows;
    }
    
    public function update($tableName, $updates, $conditions) {
        $set = [];
        foreach (array_keys($updates) as $col) {
            $set[] = "$col = ?";
        }
        $setStr = implode(", ", $set);
        
        $where = [];
        foreach (array_keys($conditions) as $col) {
            $where[] = "$col = ?";
        }
        $whereStr = implode(" AND ", $where);
        
        $query = "UPDATE $tableName SET $setStr WHERE $whereStr";
        $stmt = $this->db->prepare($query);
        
        $i = 1;
        foreach ($updates as $value) {
            $stmt->bindValue($i++, $value);
        }
        foreach ($conditions as $value) {
            $stmt->bindValue($i++, $value);
        }
        $stmt->execute();
    }
    
    public function delete($tableName, $conditions) {
        $where = [];
        foreach (array_keys($conditions) as $col) {
            $where[] = "$col = ?";
        }
        $whereStr = implode(" AND ", $where);
        $query = "DELETE FROM $tableName WHERE $whereStr";
        
        $stmt = $this->db->prepare($query);
        $i = 1;
        foreach ($conditions as $value) {
            $stmt->bindValue($i++, $value);
        }
        $stmt->execute();
    }
    
    public function deleteMany($tableName, $conditionsList) {
        $this->db->exec('BEGIN');
        foreach ($conditionsList as $conditions) {
            $this->delete($tableName, $conditions);
        }
        $this->db->exec('COMMIT');
    }
}
