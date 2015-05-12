<?php
require_once "Person.php";
class Lecturer extends Person
{
    protected $title;
    protected $currentCourses = array();
    protected $previousCourses = array();

    function __construct($title, $id, $name, $surname, $birthday = 0)
    {
        $this->title = $title;
        parent::__construct($id,$name,$surname,$birthday);
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getWorkload()
    {
        $res = 0;
        foreach($this->currentCourses as $value)
        {
            $res += $value->getCredit() * 5.0;
        }

        return $res;
    }

    public function addPreviousCourse(Course $course)
    {
        $this->previousCourses[$course->getId()] = $course;
    }

    public function addCurrentCourses(Course $course)
    {
        $this->currentCourses[$course->getId()] = $course;
    }


}