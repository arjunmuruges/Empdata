<?php 

// namespace Arjun\EmpData\Block;

// use Magento\Framework\View\Element\Template;
// use Arjun\EmpData\Model\ResourceModel\Employee\Collection; 

// class Emp extends Template
// {
    
//     private $collection;

//     public function __construct(
//         Template\Context $context,
//         Collection $collection,
//         array $data = [])
//     {
//         parent::__construct($context, $data);
//         $this->collection= $collection;
//     }
//     public function getAllCars() {
//         return $this->collection;   
//     }
//     public function getAddCarPostUrl() {
//         return $this->getUrl('empdata/index/savedata');
//     }

//     public function getDeleteUrl() {
//         return $this->getUrl('empdata/index/delete');
//     }
// } 
namespace Arjun\EmpData\Block;

use \Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;
use \Arjun\EmpData\Model\ResourceModel\Employee\CollectionFactory as EmployeeCollectionFactory;
use \Arjun\EmpData\Model\EmployeeFactory;
use Arjun\EmpData\Api\EmployeeRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\FilterBuilder;
use Symfony\Component\CssSelector\Node\FunctionNode;

class Emp extends \Magento\Framework\View\Element\Template
{
    protected $searchCriteriaBuilder;
    protected $filterBuilder;
    protected $_EmployeeCollectionFactory = null;
    protected $EmployeeFactory;
    protected $_EmployeeRepository;


    public function __construct(
        Context $context,
        EmployeeCollectionFactory $EmployeeCollectionFactory,EmployeeRepositoryInterface $EmployeeRepository,
        FilterBuilder $filterBuilder,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        EmployeeFactory $EmployeeFactory,
        array $data = []
    ) {
        $this->EmployeeFactory = $EmployeeFactory;
        $this->_EmployeeRepository=$EmployeeRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterBuilder = $filterBuilder;
        $this->_EmployeeCollectionFactory  = $EmployeeCollectionFactory;
        parent::__construct($context, $data);
    }

    public function getAddCarPostUrl() {

        return $this->getUrl('empdata/index/savedata');
    }
    public function getDeleteurl() {

      //  print_r($data);exit;
        return $this->getUrl('empdata/index/delete');
    }


    public function getCollection()
    {
        
        $EmployeeCollection = $this->_EmployeeCollectionFactory ->create();
        $EmployeeCollection->addFieldToSelect('*')->load();
        return $EmployeeCollection->getItems();
    }
    public Function fetchData()
    {
        $_searchCriteriaBuilder = $this->searchCriteriaBuilder->create();
        $list =$this->_EmployeeRepository->getList($_searchCriteriaBuilder);
        return $list->getItems();
    }
}

