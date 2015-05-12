<?php

class AddGrades extends Controller
{
	protected function loadModel()
    {
        //Could require this in the namespace rather than in this
        require MVC .  'Model/AddGradeModel.php';
        //Create a new model and pass it the database location.
        $this->model = new GradeModel($this->db_loc);
    }

    public function index()
    {
        require MVC . 'View/template/Header.php';
        require MVC . 'View/template/Nav.php';
        require MVC . 'View/Grades/upload_grades.php';
        require MVC . 'View/template/Footer.php';
    }

    public function AddRecord()
    {
    	if(isset($_POST["hide"]))
    	{
            try {
                $res = $this->model->AddGrades($_POST["hide"]);
                $this->Added($res[0], $res[1]);
            } catch (Exception $e) {
                require("Error.php");
                error::Exception($e);
    	   }
        }
    }

    public function Added($errors, $success)
    {
    	require MVC . 'View/template/Header.php';
        require MVC . 'View/template/Nav.php';
        require MVC . 'View/Grades/GradeOutput.php';
        require MVC . 'View/template/Footer.php';
    }
}