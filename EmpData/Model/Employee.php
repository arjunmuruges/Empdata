<?php
namespace Arjun\EmpData\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Arjun\EmpData\Api\Data\EmployeeInterface;
use Arjun\EmpData\Model\ResourceModel\Employee as ResourceModel;


class Employee extends AbstractModel implements EmployeeInterface, IdentityInterface
{
    const CACHE_TAG = 'Emp_data';

    
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getEmpId()
    {
        return $this->getData('emp_id');
    }
    public function setEmpId($EmpId)
    {
        return $this->setData(self::EmpId, $EmpId);
    }
    public function getName()
    {
        return $this->getData('Name');
    }
    public function setName($Name)
    {
        return $this->setData(self::Name, $Name);
    }
    public function getEmail()
    {
        return $this->getData('Email');
    }
    public function setEmail($Email)
    {
        return $this->setData(self::Email, $Email);
    }

    public function getTelephone()
    {
        return $this->getData('Telephone');
    }
    public function setTelephone($Telephone)
    {
        return $this->setData(self::Telephone, $Telephone);
    }
}