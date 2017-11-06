<?php

namespace CMPayments\PaymentSdk\Requests;

use CMPayments\PaymentSdk\Entities\Charge;
use CMPayments\PaymentSdk\Gateway;
use Money\Currencies\ISOCurrencies;
use Money\Money;

/**
 * Class CreateChargeRequest
 *
 * @package CMPayments\PaymentSdk
 * @author  Michel Westerink <michel.westerink@cmtelecom.com>
 */
class CreateChargeRequest implements RequestInterface
{
    /**
     * Default endpoint (Uri in Guzzle context)
     */
    const ENDPOINT = 'charges/v1';
    /**
     * @var Charge
     */
    private $charge;

    /**
     * CreateChargeRequest constructor.
     */
    public function __construct(Charge $charge)
    {
        $this->charge = $charge;
    }


    /**
     * Return the uri
     *
     * @return string The uri
     */
    public function getEndpoint()
    {
        return self::ENDPOINT;
    }

    /**
     * Return request method
     *
     * @return string This is the request type
     */
    public function getRequestMethod()
    {
        return Gateway::REQUEST_METHOD_POST;
    }


    /**
     * Retrieve the whole request
     *
     * @return string[] The complete request
     */
    public function getPayload()
    {
        return $this->charge->toArray();
    }
}
