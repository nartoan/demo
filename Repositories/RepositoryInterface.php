<?php
interface RepositoryInterface {

    public function getById($id);

    public function readAll();

    public function paginate($limit = 15, $page = 1);

    public function create($data);

    public function update($id, $data);

    public function delete($id);

    public function save($data);

    public function counts();
}
?>