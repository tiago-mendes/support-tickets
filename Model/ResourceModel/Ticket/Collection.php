<?php
namespace Support\Tickets\Model\ResourceModel\Ticket;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'ticket_id';
    protected $_eventPrefix = 'support_tickets_ticket_collection';
    protected $_eventObject = 'ticket_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Support\Tickets\Model\Ticket', 'Support\Tickets\Model\ResourceModel\Ticket');
    }
}
