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

    class Savedata extends Action

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
           
            $data = $this->getRequest()->getParams();
            // $EmpId =$data['emp_id'];
            $Name =$data['Name'];
            $Email =$data['Email'];
            $Telephone =$data['Telephone'];
            
            $EmployeeModel = $this->_EmployeeModel;
        // $this->_EmployeeModel->setEmpId($EmpId);
           $val1=   $this->_EmployeeModel->setName($Name);
           $val2= $this->_EmployeeModel->setEmail($Email);
           $val3=  $this->_EmployeeModel->setTelephone($Telephone);

        try {
          
            /* Use the resource model to save the model in the DB */
            $this->_EmployeeRepository->save($EmployeeModel);
            $this->messageManager->addSuccessMessage("empdata saved successfully!");
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
            $this->messageManager->addErrorMessage(__("Error saving data"));
        }
    
        /* Redirect back to cars page */
        $redirect = $this->resultRedirectFactory->create();
        $redirect->setPath('empdata');
        return $redirect;

        }}
        ?>