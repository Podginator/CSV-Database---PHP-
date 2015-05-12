<?php

//We're going to make some assumptions about the CSV parser.
//CSV Doesn't exactly have great standards, so we have to assume some stuff
//We're going to parse the CSV files assuming they have a header,
//and parse them out as an array of Hashtables:: Header => Value

class CSVParser
{

    static public function Parse($filepath)
    {
        $res = array();
        $file = fopen($filepath, "r") or die("Cannot open");

        $templateArr =(fgetcsv($file));

        $index=0;
        while(!feof($file))
        {
            $storageArray = array();
            $elems = fgetcsv($file);
            for ($i = 0; $i <= count($templateArr)-1; $i++)
            {
                $storageArray[$templateArr[$i]] = $elems[$i];
            }

            $res[$index++] = $storageArray;
        }

        fclose($file);

        return $res;
    }

}