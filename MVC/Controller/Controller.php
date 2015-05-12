<?php
abstract class Controller {

    protected $model = null;
    //This will be changed to an actual database when we add a SQL db.
    public $db_loc = null;

    function __construct()
    {
        $this->db_loc = "csvDB/";
        $this->loadModel();
    }

    protected function loadModel()
    {
        //Could require this in the namespace rather than in this
        require MVC .  '/Model/Model.php';

        //Create a new model and pass it the database location.
        $this->model = new Model($this->db_loc);
    }



}