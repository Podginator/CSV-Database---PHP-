<?php

class Courses extends Controller
{
    public function index()
    {
        $courses = $this->model->getAllCourses();

        if(isset($_GET["sort"]))
        {
            $courses = $this->model->getAllCourses($_GET["sort"], $_GET["o"]);
        }

        require MVC . 'View/template/Header.php';
        require MVC . 'View/template/Nav.php';
        require MVC . 'View/Courses/list_courses.php';
        require MVC . 'View/template/Footer.php';
    }


}

