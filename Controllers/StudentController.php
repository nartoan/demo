<?php
require_once ("Repositories/Student/StudentRepositoryInterface.php");
require_once ("Models/Student.php");

Class StudentController {
    private $student;
    public function __construct(StudentRepositoryInterface $student) {
        $this->student = $student;
    }

    public function index() {
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_SPECIAL_CHARS);
        switch ($action) {
            case "student-add":
                $this->store();
                break;
            
            case "student-edit":
                $this->update();
                break;
            
            case "student-delete":
                $this->delete();
                break;
           
            default:
                $this->view();
                break;
        }
    }

    function view() {
        $limit = isset($_GET['limit']) ? $_GET['limit'] : 15;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;

        if (isset($_GET['name'])) {
            $result = $this->student->getByName($_GET['name'], $limit, $page);
            $search_key = $_GET['name'];
        } else {
            $result = $this->student->paginate($limit, $page);
        }
        require_once "views/student.php";
    }

    function store() {
        if (isset($_POST['add'])) {
            $name = $_POST['name'];
            $grade = $_POST['grade'];
            $class = $_POST['class'];
            $dob = "";
            if ($_POST["dob"]) {
                $dob_timestamp = strtotime($_POST["dob"]);
                $dob = date("Y-m-d", $dob_timestamp);
            }
            
            $student_new = new Student(['name' => $name, 'grade' => $grade, 'dob' => $dob, 'class' => $class]);
            $insertId = $this->student->create($student_new->toArray());
            if (empty($insertId)) {
                $response = array(
                    "message" => "Problem in Adding New Record",
                    "type" => "error"
                );
            } else {
                header("Location: index.php");
            }
        }
        require_once "views/student-add.php";
    }

    function update() {
        $student_id = $_GET["id"];
        
        if (isset($_POST['add'])) {
            $name = $_POST['name'];
            $grade = $_POST['grade'];
            $class = $_POST['class'];
            $dob = "";
            if ($_POST["dob"]) {
                $dob_timestamp = strtotime($_POST["dob"]);
                $dob = date("Y-m-d", $dob_timestamp);
            }
            
            $this->student->update($student_id, ['name' => $name, 'grade' => $grade, 'dob' => $dob, 'class' => $class]);

            header("Location: index.php");
        }
        
        $result = $this->student->getById($student_id);
        require_once "views/student-edit.php";
    }

    function delete() {
        $student_id = $_GET["id"];
        $this->student->delete($student_id);

        $limit = isset($_GET['limit']) ? $_GET['limit'] : 15;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $result = $this->student->paginate($limit, $page);
        require_once "views/student.php";
    }
}