<?php
namespace Support\Tickets\Controller\Ticket;

use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\Action;
use Support\Tickets\Model\TicketFactory;
use Magento\Customer\Model\Session;
use Magento\Framework\Controller\ResultFactory;

class Index extends Action
{
    protected $_pageFactory;
    protected $_ticketFactory;
    protected $_customerSession;
    protected $_resultFactory;

    public function __construct(Context $context, PageFactory $pageFactory,TicketFactory $ticketFactory, Session $customerSession, ResultFactory $resultFactory)
    {
        $this->_pageFactory = $pageFactory;
        $this->_resultFactory = $resultFactory;
        $this->_ticketFactory = $ticketFactory;
        $this->_customerSession = $customerSession;
        
        
        return parent::__construct($context);
    }

    public function execute()
    {
        
        $resultRedirect = $this->_resultFactory->create(ResultFactory::TYPE_REDIRECT);
        if (!$this->_customerSession->isLoggedIn()) {
//
           $resultRedirect->setPath('customer/account/login');
           return $resultRedirect;
        }
        
        $ticket = $this->_ticketFactory->create();

        $collection = $ticket->getCollection();

        return $this->_pageFactory->create();  
        
    } 
    
    
}