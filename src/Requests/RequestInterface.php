<?php

namespace CMPayments\PaymentSdk\Requests;

/**
 * Interface RequestInterface
 *
 * @package CMPayments\PaymentSdk\Requests
 * @author  Michel Westerink <michel.westerink@cmtelecom.com>
 */
interface RequestInterface
{
    /**
     * Get the Guzzle uri
     *
     * @return string The Guzzle uri
     */
    public function getEndpoint();

    /**
     * Get the request type
     *
     * @return string The request type
     */
    public function getRequestMethod();


    /**
     * Get the actual request data
     *
     * @return array[] The payload
     */
    public function getPayload();
}
