<?php

namespace CMPayments\PaymentSdk\Requests;

/**
 * Class ViewChargeRequest
 * @package CMPayments\PaymentSdk\Requests
 * @author Jory Geerts <jory.geerts@cm.nl>
 */
class ViewPaymentRequest implements RequestInterface
{
    /**
     * @var string
     */
    private $paymentId;

    /**
     * ViewChargeRequest constructor.
     */
    public function __construct($paymentId)
    {
        $this->paymentId = $paymentId;
    }


    /**
     * Get the Guzzle uri
     *
     * @return string The Guzzle uri
     */
    public function getEndpoint()
    {
        return 'payments/v1/' . $this->paymentId;
    }

    /**
     * Get the request type
     *
     * @return string The request type
     */
    public function getRequestMethod()
    {
        return 'GET';
    }

    /**
     * Get the actual request data
     *
     * @return array[] The payload
     */
    public function getPayload()
    {
        return null;
    }
}
