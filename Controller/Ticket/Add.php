<?php
namespace Support\Tickets\Controller\Ticket;

use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Customer\Model\Session;

class Add extends Action
{
    protected $_customerSession;
    
    public function __construct(Context $context, PageFactory $pageFactory, Session $customerSession)
    {
        $this->_pageFactory = $pageFactory;
        $this->_customerSession = $customerSession;
       // $this->_pageFactory = $pageFactory;
        return parent::__construct($context);
    }

    public function execute()
    {        
        $id_owner = $this->_customerSession->getCustomer()->getId();
        
        $post_ticket = $this->_request->getParams(); 
        
        try 
        {
            if (empty($post_ticket['title'])) {
                throw new Exception('Enter values!');
            }
            
            $resultRedirect = $this->resultRedirectFactory->create();
         
            $model = $this->_objectManager->create('Support\Tickets\Model\Ticket');
            $model->setTitle($post_ticket['title']);
            $model->setDescription($post_ticket['description']);
            $model->setCreationDate(date('Y-m-d'));
            $model->setIsActive('1');
            $model->setIdOwner($id_owner);
            
            if ($model->save()) 
            {
                $this->messageManager->addSuccess(__('Thanks for contacting us with your comments and questions. We\'ll respond to you very soon.'));
                $resultRedirect->setUrl($this->_redirect('support_tickets/ticket'));
            } 
            else 
            {
                $this->messageManager->addError($e->getMessage());
            }
       } 
       catch (Exception $e) 
       {
           $this->messageManager->addError($e->getMessage());
           $resultRedirect->setUrl($this->_redirect('support_tickets/ticket'));
       }

        return $this->_pageFactory->create();
    } 
}