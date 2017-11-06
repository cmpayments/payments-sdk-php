<?php

namespace CMPayments\PaymentSdk\Entities;

use Money\Money;

/**
 * Class PaypalPayment
 * @package CMPayments\PaymentSdk\Entities
 * @author Jory Geerts <jory.geerts@cm.nl>
 */
class PaypalPayment extends Payment
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
     * @param string $purchaseId
     * @param string $description
     */
    public function __construct(Money $money, $purchaseId, $description)
    {
        parent::__construct($money, 'PayPal', $purchaseId);

        $this->description = $description;
    }

    /** @inheritdoc */
    public function toArray()
    {
        $array = parent::toArray();
        $array['payment_details']['description'] = $this->description;
        return $array;
    }
}
