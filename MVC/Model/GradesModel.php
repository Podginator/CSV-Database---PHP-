<?php

require ("Model.php");

class GradesModel extends Model
{

    public function getStudentGrades($section=null, $reverse=false)
    {
        $necArray = array();

        $grades = $this->getAllGrades();
        $courses = $this->getAllCourses();
        $students = $this->getAllStudents();

        foreach ($grades as $grade)
        {
            $intermediate = array();
            $date = date_create_from_format("d-m-Y", $courses[$grade["courseID"]]->getStartdate());
            
            $intermediate["courseID"] = $grade["courseID"];
            $intermediate["studentID"] = $grade["studentid"];
            $intermediate["courseName"] = $courses[$grade["courseID"]]->getName();
            $intermediate["studentName"] = $students[$grade["studentid"]]->getName();
            $intermediate["surname"] = $students[$grade["studentid"]]->getSurname();
            $intermediate["group"] = $grade["group"];
            $intermediate["year"] = $date->format("Y");
            $intermediate["semester"] = $date->format("m") > 6 && $date->format("m") <= 12 ? "Spring" : "Autumn";
            $intermediate["grade"] = $grade["grade"];

            array_push($necArray, $intermediate);

        }

        if($section != null) {
            switch ($section) {
                case "courseName":
                case "studentName":
                case "surname":
                case "group":
                case "year":  
                case "semester":
                case "grade":
                     $func = Helper::sortBy($section, "String");
                    break;
                default:
                    header('location: ' . URL . 'error');
                    break;
            }


            usort($necArray, $func);
            //Check if we can reverse.
            if ($reverse) {
                krsort($necArray);
            }
        }

        return $necArray;
    }

	public function getGradebyCourse($course)
    {
        $grades = $this->getStudentGrades();

        $res = array();

        foreach($grades as $grade)
        {
            if($grade["courseID"] == $course)
            {
                array_push($res, $grade);
            } 
        }

        return $res;

    }

    public function getGradebyPerson($person)
    {
        $grades = $this->getStudentGrades();

        $res = array();

        foreach($grades as $grade)
        {
            if($grade["studentID"] == $person)
            {
                array_push($res, $grade);
            } 
        }

        return $res;
    }
    
    public function getLetterGrade($letter)
    {
    	$grades = $this->getStudentGrades();

        $res = array();

        foreach($grades as $grade)
        {
            if($grade["grade"] == $letter)
            {
                array_push($res, $grade);
            } 
        }

        return $res;
    }

}