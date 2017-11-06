<?php

namespace CMPayments\PaymentSdk\Test\Entities;

use CMPayments\PaymentSdk\Entities\SofortPayment;
use Money\Money;

class SofortPaymentTest extends \PHPUnit_Framework_TestCase
{
    public function testToArray()
    {
        $payment = new SofortPayment(
            Money::EUR(500),
            'test_purchase_id',
            'CMPTNL3A',
            'NL52CMPT0000000020',
            'T Ester',
            'description'
        );

        $payload = $payment->toArray();

        $this->assertEquals('CMPTNL3A', $payload['payment_details']['bank_bic']);
        $this->assertEquals('NL52CMPT0000000020', $payload['payment_details']['bank_account_number']);
        $this->assertEquals('T Ester', $payload['payment_details']['consumer_name']);
        $this->assertEquals('description', $payload['payment_details']['description']);
    }
}
