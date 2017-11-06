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

        $array = $this->setUrlIfAvailable($array, 'success_url', 'successUrl');
        $array = $this->setUrlIfAvailable($array, 'cancelled_url', 'cancelledUrl');
        $array = $this->setUrlIfAvailable($array, 'failed_url', 'failedUrl');
        $array = $this->setUrlIfAvailable($array, 'expired_url', 'expiredUrl');
        $array = $this->setUrlIfAvailable($array, 'callback_url', 'callbackUrl');

        return $array;
    }

    /**
     * Set a URL in the array structure if it is available.
     *
     * @param array $structure
     * @param string $jsonNode
     * @param string $propertyName
     * @return array
     */
    private function setUrlIfAvailable($structure, $jsonNode, $propertyName)
    {
        if (!empty($this->$propertyName)) {
            $structure['payment_details'][$jsonNode] = $this->$propertyName;
        }

        return $structure;
    }
}
