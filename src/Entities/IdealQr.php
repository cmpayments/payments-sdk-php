<?php

namespace CMPayments\PaymentSdk\Entities;

use CMPayments\PaymentSdk\MoneyConverter;
use Money\Money;

/**
 * Class IdealQr
 *
 * @package CMPayments\PaymentSdk\Entities
 * @author  Michel Westerink <michel.westerink@cmtelecom.com>
 */
class IdealQr
{
    /**
     * @var Money
     */
    private $amount;

    /**
     * @var boolean
     */
    private $amountChangeable;

    /**
     * @var Money
     */
    private $amountMin;

    /**
     * @var Money
     */
    private $amountMax;

    /**
     * @var string
     */
    private $beneficiary;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \DateTime
     */
    private $expiration;

    /**
     * @var boolean
     */
    private $oneOff;

    /**
     * @var string
     */
    private $purchaseId;

    /**
     * @var int
     */
    private $size;

    /**
     * @var string
     */
    private $successUrl;

    /**
     * @var string
     */
    private $failedUrl;

    /**
     * @var string
     */
    private $cancelledUrl;

    /**
     * @var string
     */
    private $callbackUrl;

    /**
     * @var string
     */
    private $expiredUrl;

    /**
     * @param Money $amount
     */
    public function setAmount(Money $amount)
    {
        $this->amount = $amount;
    }

    /**
     * @param bool $amountChangeable
     */
    public function setAmountChangeable($amountChangeable)
    {
        $this->amountChangeable = $amountChangeable;
    }

    /**
     * @param Money $amountMin
     */
    public function setAmountMin(Money $amountMin)
    {
        $this->amountMin = $amountMin;
    }

    /**
     * @param Money $amountMax
     */
    public function setAmountMax(Money $amountMax)
    {
        $this->amountMax = $amountMax;
    }

    /**
     * @param string $beneficiary
     */
    public function setBeneficiary($beneficiary)
    {
        $this->beneficiary = $beneficiary;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param \DateTime $expiration
     */
    public function setExpiration(\DateTime $expiration)
    {
        $this->expiration = $expiration;
    }

    /**
     * @param bool $oneOff
     */
    public function setOneOff($oneOff)
    {
        $this->oneOff = $oneOff;
    }

    /**
     * @param string $purchaseId
     */
    public function setPurchaseId($purchaseId)
    {
        $this->purchaseId = $purchaseId;
    }

    /**
     * @param int $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @param string $successUrl
     */
    public function setSuccessUrl($successUrl)
    {
        $this->successUrl = $successUrl;
    }

    /**
     * @param string $failedUrl
     */
    public function setFailedUrl($failedUrl)
    {
        $this->failedUrl = $failedUrl;
    }

    /**
     * @param string $cancelledUrl
     */
    public function setCancelledUrl($cancelledUrl)
    {
        $this->cancelledUrl = $cancelledUrl;
    }

    /**
     * @param string $callbackUrl
     */
    public function setCallbackUrl($callbackUrl)
    {
        $this->callbackUrl = $callbackUrl;
    }

    /**
     * @param string $expiredUrl
     */
    public function setExpiredUrl($expiredUrl)
    {
        $this->expiredUrl = $expiredUrl;
    }

    /** @inheritdoc */
    public function toArray()
    {
        $array = [];
        // Required
        $array['amount'] = (new MoneyConverter())->toFloat($this->amount);
        $array['amount_changeable'] = $this->amountChangeable;
        $array['description'] = $this->description;
        $array['one_off'] = $this->oneOff;
        $array['expiration'] = $this->expiration->format('Y-m-d H:i:s');
        $array['beneficiary'] = $this->beneficiary;
        $array['purchase_id'] = $this->purchaseId;
        $array['size'] = $this->size;

        // Optional
        if ($this->amountMin !== null) {
            $array['amount_min'] = (new MoneyConverter())->toFloat($this->amountMin);
        }

        if ($this->amountMax !== null) {
            $array['amount_max'] = (new MoneyConverter())->toFloat($this->amountMax);
        }

        if ($this->successUrl !== null) {
            $array['success_url'] = $this->successUrl;
        }

        if ($this->failedUrl !== null) {
            $array['failed_url'] = $this->failedUrl;
        }

        if ($this->cancelledUrl !== null) {
            $array['cancelled_url'] = $this->cancelledUrl;
        }

        if ($this->expiredUrl !== null) {
            $array['expired_url'] = $this->expiredUrl;
        }

        if ($this->callbackUrl !== null) {
            $array['callback_url'] = $this->callbackUrl;
        }

        return $array;
    }
}
