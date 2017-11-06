<?php

namespace CMPayments\PaymentSdk\Test\Entities;

use CMPayments\PaymentSdk\Entities\IdealPayment;
use Money\Money;

class IdealPaymentTest extends \PHPUnit_Framework_TestCase
{

    public function testToArray()
    {
        $payment = new IdealPayment(Money::EUR(500), 'RABONL2U', 'test_purchase_id', 'test_description');

        $payload = $payment->toArray();

        $this->assertEquals('RABONL2U', $payload['payment_details']['issuer_id']);
        $this->assertEquals('test_description', $payload['payment_details']['description']);
    }
}
