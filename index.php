<?php
    require_once ("Controllers/StudentController.php");
    require_once ("Repositories/Student/StudentRepository.php");

    $studentRepository = new StudentRepository();
    $studentController = new StudentController($studentRepository);
    $studentController->index();
?>