<?php

//Do an abstract class; we shouldn't be able to instantiate a 'person' just a Lecturer/Student.
abstract class Person {
    protected $name, $surname, $birthday, $id;
    protected $currentCourses = array();
    protected $previousCourses = array();


    function __construct($id, $name, $surname, $birthday = 0)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->birthday = $birthday;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function setSurname($sname)
    {
        $this->surname = $sname;
    }

    public function getBirthday()
    {
        return $this->birthday;
    }

    public function setBirthday($bday)
    {
        $this->birthday = $bday;
    }

    abstract public function getWorkload();

    public function getPreviousCourses()
    {
        return $this->previousCourses;

    }

    public function getCurrentCourses()
    {
        return $this->currentCourses;
    }

}