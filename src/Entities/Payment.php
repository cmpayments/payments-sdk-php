<?php

namespace CMPayments\PaymentSdk\Entities;

use CMPayments\PaymentSdk\MoneyConverter;
use Money\Money;

/**
 * Class Payment
 * @package CMPayments\PaymentSdk\Entities
 * @author Jory Geerts <jory.geerts@cm.nl>
 */
class Payment
{
    /**
     * @var Money
     */
    private $money;
    /**
     * @var string
     */
    private $method;
    /**
     * @var string
     */
    private $purchaseId;
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
    private $expiredUrl;
    /**
     * @var string
     */
    private $callbackUrl;


    /**
     * Payment constructor.
     * @param Money $money
     * @param string $method
     * @param string $purchaseId
     */
    public function __construct(Money $money, $method, $purchaseId)
    {
        $this->money = $money;
        $this->method = $method;
        $this->purchaseId = $purchaseId;
    }

    /**
     * @param string $successUrl
     * @return Payment
     */
    public function setSuccessUrl($successUrl)
    {
        $this->successUrl = $successUrl;
        return $this;
    }

    /**
     * @param string $failedUrl
     * @return Payment
     */
    public function setFailedUrl($failedUrl)
    {
        $this->failedUrl = $failedUrl;
        return $this;
    }

    /**
     * @param string $cancelledUrl
     * @return Payment
     */
    public function setCancelledUrl($cancelledUrl)
    {
        $this->cancelledUrl = $cancelledUrl;
        return $this;
    }

    /**
     * @param string $expiredUrl
     * @return Payment
     */
    public function setExpiredUrl($expiredUrl)
    {
        $this->expiredUrl = $expiredUrl;
        return $this;
    }

    /**
     * @param string $callbackUrl
     * @return Payment
     */
    public function setCallbackUrl($callbackUrl)
    {
        $this->callbackUrl = $callbackUrl;
        return $this;
    }

    /**
     * Create an array that represents all the required data to create a payment.
     *
     * @return array
     */
    public function toArray()
    {
        $array = [
            'amount'          => (new MoneyConverter())->toFloat($this->money),
            'currency'        => $this->money->getCurrency(),
            'payment_method'  => $this->method,
            'payment_details' => [
                'purchase_id' => $this->purchaseId,
            ],
        ];

        if (!empty($this->successUrl)) {
            $array['payment_details']['success_url'] = $this->successUrl;
        }
        if (!empty($this->cancelledUrl)) {
            $array['payment_details']['cancelled_url'] = $this->cancelledUrl;
        }
        if (!empty($this->failedUrl)) {
            $array['payment_details']['failed_url'] = $this->failedUrl;
        }
        if (!empty($this->expiredUrl)) {
            $array['payment_details']['expired_url'] = $this->expiredUrl;
        }
        if (!empty($this->callbackUrl)) {
            $array['payment_details']['callback_url'] = $this->callbackUrl;
        }

        return $array;
    }
}
