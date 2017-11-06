<?php

namespace CMPayments\PaymentSdk\Test\Entities;

use CMPayments\PaymentSdk\Entities\CreditCardPayment;
use Money\Money;

class CreditCardPaymentTest extends \PHPUnit_Framework_TestCase
{
    public function testToArray()
    {
        $payment = new CreditCardPayment(
            Money::EUR(500),
            ['VISA'],
            'test_purchase_id',
            new \DateTime('2017-06-07 12:23:45', new \DateTimeZone('UTC'))
        );

        $payload = $payment->toArray();

        $this->assertEquals(['VISA'], $payload['payment_details']['issuers']);
        $this->assertEquals('2017-06-07T12:23:45+00:00', $payload['due_date']);
        $this->assertEquals(true, $payload['capture']);
    }
}
