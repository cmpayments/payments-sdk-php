<?php

namespace CMPayments\PaymentSdk\Test\Entities;

use CMPayments\PaymentSdk\Entities\PaypalPayment;
use Money\Money;

class PaypalPaymentTest extends \PHPUnit_Framework_TestCase
{
    public function testToArray()
    {
        $payment = new PaypalPayment(Money::EUR(500), 'test_purchase_id', 'test_description');

        $payload = $payment->toArray();

        $this->assertEquals('test_description', $payload['payment_details']['description']);
    }
}
