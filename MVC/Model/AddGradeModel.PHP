<?php

require ("Model.php");
require ("Classes/Exceptions/Invalid.php");

class GradeModel extends Model
{

    private $gradeResults = array(array(),array());

   function __destruct() {
        if(count($this->gradeResults[0]) != 0)
        {
            $this->writeFail($this->gradeResults[0]);
        }
   }

	public function AddGrades($csvContents)
    {       
       $toAdd = array();
       
        if(!$this->ValidateCSV($csvContents))
        {
             throw new InvalidCSV("Invalid Format Passed.");
        }

        $csvLines = explode("\n", $csvContents);
        //We can assume certain things about the file, but as a backup we will also add a validate function similar to the .js file.
        $index = 0;
        foreach($csvLines as $line)
        {
            if($this->ValidateRecord($line))
            {
                array_push($this->gradeResults[1], $line);
                //array_push($added,$line);
            }
            else
            {
                array_push($this->gradeResults[0], $index.": ". $line);
            }
            $index++;
        }

        if(count($this->gradeResults[1]) > 0)
        {
            $this->AddToCSV($this->gradeResults[1]);
        }
        return $this->gradeResults;
    }

    private function AddToCSV($added)
    {
    	$file = fopen("csvDB/grades.csv", "a+");
        fwrite($file,"\n");
    	for($i = 0; $i < count($added); $i++)
    	{
            $modStr = $i < count($added)-1 ? $added[$i] . "\n" : $added[$i];
    		fwrite($file,$modStr);
    	}
    	fclose($file);
    }

    private function ValidateCSV($csv)
    {
        $csvLines = explode("\n", $csv);

        for($i=0; $i != count($csvLines); $i++)
        {
            $lineSplit = explode(",", $csvLines[$i]);
            if(count($lineSplit) == 4)
            {
                if(!is_numeric($lineSplit[0]) && !is_numeric($lineSplit[1]))
                {
                    return false;
                }
               
            }
            else
            {
                return false;
            }

        }


        return true;
    }

    private function ValidateRecord($record)
    {
        if(!$this->RecordExists($record))
        {
            $record = explode(",", $record);
            $students = $this->getAllStudents();
            $courses = $this->getAllCourses();
            $grades = $this->getAllGrades();

            if(array_key_exists($record[0], $students) &&
                array_key_exists($record[1], $courses) &&
                in_array(trim($record[3]), array("A","B","C","D","E","F")) &&
                array_key_exists($record[1],$students[$record[0]]->getCurrentCourses()))

            {
                return true;
            }
        }


        return false; 
    }

    private function RecordExists($record)
    {
        $record = explode(",",$record);
        $grades = $this->getAllGrades();

        foreach($grades as $grade)
        {
            if(trim($record[0] == $grade["courseID"] &&
                trim($record[1]) == $grade["studentid"] &&
                trim($record[3]) == $grade["grade"]))
            {
                return true;
            }
        }

        return false;
    }


    private function writeFail($records)
    {
        $date  = new DateTime();
        $dir = dirname(dirname(dirname(__FILE__)));
        $file = fopen($dir . "/csvDB/Logs/" . $date->format("Y-m-d") . "-writeFail.txt", "a+", true);
        foreach($records as $record)
        {
            fwrite($file, $date->format("H:i:s") . ": Failure to Add Record: " . $record . "\n");
        }
        fclose($file);
    }
}