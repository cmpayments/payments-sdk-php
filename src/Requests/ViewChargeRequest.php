<?php

namespace CMPayments\PaymentSdk\Requests;

/**
 * Class ViewChargeRequest
 * @package CMPayments\PaymentSdk\Requests
 * @author Jory Geerts <jory.geerts@cm.nl>
 */
class ViewChargeRequest implements RequestInterface
{
    /**
     * @var string
     */
    private $chargeId;

    /**
     * ViewChargeRequest constructor.
     */
    public function __construct($chargeId)
    {
        $this->chargeId = $chargeId;
    }


    /**
     * Get the Guzzle uri
     *
     * @return string The Guzzle uri
     */
    public function getEndpoint()
    {
        return 'charges/v1/' . $this->chargeId;
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
