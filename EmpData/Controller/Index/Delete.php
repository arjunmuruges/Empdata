<?php
namespace Arjun\EmpData\Controller\Index;

    use Magento\Framework\App\Action\Action;
    use Magento\Framework\App\Action\Context;
    use Magento\Framework\Exception\CouldNotSaveException;
    use Magento\Framework\Exception\LocalizedException;
    use Magento\Framework\Exception\NoSuchEntityException;
    use Magento\Framework\View\Result\PageFactory;

    use Arjun\EmpData\Api\EmployeeRepositoryInterface;
    
    use Arjun\EmpData\Api\Data\EmployeeInterface;

    class Delete extends Action

    {
        protected $_pageFactory;

        protected $_EmployeeRepository;
        protected $_EmployeeModel;


        public function __construct(
            Context $context,
            PageFactory $pageFactory,
            EmployeeRepositoryInterface $EmployeeRepository,
            EmployeeInterface $EmployeeInterface
        ) {
            $this->_pageFactory = $pageFactory;
            $this->_EmployeeRepository=$EmployeeRepository;
            $this->_EmployeeModel = $EmployeeInterface;
            return parent::__construct($context);
        }

        public function execute()
        {
            $EmpId=$_GET['emp_id'];      
                   $this->_EmployeeRepository->deleteById($EmpId); 
                   $redirect = $this->resultRedirectFactory->create();
                   $redirect->setPath('empdata');
                   return $redirect;                                  
        
            }   
            }