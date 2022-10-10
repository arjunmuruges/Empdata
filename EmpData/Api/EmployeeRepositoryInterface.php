<?php
namespace Arjun\EmpData\Api;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Arjun\EmpData\Api\Data\EmployeeInterface;
use Magento\Framework\Api\SearchCriteriaInterface;


interface EmployeeRepositoryInterface
{
    
    public function save(EmployeeInterface $car);

    public function getById($EmpId);

 
    public function getList(SearchCriteriaInterface $criteria);

    public function delete(EmployeeInterface $car);

 
    public function deleteById($EmpId);
}