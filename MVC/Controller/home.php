<?php

class Home extends Controller
{
    public function index()
    {
        require MVC . 'View/template/Header.php';
        require MVC . 'View/template/Nav.php';
        require MVC . 'View/Home/home.php';
        require MVC . 'View/template/Footer.php';
    }
}