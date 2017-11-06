<?php

namespace CMPayments\PaymentSdk\Test\Entities;

use CMPayments\PaymentSdk\Entities\WireTransferPayment;
use Money\Money;

class WireTransferPaymentTest extends \PHPUnit_Framework_TestCase
{
    public function testToArray()
    {
        $payment = new WireTransferPayment(
            Money::EUR(500),
            'test_purchase_id',
            new \DateTime('2017-06-07 12:23:45', new \DateTimeZone('UTC'))
        );

        $payload = $payment->toArray();

        $this->assertEquals('2017-06-07T12:23:45Z', $payload['expires_at']);
    }
}
