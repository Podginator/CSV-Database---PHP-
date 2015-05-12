<?php

class Course
{
    protected $groups = array();
    protected $amountTaken,$id, $name, $credit,$teacherid,$startdate,$enddate;

    function __construct($id, $name, $credit)
    {
        $this->name = $name;
        $this->id = $id;
        $this->credit = $credit;
    }

    public function getTaken()
    {
        return $this->amountTaken;
    }

    public function setTaken($amountTaken)
    {
        $this->amountTaken = $amountTaken;
    }

    public function getID()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getCredit()
    {
        return $this->credit;
    }

    public function setCredit($credit)
    {
        $this->credit = $credit;
    }

    public function getTeacherid()
    {
        return $this->teacherid;
    }

    public function setTeacherid($teacherid)
    {
        $this->teacherid = $teacherid;
    }

    public function getStartdate()
    {
        return $this->startdate;
    }

    public function setStartdate($startdate)
    {
        $this->startdate = $startdate;
    }

    public function getEnddate()
    {
        return $this->enddate;
    }

    public function setEnddate($enddate)
    {
        $this->enddate = $enddate;
    }

    public function getGroups()
    {
        return $this->groups;
    }

    public function getGroupNums()
    {
        return count($this->groups);
    }

    public function addGroup($group)
    {
        array_push($this->groups, $group);
    }

}