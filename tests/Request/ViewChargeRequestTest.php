<?php

namespace CMPayments\PaymentSdk\Test\Request;

use CMPayments\PaymentSdk\Requests\ViewChargeRequest;

class ViewChargeRequestTest extends \PHPUnit_Framework_TestCase
{
    public function testRequestMethod()
    {
        $r = new ViewChargeRequest('ch-12345');
        $this->assertEquals('GET', $r->getRequestMethod());
    }

    public function testEndpoint()
    {
        $r = new ViewChargeRequest('ch-12345');
        $this->assertEquals('charges/v1/ch-12345', $r->getEndpoint());
    }

    public function testPayload()
    {
        $r = new ViewChargeRequest('ch-12345');
        $this->assertEquals(null, $r->getPayload());
    }
}
