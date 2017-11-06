<?php

namespace CMPayments\PaymentSdk\Test\Request;

use CMPayments\PaymentSdk\Requests\IdealIssuerListRequest;

class IdealIssuerListRequestTest extends \PHPUnit_Framework_TestCase
{
    public function testRequestMethod()
    {
        $r = new IdealIssuerListRequest();
        $this->assertEquals('GET', $r->getRequestMethod());
    }

    public function testEndpoint()
    {
        $r = new IdealIssuerListRequest();
        $this->assertEquals('issuers/v1/ideal', $r->getEndpoint());
    }

    public function testPayload()
    {
        $r = new IdealIssuerListRequest();
        $this->assertEquals(null, $r->getPayload());
    }
}
