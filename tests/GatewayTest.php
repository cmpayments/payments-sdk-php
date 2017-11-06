<?php

namespace CMPayments\PaymentSdk\Test;

use CMPayments\PaymentSdk\Credentials;
use CMPayments\PaymentSdk\Gateway;
use CMPayments\PaymentSdk\Requests\IdealIssuerListRequest;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class GatewayTest extends \PHPUnit_Framework_TestCase
{

    protected function createGateway(Response $response)
    {
        $mockHandler = new MockHandler([$response]);
        $stack = HandlerStack::create($mockHandler);
        $httpClient = new Client(['base_uri' => Gateway::API_URL, 'handler' => $stack]);

        return new Gateway(
            new Credentials('key', 'secret'),
            $httpClient
        );
    }

    public function testSuccessfulRequest()
    {
        $gateway = $this->createGateway(new Response(200, [], '{"status": "test_successful"}'));

        $response = $gateway->execute(new IdealIssuerListRequest());

        $this->assertInternalType('object', $response);
        $this->assertEquals("test_successful", $response->status);
    }


    /**
     * @expectedException \GuzzleHttp\Exception\ClientException
     */
    public function testUnauthenticatedRequest()
    {
        $gateway = $this->createGateway(new Response(403, [], '{"status": "not_authenticated"}'));

        $response = $gateway->execute(new IdealIssuerListRequest());
    }

    /**
     * @expectedException \GuzzleHttp\Exception\ClientException
     */
    public function testBadRequest()
    {
        $gateway = $this->createGateway(new Response(400, [], '{"status": "bad_request"}'));

        $response = $gateway->execute(new IdealIssuerListRequest());
    }

    /**
     * @expectedException \GuzzleHttp\Exception\ServerException
     */
    public function testServerError()
    {
        $gateway = $this->createGateway(new Response(500, [], '{"status": "server_exception"}'));

        $response = $gateway->execute(new IdealIssuerListRequest());
    }

    public function testDefaultClient()
    {
        //  Make the httpClient public, so we can do stuff with it
        $httpClientProperty = (new \ReflectionClass(Gateway::class))->getProperty('httpClient');
        $httpClientProperty->setAccessible(true);

        $gateway = new Gateway(new Credentials('key', 'secret'));

        $this->assertEquals(
            'https://api.cmpayments.com/',
            $httpClientProperty->getValue($gateway)->getConfig('base_uri')->__toString()
        );
    }
}
