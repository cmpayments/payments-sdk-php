<?php

namespace CMPayments\PaymentSdk\Entities;

use Money\Money;

/**
 * Class WireTransferPayment
 * @package CMPayments\PaymentSdk\Entities
 * @author Jory Geerts <jory.geerts@cm.nl>
 */
class WireTransferPayment extends Payment
{
    /**
     * @var \DateTime
     */
    private $expiryDate;

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
        parent::__construct($money, 'WireTransfer', $purchaseId);

        $this->expiryDate = $expiryDate;
    }

    /** @inheritdoc */
    public function toArray()
    {
        $array = parent::toArray();

        if ($this->expiryDate) {
            $array['expires_at'] = $this->expiryDate->format('Y-m-d\TH:i:s\Z');
        }

        return $array;
    }
}
