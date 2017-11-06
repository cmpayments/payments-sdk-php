<?php

namespace CMPayments\PaymentSdk\Test\Request;

use CMPayments\PaymentSdk\Entities\Charge;
use CMPayments\PaymentSdk\Entities\Payment;
use CMPayments\PaymentSdk\Requests\CreateChargeRequest;
use Money\Money;

class CreateChargeRequestTest extends \PHPUnit_Framework_TestCase
{
    private function getCharge(Money $money)
    {
        return new Charge(
            $money,
            [new Payment($money, 'test', '12345')]
        );
    }

    public function testRequestMethod()
    {
        $r = new CreateChargeRequest($this->getCharge(Money::EUR(500)));

        $this->assertEquals('POST', $r->getRequestMethod());
    }

    public function testEndpoint()
    {
        $r = new CreateChargeRequest($this->getCharge(Money::EUR(500)));

        $this->assertEquals('charges/v1', $r->getEndpoint());
    }

    public function testPayload()
    {
        $r = new CreateChargeRequest($this->getCharge(Money::EUR(500)));
        $p = $r->getPayload();

        $this->assertInternalType('array', $p);
        $this->assertEquals('5.00', $p['amount']);
        $this->assertEquals('EUR', $p['currency']);
        $this->assertEquals(1, count($p['payments']));
    }
}
