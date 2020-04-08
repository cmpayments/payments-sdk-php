<?php

namespace CMPayments\PaymentSdk\Requests;

use CMPayments\PaymentSdk\Entities\Charge;
use CMPayments\PaymentSdk\Entities\IdealQr;
use CMPayments\PaymentSdk\Gateway;
use Money\Currencies\ISOCurrencies;
use Money\Money;

/**
 * Class CreateChargeRequest
 *
 * @package CMPayments\PaymentSdk
 * @author  Michel Westerink <michel.westerink@cmtelecom.com>
 */
class CreateBatchQrRequest implements RequestInterface
{
    /**
     * Default endpoint (Uri in Guzzle context)
     */
    const ENDPOINT = 'qr/v1/genereate-batch';

    /**
     * @var IdealQr[]
     */
    private $codes;

    /**
     * @var string
     */
    private $batchId;


    /**
     * CreateChargeRequest constructor.
     */
    public function __construct(string $batchId)
    {
        $this->batchId = $batchId;
    }

    /**
     * Add qr-code to the batch
     *
     * @param IdealQr $idealQr
     */
    public function addQrCodeToBatch(IdealQr $idealQr)
    {
        $this->codes[] = $idealQr->toArray();
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
            'id' => $this->batchId,
            'data' => $this->codes
        ];
    }
}
