<?php

class Student
{
    private $id;
    private $name;
    private $grade;
    private $dob;
    private $class;

    public function __construct($student_data = [])
    {
        $this->id = $student_data['id'];
        $this->name = $student_data['name'];
        $this->grade = $student_data['grade'];
        $this->dob = $student_data['dob'];
        $this->class = $student_data['class'];
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getGrade()
    {
        return $this->grade;
    }

    /**
     * @param mixed $grade
     */
    public function setGrade($grade)
    {
        $this->grade = $grade;
    }

    /**
     * @return mixed
     */
    public function getDayOfBirth()
    {
        return $this->dob;
    }

    /**
     * @param mixed $dob
     */
    public function setDayOfBirth($dob)
    {
        $this->dob = $dob;
    }

    /**
     * @return mixed
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param mixed $class
     */
    public function setClass($class)
    {
        $this->class = $class;
    }

    public function toArray () {
        return [
            "id" => $this->getId(),
            "name" => $this->getName(),
            "grade" => $this->getGrade(),
            "dob" => $this->getDayOfBirth(),
            "class" => $this->getClass(),
        ];
    }
}