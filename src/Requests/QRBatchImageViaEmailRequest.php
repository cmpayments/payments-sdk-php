<?php

namespace CMPayments\PaymentSdk\Requests;

use CMPayments\PaymentSdk\Gateway;
use Money\Currencies\ISOCurrencies;
use Money\Money;

/**
 * Class QRBatchImageViaEmailRequest
 *
 * @package CMPayments\PaymentSdk\Requests
 * @author  Michel Westerink <michel.westerink@cmtelecom.com>
 */
class QRBatchImageViaEmailRequest implements RequestInterface
{
    /**
     * Default endpoint (Uri in Guzzle context)
     */
    const ENDPOINT = 'qr/v1/batch/image';

    /**
     * @var string
     */
    private $batchId;

    /**
     * @var string
     */
    private $email;


    /**
     * CreateChargeRequest constructor.
     */
    public function __construct(string $batchId, string $email)
    {
        $this->batchId = $batchId;
        $this->email = $email;
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
        return [
            'batch_id' => $this->batchId,
            'email'    => $this->email
        ];
    }
}
