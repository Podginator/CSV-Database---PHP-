<?php

class Helper {
    static public function sortBy($comparator, $type)
    {
        switch ($type) {
            case "String":
                return function($a,$b) use ($comparator)
                {
                    //Check if it's a date
                    
                    if(method_exists($a, $comparator) && method_exists($b, $comparator))
                    {
                        if (DateTime::createFromFormat('d-m-Y', $a->$comparator()) !== FALSE) {
                            return DateTime::createFromFormat('d-m-Y', $a->$comparator()) >  DateTime::createFromFormat('d-m-Y', $b->$comparator());
                        }
                        return strcmp(strtoupper($a->$comparator()), strtoupper($b->$comparator()));
                    }else
                    {
                        return strcmp($a[$comparator], $b[$comparator]);
                    }
                };
                break;
            case "Integer":
                return function($a,$b) use ($comparator)
                {
                    if(method_exists($a, $comparator) && method_exists($a, $comparator))
                    {
                        if($a->$comparator() == $b->$comparator()){ return 0; }
                        return $a->$comparator() > $b->$comparator();
                    }
                    else
                    {
                        if($a[$comparator] == $a[$comparator]){ return 0; }
                        return $a[$comparator] > $b[$comparator];
                    }
                    };
                break;
            case "Array":
                return function($a,$b) use ($comparator)
                {
                    if(count($a->$comparator()) == count($b->$comparator()))
                    {
                        return 0;
                    }
                    return count($a->$comparator()) > count($b->$comparator());
                };
            default:
                break;
        }
    }
}
