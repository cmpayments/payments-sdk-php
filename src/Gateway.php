<?php

namespace CMPayments\PaymentSdk;

use CMPayments\GuzzlePSPAuthenticationMiddleware\AuthenticationMiddleware;
use CMPayments\PaymentSdk\Requests\RequestInterface;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\HandlerStack;

/**
 * Gateway to the payments API.
 *
 * @package CMPayments\PaymentSdk
 * @author Jory Geerts <jory.geerts@cm.nl>
 */
class Gateway
{
    const API_URL = 'https://api.cmpayments.com/';

    const REQUEST_METHOD_POST = 'POST';
    const REQUEST_METHOD_GET = 'GET';

    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * Gateway constructor.
     * @param Credentials $credentials
     * @param HttpClient|null $httpClient
     */
    public function __construct(Credentials $credentials, HttpClient $httpClient = null)
    {
        if (!$httpClient) {
            $httpClient = new HttpClient([
                'base_uri' => static::API_URL
            ]);
        }
        $this->httpClient = $httpClient;

        /** @var HandlerStack $handlerStack */
        $handlerStack = $httpClient->getConfig('handler');
        $handlerStack->push(
            new AuthenticationMiddleware(
                $credentials->getMerchantKey(),
                $credentials->getMerchantSecret()
            )
        );
    }

    /**
     * Execute a request against the Payments API.
     *
     * @param RequestInterface $request
     * @param array $headers
     * @return array
     */
    public function execute(RequestInterface $request, array $headers = [])
    {
        $options = [
            'json' => $request->getPayload(),
        ];

        if (\count($headers)) {
            $options['headers'] = $headers;
        }

        $guzzleResponse = $this->httpClient->request(
            $request->getRequestMethod(),
            $request->getEndpoint(),
            $options
        );

        return \GuzzleHttp\json_decode($guzzleResponse->getBody()->getContents());
    }
}
