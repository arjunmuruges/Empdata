<?php

namespace Arjun\EmpData\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface EmployeeSearchResultInterface extends SearchResultsInterface
{
    
    public function getItems();
  
    public function setItems(array $items);
}



