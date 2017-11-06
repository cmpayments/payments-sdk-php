<?php

namespace CMPayments\PaymentSdk\Entities;

use Money\Money;

/**
 * Class CreditCardPayment
 * @package CMPayments\PaymentSdk\Entities
 * @author Jory Geerts <jory.geerts@cm.nl>
 */
class CreditCardPayment extends Payment
{
    /**
     * @var array
     */
    private $issuers;
    /**
     * @var \DateTime
     */
    private $dueDate;

    /**
     * CreditCardPayment constructor.
     *
     * @param Money $money
     * @param array $issuers
     * @param string $purchaseId
     * @param \DateTime $dueDate
     */
    public function __construct(Money $money, array $issuers, $purchaseId, \DateTime $dueDate = null)
    {
        parent::__construct($money, 'Creditcard', $purchaseId);

        $this->issuers = $issuers;
        $this->dueDate = $dueDate;
    }

    /** @inheritdoc */
    public function toArray()
    {
        $array = parent::toArray();
        $array['capture'] = true;

        if ($this->dueDate) {
            $array['due_date'] = $this->dueDate->format(DATE_RFC3339);
        }

        $array['payment_details']['issuers'] = $this->issuers;
        return $array;
    }
}
