<?php 
require_once ("Repositories/AbstractBaseRepository.php");

class StudentRepository extends AbstractBaseRepository implements StudentRepositoryInterface
{
    function __construct() {
        parent::__construct();
        $this->table = "students";
    }

    function getByName($name, $limit = 15, $page = 1) {
        $stm = $this->conn->prepare('SELECT * FROM '.$this->table.' WHERE `name` LIKE :name LIMIT :limit OFFSET :offset');
        $stm->bindValue(':name', '%'.$name.'%');
        $stm->bindValue(':limit', $limit);
        $stm->bindValue(':offset', ($page - 1) * $limit);

        $success = $stm->execute();
        $rows = $stm->fetchAll(PDO::FETCH_ASSOC);

        $counts = $this->countsByName($name);

        if ($success) {
            return ['data' => $rows, 'count' => $counts, 'limit' => $limit, 'page' => $page];
        }

        return ['data' => [], 'count' => $counts, 'limit' => $limit, 'page' => $page];
    }

    function countsByName($name) {
        $stm = $this->conn->prepare('SELECT COUNT(*) as count FROM '.$this->table.' WHERE `name` LIKE :name');
        $stm->bindValue(':name', '%'.$name.'%');

        $success = $stm->execute();
        $counts = $stm->fetch(PDO::FETCH_ASSOC);

        return ($success) ? $counts['count']: 0;
    }
}
?>