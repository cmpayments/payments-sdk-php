<?php

namespace CMPayments\PaymentSdk\Entities;

use Money\Money;

/**
 * Class IdealPayment
 * @package CMPayments\PaymentSdk\Entities
 * @author Jory Geerts <jory.geerts@cm.nl>
 */
class IdealPayment extends Payment
{
    /**
     * @var string
     */
    private $issuerId;
    /**
     * @var string
     */
    private $description;

    /**
     * IdealPayment constructor.
     * @param Money $money
     * @param string $issuers
     * @param string $purchaseId
     * @param string $description
     */
    public function __construct(Money $money, $issuers, $purchaseId, $description)
    {
        parent::__construct($money, 'iDEAL', $purchaseId);

        $this->issuerId = $issuers;
        $this->description = $description;
    }

    /** @inheritdoc */
    public function toArray()
    {
        $array = parent::toArray();
        $array['payment_details']['issuer_id'] = $this->issuerId;
        $array['payment_details']['description'] = $this->description;
        return $array;
    }
}
