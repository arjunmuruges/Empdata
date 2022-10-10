<?php
namespace Arjun\EmpData\Api\Data;

interface EmployeeInterface
{
    Const EmpId ='emp_id';
    Const Name ='Name';
    Const Email ='Email';
     Const Telephone ='Telephone';

    public function getEmpId();

 
    public function setEmpId($EmpId);

  
    public function getName();

 
    public function setName($Name);

 
    public function getEmail();

    
    public function setEmail($Email);

    public function getTelephone();

    public function setTelephone($Telephone);
}