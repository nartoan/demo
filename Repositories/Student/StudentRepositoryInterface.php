<?php 
require_once ("Repositories/RepositoryInterface.php");

interface StudentRepositoryInterface extends  RepositoryInterface
{
    function getByName($name);
}
?>