<?php
namespace Support\Tickets\Block\Adminhtml;

use Magento\Backend\Block\Widget\Grid\Container;

class Ticket extends Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml_ticket';
        $this->_blockGroup = 'Support_Tickets';
        $this->_addButtonLabel = __('Create New Ticket');   
        
        parent::_construct();
    }
    
    public function getTicketId($row){
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));        
    }
}