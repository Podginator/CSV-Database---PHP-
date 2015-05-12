<?php

class People extends Controller
{
    public function index()
    {
        $students = $this->model->getAllStudents();
        $lecturers = $this->model->getAllLecturers();

        if(isset($_GET["sort"])){
            //Get Which should be referenced.
            if($_GET["type"] == "Students")
            {

                $students = $this->model->getAllStudents($_GET["sort"],$_GET["o"]);
            }
            else
            {
                $lecturers = $this->model->getAllLecturers($_GET["sort"],$_GET["o"]);
            }
        }

        require MVC . 'View/template/Header.php';
        require MVC . 'View/template/Nav.php';
        require MVC . 'View/People/list_people.php';
        require MVC . 'View/template/Footer.php';
    }
}