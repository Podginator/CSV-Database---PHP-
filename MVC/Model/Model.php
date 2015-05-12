<?php
require_once  "Classes/util/CSVParser.php";
require_once  "Classes/people/Lecturer.php";
require_once  "Classes/people/Student.php";
require_once  "Classes/Courses/Course.php";
require_once "Classes/Util/Helper.php";



//This is where all the data logic happens.
//This will be changed when we change to a MYSQL database, but the structure will be the same.
//Since there's a lot of fiddling with CSV there is perhaps a lot of code here, but this will be severely
//reduced when we get to expanding hte code and adding MYSQL databases.
class Model
{

    function __construct($db_loc)
    {
        //This just gives the path to the database.
        $this->db_loc = $db_loc;
    }

    //Sorting is done by the model, since this falls under the purview of DataModels.
    //But could be abstracted slightly more than it currently is
    //We also should ensure there's no erroneous inputs from users, or at the very least have the
    //header function redirect to a 404 or Error Page.
    public function getAllStudents($section=null, $reverse=false)
    {
        $res = array();
        $elements = CSVParser::Parse($this->db_loc . "students.csv");

        //Here we have to populate our students, which involves iterating over courses they're taking too. Sucks, but it's necessary to keep it as abstract as possible.
        foreach($elements as $value)
        {
            $res[$value["ID"]] = new Student($value["ID"], $value["name"], $value["surname"], $value["birthday"]);
        }

        $courses = $this->getAllCourses();
        $elements = CSVParser::Parse($this->db_loc . "registered.csv");

        //Here we'll populate the student courses.
        //Add them to the correct thing.
        //The grades.csv will contain incomplete too

        foreach($elements as $value)
        {
            $res[$value["studentID"]]->addRegisteredCourses($courses[$value["courseID"]]);
        }

        foreach($elements =CSVParser::Parse($this->db_loc . "grades.csv") as $value)
        {
            if(isset($res[$value["studentid"]]))
            {
                $res[$value["studentid"]]->addCompletedCourses($courses[$value["courseID"]], $value["grade"]);
            }
        }


        if($section!=null)
        {
            $func = null;
            if(!($this->genericSort($res, $section)))
            {
                switch($section)
                {
                    case "getGPA":
                        $func = Helper::sortBy("getGPA", "Integer");
                        break;
                    default:
                        header('location: ' . URL . 'error');
                        break;
                }

                usort($res, $func);
            }

            if($reverse)
            {
                krsort($res);
            }
        }
        //Returns an array of Students.
        return $res;
    }

    private function genericSort(&$todo, $section)
    {
        $test = true;
        switch($section)
        {
            case "getID":
            case "getWorkload":
                $func = Helper::sortBy($section, "Integer");
                break;
            case "getName":
            case "getSurname":
            case "getBirthday":
                $func = Helper::sortBy($section, "String");
                break;
            case "getCurrentCourses":
            case "getPreviousCourses":
                $func = Helper::sortBy($section, "Array");
                break;
            default:
                $test = false;
        }

        if($test)
        {
            usort($todo, $func);
        }

        return $test;
    }

    public function getAllLecturers($section=null, $reverse=false)
    {
        $res = array();
        $elements = CSVParser::Parse($this->db_loc . "lecturers.csv");

        foreach($elements as $value)
        {
            $res[$value["ID"]] = new Lecturer($value["title"],$value["ID"], $value["name"], $value["surname"], $value["birthday"]);
        }

        $courses = $this->getAllCourses();

        foreach($courses as $value)
        {
            if(array_key_exists($value->getTeacherid(),$res))
            {
                if(DateTime::createFromFormat('d/m/Y', $value->getEndDate()) < date("Y-m-d H:i:s"))
                {
                    $res[$value->getTeacherid()]->addCurrentCourses($value);
                }
                else
                {
                    $res[$value->getTeacherid()]->addPreviousCourse($value);
                }
            }
        }

        if($section != null)
        {
            $func = null;

            if(!($this->genericSort($res, $section)))
            {
                switch($section)
                {
                    case "getTitle":
                        $func = Helper::sortBy("getTitle", "String");
                        break;
                    default:
                        header('location: ' . URL . 'error');
                        break;
                }

                usort($res, $func);
            }

            if($reverse)
            {
                krsort($res);
            }
        }

        return $res;
    }

    public function getAllCourses($section=null, $reverse=false)
    {
        $res = array();
        $elements = CSVParser::Parse($this->db_loc . "courses.csv");

        foreach($elements as $value)
        {
            if(!isset($res[$value["courseID"]]))
            {
                $res[$value["courseID"]] = new Course($value["courseID"], $value["name"], $value["credit"]);
            }

            $res[$value["courseID"]]->addGroup($value["group"]);
            $res[$value["courseID"]]->setTeacherid($value["teacherid"]);
            $res[$value["courseID"]]->setStartdate($value["startdate"]);
            $res[$value["courseID"]]->setEnddate($value["enddate"]);
        }


        if($section != null) {
            if(!($this->genericSort($res, $section)))
            {
                switch ($section) {
                    case "getCredit":
                    case "getGroupNums":
                        $func = Helper::sortBy($section, "Integer");
                        break;
                    default:
                        header('location: ' . URL . 'error');
                        break;
                }

                usort($res, $func);
            }

            
            //Check if we can reverse.
            if ($reverse) {
                krsort($res);
            }
        }


        return $res;
    }

    //This is a much simpler function as we don't need to worry about passing to objects
    //The more complicated function is found in GradesModel.php
    public function getAllGrades()
    {
        return CSVParser::Parse($this->db_loc . "grades.csv");
    }

}