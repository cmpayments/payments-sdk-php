<?php

namespace CMPayments\PaymentSdk\Test\Entities;

use CMPayments\PaymentSdk\Entities\BancontactPayment;
use Money\Money;

class BancontactPaymentTest extends \PHPUnit_Framework_TestCase
{
    public function testToArray()
    {
        $payment = new BancontactPayment(
            Money::EUR(500),
            'test_purchase_id',
            new \DateTime('2017-06-07 12:23:45', new \DateTimeZone('UTC'))
        );

        $payload = $payment->toArray();

        $this->assertEquals(['BCMC'], $payload['payment_details']['issuers']);
        $this->assertEquals('2017-06-07T12:23:45+00:00', $payload['due_date']);
    }
}
