<?php

namespace CMPayments\PaymentSdk\Test\Entities;

use CMPayments\PaymentSdk\Entities\Charge;
use CMPayments\PaymentSdk\Entities\Payment;
use Money\Money;

class ChargeTest extends \PHPUnit_Framework_TestCase
{

    public function testMultiplePayments()
    {
        $charge = new Charge(Money::EUR(1000), [new Payment(Money::EUR(500), 'test_method', 'test_purchase_id')]);
        $charge->addPayment(new Payment(Money::EUR(500), 'test_method2', 'test_purchase_id2'));

        $payload = $charge->toArray();

        $this->assertEquals(2, count($payload['payments']));
    }
}
