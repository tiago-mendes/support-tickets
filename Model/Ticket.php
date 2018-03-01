<?php
namespace Support\Tickets\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;

class Ticket extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = 'support_tickets_ticket';

    protected $_cacheTag = 'support_tickets_ticket';

    protected $_eventPrefix = 'support_tickets_ticket';

    protected function _construct()
    {
        $this->_init('Support\Tickets\Model\ResourceModel\Ticket');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}