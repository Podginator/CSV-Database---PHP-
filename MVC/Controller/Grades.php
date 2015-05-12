<?php

class Grades extends Controller
{

    protected function loadModel()
    {
        //Could require this in the namespace rather than in this
        require MVC .  'Model/GradesModel.php';
        //Create a new model and pass it the database location.
        $this->model = new GradesModel($this->db_loc);
    }

    public function index()
    {
        $grades = $this->model->getStudentGrades();
        $students = $this->model->getAllStudents();
        $courses = $this->model->getAllCourses();

        if(isset($_GET["sort"]))
        {
            $grades = $this->model->getStudentGrades($_GET["sort"], $_GET["o"]);
        }


        require MVC . 'View/template/Header.php';
        require MVC . 'View/template/Nav.php';
        require MVC . 'View/Grades/list_grades.php';
        require MVC . 'View/template/Footer.php';
    }

    public function GetCourseGrade($courseID)
    {
        require MVC . 'View/template/Header.php';
        require MVC . 'View/template/Nav.php';

        if(isset($courseID))
        {
            $grades = $this->model->getGradebyCourse($courseID);
            $students = $this->model->getAllStudents();
            $courses = $this->model->getAllCourses();
            require MVC . 'View/Grades/list_grades.php';
            require MVC . 'View/template/Footer.php';
            }
        else
        {
            require MVC . 'View/template/Error.php';
            require MVC . 'View/template/Footer.php';
        }
    }

    public function GetPersonGrade($personID)
    {
        require MVC . 'View/template/Header.php';
        require MVC . 'View/template/Nav.php';

        if(isset($personID))
        {
            $grades = $this->model->getGradebyPerson($personID);
            $students = $this->model->getAllStudents();
            $courses = $this->model->getAllCourses();
          
            require MVC . 'View/Grades/list_grades.php';
            require MVC . 'View/template/Footer.php';
            }
        else
        {
            require MVC . 'View/template/Error.php';
            require MVC . 'View/template/Footer.php';
        }
    }

    public function GetLetterGrade($grade)
    {
        require MVC . 'View/template/Header.php';
        require MVC . 'View/template/Nav.php';

        if(isset($grade))
        {
            $grades = $this->model->getLetterGrade($grade);
            $students = $this->model->getAllStudents();
            $courses = $this->model->getAllCourses();
          
            require MVC . 'View/Grades/list_grades.php';
            require MVC . 'View/template/Footer.php';
            }
        else
        {
            require MVC . 'View/template/Error.php';
            require MVC . 'View/template/Footer.php';
        }
    }




}
