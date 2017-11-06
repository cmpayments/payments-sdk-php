<?php

namespace CMPayments\PaymentSdk\Entities;

use Money\Money;

/**
 * Class BancontactPayment
 * @package CMPayments\PaymentSdk\Entities
 * @author Jory Geerts <jory.geerts@cm.nl>
 */
class BancontactPayment extends Payment
{
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
     * @param \DateTime $expiryDate
     */
    public function __construct(Money $money, $purchaseId, \DateTime $expiryDate = null)
    {
        parent::__construct($money, 'Bancontact', $purchaseId);

        $this->dueDate = $expiryDate;
    }

    /** @inheritdoc */
    public function toArray()
    {
        $array = parent::toArray();
        $array['capture'] = true;

        if ($this->dueDate) {
            $array['due_date'] = $this->dueDate->format(DATE_RFC3339);
        }

        $array['payment_details']['issuers'] = ['BCMC'];
        return $array;
    }
}
