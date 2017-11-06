<?php

namespace CMPayments\PaymentSdk\Entities;

use Money\Money;

/**
 * Class DirectDebitPayment
 * @package CMPayments\PaymentSdk\Entities
 * @author Jory Geerts <jory.geerts@cm.nl>
 */
class DirectDebitPayment extends Payment
{
    /**
     * @var string
     */
    private $description;
    /**
     * @var string
     */
    private $iban;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $mandateId;
    /**
     * @var \DateTime
     */
    private $mandateStartDate;
    /**
     * @var null|string
     */
    private $transactionDescription;

    /**
     * IdealPayment constructor.
     * @param Money $money
     * @param string $purchaseId
     * @param string $iban
     * @param string $name
     * @param string $mandateId
     * @param \DateTime $mandateStartDate
     * @param string $description
     * @param string $transactionDescription = null
     * @internal param string $bic
     */
    public function __construct(
        Money $money,
        $purchaseId,
        $iban,
        $name,
        $mandateId,
        \DateTime $mandateStartDate,
        $description,
        $transactionDescription = null
    ) {
        parent::__construct($money, 'DirectDebit', $purchaseId);

        $this->description = $description;
        $this->iban = $iban;
        $this->name = $name;
        $this->mandateId = $mandateId;
        $this->mandateStartDate = $mandateStartDate;
        $this->transactionDescription = $transactionDescription;
    }

    /** @inheritdoc */
    public function toArray()
    {
        $array = parent::toArray();
        $array['payment_details']['bank_account_number'] = $this->iban;
        $array['payment_details']['name'] = $this->name;
        $array['payment_details']['mandate_id'] = $this->mandateId;
        $array['payment_details']['mandate_start_date'] = $this->mandateStartDate->format('Y-m-d');
        $array['payment_details']['description'] = $this->description;

        if ($this->transactionDescription) {
            $array['payment_details']['transaction_description'] = $this->transactionDescription;
        }

        return $array;
    }
}
