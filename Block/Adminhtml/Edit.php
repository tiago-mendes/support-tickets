<?php
namespace Support\Tickets\Block\Adminhtml;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Support\Tickets\Model\TicketFactory;
use Magento\Customer\Model\Session;

class Edit extends Template
{    
    protected $_ticketFactory;
    protected $_customerSession;
    
    public function __construct(Context $context,TicketFactory $ticketFactory, Session $customerSession)
    {        
        $this->_ticketFactory = $ticketFactory;
        $this->_customerSession = $customerSession;
        parent::__construct($context);
        $this->pageConfig->getTitle()->set(__('Edit Tickets'));
    }
    
    public function getTicketID() 
    {   
        $_ticket = $this->_request->getParams();        
        
        return $_ticket['ticket_id'];
    }
    
    public function getTicketData($ticket_id){
        $ticket_factory = $this->_ticketFactory->create();
       
        $ticket_data = $ticket_factory->load($ticket_id);

        return $ticket_data;
    }
    
    public function getFormKey() 
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance(); 
        $FormKey = $objectManager->get('Magento\Framework\Data\Form\FormKey'); 
        return $FormKey->getFormKey();
    }
}