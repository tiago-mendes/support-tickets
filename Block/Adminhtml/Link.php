<?php
namespace Support\Tickets\Block\Adminhtml;

use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;

class Link extends AbstractRenderer
{
    protected function _construct()
    {   
        parent::_construct();
    }
    
    public function render(\Magento\Framework\DataObject $row){
        return '<a href="' . $this->getUrl('*/*/edit', array('ticket_id' => $row->getId())) . '">edit</a>';        
    }
}