<?php

namespace CMPayments\PaymentSdk;

/**
 * Credentials used to authenticate with the API.
 *
 * @package CMPayments\PaymentSdk
 * @author Jory Geerts <jory.geerts@cm.nl>
 */
class Credentials
{
    /**
     * @var string
     */
    private $merchantKey;
    /**
     * @var string
     */
    private $merchantSecret;

    /**
     * Credentials constructor.
     *
     * @param string $merchantKey
     * @param string $merchantSecret
     */
    public function __construct($merchantKey, $merchantSecret)
    {
        $this->merchantKey = $merchantKey;
        $this->merchantSecret = $merchantSecret;
    }

    /**
     * @return string
     */
    public function getMerchantKey()
    {
        return $this->merchantKey;
    }

    /**
     * @return string
     */
    public function getMerchantSecret()
    {
        return $this->merchantSecret;
    }
}
