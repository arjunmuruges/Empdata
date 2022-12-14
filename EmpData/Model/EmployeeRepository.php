<?php
namespace Arjun\EmpData\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

use Arjun\EmpData\Api\EmployeeRepositoryInterface;
use Arjun\EmpData\Api\Data\EmployeeInterface;
use Arjun\EmpData\Model\EmployeeFactory;
use Arjun\EmpData\Model\ResourceModel\Employee as ObjectResourceModel;
use Arjun\EmpData\Model\ResourceModel\Employee\CollectionFactory;


class EmployeeRepository implements EmployeeRepositoryInterface
{
    protected $objectFactory;
    protected $objectResourceModel;
    protected $collectionFactory;
    protected $searchResultsFactory;

  
    public function __construct(
        EmployeeFactory $objectFactory,
        ObjectResourceModel $objectResourceModel,
        CollectionFactory $collectionFactory,
        SearchResultsInterfaceFactory $searchResultsFactory
    ) {
        $this->objectFactory        = $objectFactory;
        $this->objectResourceModel  = $objectResourceModel;
        $this->collectionFactory    = $collectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
    }

   
    public function save(EmployeeInterface $object)
    {
        try {
            $this->objectResourceModel->save($object);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }
        return $object;
    }

    public function getById($EmpId)
    {
        $object = $this->objectFactory->create();
        $this->objectResourceModel->load($object, $EmpId);
        if (!$object->getEmpId()) {
            throw new NoSuchEntityException(__('Object with id "%1" does not exist.', $EmpId));
        }
        return $object;
    }

    /**
     * @inheritDoc
     */
    public function delete(EmployeeInterface $object)
    {
        try {
            $this->objectResourceModel->delete($object);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

   
    public function deleteById($EmpId)
    {
        return $this->delete($this->getById($EmpId));
    }

   
    public function getList(SearchCriteriaInterface $criteria)
    {
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $collection = $this->collectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            $fields = [];
            $conditions = [];
            foreach ($filterGroup->getFilters() as $filter) {
                $condition = $filter->getConditionType() ? $filter->getConditionType() : 'eq';
                $fields[] = $filter->getField();
                $conditions[] = [$condition => $filter->getValue()];
            }
            if ($fields) {
                $collection->addFieldToFilter($fields, $conditions);
            }
        }
        $searchResults->setTotalCount($collection->getSize());
        $sortOrders = $criteria->getSortOrders();
        if ($sortOrders) {
            /** @var SortOrder $sortOrder */
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());
        $objects = [];
        foreach ($collection as $objectModel) {
            $objects[] = $objectModel;
        }
        $searchResults->setItems($objects);
        return $searchResults;
    }
}