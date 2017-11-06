<?php

namespace CMPayments\PaymentSdk\Entities;

use Money\Money;

/**
 * Class PaypalPayment
 * @package CMPayments\PaymentSdk\Entities
 * @author Jory Geerts <jory.geerts@cm.nl>
 */
class SofortPayment extends Payment
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
     * @var string
     */
    private $bic;
    /**
     * @var string
     */
    private $iban;
    /**
     * @var string
     */
    private $name;

    /**
     * IdealPayment constructor.
     * @param Money $money
     * @param string $purchaseId
     * @param string $bic
     * @param string $iban
     * @param string $name
     * @param string $description
     */
    public function __construct(Money $money, $purchaseId, $bic, $iban, $name, $description)
    {
        parent::__construct($money, 'SOFORT', $purchaseId);

        $this->description = $description;
        $this->bic = $bic;
        $this->iban = $iban;
        $this->name = $name;
    }

    /** @inheritdoc */
    public function toArray()
    {
        $array = parent::toArray();
        $array['payment_details']['bank_bic'] = $this->bic;
        $array['payment_details']['bank_account_number'] = $this->iban;
        $array['payment_details']['consumer_name'] = $this->name;
        $array['payment_details']['description'] = $this->description;
        return $array;
    }
}
