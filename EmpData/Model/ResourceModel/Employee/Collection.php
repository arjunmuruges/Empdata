<?php
namespace Arjun\EmpData\Model\ResourceModel\Employee;

use Arjun\EmpData\Model\Employee as Model;
use Arjun\EmpData\Model\ResourceModel\Employee as ResourceModel;


class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct() // phpcs:ignore PSR2.Methods.MethodDeclaration
     {
        $this->_init(Model::class, ResourceModel::class);
    }
}