<?php
namespace Support\Tickets\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Support\Tickets\Model\TicketFactory;
use Magento\Customer\Model\Session;

class Main extends Template
{    
    protected $_ticketFactory;
    protected $_customerSession;
    
    public function __construct(Context $context,TicketFactory $ticketFactory, Session $customerSession)
    {
        $this->_ticketFactory = $ticketFactory;
        $this->_customerSession = $customerSession;
        parent::__construct($context);
        $this->pageConfig->getTitle()->set(__('Lista Tickets'));
    }

    public function getTicketCollection(){
       $page = ($this->getRequest()->getParam('p')) ? $this->getRequest()->getParam('p') : 1;
       return $this->getTicketFactory()->getCollection()->setPageSize(10)->setCurPage($page);
    }
    
    /**
    * Build the pagination, xml need to cache:flush
    *
    * @return string
    */
    protected function _prepareLayout()
    {
        $collection = $this->getTicketFactory()->getCollection();
        parent::_prepareLayout();

        if ($collection) 
        {
           // create pager block for collection
           $pager = $this->getLayout()->createBlock('Magento\Theme\Block\Html\Pager', 'my.custom.pager');

           // // assign collection to pager
           $pager->setLimit(10)->setCollection($collection);
           $pager->setAvailableLimit([10 => 10, 20 => 20, 50 => 50, 100 => 100]);
           $this->setChild('pager', $pager); // set pager block in layout
        }
        return $this;
    }

    public function getPagerHtml()
    {
       return $this->getChildHtml('pager');
    }
   
    public function getTicketFactory() {
        return $this->_ticketFactory->create();
    }

    /**
    * method set the factory
    *
    * @return string
    */
    public function setTicketFactory($_ticketFactory) {
        $this->_ticketFactory = $_ticketFactory;
    }
    
    public function getFormAction()
    {
        return '/support_tickets/ticket/add';        
    }
}