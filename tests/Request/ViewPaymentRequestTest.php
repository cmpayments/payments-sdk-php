<?php

namespace CMPayments\PaymentSdk\Test\Request;

use CMPayments\PaymentSdk\Requests\ViewPaymentRequest;

class ViewPaymentRequestTest extends \PHPUnit_Framework_TestCase
{
    public function testRequestMethod()
    {
        $r = new ViewPaymentRequest('pt-12345');
        $this->assertEquals('GET', $r->getRequestMethod());
    }

    public function testEndpoint()
    {
        $r = new ViewPaymentRequest('pt-12345');
        $this->assertEquals('payments/v1/pt-12345', $r->getEndpoint());
    }

    public function testPayload()
    {
        $r = new ViewPaymentRequest('pt-12345');
        $this->assertEquals(null, $r->getPayload());
    }
}
