<?php
require_once "Person.php";
class Student extends Person
{
    protected $status;

    public function getGPA()
    {
        $totalCredits = $totalGrade = 0;

        foreach($this->previousCourses as $value)
        {
            switch ($value[1]) {
                case "A":
                    $gradeVal = 5;
                    break;
                case "B":
                    $gradeVal = 4;
                    break;
                case "C":
                    $gradeVal = 3;
                    break;
                case "D":
                    $gradeVal = 2;
                    break;
                case "E":
                    $gradeVal = 1;
                    break;
                case "F":
                    $gradeVal = 0;
                    break;
                default:
                    $gradeVal= 0;
            }
            $totalCredits += $value[0]->getCredit();
            $totalGrade += $value[0]->getCredit() * $gradeVal;
        }

        return ($totalCredits > 0) ? round($totalGrade/$totalCredits,2) : 0;
    }

    public function getStatus()
    {
        $gpa = $this->getGPA();

        if($gpa >= 0 && $gpa < 2)
        {
            return "Unsatisfactory";
        }
        else if ($gpa >= 2 && $gpa < 3)
        {
            return "Satisfactor";
        }
        else if ($gpa >= 3 && $gpa < 4)
        {
            return "Honour";
        }
        else if ($gpa >= 4 && $gpa <= 5)
        {
            return "High Honors";
        }

        //If it's none of these (Invalid) return NA;

        return "NA";

    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getWorkload()
    {
        $res = 0;
        foreach($this->currentCourses as $value)
        {
            $res += $value->getCredit() * 1.6;
        }

        return $res;
    }

    public function addRegisteredCourses($course)
    {
        $this->currentCourses[$course->getId()] = $course;
    }


    public function addCompletedCourses($course, $grade)
    {
        if(isset($this->currentCourses[$course->getId()]))
        {
            unset($this->currentCourses[$course->getId()]);
        }

        $this->previousCourses[$course->getId()] = array($course,$grade);
    }

}