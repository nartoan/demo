<?php

require_once ("Repositories/DBConnect.php");

abstract class AbstractBaseRepository implements RepositoryInterface {
    protected $conn;
    protected $table;
    
    function __construct() {
        $DB_instance = DBConnect::getInstance();
        $this->conn = $DB_instance->getConnection();
    }   
    
    public function getById($id){
        $stm = $this->conn->prepare('SELECT * FROM '.$this->table.' WHERE `id` = :id');
        $stm->bindValue(':id', $id);
        $success = $stm->execute();
        $row = $stm->fetch(PDO::FETCH_ASSOC);

        return ($success) ? $row: [];
    }

    public function readAll(){
        $stm = $this->conn->prepare('SELECT * FROM '.$this->table);
        $success = $stm->execute();
        $rows = $stm->fetchAll(PDO::FETCH_ASSOC);

        return ($success) ? $rows: [];
    }

    public function paginate($limit = 15, $page = 1) {
        $stm = $this->conn->prepare('SELECT * FROM '.$this->table.' LIMIT :limit OFFSET :offset');
        $stm->bindValue(':limit', $limit);
        $stm->bindValue(':offset', ($page - 1) * $limit);

        $success = $stm->execute();
        $rows = $stm->fetchAll(PDO::FETCH_ASSOC);

        $counts = $this->counts();

        if ($success) {
            return ['data' => $rows, 'count' => $counts, 'limit' => $limit, 'page' => $page];
        }

        return ['data' => [], 'count' => $counts, 'limit' => $limit, 'page' => $page];
    }

    public function create($data) {
        $columns = array_keys($data);
        $columnSql = implode(',', $columns);
        $bindingSql = ':'.implode(',:', $columns);

        $sql = "INSERT INTO $this->table ($columnSql) VALUES ($bindingSql)";
        $stm = $this->conn->prepare($sql);
        foreach ($data as $key => $value) {
            $stm->bindValue(':'.$key, $value);
        }
        $status = $stm->execute();

        return ($status) ? $this->conn->lastInsertId() : false;
    }

    public function update($id, $data) {
        if (isset($data['id']))
            unset($data['id']);

        $columns = array_keys($data);
        $columns = array_map(function($item){
            return $item.'=:'.$item;
        }, $columns);
        $bindingSql = implode(',', $columns);

        $sql = "UPDATE $this->table SET $bindingSql WHERE `id` = :id";
        $stm = $this->conn->prepare($sql);
        $data['id'] = $id;
        foreach ($data as $key => $value){
            $stm->bindValue(':'.$key, $value);
        }
        $status = $stm->execute();

        return $status;
    }

    public function delete($id)
    {
        $stm = $this->conn->prepare('DELETE FROM '.$this->table.' WHERE id = :id');
        $stm->bindParam(':id', $id);
        $success = $stm->execute();
        
        return ($success);
    }

    public function save($data){
        if (isset($data['id'])){
            $this->update($this->table, $data['id'], $data);
        }else{
            return $this->create($this->table, $data);
        }
    }

    public function counts() {
        $stm = $this->conn->prepare('SELECT COUNT(*) as count FROM '.$this->table);
        $success = $stm->execute();
        $counts = $stm->fetch(PDO::FETCH_ASSOC);
        
        return ($success) ? $counts['count']: 0;
    }
}
?>