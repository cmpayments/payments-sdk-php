<?php

namespace CMPayments\PaymentSdk\Test;

use CMPayments\GuzzlePSPAuthenticationMiddleware\AuthenticationMiddleware;
use CMPayments\PaymentSdk\Credentials;
use CMPayments\PaymentSdk\Gateway;
use CMPayments\PaymentSdk\MoneyConverter;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use function GuzzleHttp\Psr7\stream_for;

/**
 * Class Common
 *
 * @package CMPayments\PaymentSdk\Test
 * @author  Michel Westerink <michel.westerink@cmtelecom.com>
 */
class Common extends \PHPUnit_Framework_TestCase
{

    const OAUTH_MERCHANT_KEY    = 'LmRVrL4i7byIhudrDxzojq8iDoZDQ3T0';
    const OAUTH_MERCHANT_SECRET = '897021C41646C21423285A6EE3B7ED54E5EA047337FB719A5F57B3130700A2DA';

    const ISSUER_ID = 'RABONL2U';

    /**
     * Amount
     */
    const AMOUNT = 15.95;

    /**
     * Currency
     */
    const CURRENCY = 'EUR';

    /**
     * @return string
     */
    public function getDescription()
    {
        return 'PaymentSDKtestDescription' . microtime(true);
    }

    /**
     * @return string
     */
    public function getPurchaseId()
    {
        return 'PaymentSDKtestPurchaseId' . microtime(true);
    }

    /**
     * Create credentials
     *
     * @return Credentials
     */
    public function createCredentials()
    {
        return new Credentials(self::OAUTH_MERCHANT_KEY, self::OAUTH_MERCHANT_SECRET);
    }

    /**
     * @param $amount
     * @param $currency
     *
     * @return Money
     */
    public function createMoney()
    {
        return (new MoneyConverter())->fromAmountAndCurrency(self::AMOUNT, self::CURRENCY);
    }

    /**
     * @param Credentials $credentials
     *
     * @return AuthenticationMiddleware
     */
    public function createAuth()
    {
        return new AuthenticationMiddleware(self::OAUTH_MERCHANT_KEY, self::OAUTH_MERCHANT_SECRET);
    }

    /**
     * @param Credentials $credentials
     * @param bool        $mocked
     *
     * @return Gateway
     */
    public function createGateway(Credentials $credentials, $mocked = false)
    {
        $httpClient = null;
        if ($mocked) {
            $body = stream_for(\GuzzleHttp\json_encode(['status' => 'success']));
            $mockHandler = new MockHandler([
                new Response(200, [], $body)
            ]);
            $stack = HandlerStack::create($mockHandler);
            $AuthenticationMiddleware = $this->createAuth();
            $stack->push($AuthenticationMiddleware);
            $httpClient = new Client(['base_uri' => Gateway::API_URL, 'handler' => $stack]);
        }

        return new Gateway($credentials, $httpClient);
    }
}
